<?php
 require_once("header_footer/header.php");
?>
    <?php
    $insert = false;
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
// Retrieve form data
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$amount = $_POST['amount'];
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "donate";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// SQL query to insert data into the table
$sql = "INSERT INTO donate ( `name`, `phone`, `email`, `amount`, `dt`) VALUES ('$name', '$phone', '$email', '$amount', current_timestamp());";
if ($conn->query($sql) === TRUE) {
  ///echo "Thank you! Please click on 'Next' to donate.";
  $insert = true;
} else {
   echo "Error: " . $sql . "<br>" . $conn->error;
// Close the database connection
$conn->close();
 }
}
?>
 <!--donate header section starts-->
    <body>
    <section>
<div class="donate_header">
  <div class="img-parent">
    <div class="img">
      <img src="images/survey.8.jpg" class="img-fluid" alt="">
    </div>
    <div class="img-overlay"></div>
  </div>
  <div class="img-content">
            <h6>PLEASE FILL THE BELOW FORM TO DONATE US:<br><br></h6>
            <?php
              if($insert == true){
                echo "<p class='submitMsg'>Thank You! Please click on 'Next' to donate.</p>";
              }
            ?>
            <form action="donate.php" method="post">
                <input type="text" name="name" id="name" placeholder="Enter your Name">
                <input type="tel" name="phone" id="phone" placeholder="Enter your Mobile Number">
                <input type="email" name="email" id="email" placeholder="Enter your Email Id">
                <input type="number" name="amount" id="amount" placeholder="Enter the Amount"><br>
                <input type="submit" value="Submit" class="btn" >
            </form>
            <a href="next.php" class="btn">Next</a>
        </div>
</div>
</section>
    </body>
</html>
<!--donate header section ends-->
<?php
  require_once("header_footer/footer.php"); 
?>
 