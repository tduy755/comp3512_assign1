<!-- The next shown is the Driver Page. It includes details about the driver as well as race
results for that driver for the season. How will the page “know” which driver to display?
It will be passed the driverRef value for the driver. -->
<?php
    require_once('../includes/config.inc.php'); 
    require_once('../includes/db.inc.php'); 
    
    function showDriverDetails($driverRef) {
    if (empty($driverRef)) {
        return "<p>No driver reference provided.</p>"; // Return a message if driverRef is empty
    }
    // Prepare the SQL query
    $sql = "SELECT driverId, forename, surname, dob, 
            round((julianday('now') - julianday(dob)) / 365.25) AS age, nationality, url 
            FROM drivers 
            WHERE driverRef = ?"; // Directly using driverRef

    // Get the driver data
    $driver = getData($sql, $_GET['driverRef']);

    // Check if driver data is found
    if (empty($driver)) {
        return "<p>No driver found for driverRef: $driverRef</p>";
    }

    // Build HTML output
    $output = "<ul>";
        foreach ($driver as $d) {
        $output .= "<li><strong>Name:</strong> " . $d['forename'] . ' ' . $d['surname'] . "</li>";
        $output .= "<li><strong>Date of Birth:</strong> " . $d['dob'] . "</li>";
        $output .= "<li><strong>Age:</strong> " . $d['age'] . "</li>";
        $output .= "<li><strong>Nationality:</strong> " . $d['nationality'] . "</li>";
        $output .= "<li><strong>URL:</strong> <a href='" . $d['url'] . "'>" . $d['url'] . "</a></li>";
    }
    $output .= "</ul>";

    return $output;
}

// Get driverRef from query string
$driverRef = isset($_GET['driverRef']) ? $_GET['driverRef'] : null; 

// Check if driverRef is provided before calling the function
if ($driverRef) {
    $driverData = showDriverDetails($driverRef); // Call the new function
} else {
    $driverData = "<p>No driver reference provided.</p>"; // Handle case when no driverRef is passed
}

function getDriversForRace($driverRef) {
    $sql = "   SELECT drivers.driverRef, races.round, circuits.name, results.position, results.points as total_points
                FROM drivers  
                INNER JOIN results USING(driverId)
                INNER JOIN races USING(raceId)
                INNER JOIN circuits USING(circuitId)
                INNER JOIN qualifying USING(driverId)
                WHERE drivers.driverRef = ?
                AND races.year = 2022
                GROUP BY drivers.driverRef, races.round, circuits.name
                ORDER BY races.round, circuits.name";
    
    if (empty($driverRef)) {
        return "<p>No driver reference provided.</p>"; // Return a message if driverRef is empty
    }
    $data = getData($sql, $_GET['driverRef']); // Call getData with the SQL query

    if (empty($data)) {
        return "<p>No data found for driver in 2022 for: $driverRef</p>";
    } 
    $output = "<table>";

    $output .= "<tr>";
    $output .= "<th>Round</th>";
    $output .= "<th>Name</th>";
    $output .= "<th>Position</th>";
    $output .= "<th>Points</th>";
    $output .= "</tr>";

    // Iterate through the data rows
    foreach ($data as $d) {
        $output .= "<tr>";
        $output .= "<td>" . $d['round'] . "</td>";
        $output .= "<td>" . $d['name'] . "</td>";
        $output .= "<td>" . $d['position'] . "</td>";
        $output .= "<td>" . $d['total_points'] . "</td>";
        $output .= "</tr>";
    }

    $output .= "</table>";
    return $output;
}
$raceData = getDriversForRace($driverRef);
   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>F1 Dashboard Project</title>
    <link rel="stylesheet" href="../styles/driver.css"> <!-- Link to the CSS file -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400&display=swap" >
    
</head>
<body>

<header>
    <h1>F1 Dashboard Project</h1>
    <nav>
    <a href="index.php"><i class="fas fa-home"></i> Home</a>
    <a href="browse.php"><i class="fas fa-folder-open"></i> Browse</a>
    <a href="apitester.php"><i class="fas fa-code"></i> APIs</a>
    </nav>
</header>

<div class="container">
    <div class="driver-details">
        <h2>F1 Drivers 2022</h2>
        <ul>
           <?php echo $driverData; ?>
        </ul>
      
    </div>

    <div class="race-results">
        <h2>Race Results</h2>
        <?php echo $raceData; ?> 
       
    </div>
</div>

</body>
</html>