<?php
session_start();  // Start or resume session

$action = $_GET['action'] ?? $_POST['action'] ?? 'show_menu';

switch ($action) {

    // Pubic views and carts
    case 'show_menu':
    case 'add_to_cart':
    case 'view_cart':
    case 'submit_order':
        require_once __DIR__ . '/controller/order_controller.php';
        break;

    // User authentication
    case 'show_login':
    case 'show_register':
    case 'login_user':
    case 'register_user':
    case 'logout':
        require_once __DIR__ . '/controller/user_controller.php';
        break;

    // Admin
    case 'admin_dashboard':
    case 'manage_menu':
    case 'add_menu_item':
    case 'delete_menu_item':
    case 'edit_menu_form':
    case 'update_menu_item':
    case 'view_orders':
        require_once __DIR__ . '/controller/admin_controller.php';
        break;

    // Fallback
    default:
        http_response_code(404);
        echo "<h1>404 - Page Not Found</h1>";
        break;
}
