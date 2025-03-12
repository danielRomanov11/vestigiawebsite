<?php
  $current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="variables.css">
    <link rel="stylesheet" href="navbar.css">
</head>
<body>
<!DOCTYPE HTML>
<html>
  <head>
    <title>Vestigia - Find Your Next Adventure</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap">
    <link rel="icon" href="images/vestigiaLogo.png" type="image/png">
    <link rel="stylesheet" href="navbar.css">
  </head>
  <body style="font-family: 'Open Sans', sans-serif;">
    <div class="navbar">
      <div class="logo">
        <a href="index.php"><img src="images\vestigiaLogo.png" alt="Vestigia Logo"></a>
      </div>
      <div class="search-container">
        <input type="text" placeholder="  Search..." class="search-bar">
      </div>
      <div class="hamburger-menu">
        <button class="hamburger-btn">&#9776;</button>
        <div class="mobile-menu">
          <button class="close-btn">&times;</button>
          <ul class="mobile-links">
            <li><a href="index.php" class="nav-link <?php echo $current_page == 'index.php' ? 'active' : ''; ?>"><i class="fa fa-home"></i>Home</a></li>
            <li><a href="map.php" class="nav-link <?php echo $current_page == 'map.php' ? 'active' : ''; ?>"><i class="fa fa-map"></i>Map</a></li>
            <li><a href="itinerary.php" class="nav-link <?php echo $current_page == 'itinerary.php' ? 'active' : ''; ?>"><i class="fa fa-calendar"></i>Itinerary</a></li>
            <li><a href="transportation.php" class="nav-link <?php echo $current_page == 'transportation.php' ? 'active' : ''; ?>"><i class="fa fa-bus"></i>Transportation</a></li>
            <li><a href="messaging.php" class="nav-link <?php echo $current_page == 'messaging.php' ? 'active' : ''; ?>"><i class="fa fa-comments"></i>Messaging</a></li>
            <li><a href="wiki.php" class="nav-link <?php echo $current_page == 'wiki.php' ? 'active' : ''; ?>"><i class="fa fa-book"></i>Wiki</a></li>
            <?php if (isset($_SESSION['name'])){ ?>
              <li><a href="profile.php" class="nav-link profile-btn <?php echo $current_page == 'profile.php' ? 'active' : ''; ?>"><i class="fa fa-user"></i>Profile</a>
                <div class="dropdown-menu">
                  <a href="settings.php">Settings</a>
                  <a href="logout.php">Logout</a>
                </div>
              </li>
              <?php } else { ?>
              <li><a href="login.php" class="nav-link login-btn <?php echo $current_page == 'login.php' ? 'active' : ''; ?>">Login</a></li>
              <?php } ?>
            <li><a href="/language" class="nav-link <?php echo $current_page == 'language.php' ? 'active' : ''; ?>"><i class="fa fa-globe"></i>Language</a></li>
          </ul>
        </div>
      </div>
      <ul class="nav-links">
        <li class="nav-item"><a href="index.php" class="nav-link <?php echo $current_page == 'index.php' ? 'active' : ''; ?>"><i class="fa fa-home"></i></a><span class="tooltip">Home</span></li>
        <li class="nav-item"><a href="map.php" class="nav-link <?php echo $current_page == 'map.php' ? 'active' : ''; ?>"><i class="fa fa-map"></i></a><span class="tooltip">Map</span></li>
        <li class="nav-item"><a href="itinerary.php" class="nav-link <?php echo $current_page == 'itinerary.php' ? 'active' : ''; ?>"><i class="fa fa-calendar"></i></a><span class="tooltip">Itinerary</span></li>
        <li class="nav-item"><a href="transportation.php" class="nav-link <?php echo $current_page == 'transportation.php' ? 'active' : ''; ?>"><i class="fa fa-bus"></i></a><span class="tooltip">Transportation</span></li>
        <li class="nav-item"><a href="messages.php" class="nav-link <?php echo $current_page == 'messages.php' ? 'active' : ''; ?>"><i class="fa fa-comments"></i></a><span class="tooltip">Messaging</span></li>
        <li class="nav-item"><a href="wiki.php" class="nav-link <?php echo $current_page == 'wiki.php' ? 'active' : ''; ?>"><i class="fa fa-book"></i></a><span class="tooltip">Wiki</span></li>
        <?php if (isset($_SESSION['name'])) { ?>
          <li class="nav-item profile-btn"><a href="profile.php" class="nav-link <?php echo $current_page == 'profile.php' ? 'active' : ''; ?>"><i class="fa fa-user"></i></a>
            <div class="dropdown-menu">
                <a href="settings.php">Settings</a>
                <a href="logout.php">Logout</a>
            </div>
          </li>
        <?php } else { ?>
          <li class="nav-item"><a href="login.php" class="nav-link login-btn <?php echo $current_page == 'login.php' ? 'active' : ''; ?>">Login</a></li>
        <?php } ?>
        <li class="nav-item"><a href="/language" class="nav-link <?php echo $current_page == 'language.php' ? 'active' : ''; ?>"><i class="fa fa-globe"></i></a><span class="tooltip">Language</span></li>
      </ul>
    </div>  
</body>
</html>