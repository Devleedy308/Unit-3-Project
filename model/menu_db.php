<?php
require_once(__DIR__ . '/../database.php');

/**
 * Fetch all menu items.
 */
function get_all_menu_items(): array {
    global $db;
    $query = 'SELECT * FROM menu_items ORDER BY category, name';
    $stmt = $db->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function get_menu_item(int $item_id): array|false {
    global $db;
    $query = 'SELECT * FROM menu_items WHERE item_id = :item_id';
    $stmt = $db->prepare($query);
    $stmt->bindValue(':item_id', $item_id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
