
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
date_default_timezone_set('Asia/Taipei');
session_start();
$method = isset($_POST["method"]) ? $_POST["method"] : "";
$deal_time = date('Y/m/d H:i:s');

if ($_SESSION['identity'] == "manager") {
if (isset($_POST['cancel'])) {
    $report_id = $_POST['report_id'];
    $link=mysqli_connect("localhost","root","12345678","system");
    //$link = mysqli_connect("localhost", "root");
    //mysqli_select_db($link, "system");

    $sql = "UPDATE report
            SET status = '已駁回',deal_time='$deal_time'
            WHERE report_id = '$report_id'";
    echo $sql;
    if (mysqli_query($link, $sql)) {
        header('location:report_reply_view.php?method=query');
    } else {
        echo "更新資料庫時發生錯誤: " . mysqli_error($link);
    }
} elseif (isset($_POST['delete'])) {
    $reply_id = $_POST['reply_id'];
    $report_reply = $_POST['report_reply'];
    $link=mysqli_connect("localhost","root","12345678","system");
    //$link = mysqli_connect("localhost", "root");
    //mysqli_select_db($link, "system");
    $sql1 = "UPDATE reply SET context = '此留言已被刪除' WHERE reply_id = '$reply_id'";
    $sql2 = "UPDATE report SET status = '已刪除' ,deal_time='$deal_time' WHERE report_reply = '$report_reply'";
    if (mysqli_query($link, $sql1) && mysqli_query($link, $sql2)) {
        header('location:report_reply_view.php?method=query');
    } else {
        echo "更新資料表時發生錯誤: " . mysqli_error($link);
    }
}
//}
?>


