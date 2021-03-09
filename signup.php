<?php include("header.php");
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="signup/signup.css">
    <title>Document</title>
</head>
<body>
    <form method="POST" enctype="multipart/form-data">
        <div id="profile-image-con"  title="Choose your profile picture">
			<img id="profile-pic" src="backimg/usericon.png">
		</div>
		<input id="signform-user-image" type="file" name="signform-user-image" placeholder="Photo">
        <?php if(!$_GET){?>
            <input id='signform-user-name' type="text" name="signname" placeholder="Enter your Username"  required/>
		<input id="signform-user-email" type="email" name="signemail" placeholder="Enter your Email" autocomplete="on" required/>
        <?php }else{ ?>
		<input id='signform-user-name' type="text" name="signname" placeholder="Enter your Username" value="<?=$_GET['rename']?>" required/>
		<input id="signform-user-email" type="email" name="signemail" placeholder="Enter your Email" autocomplete="on" value='<?=$_GET['reemail']?>' required/>
        <?php }?>
		<input type="password" name="signpass" placeholder="Enter your Password" required>
		<input type="password" name="signcompass" placeholder="Confirm your Password" required><br>
        <select name="identity">
            <option value="customer" selected>customer</option>
            <option value="seller">seller</option>
        </select>
        <input type="submit" name="signup-submit" value="Signup"><br>
        <a href="login.php">Login</a>
    </form>
</body>
<script src="signup/signup.js"></script>
</html>
<?php 
if (isset($_POST['signup-submit'])) {
    
        $img = $_FILES['signform-user-image'];
        $name = $_POST['signname'];
        $email = $_POST['signemail'];
        $pass = $_POST['signpass'];
        $compass = $_POST['signcompass'];
        $iden = $_POST['identity'];
        if(!empty($img['name'])){

            $chg = explode(".", $img['name']);
            $chg = strtolower(array_pop($chg));
            $file ='user_img/user'.date('YmdHis').'.'.$chg;
            if ($chg=='jpg' || $chg=='jpeg' || $chg=='png') {
                $target_path = $file;
            }else{
			    $error_ext=1;
            }   
            
            if (file_exists($file)) {
			    $file_exists=1;
            }
            if (isset($error_ext)) {
                echo "<script>alert('something is wrong, please try again')</script>";
		    }elseif (isset($file_exists)) {
                echo "<script>alert('your mama dont love u')</script>";
            
		    }elseif (isset($target_path) && !move_uploaded_file($img['tmp_name'], $target_path)) {
			    echo "<script>alert('Image failed to upload image')</script>"; 
            }

        }else{
            $file = "backimg/usericon.png";
        }

        $searchuser = "SELECT * FROM user WHERE Username = '$name'";
        $searchresult = mysqli_query($conn, $searchuser);
        $row = mysqli_num_rows($searchresult);

        if ($row == 1) {
            echo "<script>window.location.href='signup.php?rename=$name&reemail=$email';alert('This username has been taken,please try another');</script>";
        }else{
        
            if($pass === $compass){
                $que = "INSERT INTO user(Username,Password,Email,user_photo,identity) values('$name','$pass','$email','$file','$iden')";
                if ($result = mysqli_query($conn,$que)) {
                    echo "<script>window.location.href='login.php';alert('Account created!');</script>";
                } 
            }else{
                echo "<script>window.location.href='signup.php?rename=$name&reemail=$email';alert('Your passsword is not identical,please try again');</script>";
            }
        }
    }
?>