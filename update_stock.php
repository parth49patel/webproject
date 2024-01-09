<?php
    // Assuming you've established a database connection ($conn)
    $servername = "localhost";
    $username = "sofe280";
    $password = "123456";
    $dbname = "store";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed:" . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $productName = $_POST['product'];
        $quantity = $_POST['quantity'];

        // Update the inventory in the database
        $sql = "UPDATE inventory SET quantity = quantity - $quantity WHERE product_name = '$productName'";
        if ($conn->query($sql) === TRUE) {
            // Redirect to the desired page after updating inventory
            header("Location: http://localhost/assigncode.php");
            exit();
            echo "Stock updated successfully";
        } else {
            echo "Error updating stock: " . $conn->error;
        }
    }
    $conn->close();
?>