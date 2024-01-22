<?php
include('config/constants.php');
?>
<html>

<head>
    <title> Manager with PHP and MySQL</title>
</head>

<body>
    <h1>TASK MANAGER</h1>

    <a href="<?php echo SITEURL; ?>">Home</a>

    <a href="<?php echo SITEURL; ?>manage_list.php">Manage Lists</a>

    <h3>Add List Page</h3>

    <p>
        <?php
        //check whether the session is created or not
        if (isset($_SESSION['add_fail'])) {
            //display session message
            echo $_SESSION['add_fail'];

            //remove the message after displaying once
            unset($_SESSION['add_fail']);
        }
        ?>
    </p>
    <!-- Add list-->
    <form method="POST" action="">

        <table>
            <tr>
                <td>List name</td>
                <td><input type="text" name="list_name" placeholder="Type list name here" required="required" /></td>
            </tr>
            <tr>
                <td>List Description: </td>
                <td><textarea name="list_description" placeholder="Type list description here"></textarea></td>
            </tr>

            <tr>
                <td><input type="submit" name="submit" value="SAVE"></td>
            </tr>
        </table>
    </form>
</body>

</html>

<?php

//Check whether the form is submitted or not
if (isset($_POST['submit'])) {
    //Get the values from form and save it in variables
    $list_name = $_POST['list_name'];
    $list_description = $_POST['list_description'];

    //connect database
    $con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
    if (!$con) {
        die('Connection failed: ' . mysqli_connect_error());
    }

    $db_select = mysqli_select_db($con, DB_NAME);
    if (!$db_select) {
        die('Database selection failed: ' . mysqli_error($conn));
    }

    //sql query to insert data to database
    $sql = "INSERT INTO lists SET
    list_name = '$list_name',
    list_description = '$list_description'
    ";

    //execute query and insert to database
    $res = mysqli_query($con, $sql);

    //check if query excecuted seccessfully or not
    if ($res == true) {
        //create a session variable to display message
        $_SESSION['add'] = "List Added Successfully!";

        //redirect to manage list page
        header('location:' . SITEURL . 'manage_list.php');
    } else {

        //create session to send message
        $_SESSION['add_fail'] = "Failed to add list!";

        // redirect  to the same page
        header('location:' . SITEURL . 'add_list.php');
    }
}
?>