<?php
include('config/constants.php')
?>

<html>

<head>
    <title>Task Manager With PHP nd MySQL</title>
</head>

<body>
    <h1>TASK MANAGER</h1>

    <!--Menu-->

    <div class="menu">
        <a href="<?php echo SITEURL; ?>">Home</a>
        <a href="#">To Do</a>
        <a href="#">Doing</a>
        <a href="#">Done</a>


        <a href="<?php echo SITEURL; ?>manage_list.php">Manage Lists</a>
    </div>

    <p>
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        ?>
    </p>
    <!--Tasks-->
    <div class="all-tasks">
        <a href="<?php echo SITEURL; ?>add_task.php">Add task</a>
        <table>
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
                            <td><?php echo $deadline; ?></td>
                            <td>
                                <a href="#">Update</a>
                                <a href="#">Delete</a>
                            </td>
                        </tr>
                    <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="5">No Task Added Yet</td>
                    </tr>
            <?php
                }
            }



            ?>

        </table>

    </div>
</body>

</html>