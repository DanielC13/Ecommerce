<?php 
session_start();
    // include("header.php");
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "online_shop";

    $conn = new mysqli($servername,$username,$password,$database);

    if ($conn -> connect_error) {
        die("connection_failed: " . $conn-> connect_error);
    }

$userid = $_SESSION['id'];

    if (isset($_GET['carttotal'])) {
        $countqry = "SELECT SUM(pro_price) total FROM customer_cart WHERE customer_id = $userid AND status = 'exist'";
         if ($countresult = mysqli_query($conn,$countqry)) {
                $count = mysqli_fetch_array($countresult);
                       echo number_format($count['total'],2);
                      
                       // echo "<script>document.getElementById('carttotal').innerHTML= '{$count['total']}'</script>";
                    }else {
                        echo "0";
                    }
    }

  if (isset($_GET['delcart'])) {
        $proid = $_GET['delcart'];
        $delqry = "DELETE FROM customer_cart WHERE customer_id = '$userid' AND pro_id = '$proid'";
        mysqli_query($conn,$delqry);

        $qry = "SELECT * FROM customer_cart where customer_id = '".$_SESSION['id']."' ";
                    $result = mysqli_query($conn,$qry);
                    while ($row = mysqli_fetch_array($result)) {

                        $checkif = "SELECT ID FROM product WHERE ID={$row['pro_id']}";
                        $resultcheck = mysqli_query($conn, $checkif);
                        $resultcheck2 = mysqli_num_rows($resultcheck);?>


                    <li class="each-cart" id="each-cart-<?=$row['pro_id']?>">
                        <div id="each-cart-con">
                            <div class="cart-list-delete" id="<?=$row['pro_id']?>" onclick="deletecartitem(this.id)">
                                <div class="cart-xbar bar1"></div>
                                <div class="cart-xbar bar2"></div>
                            </div>
                        <?php if ($resultcheck2 == 1) {?>
                            <div class="each-all"  onclick="window.location.href='viewpro.php?id=<?=$row['pro_id']?>&quan=<?=$row['pro_quan']?>'">
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
     <?php }
    } 

    if (isset($_GET['delcart2'])) {
        $proid = $_GET['delcart2'];
        $delqry = "DELETE FROM customer_cart WHERE customer_id = '$userid' AND pro_id = '$proid'";
        mysqli_query($conn,$delqry);

        $qry = "SELECT * FROM customer_cart where customer_id = '".$_SESSION['id']."' ";
                    $result = mysqli_query($conn,$qry);
                    while ($row = mysqli_fetch_array($result)) {

                        $checkif = "SELECT ID FROM product WHERE ID={$row['pro_id']}";
                        $resultcheck = mysqli_query($conn, $checkif);
                        $resultcheck2 = mysqli_num_rows($resultcheck);?>


                    <li class="each-cart" id="each-cart-<?=$row['pro_id']?>">
                        <div id="each-cart-con">
                            <div class="cart-list-delete" id="<?=$row['pro_id']?>" onclick="deletecartitem2(this.id)">
                                <div class="cart-xbar bar1"></div>
                                <div class="cart-xbar bar2"></div>
                            </div>
                        <?php if ($resultcheck2 == 1) {?>
                            <div class="each-all"  onclick="window.location.href='viewpro.php?id=<?=$row['pro_id']?>&quan=<?=$row['pro_quan']?>'">
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
<?php }
    }

    if (isset($_GET['sortlist'])) {
        $getsort = $_GET['sortlist'];
        $sorttype = $_GET['sorttype'];
        if ($sorttype == "asc") {
                switch ($getsort) {
                case 'time':
                    $sortwut = "order_date DESC";
                    break;
                case 'name':
                    $sortwut = "first_name DESC";
                    break;
                case 'proname':
                    $sortwut = "pro_name DESC";
                    break;
                case 'quantity':
                    $sortwut = "CAST(pro_quan AS int) DESC";
                    break;
                case 'price':
                    $sortwut = "CAST(pro_price AS int) DESC";
                    break;
                default:
                    echo "???";
                    break;
            }
        }elseif ($sorttype == "desc") {
                switch ($getsort) {
                case 'time':
                    $sortwut = "order_date ASC";
                    break;
                case 'name':
                    $sortwut = "first_name ASC";
                    break;
                case 'proname':
                    $sortwut = "pro_name ASC";
                    break;
                case 'quantity':
                    $sortwut = "CAST(pro_quan AS int) ASC";
                    break;
                case 'price':
                    $sortwut = "CAST(pro_price AS int) ASC";
                    break;
                default:
                    echo "???";
                    break;
            }
        }
        $sortqry = "SELECT * FROM customer_order WHERE customer_id = $userid ORDER BY $sortwut";
        $rdy_sort = mysqli_query($conn,$sortqry);
        while ($cusresult = mysqli_fetch_array($rdy_sort)) { ?>
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
    <?php  } 
     } 

    if (isset($_GET['search'])) {
        $search = $_GET['search'];
        $search_qry = "SELECT * FROM customer_order WHERE customer_id = $userid AND pro_name LIKE '%$search%'";
        $rdy_search = mysqli_query($conn,$search_qry);
        while ($cusresult = mysqli_fetch_array($rdy_search)) {?>
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
    <?php  }
    }


