<?php
session_start();
include_once('connection.php'); // Assuming you have a file to handle the database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admins WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Admin found, set session and redirect to admin dashboard
        $_SESSION['admin_logged_in'] = true;
        header('Location: admin_dashboard.php');
        exit();
    } else {
        // Admin not found or invalid credentials
        $error = "Invalid username or password";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
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
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <h2 class="text-center mb-4" style="padding-top:20px;">Admin Login</h2>
                    <div class="user mb-3">
                        <label for="username" class="form-label" >Username</label>
                        <input type="text" class="form-control"  id="username" name="username" required>
                    </div>
                    <div class="pass mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" name="btn" class="btn btn-primary btn-block">Sign in</button>
                    <button type="button" name="btn" class="btn btn-primary btn-block" onclick="location.href='index.php';" >Home Page</button>
                    <button type="button" name="btn" class="btn btn-primary btn-block" onclick="location.href='log-in.php';">Login Page</button>
    </form>
</body>
</html>
