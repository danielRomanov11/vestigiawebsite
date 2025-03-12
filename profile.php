<?php
session_start();

if (!isset($_SESSION['username']) && isset($_COOKIE['username'])) {
    $_SESSION['username'] = $_COOKIE['username'];
}

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <title><?php echo htmlspecialchars($_SESSION['username']); ?> - Profile</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="main.css" />
    <link rel="stylesheet" href="profile.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap">
    <link rel="icon" href="images/vestigiaLogo.png" type="image/png">
</head>
<body style="font-family: 'Open Sans', sans-serif;">
<?php
include "navbar.php";
?>
<br><br><br>

<div class="banner">
    <img id="banner-image" src="images/defaultProfileBackground.jpg" alt="Banner Image"> <!-- Set default banner image source -->
    <button class="customize-banner-btn">Customize Banner</button> <!-- Added button -->
</div>

<section class="homeBody">
    <div class="profile">
        <div class="profileDetails">
            <img class="profilePic" src="images/defaultProfilePicture.png" alt="<?php echo htmlspecialchars($_SESSION['username']); ?> Profile Picture">
            <h1><?php echo htmlspecialchars($_SESSION['username'])?>
                <i class="fa fa-pencil-alt edit-icon" aria-hidden="true" onclick="enableEditing()"></i> <!-- Added pencil icon -->
            </h1>
            <p><strong>Occupation:</strong> Developer of Vestigia</p>
            <p><strong>Nationality:</strong> Russian</p>
            <p><strong>Birthday:</strong> November 11th, 2005</p>
            <p><strong>University:</strong> Florida State University</p>
            <p><strong>Hometown:</strong> Brooklyn, New York</p>
            <table class="statsTable">
                <thead>
                    <tr>
                        <th>Vestigia Milestones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><img src="images/placeholder.png" alt="Milestone Image" class="milestone-img"> First User </td> <!-- Added image placeholder -->
                    </tr>
                    <tr>
                        <td><img src="images/placeholder.png" alt="Milestone Image" class="milestone-img"> Forward of the Year</td>
                        <td>6</td>
                    </tr>
                    <tr>
                        <td><img src="images/placeholder.png" alt="Milestone Image" class="milestone-img"> CVC Series MVP</td>
                        <td>5</td>
                    </tr>
                    <tr>
                        <td><img src="images/placeholder.png" alt="Milestone Image" class="milestone-img"> Championships</td>
                        <td>7</td>
                    </tr>
                    <tr>
                        <td><img src="images/placeholder.png" alt="Milestone Image" class="milestone-img"> CVC Titles</td>
                        <td>6</td>
                    </tr>
                    <tr>
                        <td><img src="images/placeholder.png" alt="Milestone Image" class="milestone-img"> Golden Boot</td>
                        <td>4</td>
                    </tr>
                    <tr>
                        <td><img src="images/placeholder.png" alt="Milestone Image" class="milestone-img"> All-League First Team</td>
                        <td>6</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="profileBody">
        <h3 class="userBio">My Bio:</h3>
        <div id="bio">
          <p>Lorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem IpsumLorem Ipsum</p>
        </div>
        <h3 class="moreProfiles">More Profiles</h3>
        <div class="card-container">
            <a href="nazarovProfile.html"> 
                <div class="card">
                    <img src="nazarovProfilePic.png" alt="Person 1">
                    <p>George Nazarov</p>
                </div>
            </a>
            <a href="solomonProfile.html">
                <div class="card">
                    <img src="solomonProfilePic.png" alt="Person 2">
                    <p>Solomon Beny</p>
                </div>
            </a>
            <a href="jonathanProfile.html">
                <div class="card">
                    <img src="jonathanProfilePic.png" alt="Person 3">
                    <p>Jonathan Beny</p>
                </div>
            </a>
            <a href="zoloProfile.html">
                <div class="card">
                    <img src="zoloProfilePic.png" alt="Person 3">
                    <p>Mark Zolotarevsky</p>
                </div>
            </a>
            <a href="dyllonProfile.html">
                <div class="card">
                    <img src="dyllonProfilePic.png" alt="Person 5">
                    <p>Dyllon Litmanovich</p>
                </div>
            </a>
        </div>
    </div>
    <div class="moreContentGeneral">
        <h3 class="moreContentTitle">More Content</h3>
        <a class="moreContent1" href="cvcoat.html"><img class="moreContentPhoto" src="cvc20212.jpg" align="left" hspace="5px"><p style="color: #B49E65;"><br>Which Year had the Best <br>CVC Team?</p></a>
        <br><br><br>
        <a class="moreContent2" href="#"><img class="moreContentPhoto" src="VideoCapture_20220814-113012.jpg" align="left"hspace="5px"><p style="color: #B49E65;" hspace="2.5px"align="left">The Top 10 Most <br>Entertaining LL<br> Matches Ever</p></a>
        <br><br><a class="moreContent1" href="#"><img class="moreContentPhoto" src="LL$Transfers.jpg" align="left" hspace="5px"><p style="color: #B49E65;">The Leader League's <br>Most Expensive Transfers</p></a>
        <br><br><br>
        <a class="moreContent2" href="#"><img class="moreContentPhoto" src="cvc2023goal.jpg" align="left"hspace="5px"><p style="color: #B49E65;" hspace="2.5px"align="left">The 10 Best <br>Leader League Goals <br>of All-Time</p></a>
        <br><br><a class="moreContent1" href="#"><img class="moreContentPhoto" src="underrated.jpg" align="left" hspace="5px"><p style="color: #B49E65;">Who is the Leader <br>League's Most Underrated <br>Player Ever?</p></a>
        <br><br><br>
        <a class="moreContent2" href="#"><img class="moreContentPhoto" src="LLFunniest.jpg" align="left"hspace="5px"><p style="color: #B49E65;" hspace="2.5px"align="left">The Funniest LL <br>Moments: A <br>Compilation</p></a>
    </div>
  </div>
</section>
<br><br><br>
<footer>
    <p>   &nbsp;&nbsp;&nbsp;       &copy;2024 Leader League - All rights reserved</p>
</footer>
<script src="main.js"></script>
<script>
function enableEditing() {
    const elements = document.querySelectorAll('.profileDetails p, .profileDetails h1, #bio p');
    elements.forEach(element => {
        element.contentEditable = true;
        element.style.border = "1px dashed #ffd700";
    });
    document.getElementById('save-btn').style.display = 'inline-block';
    document.getElementById('cancel-btn').style.display = 'inline-block';
    document.getElementById('exit-btn').style.display = 'inline-block';
}

function disableEditing() {
    const elements = document.querySelectorAll('.profileDetails p, .profileDetails h1, #bio p');
    elements.forEach(element => {
        element.contentEditable = false;
        element.style.border = "none";
    });
    document.getElementById('save-btn').style.display = 'none';
    document.getElementById('cancel-btn').style.display = 'none';
    document.getElementById('exit-btn').style.display = 'none';
}
</script>
<button id="save-btn" style="display:none;" onclick="disableEditing()">Save</button>
<button id="cancel-btn" style="display:none;" onclick="disableEditing()">Cancel</button>
<button id="exit-btn" style="display:none;" onclick="disableEditing()">Exit</button>
</body>
</html>