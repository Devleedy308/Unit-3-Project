<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once(__DIR__ . '/../model/menu_db.php');
require_once(__DIR__ . '/../model/order_db.php');

$action = $_POST['action'] ?? $_GET['action'] ?? 'view_cart';

switch ($action) {

    // Add item to cart
    case 'add_to_cart':
        $item_id = filter_input(INPUT_POST, 'item_id', FILTER_VALIDATE_INT);
        $quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT);

        if (!$item_id || $quantity < 1) {
            header("Location: ../index.php?action=show_menu");
            exit();
        }

        $item = get_menu_item($item_id);
        if (!$item) {
            echo "Invalid item.";
            exit;
        }

        // Initialize cart if not set
        if (!isset($_SESSION['order'])) {
            $_SESSION['order'] = [];
        }

        // If item already in cart, update quantity
        if (isset($_SESSION['order'][$item_id])) {
            $_SESSION['order'][$item_id]['quantity'] += $quantity;
        } else {
            $_SESSION['order'][$item_id] = [
                'name' => $item['name'],
                'price' => $item['price'],
                'quantity' => $quantity
            ];
        }

        header("Location: ../controller/menu_controller.php?action=show_menu&added=true");
        exit();

    // Show cart
    case 'view_cart':
        include(__DIR__ . '/../view/cart_view.php');
        break;

    // Submit order
    case 'submit_order':
        if (empty($_SESSION['order'])) {
            echo "Cart is empty.";
            exit();
        }

        $customer_name = filter_input(INPUT_POST, 'customer_name', FILTER_SANITIZE_STRING);
        if (!$customer_name) {
            echo "Customer name is required.";
            exit();
        }

        // Create order
        $order_id = create_order($customer_name);

        // Add items
        foreach ($_SESSION['order'] as $item_id => $item) {
            add_order_item($order_id, $item_id, $item['quantity'], $item['price']);
        }

        // Clear the cart
        unset($_SESSION['order']);

        include('../view/order_confirmation.php');
        break;

    default:
        header("Location: ../index.php?action=view_cart");
        exit();
}