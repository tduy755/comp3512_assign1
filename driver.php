<!-- The next shown is the Driver Page. It includes details about the driver as well as race
results for that driver for the season. How will the page “know” which driver to display?
It will be passed the driverRef value for the driver. -->
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
            <li id=name>Name</li>
            <li id=dob>DOB</li>
            <li id=age>Age</li>
            <li id=nationality>Nationality</li>
            <li id=url><a href="#">URL</a></li>
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