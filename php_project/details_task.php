<?php
include('config/constants.php');

if (isset($_GET['task_id'])) {
    $task_id = stripcslashes($_GET['task_id']);

    $con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME) or die(mysqli_error($con));

    $task_id = mysqli_real_escape_string($con, $task_id);
    
    $sql = "SELECT * FROM tasks WHERE task_id=$task_id";

    $res = mysqli_query($con, $sql);

    if ($res == true) {
        $row = mysqli_fetch_assoc($res);
        $task_name = $row['task_name'];
        $task_description = $row['task_description'];
        $list_id = $row['list_id'];
        $priority = $row['priority'];
        $deadline = $row['deadline'];
    }
} else {
    header('location:' . SITEURL);
}


?>

<html>

<head>
    <title>Task MAnager With PHP and MySQL</title>
    <link rel="stylesheet" href="<?php echo SITEURL; ?>css/style.css" />

</head>

<body>
    <div class="wrapper">
        <h1>TASK MANAGER</h1>

        <p>
            <a class="btn-secondary" href="<?php echo SITEURL ?>">Home</a>
        </p>

        <h3>Task Details</h3>

        <p>
            <?php
            if (isset($_SESSION["update_fail"])) {
                ?>
        <h4 class="red"><?php echo $_SESSION['update_fail'] ?></h4>
    <?php
                unset($_SESSION['update_fail']);
            }
            ?>
        </p>

        <form method="POST" action="">

            <table class="tbl-half">
                <tr>
                    <td>Task Name:</td>
                    <td><?php echo $task_name ?></td>
                </tr>
                <tr>
                    <td>Task Description:</td>
                    <td><?php echo $task_description ?></td>
                </tr>
                <tr>
                    <td>List:</td>


                    <td>
                        <?php
                        $con2 = mysqli_connect(DB_SERVER, DB_USER, DB_PASS) or die(mysqli_error($con2));
                        $bd_select2 = mysqli_select_db($con2, DB_NAME) or die(mysqli_error($con2));

                        $sql2 = "SELECT list_name FROM lists WHERE list_id=$list_id";

                        $res2 = mysqli_query($con2, $sql2);

                        if ($res2 == true) {
                            $row = mysqli_fetch_assoc($res2);
                            $list_name = $row['list_name'];
                        }

                        echo $list_name;
                        ?>
                    </td>

                </tr>
                <tr>
                    <td>Priority: </td>
                    <td><?php echo $priority ?></td>

                </tr>
                <tr>
                    <td>Deadline:</td>
                    <td>
                        <?php
                        if ($deadline != '0000-00-00') {
                            echo $deadline;
                        } else {
                            echo 'No deadline set';
                        }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td><a class="btn-primary" href="<?php echo SITEURL; ?>update_task.php?task_id=<?php echo $task_id; ?>">Update</a></td>
                </tr>
            </table>
        </form>
    </div>
</body>

</html>