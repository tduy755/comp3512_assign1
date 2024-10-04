<!-- The next shown is the Driver Page. It includes details about the driver as well as race
results for that driver for the season. How will the page “know” which driver to display?
It will be passed the driverRef value for the driver. -->
<?php
          require_once('includes/config.inc.php'); 
          require_once('includes/db.inc.php'); 
          require_once('api/drivers.php');
    $driverRef = isset($_GET['driverRef']) ? $_GET['driverRef'] : null; // Get driverRef from query string
    $driverData = getSpecifiedDrivers($driverRef); // Call the function to get driver data
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>F1 Dashboard Project</title>
    <link rel="stylesheet" href="styles/driver.css"> <!-- Link to the CSS file -->
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
        <h2>F1 Drivers 2022</h2>
        <ul>
            <?php
        foreach ($driverData as $data) { // Corrected syntax: added $ before data
            echo "
            <li id='name'>{$data['forename']} {$data['surname']}</li> <!-- Corrected array access -->
            <li id='dob'>{$data['dob']}</li> <!-- Added data access -->
            <li id='age'>{$data['age']}</li> <!-- Added data access -->
            <li id='nationality'>{$data['nationality']}</li> <!-- Added data access -->
            <li id='url'><a href='{$data['url']}'>URL</a></li> <!-- Corrected array access -->
            ";
        }
            ?>
        </ul>
      
    </div>

    <div class="race-results">
        <h2>Race Results</h2>
        <table>
            <tr>
                <th>Rnd</th>
                <th>Circuit</th>
                <th>Pos</th>
                <th>Points</th>
            </tr>
            <tr>
                <td>1</td>
                <td>British Grand Prix</td>
                <td>1</td>
                <td>15</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Italian Grand Prix</td>
                <td>2</td>
                <td>10</td>
            </tr>
        </table>
        <p class="note">Display the results for the current season sorted by round</p>
    </div>
</div>

</body>
</html>