<?php
function select($arg1,$arg2){
    if (!empty($arg1) && !empty($arg2)) {
        $que = "select * from user where username='.$arg1.' and password='.$arg2.'";
        $result = mysqli_query($conn,$que);
        $rows = mysqli_num_rows($result);
        if ($rows==1) {
            $_SESSION['username'] = $arg1;
            $_SESSION['password'] = $arg2;
        }
    }else{
        echo "<script>Please insert username or password!</script>";
    }
}