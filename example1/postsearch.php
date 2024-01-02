<?php
$search = $_POST["searchterm"] ?? "";
//check it in inspect->network->file.php->payload 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="get" action="getsearch.php">
        <input type="text" name="searchterm" value=" <?= $search; ?>">
        <input type="submit">
    </form>
    <hr>
    <div>
        <!-- <?php
        if ($search == "recursion") {
            echo "Did you mean: <a href='getsearch.php? 
            searchterm=recursion'>recursion</a>";  //{ime na fail}?{promenlivi, s koito iskame da rabotim(promeliva=stoinost)}
        }
        ?> -->
    </div>
    Results for : <?= $search; ?>

    <br>
    <br>
    No results...
</body>

</html>