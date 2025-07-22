<?php
session_start();

$action = $_GET['action'] ?? 'home';

switch ($action) {
    case 'show_menu':
        require 'controller/menu_controller.php';
        break;

    case 'view_cart':
    case 'add_to_cart':
    case 'submit_order':
        require 'controller/order_controller.php';
        break;

    case 'show_login':
    case 'show_register':
    case 'login_user':
    case 'register_user':
    case 'logout':
        require 'controller/user_controller.php';
        break;

    case 'admin_dashboard':
    case 'manage_menu':
    case 'edit_menu_form':
    case 'update_menu_item':
    case 'add_menu_item':
    case 'delete_menu_item':
    case 'view_orders':
        require 'controller/admin_controller.php';
        break;

    case 'home':
    default:
        // Display default homepage
        include 'view/header.php';

        if (!isset($_SESSION['user'])) {
            echo '<p><a href="controller/user_controller.php?action=show_login">Login</a></p>';
            echo '<p><a href="controller/user_controller.php?action=show_register">Register</a></p>';
        } else {
            echo '<p>Welcome, ' . htmlspecialchars($_SESSION['user']['user_name']) . '!</p>';
            echo '<p><a href="index.php?action=show_menu">Go to Menu</a></p>';
            echo '<p><a href="index.php?action=view_cart">View Cart</a></p>';
            echo '<p><a href="index.php?action=logout">Logout</a></p>';
        }

        include 'view/footer.php';
        break;
}