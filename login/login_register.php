<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" type="text/css" href="../css/loginregister.css">
    <script src="../js/loginregister.js"></script>
</head>
<body>
<div class="main">
    <input type="checkbox" id="chk" aria-hidden="true">

    <div class="register">
        <form id="loginForm" action="../actions/login_action.php" method="post" onsubmit="return validateLoginForm()">
            <label for="chk" aria-hidden="true"> Register? </label>
            <input type="email" id="lemail" name="lemail" placeholder="Enter email address..." required>
            <input type="password" id="password" name="password" placeholder="Enter password...">
            <input class="butt" type="submit" name ="lsubmit" value="Login">
        </form>
    </div>

    <div class="login">
        <form id="registerForm" action="../actions/register_action.php" method="post" onsubmit="return validateForm()">
            <label for="chk" aria-hidden="true"> Login </label>
            <input type="text" id="fname" name="fname" required placeholder="First Name">
            <input type="text" id="lname" name="lname" required placeholder="Last Name">
            <select id="role" name="role" required>
                <option value=" " disabled selected>Select Role</option>
                <option value="1">Seller</option>
                <option value="2">Buyer</option>
            </select>
            <input type="tel" id="contact" name="contact" required placeholder="Contact">
            <input type="email" id="remail" name="remail" required placeholder="person23@mail.com">
            <input type="password" id="registerPassword" name="password" required placeholder="********" minlength="8">
            <input type="password" id="confirmPassword" name="confirm_password" required placeholder="********" minlength="8">
            <input class="butt" type="submit"  name= "submitBtn" value="Sign Up">
        </form>
    </div>
</div>
<script>
    document.getElementById("registerForm").addEventListener("submitBtn", function(event) {
        if (!validateForm()) {
            event.preventDefault(); // Prevent form submission if validation fails
        }
    });
</script>


</body>
</html>
