 <?php
session_start();
require_once(__DIR__ . '/../controller/auth.php');
require_login();
require_admin();
include '../view/header.php';
?>

<h2>Edit Menu Item</h2>

<form action="../controller/admin_controller.php" method="post">
    <input type="hidden" name="action" value="update_menu_item">
    <input type="hidden" name="item_id" value="<?= htmlspecialchars($item['item_id']) ?>">

    <label>Name:</label><br>
    <input type="text" name="name" value="<?= htmlspecialchars($item['name']) ?>" required><br>

    <label>Price:</label><br>
    <input type="number" name="price" value="<?= htmlspecialchars($item['price']) ?>" step="0.01" required><br>

    <label>Category:</label><br>
    <input type="text" name="category" value="<?= htmlspecialchars($item['category']) ?>" required><br>

    <label>Description:</label><br>
    <textarea name="description" rows="4" cols="50"><?= htmlspecialchars($item['description']) ?></textarea><br>

    <button type="submit">Update Item</button>
</form>

<p><a href="../controller/admin_controller.php?action=manage_menu">Cancel</a></p>

<?php include '../view/footer.php'; ?>
