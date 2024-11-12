<?php
session_start(); // Start session to get the client_id

// Check if the client_id exists in session
if (!isset($_SESSION['client_id'])) {
    echo "No client found!";
    exit();
}

include 'db.php'; // Include database connection

// Check if the form is submitted for case details
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['case_form'])) {
    // Get case data from the form
    $client_id = $_SESSION['client_id']; // Get client ID from session
    $case_description = $_POST['case_description'];
    $case_status = $_POST['case_status'];

    // Insert case data into the cases table
    $stmt_case = $conn->prepare("INSERT INTO cases (client_id, description, status) VALUES (?, ?, ?)");
    $stmt_case->bind_param("iss", $client_id, $case_description, $case_status);

    if ($stmt_case->execute()) {
        echo "Case successfully added!";
        unset($_SESSION['client_id']); // Remove client ID from session after successful insertion
    } else {
        echo "Error adding case: " . $stmt_case->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Case</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
</head>
<body>
    <h1>Add Case</h1>

    <!-- Form to enter case details -->
    <form method="POST" action="add_case.php">
        <h2>Case Information</h2>
        
        <label for="case_description">Case Description:</label>
        <textarea name="case_description" required></textarea>

        <label for="case_status">Case Status:</label>
        <select name="case_status" required>
            <option value="open">Open</option>
            <option value="closed">Closed</option>
        </select>

        <button type="submit" name="case_form">Add Case</button>
    </form>
</body>
</html>
