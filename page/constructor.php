<?php
require_once('../includes/config.inc.php'); 
require_once('../includes/db.inc.php'); 
// Get constructorRef from query string
$constructorRef = isset($_GET['constructorRef']) ? $_GET['constructorRef'] : null; 

function showConstructorDetails($constructorRef) {
    if (empty($constructorRef)) {
        return "<p>No constructor reference provided.</p>"; // Return a message if driverRef is empty
    }
    // Prepare the SQL query
    $sql = "SELECT c.name, c.nationality, c.url 
            FROM constructors as c 
            WHERE constructorRef = ?"; // Directly using constructorRef

    // Get the driver data
    $constructor = getData($sql, $_GET['constructorRef']);

    // Check if constructor data is found
    if (empty($constructor)) {
        return "<p>No driver found for driverRef: $constructorRef</p>";
    }

    // Build HTML output
    $output = "<ul>";
    foreach ($constructor as $c) {
        $output .= "<li>Name: " . $c['name']. "</li>";
        $output .= "<li>Nationality: " . $c['nationality'] . "</li>";
        $output .= "<li>URL: <a href='" . $c['url'] . "'>" . $c['url'] . "</a></li>";
    }
    $output .= "</ul>";

    return $output;
}

// Check if constructorRef is provided before calling the function
if ($constructorRef) {
    $constructorData = showConstructorDetails($constructorRef);
} else {
    $constructorData = "<p>No constructor reference provided.</p>"; 
}

function showResultsConstructor($constructorRef) {
     $sql = "   SELECT ra.round, ci.name AS circuit_name, d.forename, d.surname, r.position, r.points
                FROM results AS r
                    INNER JOIN races AS ra ON r.raceId = ra.raceId
                    INNER JOIN circuits AS ci ON ra.circuitId = ci.circuitId
                    INNER JOIN drivers AS d ON r.driverId = d.driverId
                    INNER JOIN constructors AS c ON r.constructorId = c.constructorId
                WHERE ra.year = 2022 AND c.constructorRef = ?
                ORDER BY ra.round, r.position"; // Order by round and position
    if (empty($constructorRef)) {
        return "<p>No constructor reference provided.</p>"; // Return a message if driverRef is empty
    }
    $data = getData($sql, $_GET['constructorRef']); // Call getData with the SQL query

    if (empty($data)) {
        return "<p>No data found for constructor in 2022 for: $constructorRef</p>";
    } 
    $output = "<table>";

    $output .= "<tr>";
    $output .= "<th>Round</th>";
    $output .= "<th>Circuit Name</th>";
    $output .= "<th>Driver Name</th>";
    $output .= "<th>Position</th>";
    $output .= "<th>Points</th>";
    $output .= "</tr>";

    // Iterate through the data rows
    foreach ($data as $d) {
        $output .= "<tr>";
        $output .= "<td>" . $d['round'] . "</td>";
        $output .= "<td>" . $d['circuit_name'] . "</td>";
        $output .= "<td>" . $d['forename'] . ' ' . $d['surname'] . "</td>";
        $output .= "<td>" . $d['position'] . "</td>";
        $output .= "<td>" . $d['points'] . "</td>";
        $output .= "</tr>";
    }

    $output .= "</table>";
    return $output;
}
$constructorRaceData = showResultsConstructor($constructorRef);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>F1 Dashboard Project</title>
    <link rel="stylesheet" href="../styles/driver.css"> <!-- Link to the CSS file -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap" rel="stylesheet">
</head>
<body>

<header>
    <h1>F1 Dashboard Project</h1>
    <nav>
    <a href="#"><i class="fas fa-home"></i> Home</a>
    <a href="#"><i class="fas fa-folder-open"></i> Browse</a>
    <a href="#"><i class="fas fa-code"></i> APIs</a>
    </nav>
</header>

<div class="container">
    <div class="driver-details">
        <h2>Constructor Details</h2>
        <ul>
          <?php echo $constructorData; ?>
        </ul>
    </div>

    <div class="race-results">
        <h2>Race Results</h2>
        <?php
            echo $constructorRaceData;
        ?>
        <p class="note">Display the results for the current season sorted by round for both drivers and constructor</p>
    </div>
</div>

</body>
</html>