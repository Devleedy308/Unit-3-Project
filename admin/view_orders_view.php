<?php
require_once(__DIR__ . '/../controller/auth.php');
require_login();
require_admin();
include '../view/header.php';
?>

<h2>Submitted Orders</h2>

<?php if (empty($orders)): ?>
    <p>No orders have been submitted yet.</p>
<?php else: ?>
    <?php foreach ($orders as $order): ?>
        <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 15px;">
            <p><strong>Order #<?= $order['order_id'] ?></strong></p>
            <p><strong>Customer:</strong> <?= htmlspecialchars($order['customer_name']) ?></p>
            <p><strong>Submitted:</strong> <?= $order['created_at'] ?></p>

            <table>
                <tr>
                    <th>Item</th>
                    <th>Quantity</th>
                    <th>Price Each</th>
                    <th>Line Total</th>
                </tr>
                <?php
                $items = get_order_items($order['order_id']);
                $total = 0;
                foreach ($items as $item):
                    $line_total = $item['price'] * $item['quantity'];
                    $total += $line_total;
                ?>
                <tr>
                    <td><?= htmlspecialchars($item['name']) ?></td>
                    <td><?= $item['quantity'] ?></td>
                    <td>$<?= number_format($item['price'], 2) ?></td>
                    <td>$<?= number_format($line_total, 2) ?></td>
                </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="3"><strong>Total:</strong></td>
                    <td><strong>$<?= number_format($total, 2) ?></strong></td>
                </tr>
            </table>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<?php include '../view/footer.php'; ?>
