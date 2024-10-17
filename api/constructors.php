<?php
    require_once('../includes/config.inc.php');
    include_once ('../includes/db.inc.php');

    // Tell the browser to expect JSON rather than HTML
    header('Content-type: application/json');
    // Indicate whether other domains can use this API
    header("Access-Control-Allow-Origin: *");

function getSpecifiedConstructors($constructorRef = null) { 
    if ($constructorRef) {
        $sql = "SELECT constructors.name, nationality, constructors.url
                FROM constructors   
                WHERE constructorRef = ?"; 

        $data = getData($sql, [$constructorRef]); 
    } else {
        // Return all constructors 
        $sql = "SELECT constructors.constructorId, constructors.name, nationality, constructors.url
                FROM constructors   
                ORDER BY constructors.constructorId"; 

        $data = getData($sql, []); 
    }

    if (empty($data)) {
        // Error handling for empty results
        $response = ["error" => $constructorRef ? "No constructor found for constructorRef: $constructorRef" : "No data found."];
    } else {
        // Return data in the response
        $response = $data;
    }

    // Echo the JSON response
    echo json_encode($response, JSON_NUMERIC_CHECK);
    return $response;
}

if (isset($_GET['ref']) && !empty($_GET['ref'])) {
    getSpecifiedConstructors($_GET['ref']); 
} else {
    getSpecifiedConstructors(null); // Return all constructors if no ref is provided
}
?>
