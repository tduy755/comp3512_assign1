<?php
    require_once('../includes/config.inc.php');
    include_once ('../includes/db.inc.php');

    // Tell the browser to expect JSON rather than HTML
    header('Content-type: application/json');
    // Indicate whether other domains can use this API
    header("Access-Control-Allow-Origin: *");

    
    function getQualifyingResults($raceRef) {
        if ($raceRef) {
            $sql = "
                SELECT 
                    qualifying.raceId,
                    qualifying.position as qualifyingPosition, 
                    drivers.driverRef, 
                    drivers.forename, 
                    drivers.surname, 
                    constructors.name as constructorName,
                    qualifying.q1, qualifying.q2, qualifying.q3
                FROM qualifying
                INNER JOIN drivers ON qualifying.driverId = drivers.driverId
                INNER JOIN constructors ON qualifying.constructorId = constructors.constructorId
                WHERE qualifying.raceId = ?
                ORDER BY qualifying.position ASC";
            
            $data = getData($sql, [$raceRef]);
        } else {
            $data = ["error" => "No race reference provided."];
        }

        echo json_encode($data, JSON_NUMERIC_CHECK);
    }

    if (isset($_GET['ref']) && !empty($_GET['ref'])) {
        getQualifyingResults($_GET['ref']);
    } else {
        echo json_encode(["error" => "No race reference provided."], JSON_NUMERIC_CHECK);
    }
?>
