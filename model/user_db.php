<?php
require_once(__DIR__ . '/../database.php');

/**
 * Registers a new user with hashed password.
 */
function create_user(string $email, string $password, string $name): int|false {
    global $db;

    $hash = password_hash($password, PASSWORD_DEFAULT);

    $query = 'INSERT INTO users (email, password_hash, name)
              VALUES (:email, :password_hash, :name)';

    try {
        $stmt = $db->prepare($query);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':password_hash', $hash);
        $stmt->bindValue(':name', $name);
        $stmt->execute();
        return $db->lastInsertId();
    } catch (PDOException $e) {
        error_log("User Registration Error: " . $e->getMessage());
        return false;
    }
}

/**
 * Retrieves a user by email.
 */
function get_user_by_email(string $email): array|false {
    global $db;

    $query = 'SELECT * FROM users WHERE email = :email LIMIT 1';
    $stmt = $db->prepare($query);
    $stmt->bindValue(':email', $email);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

/**
 * Validates user login credentials.
 */
function verify_user(string $email, string $password): array|false {
    $user = get_user_by_email($email);

    if (!$user) {
        echo "User not found for $email<br>";
        return false;
    }

    if (!password_verify($password, $user['password_hash'])) {
        echo "Password doesn't match<br>";
        return false;
    }

    return $user;
}


