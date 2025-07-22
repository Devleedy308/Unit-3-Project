<?php
session_start();

/**
 * Redirects to login page if user is not logged in.
 */
function require_login() {
    if (!isset($_SESSION['user_id'])) {
        header('Location: ../controller/user_controller.php?action=show_login');
        exit();
    }
}

function require_admin() {
    if ($_SESSION['role'] !== 'admin') {
        echo "Access denied.";
        exit();
    }
}
