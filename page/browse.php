<!-- The next shown is the Browse Page. Initially it will display all the races for the season.
When the user selects a race, then display more information for the race as well as a list
of qualifying results and race results. When we learn JavaScript, we will have a clean way
to hide/show data. In PHP, your page will need to “know” whether to display race results
or not. If there is a raceId passed to the page, then display results. -->
<?php
    function show2022Races() {
        //show all races in 2022

    }
    function showRacesData() {
        //Show Race Name, Round #, Circuit Name, Circuit Location, Circuit Country, Date of race, URL of race
        //This should be a Table
    }

    function showQualifyingData() {
        //Query string: driverRef, constructorRef
    }

    function showResultsData() {

    }

    function showResultsTable() {

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>F1 Dashboard Project</title>
    <link rel="stylesheet" href="../styles/driver.css"> Link to the CSS file
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
        <h2>2022 Races</h2>
        <table>
           <th>Rnd</th>
           <th>Circuit</th>
           <tr>
            <td>1</td>
            <td>British Grand Prix</td>
            </tr>   


        </table>
      
    </div>

    <div class="race-results">
        <h2>Results for Italian Grand Prix</h2>
        
        <p class="note">Display the results for the current season sorted by round</p>
    </div>
</div>

</body>
</html>