<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>User Sign Up </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="signin.css">
   <style>
    body{
        background-color:#1a1a2e;
    }
    </style>
</head>

<body>
    
    <div class="main-content" style=" color:white;">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <form class="signup-form" method="post">
                    <h2 class="text-center mb-4" style="margin-top: 1.5rem;">Sign Up</h2>
                   
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" name="user" id="username" placeholder="Enter your Username">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="pwd1" placeholder="Enter your password">
                    </div>
                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="confirmPassword" name="pwd2" placeholder="Confirm Password">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your Email">
                    </div>
                    <div class="mb-3">
                        <label for="gender" class="form-label">Gender</label>
                        <select class="form-select" name="G" id="gender">
                            <option value="" disabled selected>Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block" name="btn">Sign Up</button>
                    <button type="button" class="btn btn-primary btn-block" onclick="location.href='index.php';" name="btn">Home Page</button>
                </form>
            </div>
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
        $pwd1=$_POST["pwd1"];
        $pwd2=$_POST["pwd2"];
        $email=$_POST["email"];
        $gender=$_POST["G"];

        if($usr==null || $pwd1==null || $pwd2==null || $email==null || $gender==null){
            echo"<h1>Fill all required fields</h1><br>";
            echo"<h1>Sign up Again</h1>";
        }elseif($pwd1 != $pwd2){
        echo"<h1>Passwords are Mismatched</h1><br>";
        echo"<h1>Sign up Again</h1>";
        }else{
            $conn=mysqli_connect("localhost","root","","businessdb");
            $stmt="INSERT INTO `user` (`Username`,`Password`,`Email`,`Gender`)
            VALUES('$usr','$pwd1','$email','$gender')";
            $result=mysqli_query($conn, $stmt);
        if($result==FALSE){
            echo"<h1>Error. $name was not added</h1>";
        }
        else{
            echo"<h1>$usr was added Successfully</h1>";
        }
        }}
    ?>
   
   
</footer>
</body>

</html>