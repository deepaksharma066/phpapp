<?php
$server = "tcp:sql-app-service.database.windows.net,1433";
$database = "db-techlearner";
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
    <title>TechLearner | DevOps Dashboard</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
            background: #f4f6f9;
        }
        header {
            background-color: #1e88e5;
            padding: 20px;
            color: white;
            text-align: center;
        }
        header h1 {
            margin: 0;
        }
        .hero {
            background: url('https://images.unsplash.com/photo-1639769474646-1052f0df6bc9?auto=format&fit=crop&w=1050&q=80') center/cover no-repeat;
            height: 250px;
        }
        main {
            padding: 40px;
            max-width: 1100px;
            margin: auto;
            background: white;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 14px 16px;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #1976d2;
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        footer {
            margin-top: 60px;
            padding: 20px;
            text-align: center;
            background: #eee;
            font-size: 14px;
        }
    </style>
</head>
<body>

<header>
    <h1>TechLearner.DevOps</h1>
    <p>Explore and Learn Top DevOps Tools</p>
</header>

<div class="hero"></div>

<main>
    <h2>Top DevOps Tools</h2>
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
</main>

<footer>
    &copy; <?= date("Y") ?> TechLearner | Powered by Azure App Service & SQL Server 🚀
</footer>

</body>
</html>
