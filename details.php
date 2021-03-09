<?php 
    session_start();
    $conn = new mysqli("localhost","root","","online_shop");

if ($_SESSION['identity']=='seller') {
    $pro_qry = "SELECT * FROM customer_order WHERE customer_id = {$_GET['customerid']} AND pro_id = {$_GET['proid']} AND order_time = '{$_GET['time']}'";
    $rdy_pro = mysqli_query($conn, $pro_qry);
    $row = mysqli_fetch_array($rdy_pro);
    $seller_qry = "SELECT Username,user_photo,Email,ID FROM user WHERE ID = {$row['customer_id']}";
    $rdy_seller = mysqli_query($conn, $seller_qry);
    $row2 = mysqli_fetch_array($rdy_seller);

    if (isset($_POST['update'])) {
        $tracknum = $_POST['tracknum'];
        $updqry = "UPDATE customer_order SET status='Delivered', tracking_num='$tracknum',cancel_reason='' WHERE customer_id = {$_GET['customerid']} AND pro_id = {$_GET['proid']} AND order_time = '{$_GET['time']}'";
        if (mysqli_query($conn,$updqry)) {
            echo "<script>alert('Order status updated')</script>";
        }
    }
    if (isset($_POST['cancel'])) {
        $reason = $_POST['reason'];
        $updqry = "UPDATE customer_order SET status='Canceled',cancel_reason='$reason',tracking_num='' WHERE customer_id = {$_GET['customerid']} AND pro_id = {$_GET['proid']} AND order_time = '{$_GET['time']}'";
        if (mysqli_query($conn,$updqry)) {
            echo "<script>alert('Order status updated')</script>";
        }
    }
}else{
    $pro_qry = "SELECT * FROM customer_order WHERE customer_id = {$_SESSION['id']} AND pro_id = {$_GET['proid']} AND order_time = '{$_GET['time']}'";
    $rdy_pro = mysqli_query($conn, $pro_qry);
    $row = mysqli_fetch_array($rdy_pro);
    $seller_qry = "SELECT Username,user_photo,Email,ID FROM user WHERE ID = {$row['seller_id']}";
    $rdy_seller = mysqli_query($conn, $seller_qry);
    $row2 = mysqli_fetch_array($rdy_seller);
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href='https://fonts.googleapis.com/css?family=Roboto Mono' rel='stylesheet'>
    <link rel="stylesheet" href="details/details.css">
    <title>Document</title>
</head>
<body>
    <span id="buttback" onclick="window.history.back();">&#8592;</span>
    <div class='product-con'>
        <img src="<?=$row['pro_img']?>" alt="" class="product-img">
        <div class="product-name"><?=$row['pro_name']?></div>
        <label for="">Quantity</label>
        <div class="product-quan"><?=$row['pro_quan']?></div><br>
        <label for="">Total price</label>
        <div class="product-price">RM <?=$row['pro_price']?></div><br>
        <label for="">Status</label>
        <?php if ($row['status'] == "Ordered") {?>
            <div class="">Ordered</div>
        <?php }elseif ($row['status'] == "Delivered") {?>
            <div class="">Delivered</div>
        <?php }elseif ($row['status'] == "Canceled") {?>
            <div class="">Canceled</div>
        <?php } 

        if ($_SESSION['identity']=='seller') {?>
        <form method='POST'>
            <input type="number" name="tracknum" required>
            <input type="submit" name="update" value="Update status">
        </form>
        <form method='POST'>
            <input type="text" name="reason" required>
            <input type="submit" name="cancel" value="Cancel Order">
        </form>
        <?php }?><br>
        <label for="">Tracking number :</label>
        <a href="#"><?=$row['tracking_num']?></a>
        
    </div>
    <?php if ($_SESSION['identity']=='seller') { ?>
        <div class="product-seller">
            <div class="seller-img-con">
                <img class="seller-img" src="<?=$row2['user_photo']?>" alt="">
            </div>
            <div class="seller-content">
                <?=$row2['Username']?><br>
                <?=$row2['Email']?>
            </div>
            <div class="view-profile" onclick="window.location.href='userprofile.php?userid=<?=$row2['ID']?>'"><label for="">View profile</label></div>
        </div>
    <?php }elseif ($_SESSION['identity']=='customer') { ?>
        <div class="product-seller">
            <div class="seller-img-con">
                <img class="seller-img" src="<?=$row2['user_photo']?>" alt="">
            </div>
            <div class="seller-content">
                <?=$row2['Username']?><br>
                <?=$row2['Email']?>
            </div>
            <div class="view-profile" onclick="window.location.href='userprofile.php?userid=<?=$row2['ID']?>'"><label for="">View profile</label></div>
        </div>
    <?php }else{ ?>
        <div class="product-seller">
            <div class="seller-img-con">
                <img class="seller-img" src="<?=$row2['user_photo']?>" alt="">
            </div>
            <div class="seller-content">
                <?=$row2['Username']?><br>
                <?=$row2['Email']?>
            </div>
            <div class="view-profile" onclick="window.location.href='userprofile.php?userid=<?=$row2['ID']?>'"><label for="">View profile</label></div>
        </div>
    <?php }?>
</body>
</html>