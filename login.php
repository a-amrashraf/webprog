<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="Texx.css">

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <form class="login-form" method="post">
                    <h2 class="text-center mb-4">Admin Login</h2>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" name="user" id="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="pwd" id="password" required>
                    </div>
                    <button type="submit" name="btn" class="btn btn-primary btn-block">Login</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <?php
        if(isset($_POST['btn'])){
        $usr=$_POST["user"];
         $pwd=$_POST["pwd"];
         $conn=mysqli_connect("localhost","root","","tex_cinema");
         $stmt="SELECT * from admin where Username='$usr' AND Password='$pwd'";
         $result=mysqli_query($conn,$stmt);
         if($row=mysqli_fetch_array($result)){
            header("Location: Alogin.php");
         }
        else{
             echo"<h1>Login failed. Username or password are incorrect</h1>";
        }
    }
         ?>
     </body>
     </html>
</body>

</html>
