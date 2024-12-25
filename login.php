<?php
session_start();
include('../_conn.php');

$error = '';

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['upassword'];

    if (!empty($email) && !empty($password)) {
        // Step 1: Check users table first
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? LIMIT 1");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            echo "No user found in users table. Checking admins table...<br>";
            
            // Step 2: Check admins table if no user was found in users table
            $stmt = $conn->prepare("SELECT * FROM admins WHERE email = ? LIMIT 1");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
        }

        // Step 3: If a matching user or admin is found
        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();

            // Debugging output: Check stored hash and entered password
            echo "Stored hash from DB: " . $user['password'] . "<br>";
            echo "Entered password (plain text): " . $password . "<br>";

            // Check if the password matches using password_verify()
            if (password_verify($password, $user['password'])) {
                echo "Password verified successfully!<br>";

                // If passwords match, set session variables
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['user_role'] = isset($user['role']) ? $user['role'] : 'user';
                $_SESSION['is_admin'] = (isset($user['role']) && $user['role'] === 'admin');

                // Redirect to the home page
                header("Location: ../home/index.php");
                exit();
            } else {
                echo "password_verify() returned false.<br>";
                $error = "Invalid password.";
            }
        } else {
            echo "No user found with that email.";
            $error = "No user found with that email.";
        }
    } else {
        $error = "Please enter both email and password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../_assets/css/login.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .input-box input:is(:focus,:valid) {
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.2);
        }
        .error-message {
            color: red;
            font-size: 1.2rem;
            text-align: center;
        }
    </style>
</head>
<body>
<section>
    <div class="border border-dark LoginPage">
        <form method="post" action="login.php">
            <div>
                <h1 class="text-center"><span>Login</span></h1>
            </div>
            <hr>
            <!-- Display error message if login fails -->
            <?php if (!empty($error)) { ?>
                <div class="error-message"><?php echo $error; ?></div>
            <?php } ?>
            <div class="top3">
                <div class="mb-3 top-3 input-box">
                    <label class="fs-4" id="uemail">User Email</label>
                    <input type="email" id="email" name="email" class="form-control bg-transparent text-dark border-dark fs-5" placeholder="Enter Your Email" style="border-radius: 25px;" required>
                </div>
                <div class="input-box">
                    <label class="fs-4" for="password">Password</label>
                    <input type="password" name="upassword" class="form-control bg-transparent text-dark border-dark fs-5" placeholder="Enter Password" style="border-radius: 25px;" required>
                </div>
            </div>
            <div class="text-center">
                <button class="btn btn-primary mt-4 fs-3" name="submit" type="submit" style="border-radius: 20px;">Login</button>
            </div>
            <br>
            <div class="text-center">
                <a href="./forgot_password.php"><span class="text-primary fs-4">Forgot Password</span></a>
            </div>
        </form>
    </div>
</section>
</body>
</html>
