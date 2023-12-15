<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="Texx.css">
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <form class="login-form" method="post">
                    <h2 class="text-center mb-4">Login</h2>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" name="user" id="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="pwd" id="password" required>
                    </div>
                    <button type="submit" name="btn" class="btn btn-primary btn-block">Login</button>
                    <button type="button" class="btn btn-secondary btn-block mt-3"
                        onclick="location.href='signin.php';">Sign Up</button>
                </form>
                <!-- Display the retrieved username -->
                <?php
                if (isset($_POST['btn'])) {
                    $user = $_POST["user"]; // Update variable name
                    $password = $_POST["pwd"]; // Update variable name
                    
                    $conn = mysqli_connect("localhost", "root", "", "businessdb");
                    $stmt = "SELECT * from user where Username='$user' AND Password='$password'";
                    $result = mysqli_query($conn, $stmt);
                    if ($row = mysqli_fetch_array($result)) {
                        // Store the username in a variable
                        $retrievedUsername = $user;
                        // Display a welcome message with the retrieved username
                        echo "<h3>Welcome, $retrievedUsername!</h3>";
                    } else {
                        echo "<h4>Login failed. Username or password are incorrect</h4>";
                    }
                    mysqli_close($conn);
                }
                ?>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>
</html>
