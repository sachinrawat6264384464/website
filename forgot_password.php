<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="../_assets/css/forgot.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <style>
        .input-box input:is(:focus, :valid) {
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
<section>
    <div class="border border-dark LoginPage">
        <form id="forgotForm">
            <div>
                <h1 class="text-center"><span>Forgot Password</span></h1>
            </div>
            <hr>

            <!-- Email Input -->
            <div id="emailSection">
                <div class="top-3 input-box">
                    <label class="fs-4">User Email</label>
                    <input type="email" id="uemail" name="uemail" class="form-control bg-transparent text-dark border-dark fs-5" placeholder="Enter Your Email" style="border-radius: 25px;" required>
                </div>
                <div class="top-3 input-box text-center mt-3">
                    <button class="btn btn-primary fs-4" type="button" id="sendCode" style="border-radius: 20px;">Send</button>
                </div>
                <div class="text-center mt-3">
                    <a href="./login.php"><span class="text-primary fs-4">Login</span></a>
                </div>
            </div>

            <!-- OTP Input -->
            <div id="otpSection" style="display: none;">
                <div class="top-3 input-box">
                    <label class="fs-4">OTP</label>
                    <input type="text" id="uotp" name="uotp" class="form-control bg-transparent text-dark border-dark fs-5" placeholder="Enter OTP" style="border-radius: 25px;" required>
                </div>
                <div class="top-3 input-box text-center mt-3">
                    <button class="btn btn-primary fs-4" type="button" id="verifyOtp" style="border-radius: 20px;">Verify</button>
                </div>
            </div>

            <!-- New Password Inputs -->
            <div id="passwordSection" style="display: none;">
                <div class="input-box">
                    <label class="fs-4">New Password</label>
                    <input type="password" id="upassword" name="upassword" class="form-control bg-transparent text-dark border-dark fs-5" placeholder="Enter New Password" style="border-radius: 25px;" required>
                </div>
                <div class="input-box mt-2">
                    <label class="fs-4">Confirm Password</label>
                    <input type="password" id="confirmPassword" class="form-control bg-transparent text-dark border-dark fs-5" placeholder="Confirm Password" style="border-radius: 25px;" required>
                </div>
                <div class="text-center">
                    <button class="btn btn-primary mt-4 fs-3" type="button" id="changePassword" style="border-radius: 20px;">Change Password</button>
                </div>
            </div>
        </form>
    </div>
</section>

<script>
$(document).ready(function() {
    // Send OTP
    $('#sendCode').click(function() {
        const email = $('#uemail').val();
        $.post('forgot.php', { action: 'send_otp', uemail: email }, function(response) {
            const res = JSON.parse(response);
            if (res.status === 'success') {
                $('#emailSection').hide();
                $('#otpSection').show();
                alert(res.message);
            } else {
                alert(res.message);
            }
        });
    });

    // Verify OTP
    $('#verifyOtp').click(function() {
        const email = $('#uemail').val();
        const otp = $('#uotp').val();
        $.post('forgot.php', { action: 'verify_otp', uemail: email, uotp: otp }, function(response) {
            const res = JSON.parse(response);
            if (res.status === 'success') {
                $('#otpSection').hide();
                $('#passwordSection').show();
            } else {
                alert(res.message);
            }
        });
    });

    // Change Password
    $('#changePassword').click(function() {
        const email = $('#uemail').val();
        const newPassword = $('#upassword').val();
        const confirmPassword = $('#confirmPassword').val();

        if (newPassword !== confirmPassword) {
            alert("Passwords do not match.");
            return;
        }

        $.post('forgot.php', { action: 'change_password', uemail: email, upassword: newPassword }, function(response) {
            const res = JSON.parse(response);
            alert(res.message);
            if (res.status === 'success') {
                window.location.href = './login.php';
            }
        });
    });
});
</script>
</body>
</html>