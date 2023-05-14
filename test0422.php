<?php
$connection = mysqli_connect("localhost", "root", 12345678, 'system');
$sql = "select * from account;";
$rs = mysqli_query($connection, $sql);
echo var_dump($rs)
?>


<!DOCTYPE html>
<html lang="en">

<head>

</head>

<body>
    Hi,
    <?php echo $rs->fetch_object()->account ?>
    <?php echo $rs->fetch_object()->account ?>
, Goodbye
</body>