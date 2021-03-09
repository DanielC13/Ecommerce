<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "online_shop";
// $servername = "localhost";
// $username = "id11299168_danielc12";
// $password = "angrytriplec";
// $database = "id11299168_online_shop";

$conn = new mysqli($servername,$username,$password,$database);

if ($conn -> connect_error) {
    die("connection_failed: " . $conn-> connect_error);
}

if (isset($_POST['logout'])){
        header("location:../mine/login.php?logoutsuccess");
        session_unset();
        session_destroy();
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href='https://fonts.googleapis.com/css?family=Roboto Mono' rel='stylesheet'>
    <link rel="stylesheet" href="header/header.css">
</head>
<header>
  <nav id="nav">
    <div id="menu" onclick="showmenu()">
        <div class="bar b1"></div>
        <div class="bar b2"></div>
        <div class="bar b3"></div>
    </div>
    <div class="nav-cart">
    <svg id="cart" width="35px" height="27.5px" onclick="showcart()"> 
        <polyline points="0.5,0.5 3,0.5 6,9.5 17,9.5 18.9,3.8 7.5,3.8" style="fill:none;stroke:black;stroke-width:1px" />
        <g> 
            <circle class="st0" cx="7.3" cy="13" r="1.5" stroke="black" fill="white"></circle>
            <circle class="st0" cx="15.8" cy="13" r="1.5" stroke="black" fill="white"></circle> 
        </g> 
    </svg>
    <span id="count-cart" onclick="showcart()">
        <?php
            if (isset($_SESSION['id'])) {
               $userid = $_SESSION['id'];
               $countcart = "SELECT COUNT(pro_id) ct FROM customer_cart WHERE customer_id = '$userid'";
               $countresult=mysqli_query($conn,$countcart);
                if($countrow=mysqli_fetch_array($countresult)){
                    echo $countrow['ct'];
                }else{
                    echo "0";
               }
            }else{
                echo "0";
            }
        ?>
    </span>
    </div>
    <img id="logo" src="backimg/logo.png" alt="idk" height="40px" width="60px">
    <!-- <input id="user-pic-icon" type="image" src="backimg/usericon.png" height="30px" width="30px"> -->
  </nav>
  <div id="side-menu">
    <div id="close-menu" onclick="hidemenu()">
        <div class="xbar1"></div>
        <div class="xbar2"></div>
    </div>
    <ul id="user-list">
        <?php 
			if (isset($_SESSION['id'])) { ?>
                <input id='user-pic-icon' type='image' src='<?=$_SESSION['userphoto']?>' height='100px' width='100px'>
				<li><form method='POST'><input class='input-logout' type='submit' name='logout' value='logout'></form></li>
		<?php	}else{ ?>
                <input id='user-pic-icon' type='image' src='backimg/usericon.png' height='100px' width='100px'>
			    <li><a href='login.php'>Login</a></li>
				<li><a href='signup.php'>Sign up</a></li>
		<?php	} ?>
    </ul>
    <ul id="menu-list">
        <li><a href="index.php">Shop</a></li>
        <?php if (isset($_SESSION['id'])) { 
            if ($_SESSION['identity']=="seller") { ?>
                <li><a href="orders.php">Order List</a></li>
           <?php }else { ?>
                <li><a href="orders.php">My Order</a></li>
           <?php }}?>
        <li><a href="#">About</a></li>
    </ul>
  </div>
  <div id="side-cart">
    <div id="close-cart" onclick="hidecart()">
        <div class="xbar1"></div>
        <div class="xbar2"></div>
    </div>
    <div class="cart">
        <div class="cart-top">
            <div class="cartinfo">Cart</div>
            <div class="cartquan">Qty</div>
            <div class="carttotal">Total</div>
        </div>
        <div class="cart-bottom">
            <ul class="cart-list" id="cart-list">
                <?php 
                if (isset($_SESSION['id'])) {
                    $qry = "SELECT * FROM customer_cart where customer_id = '".$_SESSION['id']."' ";
                    $result = mysqli_query($conn,$qry);
                    while ($row = mysqli_fetch_array($result)) {
                        $checkif = "SELECT ID FROM product WHERE ID={$row['pro_id']}";
                        $resultcheck = mysqli_query($conn, $checkif);
                        $resultcheck2 = mysqli_num_rows($resultcheck);
                ?>
                <li class="each-cart" id="each-cart-<?=$row['pro_id']?>">
                  <div id="each-cart-con">
                            <div class="cart-list-delete" id="<?=$row['pro_id']?>" onclick="deletecartitem(this.id)">
                                <div class="cart-xbar bar1"></div>
                                <div class="cart-xbar bar2"></div>
                            </div>
                    <?php if ($resultcheck2 == 1) {?>
                        <div class="each-all" onclick="window.location.href='viewpro.php?id=<?=$row['pro_id']?>&quan=<?=$row['pro_quan']?>'">
                    <?php }else{?>
                        <div class="item-removed"><h4 class="item-removed-title">This item has been removed by seller</h4>
                    <?php }?>
                    <div class="each-cartinfo">
                        <div class="each-cartimg"><img src="<?=$row['pro_img']?>" width='80px' height='80px'></div>
                        <div class="each-cartname"><?=$row['pro_name']?></div></div>
                    <div class="each-cartquan"><?=$row['pro_quan']?></div>
                    <div style='position:relative;bottom:-70px;width:20px;float:left;'>RM</div>
                    <div class="each-carttotal"><?=$row['pro_price']?></div>
                    </div>
                  </div>
                </li>
                <?php }}else{?>
                    <p>login first</p>
                <?php }?>
            </ul>
        </div>
        <div class="cart-subtotal">
            <div class="cartinfo">Subtotal</div>
            <div style="width:70px;text-align:center;">RM</div>
            <div class="carttotal" id="carttotal">
                <?php 
                    if (isset($_SESSION['id'])) {
                    $total_cart = "SELECT SUM(pro_price) total FROM customer_cart WHERE customer_id = $userid AND status = 'exist'";
                    $total_cart_result = mysqli_query($conn, $total_cart);
                    if ($total_cart_row = mysqli_fetch_array($total_cart_result)) {
                       echo number_format($total_cart_row['total'],2);
                    }else {
                        echo "";
                    }
                }else{
                    echo "";
                }
                ?>
            </div>
        </div>
        <button id="btn-continue-shopping">Continue Shopping</button>
        <button id="btn-proceed-to-checkout">Proceed to<br>Checkout</button>
    </div>
  </div>
  <div id="closepanel" onclick="panelhide(this)"></div>
</header>
<script type="text/javascript" src="header/header.js"></script>