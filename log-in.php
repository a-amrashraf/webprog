<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
   
    <style>
            :root {
    --background: #1a1a2e;
    --color: #ffffff;
    --primary-color: #0f3460;
}
body {
    margin: 0;
    box-sizing: border-box;
    font-family: "poppins";
    background: var(--background);
    color: var(--color);
    letter-spacing: 1px;
    
}
       
        button{
    background-color: var(--primary-color);
    color: var(--color);
    display: block;
    padding: 13px;
    border-radius: 5px;
    outline: none;
    font-size: 13px;
    letter-spacing: 1.5px;
    font-weight: bold;
    width: 50%;
    cursor: pointer;
    margin: 5px;
    margin-bottom: 2rem;
    transition: all 0.1s ease-in-out;
    border: none;
    
}
.btn{
    background-color: var(--primary-color);
    color: var(--color);
    display: block;
    padding: 13px;
    border-radius: 5px;
    outline: none;
    font-size: 20px;
    letter-spacing: 1.5px;
    font-weight: bold;
    width: 100%;
    cursor: pointer;
    margin: 5px;
    margin-bottom: 2rem;
   border: none;
}
.login-form {
    margin-top: 3rem;
}
.user{
    font-size: large;
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
}
.pass{
    font-size: large;
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
}
    </style>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <form class="login-form" method="post">
                    <h2 class="text-center mb-4">Login</h2>
                    <div class="user mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" name="user" id="username" required>
                    </div>
                    <div class="pass mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="pwd" id="password" required>
                    </div>
                    <button type="submit" name="btn" class="btn btn-primary btn-block">Login</button>
                    <button id="signin" class="btn btn-primary btn-md center-block" onclick="location.href='signin.php';">Sign Up</button>
                    <button id="Forgot" class="btn btn-danger btn-md center-block" onclick="redirectToAdmin()">Admin Login</button>
                    <button class="btn btn-outline-primary back-to-home" onclick="location.href='index.html';">Back to Home</button>
                </form>
                <!-- Display the retrieved username -->
                <?php
session_start(); // Starting the session

if (isset($_POST['btn'])) {
    $user = $_POST["user"]; // Update variable name
    $password = $_POST["pwd"]; // Update variable name
    
    $conn = mysqli_connect("localhost", "root", "", "businessdb");
    $stmt = "SELECT * from user where Username='$user' AND Password='$password'";
    $result = mysqli_query($conn, $stmt);
    
    if ($row = mysqli_fetch_array($result)) {
        // Store the username in a session variable
        $_SESSION['username'] = $user;
        
        // Redirect to index.html
        header("Location: index.php");
        exit(); // Ensure that subsequent code is not executed after redirection
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
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script>
               function redirectToAdmin() {
        // Redirect to the admin.php page
        window.location.href = 'admin.php';
    }
        </script>
        
</body>
</html>
