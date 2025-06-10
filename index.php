<?php
$server = "tcp:sqlserver-php.database.windows.net,1433";
$database = "sqldb-php";
$username = "sqladmin";
$password = "V7m#Lk@9xZ!tQ2eW";

try {
    $conn = new PDO("sqlsrv:server=$server;Database=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "<h1>Hello this is an Azure Project of AppSvc+SQL</h1>";
    echo "<h2>Projects Table:</h2>";

    $sql = "SELECT Id, ProjectName, CreatedAt FROM Projects";
    foreach ($conn->query($sql) as $row) {
        echo "<p><strong>{$row['Id']}</strong>: {$row['ProjectName']} ({$row['CreatedAt']})</p>";
    }

} catch (PDOException $e) {
    echo "❌ Connection failed: " . $e->getMessage();
}
?>
