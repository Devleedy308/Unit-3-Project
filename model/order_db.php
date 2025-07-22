 <?php
require_once(__DIR__ . '/database.php');

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
