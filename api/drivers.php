<?php
    require_once('../includes/config.inc.php');
    include_once ('../includes/db.inc.php');

    // $data = getData('select * from drivers');

    // foreach ($races as $row) {
    //     echo "ID: " . $row['driverId'] . "  Driver Name: " . $row['surname'] . "<br>";
    // }

     // Tell the browser to expect JSON rather than HTML
header('Content-type: application/json');
// Indicate whether other domains can use this API
header("Access-Control-Allow-Origin: *");


function getSpecifiedDrivers($driverRef = null) { //function for drivers
    if ($driverRef) {
        $sql = "SELECT driverId, forename, surname, dob, 
         round((julianday('now') - julianday(dob)) / 365.25) AS age, nationality, url 
        FROM drivers 
        WHERE driverRef = ?"; // Directly include the parameter

        $data = getData($sql, [$driverRef]); // Pass the driverRef as an array
    } else { // return all drivers for 2022 season
        $sql = "SELECT driverId, forename, surname, dob, round((julianday('now') - julianday(dob)) / 365.25) AS age, nationality, drivers.url, races.year as season   
                FROM drivers
                INNER JOIN qualifying USING(driverId)
                INNER JOIN races USING(raceId)
                WHERE races.year = 2022"; 
        $data = getData($sql, []); 
    }

    if (empty($data)) {
        $response = ["error" => $driverRef ? "No driver found for driverRef: $driverRef" : "No data found."];
    } else {
        $response = $data;
    }

    // Echo the JSON response
    echo json_encode($response, JSON_NUMERIC_CHECK);
    return $response;
}

function getDriversForRace($raceId= null) {
    if ($raceId) {
        $sql = "SELECT driverId, driverRef, forename, surname, races.RaceId FROM drivers
                INNER JOIN qualifying USING(driverId)
                INNER JOIN races USING(raceId)
                WHERE races.raceId = ?
                ORDER BY driverRef";

        $data = getData($sql, [$raceId]); // Call getData with the SQL query
    } else{
        $sql = "SELECT driverId, forename, surname, dob, round((julianday('now') - julianday(dob)) / 365.25) AS age, nationality, url   FROM drivers"; // Fetch all drivers
        $data = getData($sql, []); // Call getData without parameters
    }
    if (empty($data)) {
        $response = ["error" => $raceId ? "No driver found for raceId: $raceId" : "No data found."];
    } else {
        $response = $data;
    }

    echo json_encode($response, JSON_NUMERIC_CHECK +JSON_PRETTY_PRINT);
    return $response;
}


// Check for driverRef or raceId in the query string and call the appropriate function
if (isset($_GET['driverRef']) && !empty($_GET['driverRef'])) {
    getSpecifiedDrivers($_GET['driverRef']);
} elseif (isset($_GET['raceId']) && !empty($_GET['raceId'])) {
    getDriversForRace($_GET['raceId']);
} else {
    getSpecifiedDrivers(null); // Call without parameters to fetch all drivers\
    getDriversForRace(null);
}




?>