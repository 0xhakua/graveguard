<?php
session_start();
require 'db_connect.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Initialize variables
$error = '';
$success = '';

// Fetch records from the database
try {
    $query = "SELECT * FROM transactions"; // Replace 'transactions' with your table name
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $transactions = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $error = "Error fetching data: " . $e->getMessage();
}

// Delete record
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    try {
        $query = "DELETE FROM transactions WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->execute(['id' => $id]);
        $success = "Record deleted successfully!";
        header("Location: records.php"); // Refresh the page after delete
        exit();
    } catch (PDOException $e) {
        $error = "Error deleting record: " . $e->getMessage();
    }
}

// Edit record (you can create a form for this)
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    // Code for editing the record can be added here
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Records - Dashboard</title>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        /* Same styles from the dashboard */
        body {
            font-family: Arial, sans-serif;
            display: flex;
            min-height: 100vh;
            color: #3e6553;
            background: linear-gradient(90deg, #e2e2e2, #61947c);
        }

        .sidebar {
            width: 250px;
            background: #3e6553;
            color: #fff;
            display: flex;
            flex-direction: column;
            padding: 20px;
            position: fixed;
            height: 100%;
        }

        .sidebar h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        .menu {
            list-style: none;
        }

        .menu li {
            margin: 20px 0;
        }

        .menu li a {
            color: #fff;
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 10px;
            border-radius: 5px;
            transition: background 0.3s;
        }

        .menu li a:hover {
            background: #61947c;
        }

        .menu li a i {
            margin-right: 10px;
        }

        .main-content {
            margin-left: 250px;
            flex: 1;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }

        table th, table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        table th {
            background: #61947c;
            color: #fff;
        }

        .actions button {
            margin-right: 10px;
            padding: 5px 10px;
            cursor: pointer;
            background: #3e6553;
            color: white;
            border: none;
            border-radius: 5px;
        }

        .actions button:hover {
            background: #61947c;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h1>Dashboard</h1>
        <ul class="menu">
            <li><a href="index.php"><i class="bx bx-home"></i> Home</a></li>
            <li><a href="records.php"><i class="bx bx-folder"></i> Records</a></li>
            <li><a href="accounts.php"><i class="bx bx-user"></i> Accounts</a></li>
            <li><a href="logout.php"><i class="bx bx-log-out"></i> Logout</a></li>
        </ul>
    </div>
    <div class="main-content">
        <h2>Records</h2>
        
        <?php if ($error): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="success"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Description</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($transactions as $transaction): ?>
                    <tr>
                        <td><?= htmlspecialchars($transaction['id']) ?></td>
                        <td><?= htmlspecialchars($transaction['description']) ?></td>
                        <td><?= htmlspecialchars($transaction['amount']) ?></td>
                        <td><?= htmlspecialchars($transaction['date']) ?></td>
                        <td class="actions">
                            <a href="edit_record.php?id=<?= $transaction['id'] ?>"><button>Edit</button></a>
                            <a href="?delete=<?= $transaction['id'] ?>"><button>Delete</button></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
