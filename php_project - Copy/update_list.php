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

        <h3>Update List Page</h3>

        <p>
            <?php
            //check whether the session is created or not
            if (isset($_SESSION['update_fall'])) {
                echo $_SESSION['update_fall'];

                unset($_SESSION['update_fall']);
            }
            ?>
        </p>

        <form method="POST" action="">

            <table class="tbl-half">
                <tr>
                    <td>List Name:</td>
                    <td><input type="text" name="list_name" value="<?php echo $list_name; ?>" required="required"></td>
                </tr>

                <tr>
                    <td>List Description: </td>
                    <td>
                        <textarea name="list_description">
                        <?php echo $list_description; ?>
                    </textarea>
                    </td>
                </tr>

                <tr>
                    <td><input class="btn-primary" type="submit" name="submit" value="UPDATE"></td>
                </tr>
            </table>
        </form>
    </div>
</body>

</html>


<?php
if (isset($_POST['submit'])) {
    $list_name = $_POST['list_name'];
    $list_description = $_POST['list_description'];

    $con2 = mysqli_connect(DB_SERVER, DB_USER, DB_PASS) or die(mysqli_error($con2));
    $bd_select2 = mysqli_select_db($con2, DB_NAME) or die(mysqli_error($con2));


    $sql2 = "UPDATE lists SET
        list_name = '$list_name',
        list_description = '$list_description'
        WHERE list_id = $list_id";

    $res2 = mysqli_query($con2, $sql2);

    if ($res2 == true) {
        $_SESSION['update'] = "List Updated Seccessfully";
        header('location:' . SITEURL . 'manage_list.php');
    } else {
        $_SESSION['update_fail'] = "Failed to Update List";
        header('location:' . SITEURL . 'update_list.php?list_id=' . $list_id);
    }
}
?>