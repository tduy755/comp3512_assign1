<?php
    require_once('../includes/config.inc.php');
try {
    $pdo = new PDO(DBCONNSTRING);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    //Test database connection
    $sql = $pdo ->query("select * from drivers ");

     while($row = $sql -> fetch(PDO::FETCH_ASSOC)){
        echo "ID: " . $row['driverId'] . " - Name: " . $row['surname'] . "<br>";
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>