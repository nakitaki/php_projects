<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $first_name = htmlspecialchars(($_POST["firstname"]));
    $last_name = htmlspecialchars(($_POST["lastname"]));
    $favourite_pet = htmlspecialchars(($_POST["favouritepet"]));


    if (empty($first_name)) {
        header("Location: ../index.php");
        exit();
    }

    echo "These are the data, that the user submitted:";
    echo "<br>";
    echo $first_name;
    echo "<br>";
    echo $last_name;
    echo "<br>";
    echo $favourite_pet;
} else {
    header("Location: ../index.php");
}
