<?php

include('config/constants.php');

if (isset($_GET['list_id'])) {

    $list_id = $_GET['list_id'];

    $con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS) or die(mysqli_error($con));
    $bd_select = mysqli_select_db($con, DB_NAME) or die(mysqli_error($con));

    echo $sql = "DELETE FROM lists WHERE list_id=$list_id";

    $res = mysqli_query($con, $sql);

    if($res==true){
        $_SESSION['delete'] = 'List Deleted Successfully';
        header('location:' . SITEURL . 'manage_list.php');
    }
    else{
        $_SESSION['delete_fail'] = 'Failed to Delete List';
        header('location:' . SITEURL . 'manage_list.php');
    }
    
} else {
    header('location:' . SITEURL . 'manage_list.php');
 
}
