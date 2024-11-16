<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $conn->query("DELETE FROM clients WHERE id = $id");

    header("Location: dashboard.php");
    exit;
} else {
    echo "Invalid request!";
    exit;
}
?>
