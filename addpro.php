<?php include("header.php");

    if (isset($_POST['add-product'])) {
        // $proimage = $_FILES['product-img'];
        $sellerid = $_SESSION['id'];
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

           
            $que ="insert into product(seller_id,image,name,price,quantity) values('$sellerid','$file','$proname','$proprice','$proquan')";
                if($result = mysqli_query($conn,$que)){
                    echo "<script>window.location.href='index.php';alert('Product added!');</script>";
                }else{
                    echo "<script>window.location.href='add.php';alert('Failed add');</script>";
                }
        }else{
            echo "<script>alert('please choose an image for your product!')</script>";
        }
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="addpro/addpro.css">
    <title>Document</title>
</head>
<body>
    <form id="addpro-form" method="POST" enctype="multipart/form-data">
        <div id="product-image-con"  title="Choose your product picture">
			<img id="product-pic" src="backimg/addproduct.jpg">
        </div>
        <hr>
        <input id="choose-image" type="file" name="img">
        <input type="text" name="product-name" placeholder="Product name">
        <input type="text" name="product-price" placeholder="Price(RM)" step='0.01'>
        <input type="number" name="product-quan" placeholder="Quantity" min="1" max='1000'>
        <input type="submit" name="add-product" value="Add">
    </form>
</body>
<script src="addpro/addpro.js"></script>
</html>