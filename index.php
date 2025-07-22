<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome to the Restaurant!</title>
</head>
<body>
    <h1>Welcome to the Restaurant Order System</h1>

    <?php if (!isset($_SESSION['user'])): ?>
        <p><a href="controller/user_controller.php?action=show_login">Login</a></p>
        <p><a href="controller/user_controller.php?action=show_register">Register</a></p>
    <?php else: ?>
        <p>Welcome, <?= htmlspecialchars($_SESSION['user']['user_name']) ?>!</p>
        <p><a href="controller/menu_controller.php?action=show_menu">Go to Menu</a></p>
        <p><a href="controller/auth.php?action=logout">Logout</a></p>
    <?php endif; ?>
</body>
</html>
