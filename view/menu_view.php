<?php include 'header.php'; ?>

<h2>Restaurant Menu</h2>

<?php if (empty($items)): ?>
    <p>No menu items available.</p>
<?php else: ?>
    <?php
    // Group menu items by category
    $grouped = [];
    foreach ($items as $item) {
        $grouped[$item['category']][] = $item;
    }
    ?>

    <?php foreach ($grouped as $category => $menuItems): ?>
        <h3><?= htmlspecialchars($category ?? 'Uncategorized') ?></h3>
        <ul>
            <?php foreach ($menuItems as $item): ?>
                <li>
                    <strong><?= htmlspecialchars($item['name']) ?></strong> -
                    $<?= number_format($item['price'], 2) ?><br>
                    <em><?= htmlspecialchars($item['description']) ?></em>
                </li>
            <?php endforeach; ?>
        </ul>
        <hr>
    <?php endforeach; ?>
<?php endif; ?>

<?php include 'footer.php'; ?>
