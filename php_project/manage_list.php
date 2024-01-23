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

        <a class="btn-secondary" href="<?php echo SITEURL; ?>">Home</a>


        <h3>Manage Lists Page</h3>

        <p>
            <?php
            //check whether the session is created or not
            if (isset($_SESSION['add'])) {
                //display session message
                ?>
        <h4 class="green"><?php echo $_SESSION['add'] ?></h4>
    <?php

                //remove the message after displaying once
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
        <!--Table to display list-->
        <div class="all lists">
            <a class="btn-primary" href="<?php echo SITEURL; ?>add_list.php">Add List</a>
            <table class="tbl-half">
                <tr>
                    <th>S.N.</th>
                    <th>List Name</th>
                    <th>Actions</th>
                </tr>

                <?php
                $con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS) or die(mysqli_error($con));
                $bd_select = mysqli_select_db($con, DB_NAME) or die(mysqli_error($con));


                //sql query to insert data to database
                $sql = "SELECT * FROM lists";

                $res = mysqli_query($con, $sql);

                //check if executed
                if ($res == true) {
                    $count_rows = mysqli_num_rows($res);

                    //create serial number variabe
                    $sn = 1;

                    //check wheter there is data in datadase or not
                    if ($count_rows > 0) {
                        while ($row = mysqli_fetch_assoc($res)) {
                            // getting the data from database
                            $list_id = $row['list_id'];
                            $list_name = $row['list_name'];
                ?>

                            <tr>
                                <td><?php echo $sn++ ?></td>
                                <td><?php echo $list_name ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>update_list.php?list_id=<?php echo $list_id; ?>">Update</a>
                                    <a href="#" onclick="confirmDelete(<?php echo $list_id; ?>)">Delete</a>
                                    <a href="<?php echo SITEURL; ?>details_list.php?list_id=<?php echo $list_id; ?>">Details</a>
                                </td>
                            </tr>
                        <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td class="nothing" colspan="3">No List Added Yet</td>
                        </tr>
                <?php
                    }
                }

                ?>

            </table>
        </div>
    </div>
    <script>
        function confirmDelete(listId) {
            var confirmation = confirm('Are you sure you want to delete?');

            if (confirmation) {
                window.location.href = '<?php echo SITEURL; ?>delete_list.php?list_id=' + listId;
            }
        }
    </script>
</body>

</html>