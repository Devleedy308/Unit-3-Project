 <?php include 'header.php'; ?>
<h2>Menu</h2>

<?php if (isset($_GET['added']) && $_GET['added'] == 'true'): ?>
    <p style="color: green;"><strong>Item added to cart!</strong></p>
<?php endif; ?>

<p><a href="/Unit-3-Project/controller/order_controller.php?action=view_cart">🛒 View Cart</a></p>

<?php if (!empty($items)) : ?>
    <div class="menu-grid">
        <?php foreach ($items as $item): ?>
            <div class="menu-card">
                <h3 class="menu-title"><?= htmlspecialchars($item['name']) ?></h3>
                <p class="menu-desc"><?= htmlspecialchars($item['description']) ?></p>
                <p class="menu-price">$<?= number_format($item['price'], 2) ?></p>
                <p class="menu-category"><?= htmlspecialchars($item['category']) ?></p>

                <form action="/Unit-3-Project/controller/order_controller.php" method="post" class="add-to-cart-form">
                    <input type="hidden" name="action" value="add_to_cart">
                    <input type="hidden" name="item_id" value="<?= $item['item_id'] ?>">
                    <input type="number" name="quantity" value="1" min="1" class="quantity-input">
                    <button type="submit" class="add-to-cart-btn">Add to Cart</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <p>No menu items found.</p>
<?php endif; ?>

<?php include 'footer.php'; ?>
<p><a href="/Unit-3-Project/index.php">Return Home</a></p>

