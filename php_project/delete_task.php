<?PHP
include('config/constants.php');

//check task_id in url
if (isset($_GET['task_id'])) {
    $task_id = $_GET['task_id'];

    $con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS) or die(mysqli_error($con));
    $bd_select = mysqli_select_db($con, DB_NAME) or die(mysqli_error($con));

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
