<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * Redirects to login page if user is not logged in.
 */
function require_login() {
    if (!isset($_SESSION['user'])) {
        header('Location: ../controller/user_controller.php?action=show_login');
        exit();
    }
}

/**
 * Redirects or blocks access if user is not admin.
 */
function require_admin() {
    if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
        echo "Access denied.";
        exit();
    }
}
