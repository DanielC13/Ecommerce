<?php include('header.php');
    $userid = $_GET['userid'];
    $userqry = "SELECT * FROM user WHERE ID = $userid";
    $rdyuser = mysqli_query($conn,$userqry);
    $userre = mysqli_fetch_array($rdyuser); 
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="userprofile/userprofile.css">
    <title>Document</title>
</head>
<body>
    <div class="left-con">
        <ul class="left-con-list">
            <li class="img-con"><img src="<?=$userre['user_photo']?>" alt=""></li>
            <li><?=$userre['Username']?></li>
            <li><?=$userre['Email']?></li>
            <li>Contact</li>
        </ul>
    </div>
    <div class="right-con">
        
    </div>
</body>
</html>