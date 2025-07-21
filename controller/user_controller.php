<?php
require_once(__DIR__ . '/../model/user_db.php');
session_start();

$action = $_POST['action'] ?? $_GET['action'] ?? 'show_login';

switch ($action) {
    case 'register':
        register_user();
        break;
    case 'login':
        login_user();
        break;
    case 'logout':
        logout_user();
        break;
    default:
        show_login_form();
        break;
}

function register_user() {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $name = trim($_POST['name'] ?? '');

    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).{8,}$/', $password)) {
        echo "<p>Invalid email or password (Min 8 chars, 1 uppercase, 1 number).</p>";
        return;
    }

    $existing = get_user_by_email($email);
    if ($existing) {
        echo "<p>Email already registered.</p>";
        return;
    }

    $user_id = create_user($email, $password, $name);
    if ($user_id) {
        $_SESSION['user'] = [ 'id' => $user_id, 'email' => $email, 'name' => $name ];
        header('Location: dashboard.php');
    } else {
        echo "<p>Registration failed.</p>";
    }
}

function login_user() {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    $user = verify_user($email, $password);
    if ($user) {
        $_SESSION['user'] = [ 'id' => $user['user_id'], 'email' => $user['email'], 'name' => $user['name'] ];
        header('Location: dashboard.php');
    } else {
        echo "<p>Invalid login credentials.</p>";
    }
}

function logout_user() {
    session_destroy();
    header('Location: login.php');
}

function show_login_form() {
    include(__DIR__ . '/../view/login_form.php');
}
