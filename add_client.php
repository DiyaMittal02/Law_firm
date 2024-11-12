<?php
include 'db.php'; // Include database connection

// Check if the form is submitted for client details
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['client_form'])) {
    // Get client details from form
    $client_name = $_POST['client_name'];
    $client_email = $_POST['client_email'];
    $client_phone = $_POST['client_phone'];
    $client_address = $_POST['client_address'];

    // Insert client data into the clients table
    $stmt_client = $conn->prepare("INSERT INTO clients (name, email, phone, address) VALUES (?, ?, ?, ?)");
    $stmt_client->bind_param("ssss", $client_name, $client_email, $client_phone, $client_address);
    
    if ($stmt_client->execute()) {
        // Get the client ID of the inserted client
        $client_id = $conn->insert_id;

        // Store the client_id in session for future use in case form
        session_start();
        $_SESSION['client_id'] = $client_id;

        // Debugging output: Check if the client ID is set
        echo "Client added successfully! Client ID: " . $_SESSION['client_id'];

        // Redirect to add case form
        header("Location: add_case.php");
        exit();
    } else {
        echo "Error adding client: " . $stmt_client->error;
    }
}
?>
