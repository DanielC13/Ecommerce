<?php include("header.php");

    if (isset($_POST['edit-product'])) {
        // $proimage = $_FILES['product-img'];
        $proname = $_POST['product-name'];
        $proprice = number_format($_POST['product-price'],2,".","");
        $proquan = $_POST['product-quan'];
        
        if(!empty($_FILES['img']['name'])){
            $chg = explode(".", $_FILES['img']['name']);
            $chg = strtolower(array_pop($chg));
            $file ='img/P'.date('YmdHis').'.'.$chg;
            if ($chg=='jpg' || $chg=='jpeg' || $chg=='png') {
                $target_path = $file;
            }else{
			    $error_ext=1;
            }   
            
            if (file_exists($file)) {
			    $file_exists=1;
            }
            if ($error_ext) {
                echo "<script>alert('something is wrong, please try again')</script>";
		    }elseif ($file_exists) {
			    echo "<script>alert('your mama dont love u')</script>";
		    }elseif (isset($target_path) && !move_uploaded_file($_FILES['img']['tmp_name'], $target_path)) {
			    echo "<script>alert('Image failed to upload image')</script>"; 
            }

               $que ="UPDATE product SET image='$file',name='$proname',price='$proprice',quantity='$proquan' WHERE ID = '".$_GET['id']."'";
                if($result = mysqli_query($conn,$que)){
                    echo "<script>window.location.href='index.php';alert('edit successfully!');</script>";
                }else{
                    echo "<script>window.location.href='add.php';alert('Failed to edit');</script>";
                }
            
        }else{
              $que ="UPDATE product SET name='$proname',price='$proprice',quantity='$proquan' WHERE ID = '".$_GET['id']."'";
                if($result = mysqli_query($conn,$que)){
                    echo "<script>window.location.href='index.php';alert('edit successfully!');</script>";
                }else{
                    echo "<script>window.location.href='add.php';alert('Failed to edit');</script>";
                }
            
        }
    }
$qry = "SELECT * FROM product WHERE ID='".$_GET['id']."'";
$result = mysqli_query($conn, $qry);
$row = mysqli_fetch_array($result);

if (isset($_SESSION['id'])) {
    $customerid = $_SESSION['id'];
}
    $proid = $_GET['id'];
    $proimg = $row['image'];
    $proname = $row['name'];

    if (isset($_POST['add-to-cart'])) {
        $proprice = $_POST['pro-price'];
        $proquan = $_POST['pro-quantity'];
        $que = "INSERT INTO customer_cart(customer_id,pro_id,pro_name,pro_img,pro_price,pro_quan,status) VALUES('$customerid','$proid','$proname','$proimg','$proprice','$proquan','exist')";
        if (mysqli_query($conn,$que)) {
            echo "<script>window.location.href='index.php';alert('item successfully add to your cart');</script>";
        }else{
            echo "<script>alert('item failed to add to your cart')</script>";
            // echo(mysqli_error($conn));
        }
        
    }


    if (isset($_POST['upd-my-cart'])) {
        $proprice = $_POST['pro-price'];
        $proquan = $_POST['pro-quantity'];
        $upd_qry = "UPDATE customer_cart SET pro_name='$proname',pro_img='$proimg',pro_price='$proprice',pro_quan='$proquan' WHERE customer_id = $customerid AND pro_id= $proid";
        if (mysqli_query($conn,$upd_qry)) {
            echo "<script>window.location.href='index.php';alert('item has been updated in your cart');</script>";
        }else{
            echo "<script>alert('item failed to update,impossible')</script>";
        }
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="addpro/addpro.css">
    <link rel="stylesheet" href="viewpro/viewpro.css">
    <title>Document</title>
</head>
<body>
    <div id="butt-back" onclick="window.history.back();">
        <span id="back-arrow" title="back" >&#8592;</span>
        </div>
    <?php if (isset($_SESSION['id'])) {
     if($_SESSION['identity'] === "seller"){?>
    <form method="POST" enctype="multipart/form-data" >
        <div id="product-image-con" onclick="proimg()"  title="Choose your profile picture">
			<img id="product-pic" src="<?=$row['image']?>">
        </div>
        <hr>
        <input id="choose-image" type="file" name="img" onchange="chgimg()">
        <input type="text" name="product-name" placeholder="Product name" value="<?=$row['name']?>">
        <input type="number" name="product-price" placeholder="Price(RM)" value="<?=$row['price']?>" step='0.01'>
        <input type="number" name="product-quan" placeholder="Quantity" value="<?=$row['quantity']?>" min="1" max="10000">
        <input type="submit" name="edit-product" value="edit">
    </form>

    <?php }else{?>
    <img id="pro-image" src="<?=$row['image']?>" alt="<?=$row['image']?>">
    <div id="pro-con">
        <h1 id="pro-name"><?=$row['name']?></h1>
        <div id="bott-right">
            <h2 id="pro-price">each RM<span id="get-price"><?=$row['price']?></span></h2>
        </div>
        <div id="pro-quantity-con">
                <button class="operator ope1" onclick="incquan(this)">+</button>
                <form method="POST">
                    <?php
                     $checkif = "SELECT * FROM customer_cart WHERE customer_id={$_SESSION['id']} AND pro_id={$row['ID']}";
                     $resultcheck = mysqli_query($conn, $checkif);
                     $resultcheck2 = mysqli_num_rows($resultcheck);
                     $customrow = mysqli_fetch_array($resultcheck);
                     if($resultcheck2 == 1) {?>
                        <input class='operator' onkeyup='valquan(this)' id='pro-quantity' min='1' name='pro-quantity' value='<?=$customrow['pro_quan']?>' type='number'>
                        <button id='pro-butt' type='submit' name='upd-my-cart'>Update my cart</button>
                        <input type='number' name="pro-price" id="total-price" step='0.01' value="<?=$customrow['pro_price']?>" readonly>
                    <?php }else{?>
                        <input class='operator ' onkeyup='valquan(this)' id='pro-quantity' min='1' name='pro-quantity' value='1' type='number'>
                        <button id='pro-butt' type='submit' name='add-to-cart'>Add to cart</button>
                        <input type='number' name="pro-price" id="total-price" step='0.01' value="<?=$row['price']?>" readonly>
                    <?php }?>
                </form>
                <button class="operator ope1" onclick="decquan(this)">-</button>
        </div>
    </div>
    <?php }}else{ ?>
        <img id="pro-image" src="<?=$row['image']?>" alt="<?=$row['image']?>">
        <div id="pro-con">
        <h1 id="pro-name"><?=$row['name']?></h1><br>
        login to add to cart
        <div id="bott-right">
            <h2 id="pro-price">each RM<span id="get-price"><?=$row['price']?></span></h2>
        </div>
    <?php }?>
</body>
<script src="viewpro/viewpro.js"></script>
</html>