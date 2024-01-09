<?php
    $servername = "localhost";
    $username = "sofe280";
    $password = "123456";
    $dbname = "store";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $name = $_POST["name"];
        $address = $_POST["address"];
        $phoneNumber = $_POST["phoneNumber"];
        $email = $_POST["email"];
        $bookingDate = $_POST["selectedDate"];
        $bookingTime = $_POST["selectedTime"];
        
        $sql = "INSERT INTO passport_picture_bookings (name, address, phoneNumber, email, bookingDate, bookingTime)
                VALUES ('$name', '$address', '$phoneNumber', '$email','$bookingDate', '$bookingTime')";
        
        if($conn->query($sql) === TRUE){
            // Redirect to the desired page after updating inventory
                header("Location: http://localhost/assigncode.php");
                exit();
            }
            else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
        $conn->close();
?>
<!DOCTYPE html>
<head>
    <title>Simcoe Convenince Services</title>
    <link href="services.css" rel="stylesheet" type="text/css"/>
</head>
<body>
    <header>
        <div id="logoline">
            <img src="logo.jpg" alt="Store Logo">
            <h1>Simcoe-Conlin Convenience</h1>
        </div>
        <nav>
            <a href="assigncode.php">Shop</a>
            <div class="dropdown">
                <a class="active" href="#services" onclick="toggleDropdown()">Services</a>
                <div class="dropdown-content" id="servicesDropdown">
                    <a href="#key" onclick="changeService('key')">Key Copy</a>
                    <a href="#passport" onclick="changeService('passport')">Passport Pictures</a>
                    <a href="#greetingCard" onclick="changeService('greetingCard')">Greeting Cards</a>
                    <a href="#printAndFax" onclick="changeService('printAndFax')">Print and Fax</a>
                </div>
            </div>
            <a href="checkout.php">Cart</a>
        </nav>
    </header>
    <div class="service" id="key">
        <h3 class="serviceName">Key Copy</h3>
        <img src="keys.jpg" alt="Keys" class="product-image">
        <p>
            Make a duplicate a key for your car or home. The self-service kiosks allow you to easily copy keys within minutes. The cost vaires from $2.00 - $5.00 depending on the type of key it is copying and if designs are added to it.<br><strong>This services is only avalible in store</strong>.
        </p>
    </div>
    <div class="service" id="passport">
        <h3 class="serviceName">Passport Pictures</h3>
        <img src="passport.jpg" alt="Passport" class="product-image">
        <p>Get your passport pictures taken near you! There is a professional photographer that will make sure you have no issues getting your passport. Children's photos cost $10.99 and adult's photos are $15.99. You must book at least three days in advance.
            <br><Strong>Payments are in-store only.</Strong>
            <details>
                <br>
                <summary>Book Now!</summary>
                <div>
                    <form id="form" method="post" action="services.php">
                        <label for="nameInput">Name:</label><br>
                        <input type="text" name="name" id="nameInput" placeholder="First Last"><br>

                        <label for="addressInput">Address:</label><br>
                        <input type="text" name="address" id="addressInput" placeholder="123 StreetName"><br>

                        <label for="phoneNumberInput">Phone Number:</label><br>
                        <input type="tel" name="phoneNumber" id="phoneNumberInput" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="123-456-7890"><br>

                        <label for="emailInput">Email Address:</label><br>
                        <input type="email" name="email" id="emailInput" placeholder="name@domain.com"><br>

                        <label for="selectedDate">Date: </label><br>
                        <input type="date" name="selectedDate" id="date"><br>

                        <label for="selectedTime">Time: </label><br>
                        <input type="time" name="selectedTime" id="time"><br>

                        <button type="submit" id="submitButton">Submit</button>
                    </form>
                </div>
            </details>
        </p>
    </div>
    <div class="service" id="greetingCard">
        <h3 class="serviceName">Greeting Cards</h3>
        <img src="card.jpg" alt="Greeting Card" class="product-image">
        <p>
            Choose a card for any occasion from your friend's birthday to a christmas card for your grandparents. There is a huge selection and write a custom note in the card. The price of the card varies from $1.00 to $5.00 with an additional cost of $2.50 for the custom note written inside.<br><strong>This services is only avalible in store</strong>.
        </p>
    </div>
    <div class="service" id="printAndFax">
        <h3 class="serviceName">Print and Fax</h3>
        <img src="print.jpg" alt="Print" class="product-image">
        <p>
            Print or fax documents in store. Printing is $0.10 per page and $0.15 for printing in color. To send a fax, it costs $1.80 per page and $1.50 to recieve a fax.<br><strong>This services is only avalible in store</strong>.
        </p>
    </div>
    <script>
    // Get the form element by its ID
const formElement = document.getElementById('form');

// Attach an event listener for the form submission
formElement.addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the default form submission

    // Create a new FormData object from the form
    const formData = new FormData(formElement);

    // Send the form data using an AJAX request
    fetch('services.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        // Handle the response here if needed
        console.log('Form submitted successfully');
        // You can redirect to another page if needed
        window.location.href = 'http://localhost/assigncode.php';
    })
    .catch(error => {
        // Handle errors here
        console.error('Form submission failed:', error);
    });
});
</script>
</body>
<footer>
    <div class="about-section">
        <h2>About Us</h2>
        <p>Simcoe-Conlin Convenience is your one-stop shop for all your convenience store needs. We offer a wide range of products to make your life easier.</p>
    </div>
    <div class="hours">
        <h2>Store Hours</h2>
        <p>Monday-Friday: 8:00 AM - 9:00 PM</p>
        <p>Saturday-Sunday: 9:00 AM - 7:00 PM</p>
    </div>
    <div class="copyright">
        <p>&copy; 2023 Simcoe-Conlin Convenience</p>
    </div>
</footer>
</html>