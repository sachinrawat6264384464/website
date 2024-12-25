<?php
// Start session
session_start();
include('../_conn.php'); // Include database connection

if (isset($_SESSION['user_name']) && isset($_SESSION['user_email'])) {
    if ($_SESSION['user_name'] !== "Dr. Raj Shivhare" || $_SESSION['user_email'] !== "rajshivhare42@gmail.com") {
        // Redirect to another page (e.g., home) if the user is not authorized
        header("Location: ../home/index.php");
        exit();
    }
} else {
    // Redirect to login page if the user is not logged in
    header("Location: ../account/login.php");
    exit();
}

// Initialize variables for error messages
$error = '';
$success = '';

// Check if form is submitted
if (isset($_POST['submit'])) {
    $name = $_POST['uname'];
    $email = $_POST['uemail'];
    $password = $_POST['upassword'];

    // Check if all fields are filled
    if (!empty($name) && !empty($email) && !empty($password)) {
        // Hash the password using bcrypt
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Set the default role to "user"
        $role = 'user';

        // Prepare an SQL statement to insert the new user
        $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $hashedPassword, $role);

        // Execute the statement and check for success
        if ($stmt->execute()) {
            $success = "User registered successfully!";
        } else {
            $error = "Error: Could not register user.";
        }

        // Close the statement
        $stmt->close();
    } else {
        $error = "Please fill in all fields.";
    }

    // Close the database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="../_assets/css/login.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <style>
        .input-box input:is(:focus,:valid){
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.2);
        }
        .message {
            font-size: 1.2rem;
            text-align: center;
            margin-top: 10px;
        }
        .success {
            color: green;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
<section>
    <div class="border border-dark LoginPage">
        <form method="post" action="registration.php">
            <div>
                <h1 class="text-center"><span>Registration</span></h1>
            </div>
            <hr>
            <!-- Display success or error message -->
            <?php if (!empty($success)) { ?>
                <div class="message success"><?php echo $success; ?></div>
            <?php } elseif (!empty($error)) { ?>
                <div class="message error"><?php echo $error; ?></div>
            <?php } ?>
            <div class="top3">
                <div class="top-3 input-box">
                    <label class="fs-4" id="name">User Name</label>
                    <input type="text" id="uname" name="uname" class="form-control bg-transparent text-dark border-dark fs-5" placeholder="Enter User Name" style="border-radius: 25px;" required>
                </div>
                <div class="top-3 mt-2 input-box">
                    <label class="fs-4" id="email">User Email</label>
                    <input type="email" id="uemail" name="uemail" class="form-control bg-transparent text-dark border-dark fs-5" placeholder="Enter User Email" style="border-radius: 25px;" required>
                </div>
                <div class="input-box mt-2">
                    <label class="fs-4" for="password">Password</label>
                    <input type="password" name="upassword" class="form-control bg-transparent text-dark border-dark fs-5" placeholder="Enter Password" style="border-radius: 25px;" required>
                </div>
            </div>
            <div class="text-center">
                <button class="btn btn-primary mt-4 fs-3" name="submit" type="submit" style="border-radius: 20px;">Register</button>
            </div>
        </form>
    </div>
</section>
</body>
</html>
