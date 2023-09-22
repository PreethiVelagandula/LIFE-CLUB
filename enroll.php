<?php
 require_once("header_footer/header.php");
?>
    <?php
    $insert = false;
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
// Retrieve form data
$name = $_POST['name'];
$class = $_POST['class'];
$phone = $_POST['phone'];
$email = $_POST['email'];
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "enroll";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// SQL query to insert data into the table
$sql = "INSERT INTO enroll ( `name`, `class`, `phone`, `email`, `dt`) VALUES ('$name', '$class', '$phone', '$email', current_timestamp());";
if ($conn->query($sql) === TRUE){
  ///echo "Thank you! ";
  $insert = true;
} else {
   echo "Error: " . $sql . "<br>" . $conn->error;
// Close the database connection
$conn->close();
 }
}
?>
 <!--enroll header section starts-->
<body>
<section>
<div class="enroll_header">
  <div class="img-parent">
    <div class="img">
        <img src="images/pic1.jpg.jpg" class="img-fluid" alt="">
    </div>
     <div class="img-overlay"></div>
  </div>
<div class="img-content">
            <h6>ENROLL NOW<br><br></h6>
            <?php
              if($insert == true){
                echo "<p class='submitMsg'>Thank You! Please contact the head of the club.</p>";
              }
            ?>
            <form action="enroll.php" method="post">
                <input type="text" name="name" id="name" placeholder="Enter your Name">
                <input type="class" name="class" id="class" placeholder="Enter your Class/Year">
                <input type="tel" name="phone" id="phone" placeholder="Enter your Mobile Number">
                <input type="email" name="email" id="email" placeholder="Enter your Email Id"><br>
                
                <input type="submit" value="Enroll" class="btn">
            </form>
        </div>
</div>
 </section>
</body>
</html>
<!--enroll header section ends-->
<?php
  require_once("header_footer/footer.php"); 
?>