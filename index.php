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
    <title>TechLearner | DevOps Toolkit</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to bottom right, #f0f4f8, #dce7f3);
        }

        .container {
            max-width: 1200px;
            margin: 40px auto;
            background: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            border: 2px solid #007acc;
        }

        header {
            text-align: center;
            background-color: #004b8d;
            color: white;
            padding: 40px 20px;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
        }

        header h1 {
            margin: 0;
            font-size: 38px;
        }

        header p {
            font-size: 16px;
            margin-top: 10px;
            color: #d0e6f7;
        }

        .hero-image {
            width: 100%;
            height: 300px;
            object-fit: cover;
            border-bottom: 4px solid #004b8d;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-top: 40px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            padding: 16px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #007acc;
            color: white;
        }

        tr:hover {
            background-color: #f9f9f9;
        }

        footer {
            margin-top: 40px;
            padding: 20px;
            text-align: center;
            background: #004b8d;
            color: white;
            border-bottom-left-radius: 12px;
            border-bottom-right-radius: 12px;
        }

        @media (max-width: 768px) {
            th, td {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

<header>
    <h1>TechLearner.DevOps</h1>
    <p>Where Learning Meets Engineering</p>
</header>

<img class="hero-image" src="https://images.unsplash.com/photo-1551434678-e076c223a692?auto=format&fit=crop&w=1350&q=80" alt="DevOps Tools Banner">

<div class="container">
    <h2>Top DevOps Tools</h2>
    <table>
        <thead>
            <tr>
                <th>Tool Name</th>
                <th>Category</th>
                <th>Description</th>
                <th>Language Support</th>
                <th>License</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
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
        </tbody>
    </table>
</div>

<footer>
    &copy; <?= date("Y") ?> TechLearner | Powered by Azure SQL & App Service 🚀
</footer>

</body>
</html>
