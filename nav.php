<?php
session_start();
?>
<body>
    <div>
    <header class="sticky-top">
        <nav class="navbar navbar-expand-lg bg-primary">
            <div class="container-fluid">
                <a class="navbar-brand fs-2" href="./index.php"><b><span class="text-light">MP_Ajjaks</span></b></a>

                <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                    <!--ul class="nav justify-content-center gap-5">
                        <li class="nav-item">
                            <a class="nav-link text-light fs-5 fw-bolder" aria-current="page" href="../index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light fs-5 fw-bolder" aria-current="page" href="#">About</a>
                        </li>
                        <!-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-dark fs-5 fw-bolder" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                About
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item fs-6 fw-bolder" href="../home/constitution.php">संविधान</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item fs-6 fw-bolder" href="../home/history.php">इतिहास</a></li>
                            </ul>
                        </li> -->
                        <li class="nav-item">
                            <a class="nav-link text-light fs-5 fw-bolder" href="../index.php" style="font-size:12px;"><h2>Home</h2></a>
                        </li>
                        <!--li class="nav-item">
                            <a class="nav-link text-light fs-5 fw-bolder" href="../functionality/events.php">Events</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light fs-5 fw-bolder" href="#">Contact Us</a>
                        </li>

                        <!-- Only show "Add Users" if the user is an admin -->
                        <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true): ?>
                            <li class="nav-item">
                                <a class="nav-link text-light fs-5 fw-bolder" href="../account/registration.php">Add Users</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>

                <!-- Right-side User Icon Dropdown for Logged-in Users -->
                <div class="d-flex">
                    <?php if (isset($_SESSION['user_email'])): ?>
                        <!-- User Icon Dropdown -->
                        <div class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-light fs-5 fw-bolder" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?php echo htmlspecialchars($_SESSION['user_name']); ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <!-- <li><a class="dropdown-item fs-6 fw-bolder" href="../account/view_account.php">View Account</a></li> -->
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
        
        <div class="rr" style="display: inline-block; margin-left: 0px;">
            <img src="../_assets/photos/nav_image.png" style="width: 1530px; height: 210px; border: 2px solid rgb(249, 248, 248); border-radius: 20px;">
        </div>
    </div>
</div>
<div class="jj  text-light ml-40" style=" width:1520px; height:30px; background-color: darkgrey;"><h2 style =" margin-left:40px;">प्रांतीय कार्यकारिणी सदस्यः-</h2>

</div>

</body>