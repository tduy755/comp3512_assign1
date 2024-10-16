<!-- The next shown is the Browse Page. Initially it will display all the races for the season.
When the user selects a race, then display more information for the race as well as a list
of qualifying results and race results. When we learn JavaScript, we will have a clean way
to hide/show data. In PHP, your page will need to “know” whether to display race results
or not. If there is a raceId passed to the page, then display results. -->
<?php
require_once('../includes/config.inc.php'); 
require_once('../includes/db.inc.php'); 
    
function show2022Races() {
    // Show all races in 2022
    $sql = "SELECT raceId, name, round, url FROM races
            WHERE year = 2022
            ORDER BY round";
    
    $races = getData($sql, []);

    // Start the table
    $output = '<table>';
    $output .= '<tr>';
    $output .= '<th>Rnd</th>';
    $output .= '<th>Circuit</th>';
    $output .= '<th>Results</th>'; // Add the Results header
    $output .= '</tr>';

    // Loop through the races and print each row
    foreach ($races as $race) {
        $output .= '<tr>';
        $output .= '<td>' . $race['round'] . '</td>';
        $output .= '<td>' . $race['name'] . '</td>';
        $output .= '<td><a class="button" href="?raceId=' . $race['raceId'] . '">Results</a></td>';
        $output .= '</tr>';
    }

    // End the table
    $output .= '</table>';

    return $output; // Return the generated HTML
}

$raceId = isset($_GET['raceId']) ? $_GET['raceId'] : null; 
    function showRacesData($raceId) {
        //Show Race Name, Round #, Circuit Name, Circuit Location, Circuit Country, Date of race, URL of race
        //This should be a Table
        $sql = "select r.raceId, r.round, c.name, c.location, c.country, r.date, r.url
                from races as r
                    inner join circuits as c using(circuitId)
                where year = 2022 and r.raceId = ?
                order by r.round";

        $data = getData($sql, [$raceId]);
        if (empty($raceId)) {
            echo "<p><strong>Please select a race.</strong></p>";
        }
     // Generate the table dynamically
         $output = '<table>';
        $output .= '<tr>
            <th>Race Name</th>
            <th>Round #</th>
            <th>Circuit Name</th>
            <th>Circuit Location</th>
            <th>Circuit Country</th>
            <th>Date of Race</th>
            <th>URL of Race</th>
        </tr>';
        
        foreach ($data as $row) {
            $output .= '<h2>Data for ' .$row['name'].'</h2>';
            $output .= '<tr>
                <td>' . $row['name'] . '</td>
                <td>' . $row['round'] . '</td>
                <td>' . $row['name'] . '</td>
                <td>' . $row['location'] . '</td>
                <td>' . $row['country'] . '</td>
                <td>' . $row['date'] . '</td>
                <td><a href="' . $row['url'] . '">Link</a></td>
            </tr>';
        }
        
        $output .= '</table>';
        return $output; // Return the generated HTML
    }

    

    function showQualifyingData($raceId) {
        //Output Query string: driverRef, constructorRef
        $sql ="SELECT r.raceId, q.position, d.forename, d.surname, co.name as constructor, d.driverRef, co.constructorRef , q.q1, q.q2, q.q3
                FROM qualifying AS q
                    INNER JOIN drivers AS d ON q.driverId = d.driverId
                    INNER JOIN constructors AS co ON q.constructorId = co.constructorId
                    INNER JOIN races AS r ON q.raceId = r.raceId
                    INNER JOIN circuits AS c ON r.circuitId = c.circuitId
                WHERE r.year = 2022 and r.raceId = ?
                order by q.position";
    

    $data = getData($sql, [$raceId]);
      


    // Generate the table dynamically
    $output = '<h2>Qualifying</h2>';
    $output .= '<table>';
    $output .= '<tr>
        <th>Pos</th>
        <th>Driver</th>
        <th>Constructor</th>
        <th>Q1</th>
        <th>Q2</th>
        <th>Q3</th>
    </tr>';

    foreach ($data as $row) {
        $output .= '<tr>
            <td>' . $row['position'] . '</td>
            <td><a href="driver.php?driverRef=' . $row['driverRef'] . '" target="_blank">' . $row['forename'] . ' ' . $row['surname'] . '</a></td>
            <td><a href="constructor.php?constructorRef=' . $row['constructorRef'] . '" target="_blank">' . $row['constructor'] . '</a></td>
            <td>' . $row['q1'] . '</td>
            <td>' . $row['q2'] . '</td>
            <td>' . $row['q3'] . '</td>
        </tr>';
    }

    $output .= '</table>';
    return $output; // Return the generated HTML

   
}

    function showResultsData($raceId) {
    // Top 3 racers
    $sql = "SELECT d.forename, d.surname, re.position
            FROM results AS re
                INNER JOIN drivers AS d ON re.driverId = d.driverId
                INNER JOIN races AS r ON re.raceId = r.raceId
            WHERE r.year = 2022 AND r.raceId = ?
            ORDER BY re.position
            LIMIT 3";
    
    $data = getData($sql, [$raceId]);

    // Generate the HTML for top results
    $output = '<div class="top-results">';
    foreach ($data as $row) {
        $output .= '<div class="result-box">
                        <h3>' . $row['forename'] . ' ' . $row['surname'] . '</h3>
                        <p>' . $row['position'] . 'st</p>
                    </div>';
    }
    $output .= '</div>';

    return $output; // Return the generated HTML
}
    function showResultsTable($raceId) {
    // Top 1 - 20 of a race
    $sql ="SELECT re.position, d.forename, d.surname, co.name, re.laps, re.points 
            FROM results AS re
                INNER JOIN drivers AS d ON re.driverId = d.driverId
                INNER JOIN constructors AS co ON re.constructorId = co.constructorId
                INNER JOIN races AS r ON re.raceId = r.raceId
            WHERE r.year = 2022 AND r.raceId = ?
            ORDER BY re.position
            LIMIT 3";
    $data = getData($sql, [$raceId]);

    // Generate the results table dynamically
    $output = '<table>';
    $output .= '<tr>
                    <th>Pos</th>
                    <th>Driver</th>
                    <th>Constructor</th>
                    <th>Laps</th>
                    <th>Pts</th>
                </tr>';

    foreach ($data as $row) {
        $output .= '<tr>
                        <td>' . $row['position'] . '</td>
                        <td>' . $row['forename']. ' ' . $row['surname'] . '</td>
                        <td>' . $row['name'] . '</td>
                        <td>' . $row['laps'] . '</td>
                        <td>' . $row['points'] . '</td>
                    </tr>';
    }

    $output .= '</table>';
    return $output; // Return the generated HTML
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>F1 Dashboard Project</title>
    <link rel="stylesheet" href="../styles/browse.css"> 
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
    <div class="races">
        <h2>2022 Races</h2>
        <?php echo show2022Races()?>
    </div>
    <div class="race-info"> 
        <?php echo showRacesData($raceId);?>
        <?php echo showQualifyingData($raceId); ?>
    </div>
        
        
 <div class="results">
        <h2>Results</h2>
        
        <?php echo showResultsData($raceId); ?>

       <?php echo showResultsTable($raceId); ?>
    </div>
</div>

</body>
</html>