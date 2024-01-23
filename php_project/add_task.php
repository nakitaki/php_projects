<?php
include('config/constants.php')
?>

<html>

<head>
    <title>Task Manager with PHP and MySQL</title>
    <link rel="stylesheet" href="<?php echo SITEURL; ?>css/style.css" />

</head>

<body>
    <div class="wrapper">
        <h1>TASK MANAGER</h1>

        <a class="btn-secondary" href="<?php echo SITEURL ?>">Home</a>
        <h3>Add Task Page</h3>

        <p>
            <?php
            if (isset($_SESSION['add_fail'])) {
            ?>
        <h4 class="red"><?php echo $_SESSION['add_fail'] ?></h4>
    <?php
                unset($_SESSION['add_fail']);
            }


    ?>
    </p>
    <form method="POST" action="">
        <table class="tbl-half">
            <tr>
                <td>Task Name: </td>
                <td><input type="text" name="task_name" placeholder="Type your Task Name" required="required"></td>
            </tr>
            <tr>
                <td>Task Description: </td>
                <td><textarea name="task_description"placeholder="Type Task Description"></textarea></td>
            </tr>
            <tr>
                <td>Select List: </td>
                <td>
                    <select name="list_id">

                        <?php
                        $con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS) or die(mysqli_error($con));
                        $bd_select = mysqli_select_db($con, DB_NAME) or die(mysqli_error($con));

                        $sql = "SELECT * FROM lists";
                        $res = mysqli_query($con, $sql);

                        if ($res == true) {
                            $count_rows = mysqli_num_rows($res);

                            if ($count > 0) {
                            } else {
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $list_id = $row['list_id'];
                                    $list_name = $row['list_name'];
                        ?>
                                    <option value="<?php echo $list_id; ?>"><?php echo $list_name; ?></option>
                            <?php
                                }
                            }
                        } else {
                            ?>
                            <option value="0">None</option>
                        <?php
                        }

                        ?>

                    </select>
                </td>
            </tr>
            <tr>
                <td>Priority: </td>
                <td>
                    <select name="priority">
                        <option value="High">High</option>
                        <option value="Medium">Medium</option>
                        <option value="Low">Low</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td>Deadline: </td>
                <td><input type="date" name="deadline"></td>
            </tr>

            <tr>
                <td><input class="btn-primary btn-lg" type="submit" name="submit" value="SAVE"></td>
            </tr>
        </table>
    </form>
    </div>
</body>

</html>

<?php
if (isset($_POST['submit'])) {
    $taks_name = stripcslashes($_POST['task_name']);
    $task_description = stripcslashes($_POST['task_description']);
    $list_id = stripcslashes($_POST['list_id']);
    $priority = stripcslashes($_POST['priority']);
    $deadline = stripcslashes($_POST['deadline']);

    
    $con2 = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME) or die(mysqli_error($con2));
    $taks_name = mysqli_real_escape_string($con2, $taks_name);
    $task_description = mysqli_real_escape_string($con2, $task_description);
    $list_id = mysqli_real_escape_string($con2, $list_id);
    $priority = mysqli_real_escape_string($con2, $priority);
    $deadline = mysqli_real_escape_string($con2, $deadline);

    echo $sql2 = "INSERT INTO tasks SET
        task_name = '$taks_name',
        task_description = '$task_description',
        list_id = '$list_id',
        priority = '$priority',
        deadline = '$deadline'";

    $res2 = mysqli_query($con2, $sql2);

    if ($res2 == true) {
        $_SESSION['add'] = "Task Added Seccessfully";
        header('location:' . SITEURL);
    } else {
        $_SESSION['add_fail'] = "Failed to Add Task";
        header('location:' . SITEURL . 'add_task.php?list_id=' . $list_id);
    }
}


?>