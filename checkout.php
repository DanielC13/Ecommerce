<?php 
include("header.php");

    if (isset($_POST['place-order'])) {
        $customer_id = $_SESSION['id'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $phone_number = $_POST['phone-number'];
        $postal_code = $_POST['postal_code'];
        $area = $_POST['area'];
        $state = $_POST['state'];
        $detail_address = $_POST['detail_address'];
        $qry_stmt = "SELECT * FROM customer_cart WHERE customer_id = $customer_id AND status = 'exist'";
        $qry_result = mysqli_query($conn, $qry_stmt); 
        while ($cart = mysqli_fetch_array($qry_result)){
            $find_seller_qry = "SELECT seller_id FROM product WHERE ID = '{$cart['pro_id']}'";
            $find_result = mysqli_query($conn, $find_seller_qry);
            $find_result2 = mysqli_fetch_array($find_result);  
            $seller_id = $find_result2['seller_id'];
            $order_qry_stmt = "INSERT INTO customer_order(customer_id,seller_id,pro_id,pro_name,pro_img,pro_price,pro_quan,status,first_name,last_name,phone_number,postal_code,area,state,detailed_address) VALUES ('$customer_id','$seller_id','{$cart['pro_id']}','{$cart['pro_name']}','{$cart['pro_img']}','{$cart['pro_price']}','{$cart['pro_quan']}','pending','$first_name','$last_name','$phone_number','$postal_code','$area','$state','$detail_address')";
            $delete_qry_stmt = "DELETE FROM customer_cart WHERE pro_id = '{$cart['pro_id']}' AND customer_id='$customer_id'";
            if (mysqli_query($conn,$order_qry_stmt) &&  mysqli_query($conn,$delete_qry_stmt)) {
                echo "<script>alert('Thank you for the order!');window.location.href='index.php';</script>";
            }else{
                echo "<script>alert('something is wrong,please try again!');</script>";
            }
        }
    }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="checkout/checkout.css">
    <title>Document</title>
</head>
<body>


    <div id="butt-back" onclick="window.history.back();">
        <span id="back-arrow" title="back" >&#8592;</span>
    </div>
    <div class="main-con">
    <div class="con-left">
        <form method="post">
            <p>Contact details*</p>
            <div class="con-left-contact">
                <input type="text" placeholder="First Name" name="first_name" required>
                <input type="text" placeholder="Last Name" name="last_name" required>
                <input type="number" placeholder="Phone Number" name="phone-number" required>
            </div>
            <p>Address*</p>
            <div class="con-left-address">
                <input type="number" placeholder="Postal Code" name="postal_code" required>
                <input type="text" placeholder="Area" name="area" required>
                <input type="text" placeholder="State" name="state" required>
            </div>
            <p>Detailed Address</p>
                <span>Unit number, house number, building, street name</span>
                <input type="text" name="detail_address" required>
                <input type="submit" id="sub-place-order" name="place-order">
        </form>
    </div>
    <div class="con-right">
        <div class="cart">
        <div class="cart-top">
            <div class="cartinfo">Cart</div>
            <div class="cartquan">Qty</div>
            <div class="carttotal">Total</div>
        </div> 
        <div class="cart-bottom">
            <ul class="cart-list cart-list-checkout" id="checkout-cart-list">
                <?php 
                if (isset($_SESSION['id'])) {
                    $qry = "SELECT * FROM customer_cart where customer_id = '".$_SESSION['id']."' AND status = 'exist' ";
                    $result = mysqli_query($conn,$qry);
                    while ($row = mysqli_fetch_array($result)) {
                        $checkif = "SELECT ID FROM product WHERE ID={$row['pro_id']}";
                        $resultcheck = mysqli_query($conn, $checkif);
                        $resultcheck2 = mysqli_num_rows($resultcheck);
                ?>
                <li class="each-cart" id="checkout-each-cart-<?=$row['pro_id']?>">
                  <div id="each-cart-con">
                            <div class="cart-list-delete" id="<?=$row['pro_id']?>" onclick="deletecartitem2(this.id)">
                                <div class="cart-xbar bar1"></div>
                                <div class="cart-xbar bar2"></div>
                            </div>
                    <?php if ($resultcheck2 == 1) {?>
                        <div class="each-all" id="each-all-id" data-each-id="<?=$row['pro_id']?>" onclick="window.location.href='viewpro.php?id=<?=$row['pro_id']?>&quan=<?=$row['pro_quan']?>'">
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
            <div class="carttotal" id="checkout-carttotal">
                <?php 
                $total_cart = "SELECT SUM(pro_price) total FROM customer_cart WHERE customer_id = $userid AND status = 'exist'";
                    $total_cart_result = mysqli_query($conn, $total_cart);
                    if ($total_cart_row = mysqli_fetch_array($total_cart_result)) {
                       echo number_format($total_cart_row['total'],2);
                    }else {
                        echo "";
                    }
                ?>
            </div>
        </div>
            <input type="button" id="btn-place-order" value="Place My Order" onclick="placeorder()">
    </div>
  </div>
  <div id="closepanel" onclick="panelhide(this)"></div>
    </div>
    </div>
</body>
</html>
<script src="checkout/checkout.js"></script>