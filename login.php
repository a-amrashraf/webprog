<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="Texx.css">
</head>
<body>
   
               
    <div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <form class="signup-form" method="post">
                    <h2 class="text-center mb-4">Sign Up</h2>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter your name">
                    </div>
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
                </form>
            </div>
        </div>
    </div>
</div>


    <!-- Bootstrap JS and dependencies -->
    
    <?php
     if(isset($_POST['btn'])){
        $name=$_POST["name"];
        $usr=$_POST["user"];
        $pwd1=$_POST["pwd1"];
        $pwd2=$_POST["pwd2"];
        $email=$_POST["email"];
        $gender=$_POST["G"];

        if($name==null || $usr==null || $pwd1==null || $pwd2==null || $email==null || $gender==null){
            echo"<h1>Fill all required fields</h1><br>";
            echo"<h1>Sign up Again</h1>";
        }elseif($pwd1 != $pwd2){
        echo"<h1>Passwords are Mismatched</h1><br>";
        echo"<h1>Sign up Again</h1>";
        }else{
            $conn=mysqli_connect("localhost","root","","businessdb");
            $stmt="INSERT INTO `user` (`Name`,`Username`,`Password`,`Email`,`Gender`)
            VALUES('$name','$usr','$pwd1','$email','$gender')";
            $result=mysqli_query($conn, $stmt);
        if($result==FALSE){
            echo"<h1>Error. $name was not added</h1>";
        }
        else{
            echo"<h1>$name was added Successfully</h1>";
        }
        }}
    ?>
   
</body>

</html>