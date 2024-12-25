<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME</title>
    <link rel="stylesheet" href="C:/xampp/htdocs/mp_ajjaks/_assets/css/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <style>
        .slider{
            display: block;
            margin-left: auto;
            margin-right: auto;
            box-shadow: 0px 7px 7px 7px #444444;
        }
    </style>
</head>
<body class="jj" style="background-color:rgb(255, 255, 255);">
<div>
    <?php
    session_start();
    ?>
    <header class="sticky-top">
        <nav class="navbar navbar-expand-lg bg-primary" >
            <div class="container-fluid">
                <a class="navbar-brand fs-2" href="./index.php">
                    <b><span class="text-light">MP_Ajjaks</span></b>
                </a>
                <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                    <ul class="nav justify-content-center gap-5">
                        <li class="nav-item">
                            <a class="nav-link text-light fs-5 fw-bolder" href="../index.php">Home</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-light fs-5 fw-bolder" href="#" id="aboutDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            हमारे बारे में
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="aboutDropdown">
                                <li><a class="dropdown-item bg-primary text-light" href="../functionality/about1.html" >संगठन के उद्देश्य:</a></li>
                                
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-light fs-5 fw-bolder" href="" id="aboutDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">सदस्य</a>
                            <ul class="dropdown-menu" aria-labelledby="aboutDropdown">
                                <!--li><a class="dropdown-item bg-primary text-light" href="../functionality/new_members.php" >new_members</a></li-->
                                <li><a class="dropdown-item bg-primary text-light" href="../functionality/members.php" >सदस्य की जानकारी</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-light fs-5 fw-bolder" href="" id="aboutDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">कार्यक्रम</a>
                            <ul class="dropdown-menu" aria-labelledby="aboutDropdown">
                                <li><a class="dropdown-item bg-primary" href="../functionality/Events.php" style="color:white;">कार्यक्रम की जानकारी</a></li>
                            </ul>
                        </li>
                        <li>
                            <a class="nav-link  text-light fs-5 fw-bolder" href="../functionality/contact_us.html"  role="button"  ><b>संपर्क करें</b></a>
                            
                        </li>
                        <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true): ?>
                            <li class="nav-item">
                                <a class="nav-link text-light fs-5 fw-bolder" href="../account/registration.php">Add Users</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
                <div class="d-flex">
                    <?php if (isset($_SESSION['user_email'])): ?>
                        <!-- User Icon Dropdown -->
                        <div class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-light fs-5 fw-bolder" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?php echo htmlspecialchars($_SESSION['user_name']); ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item fs-6 fw-bolder" href="../account/logout.php">Logout</a></li>
                            </ul>
                        </div>
                    <?php else: ?>
                        <!-- Login Link for Guests -->
                        <a class="nav-link text-light fs-5 fw-bolder" href="../account/login.php">Login</a>
                    <?php endif; ?>
                </div>
            </div>
        </nav>
    </header>
</div>


<div>
    <div class="kk" style="padding-top: 20px; position: relative;">
        <div style="display: inline-block;">
            <img src="../_assets/photos/images.jpeg" style="width: 210px; height: 190px;">
        </div>
        <div class="rr" style="display: inline-block; margin-left: 70px;">
            <img src="../_assets/photos/nav_image.png" style="width: 1000px; height: 210px; border: 2px solid rgb(249, 248, 248); border-radius: 20px;">
        </div>
    </div>
</div>

        <div class="ee bg-primary" style=" width:1520px; height:80px;">
            <div class="ll" style="margin-top:0px;"><h3 style="font-size:30px; color:white; margin-left:380px; margin-top:25px; "><b>मध्यप्रदेश अनुसूचित जाति-जनजाति अधिकारी एवं कर्मचारी संघ</b></h3></div>
             </div>
        <div class="flash">
            <div class="plug_flash_crousal carousel slide fade-carousel" stype="">
                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner mt-4 border border-blue border-3 rounded-1 slider" style="width: 90%; height:350px;">
                        <div class="carousel-item active">
                            <img src="../_assets/photos/image1.jpg" class="d-block w-100" alt="..." style =" width:50%; height:350px">
                        </div>
                        <div class="carousel-item">
                            <img src="../_assets/photos/image2.jpg" class="d-block w-100" alt="..." style =" width:50%; height:350px">
                        </div>
                        <div class="carousel-item">
                            <img src="../_assets/photos/image3.jpg" class="d-block w-100" alt="..." style =" width:50%; height:350px">
                        </div>
                        <div class="carousel-item">
                            <img src="../_assets/photos/image4.jpg" class="d-block w-100" alt="..." style =" width:50%; height:350px"> 
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </>
        <!--div class="overlay" id="overlay"></div> <-- Background blur overlay >
        <div id="sliding-box">
            <div class="close-btn-up">
                <div class="left" style = "margin-top:90px">
                    <h1 style="p">Recent Events</h1>
                </div>
                <div class="right">
                    <button class="pepop" id="pepo">×</button>
                </div>
            </div>
            <div class="content"-->
           <!--?php
                include('C:/xampp/htdocs/mp_ajjaks/_conn.php');
                $sql = "SELECT event_name, event_date FROM events ORDER BY event_date DESC LIMIT 5";
                $result = $conn->query($sql);
                
                // Check if there are any events
                $events = [];
                if ($result->num_rows > 0) {
                    // Fetch all events
                    while($row = $result->fetch_assoc()) {
                        $events[] = $row;
                    }
                }

                if (count($events) > 0) {
                    echo "<ul>";
                    foreach ($events as $event) {
                        // Format the date to dd-mm-yyyy
                        $formatted_date = date("d-m-Y", strtotime($event['event_date']));
                        echo "<li><strong>" . htmlspecialchars($event['event_name']) . "</strong> - " . $formatted_date . "</li><br>";
                    }
                    echo "</ul>";
                } else {
                    echo "<p>No recent events available.</p>";
                }
            ?>
            </div>
            <div class="close-btn-down">
                <button type="button" id="pepo2" class="btn btn-primary">Close</button>
            </div>
        </div-->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const box = document.getElementById("sliding-box");
            const closeButton = document.getElementById("pepo");
            const overlay = document.getElementById("overlay");
            const closeButton2 = document.getElementById("pepo2");

            // Show the sliding box with background blur
            setTimeout(() => {
                box.classList.add("show");
                overlay.classList.add("show");
            }, 100);

            // Hide the box and the overlay when the close button is clicked
            closeButton.addEventListener("click", () => {
                box.classList.remove("show");
                overlay.classList.remove("show");
            });
            closeButton2.addEventListener("click", () => {
                box.classList.remove("show");
                overlay.classList.remove("show");
            });
        });
    </script>
    <footer>
        
    
    <div class="ee" style=" width:1520px; height:120px; margin-top:60px; background-color: rgb(28, 100, 207);"><h3 style="font-size:30px; color: black; margin-left:600px;">!Services_mp_ajjaks</h3>
             </div>
             
            
<?php include('../kk.php'); ?>

    <script>
        // Function to send a click update to the backend
        function updateClickCount() {
            fetch(window.location.href, { method: 'POST' });
        }

        // Automatically update the click count when the page loads
        window.onload = updateClickCount;
    </script>

   <div class="yy" style="width:1300px; height:30px;">
    <p class="ww" style="margin-left:700px;"><b>Today's Clicks:</b> <strong id="counter"><?php echo $click_count; ?></strong></p>

    </div>
    
    </footer>
    
</body>
</html>