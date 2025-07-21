 <?php
session_start();
require_once(__DIR__ . '/../model/user_db.php');

$action = $_POST['action'] ?? $_GET['action'] ?? 'show_login';

switch ($action) {
    case 'register_user':
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = $_POST['password'];
        $name = trim($_POST['name']);

        if (!$email || !preg_match('/^(?=.*[A-Z])(?=.*\d).{8,}$/', $password)) {
            echo "Invalid email or weak password.";
            exit;
        }

        if (get_user_by_email($email)) {
            echo "Email already registered.";
            exit;
        }

        $user_id = create_user($email, $password, $name);
        if ($user_id) {
            $_SESSION['user_id'] = $user_id;
            $_SESSION['email'] = $email;
            header('Location: ../admin/dashboard_view.php');
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
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['email'] = $user['email'];
            header('Location: ../admin/dashboard_view.php');
            exit;
        } else {
            echo "Invalid login.";
        }
        break;

    case 'logout':
        session_destroy();
        header('Location: ../view/login_view.php');
        exit;

    case 'show_register':
        include('../view/register_view.php');
        break;

    case 'show_login':
    default:
        include('../view/login_view.php');
        break;
}