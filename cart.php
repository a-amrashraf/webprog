<!DOCTYPE html>
<html>
<head>
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="Test.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <style>
        .slideshow-container {
    max-width: 50%; /* Set the maximum width as desired */
    position: relative;
    margin: auto;
    text-align: center; /* Center the image horizontally */
}

.mySlides {
    display: block; /* Show the image */
    max-width: 50%; /* Set the maximum width for the image */
    height: auto; /* Maintain aspect ratio */
    margin: auto; /* Center the image horizontally */
}

    </style>
    </head>
<body>
<div class="info">
            <div class="blackRectangle">
            <span class="icon"><i class="fa fa-home" aria-hidden="true"></i></span>
    <a href="index.html" class="text">Home Page </a>
                <span class="icon"><i class="fa fa-phone" aria-hidden="true"></i></span>
                <span class="text">19255</span>
                <span class="icon"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                    <a href="https://pan-marine.net/images/2020/06/18/pm-map.jpg" class="text">Our Stores </a>
                </span>               
                 <span class="icon"><i class="fa fa-shopping-cart" aria-hidden="true"></i></span>
               <a href="cart.php" class="text">My Cart</a>
                <a href="log-in.php">
                 <span class="icon"><i class="fa fa-user" aria-hidden="true"></i></span>
                </a>
            </div>
        </div>
         
        <h1 class="name">MY CART</h2><br>
        <div class="container">
    <h2>Products</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="text-left">ID</th>
                <th class="text-center" style="width:35%;">Product Name</th>
                <th style="text-align:center; width:120px;">Price</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>
        <?php
include_once('connection.php');

// Check if the ID parameter is set in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the data for the clicked ID from your database
    $sql = "SELECT * FROM product WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result) {
        $row = mysqli_fetch_assoc($result);

        // Insert the fetched data into the cart table
        $insertQuery = "INSERT INTO cart (id, description, price, quantity) VALUES (?, ?, ?, 1) ON DUPLICATE KEY UPDATE quantity = quantity + 1";
        $stmtInsert = mysqli_prepare($conn, $insertQuery);
        mysqli_stmt_bind_param($stmtInsert, 'isd', $row['id'], $row['description'], $row['price']);
        mysqli_stmt_execute($stmtInsert);
        mysqli_stmt_close($stmtInsert);

        // Redirect back to the previous page or wherever you want after insertion
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    } else {
        echo "No data found for the selected ID";
    }
}

// Handle form submission for updating quantity
if (isset($_POST['update_id']) && isset($_POST['quantity'])) {
    $updateId = $_POST['update_id'];
    $newQuantity = $_POST['quantity'];

    // Update the quantity in the cart table
    $updateQuery = "UPDATE cart SET quantity = ? WHERE id = ?";
    $stmtUpdate = mysqli_prepare($conn, $updateQuery);
    mysqli_stmt_bind_param($stmtUpdate, 'ii', $newQuantity, $updateId);
    mysqli_stmt_execute($stmtUpdate);
    mysqli_stmt_close($stmtUpdate);

    // Redirect back to the cart page after updating quantity
    header('Location: cart.php');
    exit();
}

// Handle form submission for deleting an item from the cart
if (isset($_POST['delete_id'])) {
    $deleteId = $_POST['delete_id'];

    // Delete the item from the cart table
    $deleteQuery = "DELETE FROM cart WHERE id = ?";
    $stmtDelete = mysqli_prepare($conn, $deleteQuery);
    mysqli_stmt_bind_param($stmtDelete, 'i', $deleteId);
    $deleteResult = mysqli_stmt_execute($stmtDelete);

    if ($deleteResult) {
        // Redirect back to the cart page after successful deletion
        header('Location: cart.php');
        exit();
    } else {
        // Display an error message if deletion fails
        echo "Error deleting item: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmtDelete);
}

// Display existing cart items with quantity controls and delete option
$sqlCart = "SELECT * FROM cart";
$resultCart = mysqli_query($conn, $sqlCart);

echo '<div id="cartInfo">';
$totalPrice = 0; // Initializing the total price variable

// Display existing cart items with quantity controls and delete option
if ($resultCart) {
    if (mysqli_num_rows($resultCart) > 0) {
        echo '<table >';
        

        while ($row = mysqli_fetch_assoc($resultCart)) {
            echo '<tr >';
            echo '<th style="padding-left: 10px; padding-right: 95px;">' . $row['id'] . '</th>';
            echo '<th style=" text-align:center; padding-left:85px; padding-right:50px; min-width:465px; position:absoulte; ">' . $row['description'] . '</th>';
            echo '<th style="padding-right:80px; ">' . $row['price'] . '</th>';
            echo '<th style="text-align:right;">';
            
            echo '<form method="post">';
            echo '<input  type="hidden" name="delete_id" value="' . $row['id'] . '">';
        
            // Minus button
            echo '<button style="" type="button" class="quantity-button" data-type="minus">-</button>';
        
            // Quantity input field
            echo '<input  type="text" style="width:80px; text-align:center; " name="quantity" value="' . $row['quantity'] . '">';
        
            // Plus button
            echo '<button style="" type="button" class="quantity-button" data-type="plus">+</button>';
        
            echo '<button style="" type="submit" class="upd-button" name="update_id" value="' . $row['id'] . '">Update</button>';
        
            // Delete button
            echo '<button style="" type="button" class="delete-button" data-id="' . $row['id'] . '"><i class="fa fa-trash" aria-hidden="true"></i></button>';
            echo '</form>';
            echo '</th>';
            echo '</tr>';
        
            $totalPrice += $row['price'] * $row['quantity'];
        }
    
        echo '<tr><th><strong>Total:</strong></th><th style="font-size:20px;">' . $totalPrice . '</th><th></th></tr>';
        echo '</table>';
    } else {
        echo "No items in the cart";
    }
} else {
    echo "Query execution failed for the cart";
}
echo '</div>';
?>
    </tbody>
    </table>
</div>

<div class="container">
    
<button class="cart_btn" onclick="goToIndex()">Continue Shopping </button>
<button class="cart_btn" onclick="checkout()">CheckOut </button>
</div>

<div class="slideshow-container">
    <!-- Images in the slideshow -->
    <a href="tires.php">
    <img class="mySlides" src="https://images.all-free-download.com/images/graphiclarge/tires_stacked_312349.jpg">
    </a>
    <a href="oils.php">
    <img class="mySlides" src="https://media.istockphoto.com/id/1209513346/vector/machine-oil-line-and-glyph-icon-engine-oil-vector-illustration-isolated-on-white-car.jpg?s=612x612&w=0&k=20&c=98-0y_aigL7tu25WfxdowlO2kcXHSuRkoGmHSV1_hck=">
    </a>
    <a href="batteries.php">
    <img class="mySlides" src="data:image/jpeg;base64,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"> 
    </a>
    <a href="services.php">
    <img class="mySlides" src="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBxISEhUTEhMWFhUVGBUaFRYXGBYWFxUWGRUWFxoYFxUYKCggGBolHRgXITIhJSkrLi4vFx8zODMuNygtLisBCgoKDg0OGhAQGS0lICUtLS0tLS0tLS0tLS0tLy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLf/AABEIALEBHQMBIgACEQEDEQH/xAAbAAEAAgMBAQAAAAAAAAAAAAAABAUCAwYHAf/EAEoQAAEDAgMEBQcIBwUJAQAAAAEAAgMEERIhMQUGQVETFCJhcTJigZGhsdEWQlJygpLB8AcVIzN0s+FUstLT8TREU2Nzk6KjwkP/xAAaAQEAAwEBAQAAAAAAAAAAAAAAAQIDBAUG/8QANREAAgECBAIHBwQCAwAAAAAAAAECAxEEEiExQVEFYXGBkbHBFCIyodHh8BMVUpJCojNDgv/aAAwDAQACEQMRAD8A9xREQBERAEREAREQBERAEREAREQBERAEREAREQBERAEREAREQBERAEREAREQBERAEREAREQBERAEREAREQBERAEREAREQBERAEWLnAaqO+q5BSk3sQ3YlIq41Ljx9S1kq/6bK5yzxjmExDmqtE/T6yM5bIqxryNCVsbUuHeodNk50T0WiOpB1y/PNb1RprcuncIiIAiIgCIiAIiIAiIgCIiAIiIAiKs2ltiOEtaQ58j/ACI42l73Aamw0aPpGw71KTexDaSuyzRUv64n/sM/3qf/ADE/XE/9hqPvU/8AmKcrK50XSKl/XE/9hn+9T/5i+HbMozdRVAHEjoXkfZa8k+gJkYzr8uXaKHs3aEc7McbsQuQdQWuGrXNObXDkc1MVWraFk01dBERCQo81SBkMytc1RfJunNQ5JA0XOi0jC+5SU7Gx7ycyqzaD3B1r5HRWAkFr3Fuaq6uoxnTIac10U1qYTehnQThtwTYfj+fcpnXGfS96qEWjppu5RTaVjYZTiLgbEq0pXOLQXan3KnVrR1AcLaEcPgoqLQmD1JSLAvANri50CzWJqFnFMW+HJYIosCwikDhktiq2PINwp8MocL+tYyjY1jK5tREVSwREQBERAEREAREQBERAFRbvxhz6mZ2b3TPZflHEcDWjkMi7xcVeql3Z8mf+Jqf5pVl8LKS+JfnAz25VvbFIYZYmSRNxu6QF4DLE9oNILQbHtZ6HIrRudtw1lM2ZzAx13Nc0G4u06jkCLG3v1WG8m6dPWlrpMTXtFsbCA4svfA64IIvnpl61x5bPsSe4xS0Urs+bT7hIAPBwHMZWSTVluVlKUZXex6ioNPW9JI5rWnAzIyXyL72LWD51s7ngcs87Q4awVYHQOPQEdqUXBd5kZ1B4OdwzA7Vy21hia0BrQAAAAALAAaADgFS1ty6d9inYwR19m5CeFz3jgXxPY0O8S2Sx+qFeqlm/2+L+Hn/mwK1llDfHkplrbsIjpft+5m5wAuVCmmLsuC1ySlxzPoWN1eMLasrKVz6q7abjkLZc+9WKxctYuzuUauiiRbKgdp1ss0gZdwHMhdN9LmFjdT0ZcLk2HtK3P2dyd61X7Q3wooXFjpbuGRDGufYjgXDs37rrPZm9dHUODI5RjOjXhzCTyGLJx7gVhnluaJQ2ufJGFpsdV8a4jMZKx2mzIHkbetVq2i7oo1Zn0OIN+Oqu2OuAeai7PibhvbO5zU1Y1Hd2NILiU28m3m0jAcON774G3sMrXJPAC49fpVZu9viJ5BFKwMc7yHAktJ+iQcweWZv3LLerY3SvD3SOvYhoywtAtkBr4m/wXNHYr43wOBxHpo8VssLAbk3PG4GXG9lVV8MvclL3uxiVDFN54x93tXD5np6yikwm/rWKKpcsmm+ayUOjl+afQpiwasbJ3QREUEhERAEREAREQBERAFS7s+TP/E1P80q6VLu15M/8TUfzCfcVdfCyr+JFpPM1jS55DWtBJJyAA4krgqvasm05urwACEYseO9ntyF3gacbDW5BuCMsN4qmprqk0kTS1jHdq9xex8t/dyHgdSLdlsPY0dLGI4x9Z3F55n8BwWqSpRu/iey5dpzOUq0ssdIrd8+pHCO6xsSe/alopXZ82n8HgehwHA6ei0NZHNG2SJwcxwu1w4/A9yV1HHNG6OVocx4s5p0I/A9/BcxunuzPQ1EobKHUjhdrDcvx3FiRawIFwSD2sssssm1JXe/mbJODstvIstoPIrobf8Cf+ZCpDnjMk6aqLtL/AG6Lup5vbJFb3KHURFpsTe+fj4reEbpdnqzOUrN9voj4yUtddueuvEd6+z1Bfa9suS3UdKHC50962VVGALt4ahbZo5jPK7EmmIwjO+WqwqKsMysSfzxVZG0uOEceHBTKqncWt4uGRt+fzdUcEnqWUnbQhSPuSea+NNipBonAX9nFVO2K50ERlDMYaRiANiG8XaHTL0XWqaexm1bc3Tbl0Eou2LB/03Obb7ObfYvK9qUvQzyxAn9nI9oPGzXEA5cbALuId+oQ0kCRrgMm2FnHlcH2kLgqqd0j3SOzc9znO8XEk+0qiTT3KzcXsj1nZG2RU00Tr3cABL3SAWPr8r7QW9eTbM2nLTuxROtfUHNrh3jj712myN8YpLNmHRO+lmY/WM2+nLvVo2SsTmvudnR1TWjCcu9WAN9FTQR48NiC12jgQWkcw4ZFXMbcwPALKpZO6NoXIG12AtFyARfCD86zS4gegE+hQdmRgYpZA0RsFy92jSLZ3PFXMjAayNvCOCQ273vY0H1NcPSVWbxNE9VT0h/dNBmmbwcAcLGnzcV7jvC4nQU6yqbaXfcdaxEoUZU7Xu7Lv+5aRyBwDmkEEAgjMEHMEHiFsU2eIEZajT4KqbVsL8DTicNbZhv1joPDVbqaMv05cNSQCrCGTEL+tV62U8mE9x1SauiIuxYIiLE1CIiAIiIAiIgCIvhKA+rnaqGWCZ8sAEjZLGWG4a7GAG9JG45XIABabXsDdWs1TfJunNaFrCNtzKbuRBt52vU57nX9z78ea+jeB9wOp1Fzp+48fpqUkP7xnif7jlZxilsVTlffyIo3icf9zqP/AE/418dt+Q+TRz34YjC1vpdjNh6Ct8Onr95WxTljy+bF58/kivoKaTG+eYgyvAGFt8EbG3IjaTrmSS7iTyAUWpmxm5FuCulrfE2xBAsdfirxlbgUcdLEKhqQBhdlyKzq6puEgG5Kgxxlxs0f6JLE5uostcizFMzsfYJMLgbXsriN1wDa11phgZhGVwc81vWc5KRpFNGSqdoNbisBwz5Z9ytlBqKG5JBzPA/FRBpPUiabRxe0Ny4pSXRF0Z4gDEz7uo9Bt3LXsvchrHYpj0gGjcJa3xdz8Peu9oocLc9Tr+fzqt7hcWPFXdTXYp+kuJ51tXcyN93QO6N30TcsP4t9o7ly1fu9VQmz4naXDm9ppGWYcPEZa9y9cZQOJzyH54KaaZpbgcMQ0zUVJ2XuiNNN+9c8R2VtiopXXhkczPNurT9Zhyv7V3uxP0jRmwqWYHD5zLljvEeUz2+K37d3BhmJfC4xSHM3u5jjzI1BPMH0Lz/bO79TSn9tGQ3g9vaYftDTwNj3JpPcr70Hpseh7Z3wbDUtnij6VskLAO3htaWW+bQ6607r7XNXtCSRzA0ugIDcWLyXxm2Kw1z4cVyGwd33SWe51mOF+y7tDxBaQfC6utmbAlifjExbbQx4muI5E8PasHiMNCLhKXvJWvbfwOhYbFVJqcY+63e11p6noO0ttFhLGNzGpcD7lq2RSMiiaxl7a3cbklxxEk+J9Gipe1I61y59uJu6wyzvnbP2roKOMtY0HUBcWEqSnOTe3A78XTjCnFLfjr+fNG9ERegcBMpZbi3Ee5SFWRvsbqxa64uFjNWZrF3RkiIqFgiIgCIiAKBUzXyGnvUiqksLc1CWkI8TOb4BERalAkP7xnif7jkXyI2ewnmf7jlEtgnqa4dPX7ytqqKnbkMQt2nuz7LBfifnGzR61S1m8s7so2tjHM9t34NHtVJVYR+KS/Opam9PC1qnwQb7rLxdl8zsHGwucgNTwCrptuU7NZAfq9r2jJcPUSOkzlc6Q+cbj0N0HoC5R9S4B08vlO8hh+aODQOHeopT/XbUNlu36L1NMThvY4qVbVvZJ+crWXYr9u56TVb70kbiBcuyFsrnlk25WiffRp0iBtpck/gF5dsbtSlzs3WJHjcXPtXRRx8Tp7SeQXTChdXcn8l6HDPGRi7Rpx78z9V5HVnfSThG0jTyX/4lpdvlNe2Fg9B+KoJJMP1uA4MHxUZX9lhzfizP26p/GP8AVPzuy8of0iSSEtwNBAvmDnwOhVkzfd3zo2+gOH4leWl/RTk8A438D/Qrpoo79wGpVIYeLW78frcvPGSTvlj/AFXpZncQb6RnymW8D8QPerem29Tv+fh+tl/5ae1eYySXyGQGg/E96+RvIzBsjw0l8Mu5/Va/J9hMcZTlpOnbri35Sbv4rtPYgV9XmGzNuPh8lxaORzafGPh4ixXY7N3mjksJLRuOjr3jP2vmnuPrKyd07SVn59j29eo2UM0XKDzJb23Xat12/D1l8oe1K2OGJz5LYQDkdHZaZqVdczG11ZV3c09XgsW3Fmyvv2bX1AtiP2BzVZN7LdlqUU7ylsvm+C79e5O2pye1pZ4Q0stEJxja1oOFjCTZoaThbcWOQuL81ysuMEklxJ1dcm/iV2m+LOxTW0YJov8AsyCP/wCVzK7aNGGRNb8/qebiK83Uab04LguzkQ6Cvlgf0kT3MfzHEciDk4dxXdbE/SLo2qZb/mRjL7Uf4j1Kn3b3bZWGVpcWOY1paQARclw7TeIy4EKDtvdSqprlzMbB/wDoy7m284at9It3qk0r5WTCUsuZHr9DXRTNxxPa9vNpvY8jyPcVJXnn6K6GQOlmNxG5oYOT3XxXHPCMr+ee9ehrFqzsdUXdXCkUcvzT6FHQFVauWTsy0RaoZMQv61tXObhERAEREBBrD2vQtK3VflepaVvHYxluERFYg4vb+1BDUPa+ZwvhIaC+wBA4DIfnmqx22oTrLfxxfistuQskqJXloJLnC5z8k4Rr3BRmRNGjQPAALwqkrzfK59ph6SVKF97LlyJ8NSxwu1wIWWMcx61BRVubZSwuFrmia/JzWuHIgH3qvmmYzy3Nb9Yge9fIZmP8hzXfVIPuU3e5VxTeW/d9vsbjsumBv0bGnmOz7rLL9WxHQeFnFa7L6MlpHEVY7SfiznngcPN3lTi//KMjsmLzvWPgsDsdn0nez4L7iPMrLpDzPrV/bK/82ZPorCP/AK15FVW7pse4u6Vwvb5oOgspkWxC1gb0t7ebr7VI6Q8yjnuI8o+tWWOrp3zfJfQpLojCSVnD5y+poOxj/wAT2LE7Gf8ASapTZXDiV96d3P3K66RrrivBGT6Dwj/x/wBn9TVS7OLb42tffS7nNt4WC+dRePJAHdiuD4ghb+sOTrDu5UljKk3eX28L2NqfRdGmrRuuvS67JNXXcyVRzzMY6MO7DmkFtyQ2/Fh1b4adys6fbsrGtb0bCGgAZkaCyo+sHuX3rJ5BZ+0Tve5ssDRtlcFz7+ellr1JETeGUujsWWBnkkGenSAFze/tAuv3rnm6BXu2atpYWktDrggXFznwHhdULV73R1Rzo3fNnx3TdCFHE5YKyaT816HY/o9qY4zMZHhpd0YF+7GTnoNQu9ila4Xa4OHMEEesLzbdyufFG4NsQ51yCGuByA0cCujpduU4sX04D+L4iGE+htveuPEYpKtKL4P81PQw3RkpYWE4p3avwe/VpbxZ1SKoh3jp3kNAkbfK7w23pIJVutIVIzV4s5q1CpRdqkWgiIrmRsp34T3HVWCq1Pp3XaFlUXE0g+BtREWZcIiICDWDtehaVKrRkCoq2hsYyWoWD3gAk6DM+AWa01UAexzDo5pHrFlZ34EJJuz2PN247uLn4sRJGQFrknhqs1sqad0bi14sQbf6cwta8DbRn3i1V1sFQ7e2u5ruhhNn2GN9r4AdA0cXlXwXNbjhkkr55niMBsspkJaMDi4Ma7tZdnFcX4gLswdGM5Ny2R5HS+KnRpxhB2cuPJLczm3W6GB1XVuIAIDgGiaYXcG9suIDSCRcXNl9h3UbPTtqqV9wSQ0OAhluHllmua4gkuGQuL3Cx2T0VO+V9JWzSMYHPqi6nL6eRtxdrrkXkcHeVxscwF9fs109LDS0xLafpJao1Dw6NkEOKRrWON7Oe04zkdWtN7G49XMfL5F38+JlsPazy/oZjd2eB5Fi4t1Y8cHix8bHiugXNb8tY10c8Moluxj+lBacckTsDnktyubC9uN10bX3APAgH1heVjKMYSUo7M+o6Ixc61OUJu7jx5p7GSIi4z1wgXwr6gCIiAIiIAuY2htKWok6GnxYb4bs8uV3ENPzWjO59tlcbcqDHTyvBsQ2wPInIH2+xVu69HAKWd0tR1cFrIWSZXBcC94aDqXAAWGdg6xC78FRjK85a2PC6YxU4ZaNN2vq3xt+fnPHaG78dDHHNO/OQkM6JokGLDcY5XOBIIvmAdCsQvlM+CGmka2qmfQu/ZOElOcLpHtf2qZxcMBYWYjcD7RXxotle+WuYvbjY5r28PJu58lioJWaLTZFU0jor9poxW5tJtceke0KzXIGTBUwPHFwYe9r7jP2H0Lr14fSNPJXb56n2XQdd1cJFP8Ax93w2+ncF3mxJXOgjLtbesAkA+kAFec1krsUcMd+kmc1jTa+G5ALz4Xv+SvUIIQxrWN0aA0eAFgr4Km1eb2Zz9MYiErUlutX1dX1NqIi7zwwptH5PpKhKxjbYALOo9C8NzNERZGgREQGEjLiyrnNsbFWi0zQh3jzV4ysUlG5BRbuqu7k6q7uWmZcymV8iO4A65qN+rYHvaHRMzJv2QPmk6hWPVXdyR0zg5pysCb/AHSPxVZuLRaDnF3V12FCN36dw8kjXR3f33Xn22t2YtnyNjxSdVqI3wve6znRlxuTcADIhjhloHa2XrsdI4Dhx960bQ2O2eN0crQ5jtQfYQeBHNTDJDaxNWdWqlnbdtru55LUsjirqOhiL2QtimEb7Bwklnif+0NxhlAu03sRc8hlC2fTw1cxpK1k7KhgLXvid+xtG0BrjHYtiBaAbgBpyOV12sm4tdAR1OpYWA3ayYXwEgjsnC4XzOYDdUG5FfUXFXVMEZIxMiHl2Fu12Wj14tNFe8eZj738WcXLu7JXAw0JaYqdjY2ySuLQ/tFznXa03c5xccha1jlcLs4N15w1o7GQA8o8Bbkuy2bsZtPGIomhrR35k8STxJ5qV1V3csa0IVbZnsdeExFXDXcLXe90cN8mZvM+9/RPkzN5n3v6Luequ7k6q7uWHslHm/E7P3bFcl4fc4b5MzeZ97+ifJmbzPvH4Luequ7k6q7uT2SjzfiP3bFdXh9zhvkzN5n3j8E+TM3mfePwXc9Vd3J1V3cnslHm/Efu2K6vD7nDfJmbzPvH4J8mZvM+8fgu56q7uTqru5PZKPN+I/dsV1eH3POtsbn1EsEkbeju5uV3G173FzbmFzNPsDo3dQ2gcDZeie17HDDjZiaA17hliDnNJtkQOYK9r6q7uVZt3duOrj6OYDK+FwPaYTxBt7DkVvRjCkmk9GcWLrVcRJTla6PLBLJPWVsEIMb4oY20sbowWFlPICWuZICAHuOTraO151xmLzjcLF93EZ5F2ZGefrXV7Y3d2vRgdVk6w2xaCGsMkbdbASXNtNHHMDJcPWU8lJnUSh0z7k04cXvjuRd0zvJjcbeT2nG4vbO3XRqRizz69OU0tLWLvZe7E9XJHJHg6OKQF+JxDrgYm2ABv612rN15uLmD0uP4LR+iSXp4J3tbYCUAXN72jbextzJC7vqru5c2Jp0qtRyZ34HFV8NSyQsr6vS5y1PusB5cpP1Rb2m/uV9TQNY0Mbo0WHH2qX1V3cnVXdyrTp0qfwlq+Jr1v+R3NKLd1V3cso6U3z07lpmRz5WfKWK5udBopq+AL6sW7s1SsERFBIREQBERAEREAREQBERAEREAREQBERAEREAREQBERAEREAXKV36PtnTTGd9P23OLnAPkax7ibkuY04SSczlnfO66tEIauaoImsaGsaGtaLNa0AAAcABkAtqIhIREQBERAEREAREQBERAEREAREQBERAEREAREQBERAEREAREQBERAEREAREQBERAEREAREQBERAEREAREQH/2Q==">
    </a>
</div>

     
<div class="lowerpRectangle">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="whitepText">
                    <h5>
                        <a href="" class="navbar-brand">
                            <span>Ghayarly</span>
                        </a>
                    </h5>
                    <p>
                        <i class="fa fa-map-marker" aria-hidden="true"></i> All over Egypt
                    </p>
                    <p>
                        <i class="fa fa-phone" aria-hidden="true"></i> 19255
                    </p>
                    <p>
                        <i class="fa fa-envelope" aria-hidden="true"></i> feedback@Ghayarly.com
                    </p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="whitepText">
                    <h5>Information</h5>
                    <p>
                        All your car needs and services at your doorstep. <br>
                        With Ghayarly, you can order your car service online, and we will come to you or visit us at the nearest shop.
                    </p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="whitepText">
                    <h5>Useful Links</h5>
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li><a>About us</a></li>
                        <li><a>Why Us</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-12 text-center">
                <div class="social_box">
                    <a href=""><i class="fa fa-facebook" aria-hidden="true"></i></a>
                    <a href=""><i class="fa fa-twitter" aria-hidden="true"></i></a>
                    <a href=""><i class="fa fa-instagram" aria-hidden="true"></i></a>
                    <a href=""><i class="fa fa-youtube" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>

   

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Quantity adjustment script
        const quantityButtons = document.querySelectorAll('.quantity-button');

        quantityButtons.forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent the default action (form submission)

                const type = this.getAttribute('data-type');
                const inputField = this.parentNode.querySelector('input[name="quantity"]');
                let currentValue = parseInt(inputField.value);

                if (type === 'minus' && currentValue > 1) {
                    currentValue -= 1;
                } else if (type === 'plus') {
                    currentValue += 1;
                }

                inputField.value = currentValue;

                // If needed, you can add an AJAX call here to update the quantity without submitting the form
            });
        });

        // Delete button functionality
        const deleteButtons = document.querySelectorAll('.delete-button');

        deleteButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                if (confirm('Are you sure you want to delete this item?')) {
                    const deleteId = this.getAttribute('data-id');
                    const form = this.closest('form');

                    form.querySelector('input[name="delete_id"]').value = deleteId;
                    form.submit();
                }
            });
        });
    });
    let slideIndex = 0;
    showSlides();

    function showSlides() {
        let i;
        const slides = document.getElementsByClassName("mySlides");
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        slideIndex++;
        if (slideIndex > slides.length) {
            slideIndex = 1;
        }
        slides[slideIndex - 1].style.display = "block";
        setTimeout(showSlides, 5000); // Change image every 5 seconds (5000 milliseconds)
    }
</script>

<script>
    function goToIndex() {
        window.location.href = 'index.html';
    }
    function checkout() {
        
        alert("your order is confirmed.  Thank you for shopping with us");
    
}
   

</script>
</body>
</html>
