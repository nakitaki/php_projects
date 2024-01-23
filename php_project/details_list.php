<?php
include('config/constants.php');

if (isset($_GET['list_id'])) {
    $list_id = $_GET['list_id'];

    $con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS) or die(mysqli_error($con));
    $bd_select = mysqli_select_db($con, DB_NAME) or die(mysqli_error($con));

    $sql = "SELECT * FROM lists WHERE list_id=$list_id";
    $res = mysqli_query($con, $sql);

    if ($res == true) {
        $row = mysqli_fetch_assoc(($res));

        $list_name = $row['list_name'];
        $list_description = $row['list_description'];
    } else {
        header('location:' . SITEURL . 'manage_list.php');
    }
}


?>


<html>

<head>
    <title>Task Manager with PHP and MySQL</title>
    <link rel="stylesheet" href="<?php echo SITEURL; ?>css/style.css" />
</head>

<body>
    <div class="wrapper">
        <h1>TASK MANAGER</h1>

        <div class="menu">

            <a class="btn-secondary" href="<?php echo SITEURL; ?>">Home</a>
            <a class="btn-secondary" href="<?php echo SITEURL; ?>manage_list.php">Manage Lists</a>

        </div>

        <h3>List details</h3>

        <p>
            <?php
            //check whether the session is created or not
            if (isset($_SESSION['update_fall'])) {
                ?>
        <h4 class="green"><?php echo $_SESSION['update_fall'] ?></h4>
    <?php

                unset($_SESSION['update_fall']);
            }
            ?>
        </p>

        <form method="POST" action="">

            <table class="tbl-half">
                <tr>
                    <td>List Name:</td>
                    <td><?php echo $list_name; ?></td>
                </tr>

                <tr>
                    <td>List Description: </td>
                    <td><?php echo $list_description; ?></td>
                </tr>

                <tr>
                    <td><a  class="btn-primary"  href="<?php echo SITEURL; ?>update_list.php?list_id=<?php echo $list_id; ?>">Update</a></td>
                    
                </tr>
            </table>
        </form>
    </div>
</body>

</html>

