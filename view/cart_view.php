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
    <form action="index.php?action=submit_order" method="post">
        <label for="customer_name">Your Name:</label>
        <input type="text" name="customer_name" id="customer_name" required>
        <button type="submit">Place Order</button>
    </form>
<?php endif; ?>

<?php include 'footer.php'; ?>
