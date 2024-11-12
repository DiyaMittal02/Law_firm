<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the form inputs are being received
    echo "Username: $username <br>";
    echo "Password: $password <br>";

    // Prepare and execute query
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a user was found
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Print fetched password hash for verification
        echo "Password hash in DB: " . $user['password'] . "<br>";

        // Verify the password
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            echo "Login successful! Redirecting to dashboard...";
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Password verification failed.";
        }
    } else {
        echo "No user found with that username.";
    }
}
?>
