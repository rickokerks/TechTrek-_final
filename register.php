<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="registerfront.css">
    <title>Sign Up</title>
    <link rel="stylesheet" type="text/css" href="login.css">
</head>

<body>
    <div class="header">
        <img src="TeckTrekResized.png" alt="TechTrek Logo" class="logo">
        <button class="logout-btn" onclick="logout()">GO BACK</button>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-md-offset-3" align="center">
                <form autocomplete="off" action="code.php" method="POST" onsubmit="return validateForm()">
                    <div class="form-group">
                        <input type="text" name="username" class="form-control mb-3"
                            placeholder="Username (max 8 characters)" required>
                        <input type="email" name="email" class="form-control mb-3" placeholder="Email" required>

                        <input type="password" name="password" class="form-control mb-3" id="passwordInput"
                            placeholder="Password (max 8 characters)" required>
                        <input type="confirmpassword" name="confirmpassword" class="form-control mb-3"
                            id="passwordInput" placeholder="Confirm password" required>
                    </div>
                    <input type="submit" name="signup_btn" value="Sign Up" class="btn btn-primary btn-block">
                </form>
            </div>
        </div>
    </div>

    <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById("passwordInput");
            var eyeIcon = document.getElementById("eyeIcon");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                eyeIcon.src = "eye-open.png";
            } else {
                passwordInput.type = "password";
                eyeIcon.src = "eye-close.png";
            }
        }
        function logout() {
            window.location.href = 'index.html';
        }
        <script>
            function validateForm() {
            var username = document.getElementsByName("username")[0].value;
            var password = document.getElementsByName("password")[0].value;

            if (username.length > 8) {
                alert("Username must be maximum 8 characters");
            return false;
            }

            if (password.length > 8) {
                alert("Password must be maximum 8 characters");
            return false;
            }

            return true;
        }

    </script>


</body>

</html>