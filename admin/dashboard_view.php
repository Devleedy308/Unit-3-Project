<?php
require_once(__DIR__ . '/../controller/auth.php');
require_login();         // Make sure user is logged in
require_admin();         // Make sure user is admin
include '../view/header.php';
?>

<h2>Admin Dashboard</h2>

<p>Welcome, <?= htmlspecialchars($_SESSION['user_name'] ?? 'Admin') ?>!</p>

<ul>
    <li><a href="index.php?action=manage_menu">Manage Menu Items</a></li>
    <li><a href="index.php?action=view_orders">View Submitted Orders</a></li>
    <li><a href="index.php?action=logout">Log Out</a></li>
</ul>

<?php include '../view/footer.php'; ?>
