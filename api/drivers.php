<?php
    require_once('../includes/config.inc.php');
try {
    $pdo = new PDO(DBCONNSTRING);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    //Test database connection
    $sql = $pdo ->query("select * from drivers ");
    $results = $sql -> fetchAll(PDO::FETCH_ASSOC);

     foreach ($results as $row) {
        echo "ID: " . $row['driverId'] . " - Name: " . $row['surname'] . "<br>";
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>