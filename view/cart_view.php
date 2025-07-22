<?php include 'header.php'; ?>
<h2>Your Order</h2>

<?php
$cart = $_SESSION['order'] ?? [];
$cart_total = 0;
?>

<?php if (empty($cart)): ?>
    <p>Your cart is empty.</p>
<?php else: ?>
    <table>
        <tr>
            <th>Item</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Line Total</th>
        </tr>
        <?php foreach ($cart as $item): 
            $line_total = $item['price'] * $item['quantity'];
            $cart_total += $line_total;
        ?>
            <tr>
                <td><?= htmlspecialchars($item['name']) ?></td>
                <td>$<?= number_format($item['price'], 2) ?></td>
                <td><?= $item['quantity'] ?></td>
                <td>$<?= number_format($line_total, 2) ?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="3"><strong>Total:</strong></td>
            <td><strong>$<?= number_format($cart_total, 2) ?></strong></td>
        </tr>
    </table>

    <h3>Submit Your Order</h3>
    <p>Order will be placed under: <strong><?= htmlspecialchars($_SESSION['user']['user_name'] ?? 'Guest') ?></strong></p>

    <form action="../controller/order_controller.php" method="post">
    <input type="hidden" name="action" value="submit_order">
        <button type="submit">Place Order</button>
    </form>
<?php endif; ?>

<?php include 'footer.php'; ?>
