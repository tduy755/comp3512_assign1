<?php
    require_once('../includes/config.inc.php');
    include_once ('../includes/db.inc.php');

     // Tell the browser to expect JSON rather than HTML
    header('Content-type: application/json');
    // Indicate whether other domains can use this API
    header("Access-Control-Allow-Origin: *");

function getSpecifiedCircuits($circuitRef = null) { 
    if ($circuitRef) {
        $sql = "SELECT c.circuitId, c.name, c.country, c.location, c.country, c.url, seasons.year as season from circuits as c   
                    INNER JOIN races USING(circuitId)
                    INNER JOIN seasons USING(year)
                WHERE circuitRef = ? "; 

        $data = getData($sql, [$circuitRef]); 
    } else {
        //return all circuits from 2022 season
        $sql = "SELECT  c.circuitId, c.name, c.country, c.location, c.country, c.url, seasons.year as season from circuits as c   
                    INNER JOIN races USING(circuitId)
                    INNER JOIN seasons USING(year)

                WHERE races.year = 2022
                ORDER BY c.circuitId"; 
        $data = getData($sql, []); 
    }

    if (empty($data)) {
        $response = ["error" => $circuitRef ? "No circuit found for circuitRef: $circuitRef" : "No data found."];
    } else {
        $response = $data;
    }

    // Echo the JSON response
    echo json_encode($response, JSON_NUMERIC_CHECK);
    return $response;
}


if (isset($_GET['circuitRef']) && !empty($_GET['circuitRef'])) {
    getSpecifiedCircuits($_GET['circuitRef']);
}else {
    getSpecifiedCircuits(null);
}

?>