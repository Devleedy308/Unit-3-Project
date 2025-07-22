 <?php
require_once(__DIR__ . '/../controller/auth.php');
require_login();
require_admin();
include '../view/header.php';
?>

<h2>Manage Menu Items</h2>

<h3>Add New Menu Item</h3>
<form action="index.php?action=add_menu_item" method="post">
    <label for="name">Name:</label><br>
    <input type="text" name="name" id="name" required><br>

    <label for="price">Price:</label><br>
    <input type="number" name="price" id="price" step="0.01" min="0" required><br>

    <label for="category">Category:</label><br>
    <input type="text" name="category" id="category" required><br>

    <label for="description">Description:</label><br>
    <textarea name="description" id="description"></textarea><br>

    <button type="submit">Add Item</button>
</form>

<hr>

<h3>Current Menu Items</h3>
<?php if (empty($items)): ?>
    <p>No items in the menu yet.</p>
<?php else: ?>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Category</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($items as $item): ?>
            <tr>
                <td><?= htmlspecialchars($item['name']) ?></td>
                <td>$<?= number_format($item['price'], 2) ?></td>
                <td><?= htmlspecialchars($item['category']) ?></td>
                <td><?= htmlspecialchars($item['description']) ?></td>
                <td>
                    <a href="index.php?action=edit_menu_form&item_id=<?= $item['item_id'] ?>">Edit</a>

                    <form action="index.php?action=delete_menu_item" method="post" onsubmit="return confirm('Delete this item?');">
                        <input type="hidden" name="item_id" value="<?= $item['item_id'] ?>">
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>

<?php include '../view/footer.php'; ?>
