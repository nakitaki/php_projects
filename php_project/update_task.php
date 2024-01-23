<?php
include('config/constants.php');

if (isset($_GET['task_id'])) {
    $task_id = $_GET['task_id'];

    $con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS) or die(mysqli_error($con));
    $bd_select = mysqli_select_db($con, DB_NAME) or die(mysqli_error($con));

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
</head>

<body>
    <h1>TASK MANAGER</h1>

    <p>
        <a href="<?php echo SITEURL ?>"></a>
    </p>

    <h3>Update Task Page</h3>

    <p>
        <?php
        if(isset($_SESSION["update_fail"])){
            echo $_SESSION['update_fail'];
            unset($_SESSION['update_fail']);
        }
        ?>
    </p>

    <form method="POST" action="">

        <table>
            <tr>
                <td>Task Name:</td>
                <td><input type="text" name="task_name" value="<?php echo $task_name ?>" required="required" /></td>
            </tr>
            <tr>
                <td>Task Description:</td>
                <td>
                    <textarea name="task_description">
                        <?php echo $task_description ?>
                    </textarea>
                </td>
            </tr>
            <tr>
                <td>Select List:</td>
                <td>
                    <select name="list_id">

                        <?php
                        $con2 = mysqli_connect(DB_SERVER, DB_USER, DB_PASS) or die(mysqli_error($con2));
                        $bd_select2 = mysqli_select_db($con2, DB_NAME) or die(mysqli_error($con2));

                        $sql2 = "SELECT * FROM lists";

                        $res2 = mysqli_query($con2, $sql2);

                        if ($res2 == true) {

                            $count_rows2 = mysqli_num_rows($res2);

                            if ($count_rows2 > 0) {

                                while ($row2 = mysqli_fetch_assoc($res2)) {
                                    $list_id_db = $row2['list_id'];
                                    $list_name = $row2['list_name'];
                        ?>
                                    <option <?php if ($list_id_db == $list_id) {
                                                echo "selected='selected'";
                                            } ?> value="<?php echo $list_id_db; ?>"><?php echo $list_name; ?></option>

                                <?php
                                }
                            } else {
                                ?>
                                <option <?php if ($list_id = 0) {
                                            echo "selected='selected'";
                                        } ?> value="0">None</option>
                        <?php
                            }
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Priority: </td>
                <td>
                    <select name="priority">
                        <option <?php if ($priority == "High") {
                                    echo "selected='selected'";
                                } ?> value="High">High</option>
                        <option <?php if ($priority == "Medium") {
                                    echo "selected='selected'";
                                } ?> value="Medium">Medium</option>
                        <option <?php if ($priority == "Low") {
                                    echo "selected='selected'";
                                } ?>value="Low">Low</option>
                    </select>
                </td>

            </tr>
            <tr>
                <td>Deadline: </td>
                <td><input type="date" name="deadline" value="<?php echo $deadline ?>" /></td>
            </tr>
            <tr>
                <td><input type="submit" name="submit" value="UPDATE" /></td>
            </tr>
        </table>
    </form>
</body>

</html>


<?php
if (isset($_POST['submit'])) {
    $task_name = $_POST['task_name'];
    $task_description = $_POST['task_description'];
    $list_id = $_POST['list_id'];
    $priority = $_POST['priority'];
    $deadline = $_POST['deadline'];

    $con3 = mysqli_connect(DB_SERVER, DB_USER, DB_PASS) or die(mysqli_error($con3));
    $bd_select3 = mysqli_select_db($con3, DB_NAME) or die(mysqli_error($con3));

    $sql3 = "UPDATE tasks SET
    task_name = '$task_name',
    task_description = '$task_description',
    list_id = '$list_id',
    priority = '$priority',
    deadline = '$deadline'
    WHERE task_id=$task_id";

    $res3 = mysqli_query($con3, $sql3);

    if ($res3 == true) {
        $_SESSION['update'] = "Task successfully updated";
        header('location:'.SITEURL);
    } else {
        $_SESSION['update_fail'] = "Failed to Update Task";
        header('location:'.SITEURL."update_task.php?task_id=".$task_id);
    }
}
?>