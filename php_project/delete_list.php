<?php

include('config/constants.php');

if (isset($_GET['list_id'])) {

    $list_id = stripcslashes($_GET['list_id']);

    $con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME) or die(mysqli_error($con));

    $list_id = mysqli_real_escape_string($con, $list_id);
    $sql = "DELETE FROM lists WHERE list_id=$list_id";

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
