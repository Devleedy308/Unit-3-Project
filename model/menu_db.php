<?php
require_once(__DIR__ . '/../database.php');

// Fetch all menu items.
function get_all_menu_items(): array {
    global $db;
    $query = 'SELECT * FROM menu_items ORDER BY category, name';
    $stmt = $db->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// get single menu item by ID.
function get_menu_item(int $item_id): array|false {
    global $db;
    $query = 'SELECT * FROM menu_items WHERE item_id = :item_id';
    $stmt = $db->prepare($query);
    $stmt->bindValue(':item_id', $item_id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Delete a menu item by ID.
function delete_menu_item(int $item_id): bool {
    global $db;
    $query = 'DELETE FROM menu_items WHERE item_id = :item_id';
    $stmt = $db->prepare($query);
    $stmt->bindValue(':item_id', $item_id);
    return $stmt->execute();
}

// Add a new menu item.
function add_menu_item(string $name, float $price, string $category, string $description): bool {
    global $db;

    $query = 'INSERT INTO menu_items (name, price, category, description)
              VALUES (:name, :price, :category, :description)';
    $stmt = $db->prepare($query);
    $stmt->bindValue(':name', $name);
    $stmt->bindValue(':price', $price);
    $stmt->bindValue(':category', $category);
    $stmt->bindValue(':description', $description);

    return $stmt->execute();
}

function update_menu_item(int $item_id, string $name, float $price, string $category, string $description): bool {
    global $db;
    $query = 'UPDATE menu_items
              SET name = :name, price = :price, category = :category, description = :description
              WHERE item_id = :item_id';
    $stmt = $db->prepare($query);
    $stmt->bindValue(':name', $name);
    $stmt->bindValue(':price', $price);
    $stmt->bindValue(':category', $category);
    $stmt->bindValue(':description', $description);
    $stmt->bindValue(':item_id', $item_id);
    return $stmt->execute();
}

