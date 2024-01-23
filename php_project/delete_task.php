<?PHP
include('config/constants.php');

//check task_id in url
if (isset($_GET['task_id'])) {
    $task_id = stripcslashes($_GET['task_id']);

    $con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME) or die(mysqli_error($con));
    $task_id = mysqli_real_escape_string($con, $task_id);
    
    $sql = "DELETE FROM tasks WHERE task_id=$task_id";

    $res = mysqli_query($con, $sql);

    if ($res == true) {
        $_SESSION['delete'] = "Task Deleted Successfully.";
        header('location:' . SITEURL);
    } else {
        $_SESSION['delete_fail'] = "Failed to Delete Task.";
        header('location:' . SITEURL);
    }
} else {
    header('location:' . SITEURL);
}
