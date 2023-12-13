<!DOCTYPE html>
<html>
<head>
    <title>Sign In</title>
</head>
<body>
    <h2>Sign In</h2>
    <form action="index.html" method="post">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" value="Sign In">
    </form>
    <?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database configuration
    $host = "localhost"; // Replace with your host if it's different
    $dbname = "businessdb"; // Replace with your database name
    $username_db = "root"; // Update with your database username
    $password_db = ""; // Replace with your database password
    
    // Attempt to connect to the database
    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username_db, $password_db);
        // Set PDO to throw exceptions on error
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
    
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve username and password from the form
        $username = $_POST["username"];
        $password = $_POST["password"];
    
        // Prepare a query to fetch the user's credentials from the database
        $query = "SELECT * FROM users WHERE Username = :username";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
    
        // Fetch the user's data
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // Check if a user was found with the given username
        if ($user) {
            // Verify the password
            if (password_verify($password, $user['Password'])) {
                // Start a session and store username for future use
                session_start();
                $_SESSION["username"] = $username;
    
                // Redirect to a logged-in page or dashboard
                header("Location: dashboard.php");
                exit();
            } else {
                // Password is incorrect
                echo "Invalid username or password. Please try again.";
            }
        } else {
            // Username not found
            echo "Invalid username or password. Please try again.";
        }
    }
}
    ?>
</body>
</html>