<?php
include 'db.php'; // Include database connection

// Check if 'id' is passed via URL for editing a specific case
if (isset($_GET['id'])) {
    $case_id = $_GET['id'];

    // Fetch the case details using the case id
    $stmt = $conn->prepare("SELECT * FROM cases WHERE id = ?");
    $stmt->bind_param("i", $case_id);
    $stmt->execute();
    $case_result = $stmt->get_result();

    // If case exists, fetch it
    if ($case_result->num_rows > 0) {
        $case = $case_result->fetch_assoc();
    } else {
        echo "Case not found!";
        exit();
    }

    // Check if the form is submitted to update the case
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_case'])) {
        $description = $_POST['description'];
        $status = $_POST['status'];

        // Update the case in the database
        $stmt_update = $conn->prepare("UPDATE cases SET description = ?, status = ? WHERE id = ?");
        $stmt_update->bind_param("ssi", $description, $status, $case_id);

        if ($stmt_update->execute()) {
            header("Location: view_client.php?id=" . $case['client_id']); // Redirect back to client view page
            exit();
        } else {
            echo "Error updating case: " . $stmt_update->error;
        }
    }

    $stmt->close();
} else {
    echo "No case ID provided!";
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Case</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="mt-5">Edit Case</h2>
        <form method="POST">
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" required><?php echo htmlspecialchars($case['description']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="open" <?php if ($case['status'] == 'open') echo 'selected'; ?>>Open</option>
                    <option value="closed" <?php if ($case['status'] == 'closed') echo 'selected'; ?>>Closed</option>
                </select>
            </div>
            <button type="submit" name="update_case" class="btn btn-primary">Update Case</button>
        </form>
    </div>
</body>
</html>
