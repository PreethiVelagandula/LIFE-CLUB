<?php 
$con=mysqli_connect("localhost","root","","admin");
if(mysqli_connect_error())
{
    echo "cannot connect";
}
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>LFDC</title>
    <!--CSS on Admin Form-->
    <style>
        *{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
    font-family: poppins;
    text-decoration: none;
  }
  body{
    margin: 11%;
    padding-left: 25%;
    background-color: #f2f4f6;

  }
  div.login-form{
    width: 450px;
    background-color: white;
    box-shadow: 0px 5px 10px black;
  }
div.login-form h2{
    text-align: center;
    background-color: black;
    padding: 12px 0px;
    color: white;
}
div.login-form form{
    padding: 30px 60px;
}
div.login-form form div.input-field{
    display: flex;
    flex-direction: row;
    margin: 12px 0px;
}
div.login-form form div.input-field i{
    color: darkslategray;
    padding: 10px 14px;
    background-color: #f2f4f6;
    margin-right: 5px;
}
div.login-form form div.input-field input{
    background-color: #f2f4f6;
    padding: 10px;
    border: none;
    width: 100%;
    padding-left: 15px;
}
div.login-form form button{
    width: 100%;
    background-color: #13879b85;
    color: black;
    padding: 8px;
    border-radius: 10px;
    border: 1px solid ;
    font-size: 18px;
    font-weight: 500;
    margin: 10px 0;
    transition: 0.4s;
}
div.login-form form button:hover{
    background-color: #4196e681;
    letter-spacing: 3px;
}
div.login-form form a{
    margin: 142px;
    font-weight: bolder;
    font-size: 18.5px;
}
    </style>
    <!--CSS ends-->
</head>
<body>
    <!--Admin form starts-->
<div class="login-form">
    <h2>Admin Login</h2>
    <form method="POST">
        <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="text" placeholder="Admin Name" name="AdminName">
        </div>
        <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="Password" name="AdminPassword">
        </div>
        <button type="submit" name="Login">Log In</button>
        <a href="index.php">Home</a>
    </form>
</div>
<?php  
if(isset($_POST['Login']))
{
    $query="SELECT * FROM `admin` WHERE `Admin_Name`='$_POST[AdminName]' AND `Admin_Password`='$_POST[AdminPassword]'";
    $result=mysqli_query($con,$query);
    if(mysqli_num_rows($result)==1){
       session_start();
       $_SESSION['AdminLoginId']=$_POST['AdminName'];
       header("location: adminpanel.php");
    }
    else{
        echo "<script>alert('Incorrect Password or Admin Name');</script>";
    }
}
?>
<!--Admin Form Ends-->
@LifeClub | All Rights Reserved
</body>
</html>


