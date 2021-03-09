<?php include("header.php"); 

    if (isset($_GET['ID']) && isset($_GET['action']) && $_GET['action'] == 'delete') {
        $id = $_GET['ID'];
        $delqry = "DELETE FROM product WHERE ID= '$id'";
        $statusqry = "UPDATE customer_cart SET status='removed' WHERE pro_id='$id'";
        mysqli_query($conn, $statusqry);
         if ($result = mysqli_query($conn, $delqry)) {
              echo "<script>alert('product deleted');window.location.href='index.php';</script>";
        }else{
            echo "<script>alert('failed to delete');window.location.href='index.php';</script>";
        }
    }


?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="index/index.css">
    <title>Document</title>
</head>
<body>
    <div id="main">
    <?php if (isset($_SESSION['id'])) {
        if($_SESSION['identity'] === "seller") {
            $seller_qry = "SELECT * FROM product WHERE seller_id = '{$_SESSION['id']}'";
            $seller_sql = mysqli_query($conn, $seller_qry);
        ?>
    <button type="button" onclick="window.location.href='addpro.php'">Add New product</button>
    <table>
    <thead>
    <th>ID</th>
    <th>Image</th>
    <th>Name</th>
    <th>Price</th>
    <th>Quantity</th>
    <th></th>
    <th></th>
    </thead>
    <tbody>
    <?php while($row = mysqli_fetch_array($seller_sql)){?>
    <tr>
    <td><?=$row['ID']?></td>
    <td class='td-iamge'><img src="<?=$row['image'] ?>" style="width:100px; height:100px;"></td>
    <td><?=$row['name']?></td>
    <td>RM <?=$row['price']?></td>
    <td><?=$row['quantity']?></td>
    <td><input type="button" onclick="window.location.href='viewpro.php?id=<?=$row['ID']?>'" value="edit"></td>
    <td><a href="index.php?ID=<?=$row['ID']?>&action=delete" onclick="return confirm('Are you sure you want to Delete?');">
        <button type="button">Delete</button></a></td>
    </tr>
    <?php }?>
    </tbody>
    </table>

    <?php }else{
        $qry = "SELECT * FROM product";
        $sql = mysqli_query($conn, $qry);
        while($row = mysqli_fetch_array($sql)){
        $getcart = "SELECT pro_quan FROM customer_cart WHERE customer_id='{$_SESSION['id']}' AND pro_id='{$row['ID']}'";
        $cartresult = mysqli_query($conn, $getcart);
        $fetchcart = mysqli_fetch_array($cartresult);

        if (mysqli_num_rows($cartresult) == 1) {?>
            <div id="itembox-2" onclick="window.location.href='viewpro.php?id=<?=$row['ID']?>'">
            <div id="itembox-hover"><h4>Edit product</h4></div>
            <img id="itembox-pic" src="<?=$row['image']?>" alt="">
            <hr>
            <p id="itembox-name"><?=$row['name']?></p>
            <h4 id='itemmbox-price-tag'>RM <?=$row['price']?></h4>
            </div>
            
        <?php }else { ?>
            <div id="itembox" onclick="window.location.href='viewpro.php?id=<?=$row['ID']?>'">
            <div id="itembox-hover"><h4>View product</h4></div>
            <img id="itembox-pic" src="<?=$row['image']?>" alt="">
            <hr>
            <p id="itembox-name"><?=$row['name']?></p>
            <h4 id='itemmbox-price-tag'>RM <?=$row['price']?></h4>
            </div>

        <?php }}} }else{?>
            <?php while($row = mysqli_fetch_array($sql)){?>
                <div id="itembox" onclick="window.location.href='viewpro.php?id=<?=$row['ID']?>'">
                <div id="itembox-hover"><h4>View product</h4></div>
                <img id="itembox-pic" src="<?=$row['image']?>" alt="">
                <hr>
                <p id="itembox-name"><?=$row['name']?></p>
                <h4 id='itemmbox-price-tag'>RM <?=$row['price']?></h4>
                </div>
        <?php   }}?>
    </div>
</body>
</html>