 <?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once(__DIR__ . '/../model/menu_db.php');
require_once(__DIR__ . '/../model/order_db.php');

// Default action
$action = $_POST['action'] ?? $_GET['action'] ?? 'show_menu';

switch ($action) {
    case 'show_menu':
        $items = get_all_menu_items();
        include(__DIR__ . '/../view/menu_view.php');
        break;

    case 'add_to_cart':
        $item_id = filter_input(INPUT_POST, 'item_id', FILTER_VALIDATE_INT);
        $quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT);

        if (!$item_id || $quantity < 1) {
            header("Location: menu_controller.php?action=show_menu");
            exit;
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

        // Update quantity if item exists
        if (isset($_SESSION['order'][$item_id])) {
            $_SESSION['order'][$item_id]['quantity'] += $quantity;
        } else {
            $_SESSION['order'][$item_id] = [
                'item_id' => $item['item_id'],
                'name' => $item['name'],
                'price' => $item['price'],
                'quantity' => $quantity
            ];
        }

        header("Location: menu_controller.php?action=view_cart");
        break;

    case 'view_cart':
        include('../view/cart_view.php');
        break;

    case 'clear_cart':
        unset($_SESSION['order']);
        header("Location: menu_controller.php?action=view_cart");
        break;

    case 'checkout':
        $customer_name = $_SESSION['user']['user_name'] ?? 'Guest';
        $order_id = create_order($customer_name);

        if ($order_id && isset($_SESSION['order'])) {
            foreach ($_SESSION['order'] as $item) {
                add_order_item($order_id, $item['item_id'], $item['quantity'], $item['price']);
            }
            unset($_SESSION['order']); // Clear cart
            header("Location: ../view/order_confirmation.php?order_id=$order_id");
        } else {
            echo "Order failed.";
        }
        break;

    default:
        header("Location: menu_controller.php?action=show_menu");
        break;
}
