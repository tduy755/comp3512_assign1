<?php
 require_once('../includes/config.inc.php'); 
 require_once('../includes/db.inc.php'); 


    // Function to show constructor details based on constructorRef
    function showConstructorDetails($constructorRef) {
        if (empty($constructorRef)) {
            return "<p>No constructor reference provided.</p>";
        }
        
        // SQL query to retrieve constructor details
        $sql = "SELECT constructorId, name, nationality, url 
                FROM constructors 
                WHERE constructorRef = ?";

        // Fetch constructor data
        $constructor = getData($sql, $constructorRef);

        // Check if constructor data is found
        if (empty($constructor)) {
            return "<p>No constructor found for constructorRef: $constructorRef</p>";
        }

        // Build HTML output
        $output = "<ul>";
        foreach ($constructor as $c) {
            $output .= "<li>Name: " . $c['name'] . "</li>";
            $output .= "<li>Nationality: " . $c['nationality'] . "</li>";
            $output .= "<li>URL: <a href='" . $c['url'] . "'>" . $c['url'] . "</a></li>";
        }
        $output .= "</ul>";

        return $output;
    }

    // Function to show race results for the constructor in 2022 season
    function getConstructorRaceResults($constructorRef) {
        if (empty($constructorRef)) {
            return "<p>No constructor reference provided.</p>";
        }

        // SQL query to retrieve race results for the constructor
        $sql = "   SELECT constructors.constructorRef, races.round, circuits.name, results.position, results.points as total_points
                    FROM constructors  
                    INNER JOIN results USING(constructorId)
                    INNER JOIN races USING(raceId)
                    INNER JOIN circuits USING(circuitId)
                    WHERE constructors.constructorRef = ?
                    AND races.year = 2022
                    GROUP BY constructors.constructorRef, races.round, circuits.name
                    ORDER BY races.round, circuits.name";
        
        // Fetch race results data
        $data = getData($sql, $constructorRef);

        if (empty($data)) {
            return "<p>No data found for constructor in 2022 for: $constructorRef</p>";
        }

        // Build table output for race results
        $output = "<table>";
        $output .= "<tr>";
        $output .= "<th>Round</th>";
        $output .= "<th>Circuit</th>";
        $output .= "<th>Position</th>";
        $output .= "<th>Points</th>";
        $output .= "</tr>";

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

    // Get constructorRef from query string
    $constructorRef = isset($_GET['constructorRef']) ? $_GET['constructorRef'] : null; 

    // Call functions to retrieve data if constructorRef is provided
    if ($constructorRef) {
        $constructorData = showConstructorDetails($constructorRef);
        $raceData = getConstructorRaceResults($constructorRef);
    } else {
        $constructorData = "<p>No constructor reference provided.</p>";
        $raceData = "<p>No constructor reference provided.</p>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>F1 Constructor Dashboard</title>
    <link rel="stylesheet" href="../styles/constructor.css"> <!-- Link to the CSS file -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap" rel="stylesheet">
</head>
<body>

<header>
    <h1>F1 Constructor Dashboard</h1>
    <nav>
        <a href="#"><i class="fas fa-home"></i> Home</a>
        <a href="#"><i class="fas fa-folder-open"></i> Browse</a>
        <a href="#"><i class="fas fa-code"></i> APIs</a>
    </nav>
</header>

<div class="container">
    <div class="constructor-details">
        <h2>Constructor Details</h2>
        <?php echo $constructorData; ?> <!-- Display constructor details -->
    </div>

    <div class="race-results">
        <h2>Race Results</h2>
        <?php echo $raceData; ?> <!-- Display constructor's race results -->
        <p class="note">Display the results for the current season sorted by round</p>
    </div>
</div>

</body>
</html>
