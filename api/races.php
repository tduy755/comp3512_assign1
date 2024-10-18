<?php
    require_once('../includes/config.inc.php');
    include_once ('../includes/db.inc.php');

    // Tell the browser to expect JSON rather than HTML
    header('Content-type: application/json');
    // Indicate whether other domains can use this API
    header("Access-Control-Allow-Origin: *");

    function getSpecifiedRaces($raceRef = null) { 
        if ($raceRef) {
            $sql = "SELECT r.raceId, r.name AS raceName, c.name AS circuitName, c.location, c.country
                    FROM races AS r
                        INNER JOIN circuits AS c ON r.circuitId = c.circuitId
                    WHERE r.raceId = ?"; 

            $data = getData($sql, [$raceRef]);
        } else {
            // Query to return all races from the 2022 season
            $sql = "SELECT r.raceId, r.name AS raceName, c.name AS circuitName, c.location, c.country
                    FROM races AS r
                        INNER JOIN circuits AS c ON r.circuitId = c.circuitId
                    WHERE r.year = 2022
                    ORDER BY r.round"; 

            $data = getData($sql, []);
        }

        if (empty($data)) {
            // Error handling for empty results
            $response = ["error" => $raceRef ? "No race found for raceId: $raceRef" : "No data found."];
        } else {
            // Return data in the response
            $response = $data;
        }

        // Echo the JSON response
        echo json_encode($response, JSON_NUMERIC_CHECK);
        return $response;
    }

    if (isset($_GET['ref']) && !empty($_GET['ref'])) {
        getSpecifiedRaces($_GET['ref']); 
    } else {
        getSpecifiedRaces(null); // Return all races if no ref is provided
    }
?>
