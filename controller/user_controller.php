<?php
session_start();
require_once(__DIR__ . '/../model/user_db.php');

$action = $_POST['action'] ?? $_GET['action'] ?? 'show_login';

switch ($action) {
    case 'register_user':
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = $_POST['password'];
        $name = trim($_POST['name']);

        // Regex: 1 uppercase, 1 digit, 8+ characters
        if (!$email || !preg_match('/^(?=.*[A-Z])(?=.*\d).{8,}$/', $password)) {
            echo "Invalid email or weak password.";
            exit;
        }

        // Check for duplicates
        if (get_user_by_email($email)) {
            echo "Email already registered.";
            exit;
        }

        // Create user and store in session
        $user_id = create_user($email, $password, $name);
        if ($user_id) {
            $_SESSION['user'] = [
                'user_id' => $user_id,
                'email' => $email,
                'user_name' => $name,
                'role' => 'user'  // default on registration
            ];
            header('Location: ../controller/menu_controller.php?action=show_menu');
            exit;
        } else {
            echo "Registration failed.";
        }
        break;

    case 'login_user':
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = $_POST['password'];

        $user = verify_user($email, $password);
        if ($user) {
            $_SESSION['user'] = [
                'user_id' => $user['user_id'],
                'email' => $user['email'],
                'user_name' => $user['name'],
                'role' => $user['role']
            ];
            
            // Redirect based on role
            if ($user['role'] === 'admin') {
                header('Location: ../admin/dashboard_view.php');
            } else {
                header('Location: ../controller/menu_controller.php?action=show_menu');
            }
            exit;
        } else {
            echo "Invalid login.";
        }
        break;

    case 'logout':
        session_unset();
        session_destroy();
        header('Location: /Unit-3-Project/controller/user_controller.php?action=show_login');
        exit;

    case 'show_register':
        include('../view/register_view.php');
        break;

    case 'show_login':
    default:
        include('../view/login_view.php');
        break;
}
