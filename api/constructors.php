<?php
    require_once('../includes/config.inc.php');
    include_once ('../includes/db.inc.php');

     // Tell the browser to expect JSON rather than HTML
    header('Content-type: application/json');
    // Indicate whether other domains can use this API
    header("Access-Control-Allow-Origin: *");

function getSpecifiedConstructors($constructorRef = null) { 
    if ($constructorRef) {
        $sql = "SELECT  constructors.name, nationality, constructors.url, races.year as season from constructors   
                    INNER JOIN qualifying USING(constructorId)
                    INNER JOIN races USING(raceId)
                WHERE constructorRef = ? "; // Directly include the parameter

        $data = getData($sql, [$constructorRef]); // Pass the driverRef as an array
    } else {
        //return all constructors from 2022 season
        $sql = "SELECT  distinct(constructors.constructorId), constructors.name, nationality, constructors.url, races.year as season from constructors   
                    INNER JOIN qualifying USING(constructorId)
                    INNER JOIN races USING(raceId)
                   
                WHERE races.year = 2022
                ORDER BY constructors.constructorId"; 
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