<!DOCTYPE html>
<html>
<head>
    <title>Sign In</title>
</head>
<body>
    <h2>Sign In</h2>
    <form action="" method="post">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" value="Sign In">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Database configuration
        $host = 'localhost'; // Assuming XAMPP is running on your local machine
        $dbname = 'businessdb'; // Database name
        $username_db = 'root'; // Database username
        $password_db = ''; // Database password is empty (null) by default in XAMPP
        
        try {
            $conn = new PDO("mysql:host=$host;dbname=$dbname", $username_db, $password_db);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Retrieve username and password from the form
            $username = $_POST["username"];
            $password = $_POST["password"];
            
            // Prepare a query to fetch the user's credentials from the database
            $query = "SELECT * FROM user WHERE Username = :username AND Password = :password";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password); // In practice, passwords should be hashed and compared securely
            
            // Execute the query
            $stmt->execute();
            
            // Fetch the user data
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($user) {
                // User found, show a confirmation
                echo "<p>Login successful for user: " . $user['Username'] . "</p>";
                // Additional logic or display here
            } else {
                // User not found, show error message
                echo "<p>Invalid username or password.</p>";
            }
        } catch(PDOException $e) {
            echo "<p>Connection failed: " . $e->getMessage() . "</p>";
        }
    }
    ?>
</body>
</html>
