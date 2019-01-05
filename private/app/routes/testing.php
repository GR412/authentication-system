<?php
$nameError = " ";

if(isset($_POST['submit']))
{
    if (empty($_POST["username"])) {
        $nameError = "Name is required";
    } else {
        $name = test_input($_POST["username"]);
// check name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
            $nameError = "Only letters and white space allowed";
        }
    }
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}