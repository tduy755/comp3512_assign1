<?php
    require_once('../includes/config.inc.php');
    include_once ('../includes/db.inc.php');

     // Tell the browser to expect JSON rather than HTML
    header('Content-type: application/json');
    // Indicate whether other domains can use this API
    header("Access-Control-Allow-Origin: *");

function getSpecifiedConstructors($constructorRef = null) { //function for drivers
    if ($constructorRef) {
        $sql = "SELECT  constructors.name, nationality, constructors.url, races.year as season from constructors   
                    INNER JOIN qualifying USING(constructorId)
                    INNER JOIN races USING(raceId)
                WHERE constructorRef = ? and races.year = 2022"; // Directly include the parameter

        $data = getData($sql, [$constructorRef]); // Pass the driverRef as an array
    } else {
        //return all drivers from 2022 season
        $sql = "SELECT  constructors.name, nationality, constructors.url, races.year as season from constructors   
                    INNER JOIN qualifying USING(constructorId)
                    INNER JOIN races USING(raceId)
                WHERE races.year = 2022"; 
        $data = getData($sql, []); // Call getData without parameters
    }

    if (empty($data)) {
        $response = ["error" => $constructorRef ? "No constructor found for constructorRef: $constructorRef" : "No data found."];
    } else {
        $response = $data;
    }

    // Echo the JSON response
    echo json_encode($response, JSON_NUMERIC_CHECK);
    return $response;
}


if (isset($_GET['constructorRef']) && !empty($_GET['constructorRef'])) {
    getSpecifiedConstructors($_GET['constructorRef']);
}else {
    getSpecifiedConstructors(null);
}

?>