<?php
$server = "tcp:sql-phpapp-centralus.database.windows.net,1433";
$database = "db-phpapp-centralus";
$username = "sqladmin";
$password = "V7m#Lk@9xZ!tQ2eW";

try {
    $conn = new PDO("sqlsrv:server=$server;Database=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT tool_name, category, description, language_support, license_type, created_at FROM devops_tools ORDER BY created_at DESC";
    $stmt = $conn->query($sql);
    $tools = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DevOps Tools Dashboard</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f4f7f9;
            padding: 20px;
        }
        h1 {
            color: #333;
            text-align: center;
        }
        table {
            margin: auto;
            width: 90%;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 14px 16px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #0078d4;
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            color: #888;
        }
    </style>
</head>
<body>
<h1>Top DevOps Tools</h1>
<table>
    <tr>
        <th>Tool Name</th>
        <th>Category</th>
        <th>Description</th>
        <th>Language Support</th>
        <th>License</th>
        <th>Created At</th>
    </tr>
    <?php foreach ($tools as $tool): ?>
        <tr>
            <td><?= htmlspecialchars($tool['tool_name']) ?></td>
            <td><?= htmlspecialchars($tool['category']) ?></td>
            <td><?= htmlspecialchars($tool['description']) ?></td>
            <td><?= htmlspecialchars($tool['language_support']) ?></td>
            <td><?= htmlspecialchars($tool['license_type']) ?></td>
            <td><?= htmlspecialchars($tool['created_at']) ?></td>
        </tr>
    <?php endforeach; ?>
</table>
<div class="footer">
    Powered by Azure SQL & PHP on App Service 🚀
</div>
</body>
</html>
