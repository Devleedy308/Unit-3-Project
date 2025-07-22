 <?php
require_once(__DIR__ . '/../database.php');

 // Create a new order and return the order_id.
function create_order(string $customer_name): int|false {
    global $db;

    $query = 'INSERT INTO orders (customer_name) VALUES (:customer_name)';
    $stmt = $db->prepare($query);
    $stmt->bindValue(':customer_name', $customer_name);

    if ($stmt->execute()) {
        return $db->lastInsertId();
    } else {
        return false;
    }
}


 // Add an item to the order_items table.
function add_order_item(int $order_id, int $item_id, int $quantity, float $price): bool {
    global $db;

    $query = 'INSERT INTO order_items (order_id, item_id, quantity, price)
              VALUES (:order_id, :item_id, :quantity, :price)';
    $stmt = $db->prepare($query);
    $stmt->bindValue(':order_id', $order_id);
    $stmt->bindValue(':item_id', $item_id);
    $stmt->bindValue(':quantity', $quantity);
    $stmt->bindValue(':price', $price);

    return $stmt->execute();
}

function get_all_orders(): array {
    global $db;
    $query = 'SELECT * FROM orders ORDER BY created_at DESC';
    $stmt = $db->query($query);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function get_order_items(int $order_id): array {
    global $db;
    $query = 'SELECT oi.quantity, oi.price, mi.name
              FROM order_items oi
              JOIN menu_items mi ON oi.item_id = mi.item_id
              WHERE oi.order_id = :order_id';
    $stmt = $db->prepare($query);
    $stmt->bindValue(':order_id', $order_id);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
