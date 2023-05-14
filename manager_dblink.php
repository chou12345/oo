<?php
$method=$_POST["method"];
$manager_id=$_POST["manager_id"];
$name=$_POST["name"];
$phone=$_POST["phone"];
$bank_account=$_POST["bank_account"];
$email=$_POST["email"];
$public_key=$_POST["public_key"];

$link=mysqli_connect("localhost","root","12345678","system");
//$link=mysqli_connect("localhost","root");
  //    mysqli_select_db($link, "system");

if ($_SESSION['identity'] ==""){
    if($method=="update"){
 $sql="update manager set name = '$name', email = '$email',phone = '$phone',bank_account = '$bank_account', public_key = '$public_key' where manager_id = '$manager_id'";
    if(mysqli_query($link,$sql))
    {
        
        header('location:manager_index.php');

    }

}
}
?>