<?php
$server = "tcp:sqlserver-php.database.windows.net,1433";
$database = "sqldb-php";
$username = "sqladmin";
$password = "V7m#Lk@9xZ!tQ2eW";

try {
    $conn = new PDO("sqlsrv:server=$server;Database=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get first available table
    $tableQuery = "SELECT TOP 1 TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE = 'BASE TABLE' ORDER BY TABLE_NAME";
    $stmt = $conn->query($tableQuery);
    $tableName = $stmt->fetchColumn();

    echo "<!DOCTYPE html>
    <html>
    <head>
        <title>Azure PHP + SQL App</title>
        <style>
            body {
                font-family: 'Segoe UI', sans-serif;
                background-color: #f9f9f9;
                padding: 40px;
                color: #333;
            }
            h1 {
                color: #005f9e;
            }
            table {
                border-collapse: collapse;
                width: 90%;
                margin-top: 20px;
                background: white;
                box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            }
            th, td {
                border: 1px solid #ddd;
                padding: 12px 15px;
                text-align: left;
            }
            th {
                background-color: #0078D7;
                color: white;
            }
            tr:nth-child(even) {
                background-color: #f2f2f2;
            }
        </style>
    </head>
    <body>
        <h1>🌐 Azure App Service + SQL (Auto Table Viewer)</h1>";

    if ($tableName) {
        echo "<h2>🗂️ Showing table: <code>$tableName</code></h2>";

        // Query all data from the table
        $dataQuery = "SELECT * FROM [$tableName]";
        $stmt = $conn->query($dataQuery);

        // Render table
        echo "<table><thead><tr>";
        for ($i = 0; $i < $stmt->columnCount(); $i++) {
            $meta = $stmt->getColumnMeta($i);
            echo "<th>{$meta['name']}</th>";
        }
        echo "</tr></thead><tbody>";

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            foreach ($row as $cell) {
                echo "<td>" . htmlspecialchars($cell) . "</td>";
            }
            echo "</tr>";
        }

        echo "</tbody></table>";
    } else {
        echo "<p>❌ No user-defined tables found in the database.</p>";
    }

    echo "</body></html>";

} catch (PDOException $e) {
    echo "<p style='color:red;'>❌ Connection failed: " . $e->getMessage() . "</p>";
}
?>
