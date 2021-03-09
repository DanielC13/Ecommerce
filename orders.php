<?php include("header.php");?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="orders/orders.css">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <title>Document</title>
</head>
<body>
<button>Orders</button>
<button>History</button>
<input type="text" onkeyup="search(this.value)" class="searchbox" placeholder="Product Name"> 
<ul class="order-header">
    <?php if($_SESSION['identity']=="seller") {?>
        <li id="order-list-header">
            <div id="order-time" data-order-header="time" data-sort-type="asc" onclick="sortlist(this)">Order Time  <i class="fas fa-sort"></i></div>
            <div id="order-name" data-order-header="name" data-sort-type="asc" onclick="sortlist(this)">Name  <i class="fas fa-sort"></i></div>
            <div id="order-img">Image</div>
            <div id="order-pro" data-order-header="proname" data-sort-type="asc" onclick="sortlist(this)">Product Name  <i class="fas fa-sort"></i></div>
            <div id="order-quan" data-order-header="quantity" data-sort-type="asc" onclick="sortlist(this)">Qty  <i class="fas fa-sort"></i></div>
            <div id="order-price" data-order-header="price" data-sort-type="asc" onclick="sortlist(this)">Price  <i class="fas fa-sort"></i></div>
            <div id="order-status">Status</div>
            <div id="order-details"></div>
        </li>
    <?php }elseif($_SESSION['identity']=="customer") {?>
        <li id="order-list-header">
            <div id="order-time" data-order-header="time" data-sort-type="asc" onclick="sortlist(this)">Order Date  <i class="fas fa-sort"></i></div>
            <div id="order-name" data-order-header="name" data-sort-type="asc" onclick="sortlist(this)">Name  <i class="fas fa-sort"></i></div>
            <div id="order-img">Image</div>
            <div id="order-pro" data-order-header="proname" data-sort-type="asc" onclick="sortlist(this)">Product Name  <i class="fas fa-sort"></i></div>
            <div id="order-quan" data-order-header="quantity" data-sort-type="asc" onclick="sortlist(this)">Qty  <i class="fas fa-sort"></i></div>
            <div id="order-price" data-order-header="price" data-sort-type="asc" onclick="sortlist(this)">Price  <i class="fas fa-sort"></i></div>
            <div id="order-status">Status</div>
            <div id="order-details"></div>
        </li>
    <?php }else{?>

    <?php }?>
</ul>
<ul id="order-list-con">
    <!-- for seller -->
   <?php if($_SESSION['identity']=="seller") {
       $selqry = "SELECT * FROM customer_order WHERE seller_id = {$_SESSION['id']}";
       $selrdy = mysqli_query($conn,$selqry);
       while ($selresult = mysqli_fetch_array($selrdy)) {?>
    <li id="order-list">
        <div id="order-time"><?=$selresult['order_date']?></div>
        <div id="order-name"><?=$selresult['first_name']?> <?=$selresult['last_name']?></div>
        <div id="order-img"><img src="<?=$selresult['pro_img']?>" alt=""></div>
        <div id="order-pro"><?=$selresult['pro_name']?></div>
        <div id="order-quan"><?=$selresult['pro_quan']?></div>
        <div id="order-price">RM<span><?=$selresult['pro_price']?></span></div>
        <div id="order-status"><?=$selresult['status']?></div>
        <div id="order-details"><a href="details.php?time=<?=$selresult['order_date']?>&proid=<?=$selresult['pro_id']?>&customerid=<?=$selresult['customer_id']?>" target="_blank">Details</a></div>
    </li>
    <?php }?>
    <!-- for customer -->
   <?php }elseif($_SESSION['identity']=="customer") {
       $cusqry = "SELECT * FROM customer_order WHERE customer_id = {$_SESSION['id']}";
       $cusrdy = mysqli_query($conn,$cusqry);
       if ($cusrdy) {          
       while ($cusresult = mysqli_fetch_array($cusrdy)) {?>
    <li id="order-list">
        <div id="order-time"><?=$cusresult['order_date']?></div>
        <div id="order-name"><?=$cusresult['first_name']?> <?=$cusresult['last_name']?></div>
        <div id="order-img"><img src="<?=$cusresult['pro_img']?>" alt=""></div>
        <div id="order-pro"><?=$cusresult['pro_name']?></div>
        <div id="order-quan"><?=$cusresult['pro_quan']?></div>
        <div id="order-price">RM<span><?=$cusresult['pro_price']?></span></div>
        <div id="order-status"><?=$cusresult['status']?></div>
        <div id="order-details"><a href="details.php?time=<?=$cusresult['order_date']?>&proid=<?=$cusresult['pro_id']?>" target="_blank">Details</a></div>
    </li>
   <?php }}else{ ?>
    <p>No item</p>
    <?php }}else{ ?>
    <!-- for guest -->
        
       
   <?php }?>
</ul>
</body>
</html>
<script src="orders/orders.js"></script>