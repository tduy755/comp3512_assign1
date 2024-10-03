<?php
    require_once('../includes/config.inc.php');
    include_once '../includes/db.inc.php';

    // $data = getData('select * from drivers');

    // foreach ($races as $row) {
    //     echo "ID: " . $row['driverId'] . "  Driver Name: " . $row['surname'] . "<br>";
    // }

     // Tell the browser to expect JSON rather than HTML
header('Content-type: application/json');
// Indicate whether other domains can use this API
header("Access-Control-Allow-Origin: *");

function getSpecifiedDrivers($driverRef = null) {
    if ($driverRef) {
       
        $sql = "SELECT driverId, forename, surname FROM drivers WHERE driverRef = '$driverRef'"; // Directly include the parameter
    } else {
        $sql = "SELECT driverId, forename, surname FROM drivers"; // Fetch all drivers
    }

    $data = getData($sql); // Call getData with the SQL query

    if (empty($data)) {
        echo json_encode(["error" => $driverRef ? "No driver found for driverRef: $driverRef" : "No data found."]);
    } else {
        echo json_encode($data, JSON_NUMERIC_CHECK);
    }
}

function getDriversForRace($raceId) {
    $sql = "SELECT driverId, driverRef, forename, surname, races.RaceId FROM drivers
            INNER JOIN qualifying USING(driverId)
            INNER JOIN races USING(raceId)
            WHERE races.raceId = '$raceId'
            ORDER BY driverRef";

    $data = getData($sql); // Call getData with the SQL query

    if (empty($data)) {
        echo json_encode(["error" => "No drivers found for raceId: $raceId"]);
    } else {
        echo json_encode($data, JSON_NUMERIC_CHECK);
    }
}

// Check for driverRef or raceId in the query string and call the appropriate function
if (isset($_GET['driverRef']) && !empty($_GET['driverRef'])) {
    getDrivers($_GET['driverRef']);
} elseif (isset($_GET['raceId']) && !empty($_GET['raceId'])) {
    getDriversForRace($_GET['raceId']);
} else {
    getDrivers(); // Call without parameters to fetch all drivers
}




?>