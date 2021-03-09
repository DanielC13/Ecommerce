<?php
include("header.php");
// include("dynamic/loginfunc.php");
if (isset($_POST['sublog'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if (!empty($username) && !empty($password)) {
    $que = "select * from user where username = '".$username."' and password = '".$password."'";
    $result = mysqli_query($conn, $que);
    $rows = mysqli_num_rows($result);
    $row = mysqli_fetch_array($result);
    if ($rows==1) {
            $_SESSION["id"]= $row[0];
            $_SESSION['userphoto']=$row['user_photo'];
            $_SESSION['username']=$username;
            $_SESSION['identity']=$row['identity'];
            echo "<script>window.location.href='index.php';</script>";
        }else {
            echo "<script>alert('wrong username or password!')</script>";
        }
    }else{
        echo "<script>alert('pls insert')</script>";
    }
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>login</title>
    <link rel="stylesheet" href="login/login.css">
    <script src="login/login.js"></script>
    
</head>
<body>
    <form method="POST">
       <h1>Login</h1>
       <input type="text" name="username" placeholder="Username">
       <input id="txtpass" type="password" name="password" placeholder="Password">
       <div><input id="chkbx" type="checkbox" name="chkpass" onclick="chk(this)">show password</div>
       <input type="submit" name="sublog" value="login">
       <br>
       <a href="signup.php">Sign up</a>
    </form>
</body>
</html>