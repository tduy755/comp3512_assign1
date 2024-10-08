<?php
    require_once('../includes/config.inc.php');
    include_once ('../includes/db.inc.php');

     // Tell the browser to expect JSON rather than HTML
    header('Content-type: application/json');
    // Indicate whether other domains can use this API
    header("Access-Control-Allow-Origin: *");

function getSpecifiedRaces($raceId = null) { 
    if ($raceId) {
        $sql = "SELECT r.raceId, r.name, c.name, c.location, c.country, r.year
                FROM races as r  
                    INNER JOIN circuits as c USING(circuitId)
                WHERE r.raceId = ? "; 

        $data = getData($sql, [$raceId]); 
    } else {
        //return all constructors from 2022 season
        $sql = "SELECT r.raceId, r.name, c.name, c.location, c.country, r.year, r.round
                FROM races as r  
                    INNER JOIN circuits as c USING(circuitId)
                WHERE r.year = 2022
                ORDER BY r.round"; 
        $data = getData($sql, []); 
    }

    if (empty($data)) {
        $response = ["error" => $raceId ? "No race found for raceId: $raceId" : "No data found."];
    } else {
        $response = $data;
    }

    // Echo the JSON response
    echo json_encode($response, JSON_NUMERIC_CHECK);
    return $response;
}


if (isset($_GET['raceId']) && !empty($_GET['raceId'])) {
    getSpecifiedRaces($_GET['raceId']);
}else {
    getSpecifiedRaces(null);
}

?>