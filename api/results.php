<?php
    require_once('../includes/config.inc.php');
    include_once ('../includes/db.inc.php');

     // Tell the browser to expect JSON rather than HTML
    header('Content-type: application/json');
    // Indicate whether other domains can use this API
    header("Access-Control-Allow-Origin: *");

    function getRaceResults($raceRef) {
        if ($raceRef) {
            $sql = "
                SELECT 
                    results.raceId,
                    results.position AS finishPosition,
                    results.grid AS gridPosition,
                    results.laps AS laps,
                    results.time AS raceTime,
                    results.fastestLap AS fastestLap,
                    drivers.driverRef,
                    drivers.forename,
                    drivers.surname,
                    constructors.name AS constructorName,
                    constructors.constructorRef,
                    constructors.nationality
                FROM results
                INNER JOIN drivers ON results.driverId = drivers.driverId
                INNER JOIN constructors ON results.constructorId = constructors.constructorId
                WHERE results.raceId = ?
                ORDER BY results.position ASC";
    
            // Execute the query and retrieve the data
            $data = getData($sql, [$raceRef]);
        } else {
            // If no raceRef is provided, return an error
            $data = ["error" => "No race reference provided."];
        }
    
        // Return the data as JSON
        echo json_encode($data, JSON_NUMERIC_CHECK);
    }
    
   
    function getDriverResults($driverRef) {
        if ($driverRef) {
            $sql = "
                SELECT 
                    drivers.driverRef,
                    results.position AS finishPosition,
                    results.grid AS gridPosition,
                    results.laps AS laps,
                    results.time AS raceTime,
                    results.fastestLap AS fastestLap,
                    races.name AS raceName,
                    races.round AS raceRound,
                    races.year AS raceYear,
                    races.date AS raceDate,
                    constructors.name AS constructorName
                FROM results
                INNER JOIN races ON results.raceId = races.raceId
                INNER JOIN constructors ON results.constructorId = constructors.constructorId
                INNER JOIN drivers ON results.driverId = drivers.driverId
                WHERE drivers.driverRef = ?
                ORDER BY races.date ASC";
    
            $data = getData($sql, [$driverRef]);
        } else {
            $data = ["error" => "No driver reference provided."];
        }
    
        echo json_encode($data, JSON_NUMERIC_CHECK);
    }
    
    if (isset($_GET['ref']) && !empty($_GET['ref'])) {
        getRaceResults($_GET['ref']);
    } elseif (isset($_GET['driver']) && !empty($_GET['driver'])) {
        getDriverResults($_GET['driver']);
    } else {
        echo json_encode(["error" => "No race reference or driver reference provided."], JSON_NUMERIC_CHECK);
    }
    ?>