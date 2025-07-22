<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once(__DIR__ . '/auth.php'); 
require_login();
require_admin();

$action = $_GET['action'] ?? $_POST['action'] ?? 'admin_dashboard';

switch ($action) {
    case 'admin_dashboard':
        include(__DIR__ . '/../admin/dashboard_view.php');
        break;

    case 'manage_menu':
        require_once(__DIR__ . '/../model/menu_db.php');
        $items = get_all_menu_items();
        include(__DIR__ . '/../admin/manage_menu_view.php');
        break;

    case 'delete_menu_item':
        require_once(__DIR__ . '/../model/menu_db.php');
        $item_id = filter_input(INPUT_POST, 'item_id', FILTER_VALIDATE_INT);
        if ($item_id) {
            delete_menu_item($item_id);
        }
        header('Location: admin_controller.php?action=manage_menu');
        exit();

    case 'add_menu_item':
        require_once(__DIR__ . '/../model/menu_db.php');
        $name = trim($_POST['name'] ?? '');
        $price = floatval($_POST['price'] ?? 0);
        $category = trim($_POST['category'] ?? '');
        $description = trim($_POST['description'] ?? '');

        if ($name && $price > 0 && $category) {
            add_menu_item($name, $price, $category, $description);
        }
        header('Location: admin_controller.php?action=manage_menu');
        exit();

    case 'edit_menu_form':
        require_once(__DIR__ . '/../model/menu_db.php');
        $item_id = filter_input(INPUT_GET, 'item_id', FILTER_VALIDATE_INT);
        if ($item_id) {
            $item = get_menu_item($item_id);
            include(__DIR__ . '/../admin/edit_menu_view.php');
        } else {
            echo "Invalid item ID.";
        }
        break;

    case 'update_menu_item':
        require_once(__DIR__ . '/../model/menu_db.php');
        $item_id = filter_input(INPUT_POST, 'item_id', FILTER_VALIDATE_INT);
        $name = trim($_POST['name'] ?? '');
        $price = floatval($_POST['price'] ?? 0);
        $category = trim($_POST['category'] ?? '');
        $description = trim($_POST['description'] ?? '');

        if ($item_id && $name && $price > 0 && $category) {
            update_menu_item($item_id, $name, $price, $category, $description);
        }
        header('Location: admin_controller.php?action=manage_menu');
        exit();

    case 'view_orders':
        require_once(__DIR__ . '/../model/order_db.php');
        $orders = get_all_orders();
        include(__DIR__ . '/../admin/view_orders_view.php');
        break;

    default:
        header('Location: admin_controller.php?action=admin_dashboard');
        exit();
}

