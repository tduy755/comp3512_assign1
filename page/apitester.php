
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>F1 Dashboard Project</title>
    <link rel="stylesheet" href="../styles/apitester.css"> 
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
    <h2> API List</h2>

    <table>
        <thead>
            <tr>
                <th>API URL</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><a href="/assign1/api/circuits.php" target="_blank">/api/circuits.php</a></td>
                <td>Returns all the circuits for the 2022 season.</td>
            </tr>
            <tr>
                <td><a href="/assign1/api/circuits.php?circuitRef=monaco" target="_blank">/api/circuits.php?circuitRef=monaco</a></td>
                <td>Returns details for the circuit with the ref `monaco`.</td>
            </tr>
            <tr>
                <td><a href="/assign1/api/constructors.php" target="_blank">/api/constructors.php</a></td>
                <td>Returns all constructors for the 2022 season.</td>
            </tr>
            <tr>
                <td><a href="/assign1/api/constructors.php?ref=mclaren" target="_blank">/api/constructors.php?ref=mclaren</a></td>
                <td>Returns details for the constructor with the ref `mclaren`.</td>
            </tr>
            <tr>
                <td><a href="/assign1/api/drivers.php" target="_blank">/api/drivers.php</a></td>
                <td>Returns all drivers for the 2022 season.</td>
            </tr>
            <tr>
                <td><a href="/assign1/api/drivers.php?driverRef=hamilton" target="_blank">/api/drivers.php?driverRef=hamilton</a></td>
                <td>Returns details for the driver with the ref `hamilton`.</td>
            </tr>
            <tr>
                <td><a href="/assign1/api/drivers.php?raceId=1106" target="_blank">/api/drivers.php?raceId=1106</a></td>
                <td>Returns drivers for a specific race (race ID: 1106).</td>
            </tr>
            <tr>
                <td><a href="/assign1/api/races.php" target="_blank">/api/races.php</a></td>
                <td>Returns all races for the 2022 season.</td>
            </tr>
            <tr>
                <td><a href="/assign1/api/races.php?ref=1106" target="_blank">/api/races.php?ref=1106</a></td>
                <td>Returns details for a specific race (race ID: 1106).</td>
            </tr>
            <tr>
                <td><a href="/assign1/api/qualifying.php?ref=1106" target="_blank">/api/qualifying.php?ref=1106</a></td>
                <td>Returns qualifying results for a specific race (race ID: 1106).</td>
            </tr>
            <tr>
                <td><a href="/assign1/api/results.php?ref=1106" target="_blank">/api/results.php?ref=1106</a></td>
                <td>Returns race results for a specific race (race ID: 1106).</td>
            </tr>
            <tr>
                <td><a href="/assign1/api/results.php?driver=max_verstappen" target="_blank">/api/results.php?driver=max_verstappen</a></td>
                <td>Returns all results for a specific driver (driver: Max Verstappen).</td>
            </tr>
        </tbody>
    </table>
</div>

</body>
</html>