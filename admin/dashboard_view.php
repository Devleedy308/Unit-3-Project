<?php
session_start();
require_once(__DIR__ . '/../controller/auth.php');
require_login();
require_admin();
include '../view/header.php';
?>

<h2>Admin Dashboard</h2>

<p>Welcome, <?= htmlspecialchars($_SESSION['user']['user_name'] ?? 'Admin') ?>!</p>

<ul>
    <li><a href="../controller/admin_controller.php?action=manage_menu">Manage Menu Items</a></li>
    <li><a href="../controller/admin_controller.php?action=view_orders">View Submitted Orders</a></li>
    <li><a href="../controller/user_controller.php?action=logout">Log Out</a></li>
</ul>

<?php include '../view/footer.php'; ?>
