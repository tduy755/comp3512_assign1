<!-- The first shown below is the Home Page. This will be what the user sees first. It’s
filename must be index.php. The prototype shown below is purposively simple and
focuses on functionality. It’s up to you to make it look good.
8. Header. The page title can be whatever you’d like. You need to provide a brief
description (be sure to mention it is assignment #1 for COMP3512 at Mount Royal
University), styled nicely, about what this site is about, what technologies you are using,
the group member names, and the URL for the github repo. Notice also there are buttons
or links that will appear on every PHP page. -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>F1 Dashboard Project</title>
    <link rel="stylesheet" href="../styles/index.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400&display=swap" >
    
</head>
<body>

<header>
    <h1>F1 Dashboard Project</h1>
    <nav>
        <a href=" index.php"><i class="fas fa-home"></i> Home</a>
        <a href="browse.php"><i class="fas fa-folder-open"></i> Browse</a>
        <a href="apitester.php"><i class="fas fa-code"></i> APIs</a>
    </nav>
</header>

<div class="container">
    <div class="description">
        <h2>Description</h2>
       <p>This project is about F1 races that happened in 2022, it shows how each driver did at a circuit. Duy Tran and Chase Knight
         <a href="https://github.com/tduy755/comp3512_assign1/tree/master">Our GitHub Repo!</a><br>
         <a href="browse.php">
            <button type="button">Browse 2022 Season</button></a>
        </p>
    </div>

    <div class="image">
        <img src="/assign1/images/f1.jpeg" alt="2 Cars">
    </div>
</div>
</html>