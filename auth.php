<?php
session_start();

function loginUser($id, $email, $name, $role = 'user') {
    $_SESSION['user_id'] = $id;
    $_SESSION['user_email'] = $email;
    $_SESSION['user_name'] = $name;
    $_SESSION['user_role'] = $role;
}

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function isAdmin() {
    return isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin';
}