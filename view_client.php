<?php
include 'db.php';

$client_id = $_GET['id'];

$client_result = $conn->query("SELECT * FROM clients WHERE id = $client_id");
$client = $client_result->fetch_assoc();

$cases_result = $conn->query("SELECT * FROM cases WHERE client_id = $client_id");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Client Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="mt-5">Client Details</h2>
        <p><strong>Name:</strong> <?php echo $client['name']; ?></p>
        <p><strong>Email:</strong> <?php echo $client['email']; ?></p>
        <p><strong>Phone:</strong> <?php echo $client['phone']; ?></p>
        <p><strong>Address:</strong> <?php echo $client['address']; ?></p>
        
        <h3 class="mt-5">Cases</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($case = $cases_result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $case['id']; ?></td>
                        <td><?php echo $case['case_title']; ?></td>
                        <td><?php echo $case['case_description']; ?></td>
                        <td><?php echo $case['status']; ?></td>
                        <td>
                            <a href='edit_case.php?id=<?php echo $case['id']; ?>' class='btn btn-warning'>Edit</a>
                            <a href='delete_case.php?id=<?php echo $case['id']; ?>' class='btn btn-danger'>Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
