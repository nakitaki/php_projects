<?php
include('config/constants.php')
?>

<html>

<head>
    <title>Task Manager With PHP nd MySQL</title>
    <link rel="stylesheet" href="<?php echo SITEURL; ?>css/style.css" />
</head>

<body>
    <div class="wrapper">
        <h1>TASK MANAGER</h1>

        <!--Menu-->

        <div class="menu">
            <a href="<?php echo SITEURL; ?>">Home</a>

            <?php
            $con2 = mysqli_connect(DB_SERVER, DB_USER, DB_PASS) or die(mysqli_error($con2));
            $bd_select2 = mysqli_select_db($con2, DB_NAME) or die(mysqli_error($con2));

            $sql2 = "SELECT * FROM lists";

            $res2 = mysqli_query($con2, $sql2);

            if ($res2 == true) {
                while ($row = mysqli_fetch_assoc($res2)) {
                    $list_id = $row['list_id'];
                    $list_name = $row['list_name'];

            ?>

                    <a href="<?php echo SITEURL; ?>list_task.php?list_id=<?php echo $list_id; ?>"><?php echo $list_name; ?></a>

            <?php
                }
            }
            ?>


            <a href="<?php echo SITEURL; ?>manage_list.php">Manage Lists</a>
        </div>

        <p>
            <?php
            if (isset($_SESSION['add'])) {
            ?>
        <h4 class="green"><?php echo $_SESSION['add'] ?></h4>
    <?php
                unset($_SESSION['add']);
            }

            if (isset($_SESSION['delete'])) {
    ?>
        <h4 class="orange"><?php echo $_SESSION['delete'] ?></h4>
    <?php
                unset($_SESSION['delete']);
            }

            if (isset($_SESSION['update'])) {
    ?>
        <h4 class="green"><?php echo $_SESSION['update'] ?></h4>
    <?php
                unset($_SESSION['update']);
            }

            if (isset($_SESSION['delete_fail'])) {
    ?>
        <h4 class="red"><?php echo $_SESSION['delete_fail'] ?></h4>
    <?php
                unset($_SESSION['delete_fail']);
            }

    ?>
    </p>
    <!--Tasks-->
    <div class="all-tasks">
        <a class="btn-primary" href="<?php echo SITEURL; ?>add_task.php">Add task</a>
        <table class="tbl-full">
            <tr>
                <th>S.N.</th> <!--serial number-->
                <th>Task Name</th>
                <th>Priority</th>
                <th>Deadline</th>
                <th>Actions</th>

            </tr>

            <?php
            $con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS) or die(mysqli_error($con));
            $bd_select = mysqli_select_db($con, DB_NAME) or die(mysqli_error($con));

            $sql = "SELECT * FROM tasks";

            $res = mysqli_query($con, $sql);

            if ($res == true) {
                $count_rows = mysqli_num_rows($res);

                $sn = 1;
                if ($count_rows > 0) {


                    while ($row = mysqli_fetch_assoc($res)) {
                        $task_id = $row['task_id'];
                        $task_name = $row['task_name'];
                        $priority = $row['priority'];
                        $deadline = $row['deadline'];

            ?>
                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $task_name; ?></td>
                            <td><?php echo $priority; ?></td>
                            <td><?php
                                if ($deadline != '0000-00-00') {
                                    echo $deadline;
                                } else {
                                    echo 'No deadline set';
                                }
                                ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>update_task.php?task_id=<?php echo $task_id; ?>">Update</a>
                                <a href="#" onclick="confirmDelete(<?php echo $task_id; ?>)">Delete</a>
                                <a href="<?php echo SITEURL; ?>details_task.php?task_id=<?php echo $task_id; ?>">Details</a>
                            </td>
                        </tr>
                    <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td class="nothing" colspan="5">No Task Added Yet</td>
                    </tr>
            <?php
                }
            }



            ?>

        </table>

    </div>
    </div>

    <script>
        function confirmDelete(taskId) {
            var confirmation = confirm('Are you sure you want to delete?');

            if (confirmation) {
                window.location.href = '<?php echo SITEURL; ?>delete_task.php?task_id=' + taskId;
            }
        }
    </script>
</body>

</html>