<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="mt-5">Client Management Dashboard</h2>
        <a href="add_client_form.html" class="btn btn-primary mb-3">Add New Client</a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = $conn->query("SELECT * FROM clients");
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['name']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['phone']}</td>
                            <td>{$row['address']}</td>
                            <td>
                                <a href='view_client.php?id={$row['id']}' class='btn btn-info'>View</a>
                                <a href='edit_client.php?id={$row['id']}' class='btn btn-warning'>Edit</a>
                                <a href='delete_client.php?id={$row['id']}' class='btn btn-danger'>Delete</a>
                            </td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
