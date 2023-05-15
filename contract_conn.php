<?php
  require_once __DIR__ . '/helpers/helper.php';
  date_default_timezone_set('Asia/Taipei');
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
  session_start();
  $general_id=$_SESSION['general_id'];
  $method=$_POST["method"];
  echo $method;
  $user_a=$_POST["user_a"];
  $user_b=$_POST["user_b"];
  $user_c=$_POST["user_c"];
  $title=$_POST["title"];
  $context=$_POST["context"];
  $profit_a=$_POST["profit_a"];
  $profit_b=$_POST["profit_b"];
  $profit_c=$_POST["profit_c"];
  $start_time  = date('Y/m/d H:i:s');
  $contract_status=$_POST["contract_status"];
//   $status_a=$_POST["status_a"];
//   $status_b=$_POST["status_b"];
//   $status_c=$_POST["status_c"];
  $contract_check = $_POST['contract_check'];
  $private_key = $_POST['private_key'];
  $contract_id = $_POST["contract_id"];
  $manager_id = $_POST["manager_id"];
  $merchant_id = $_POST["merchant_id"];
  $profit_manager= $_POST["profit_manager"];
  $profit_merchant = $_POST["profit_merchant"];
  $contract_id_mer = $_POST["contract_id_mer"];
  $contract_id_user = $_POST["contract_id_user"];

  $conn = mysqli_connect('localhost', 'root', '12345678', 'system');
  //$conn = mysqli_connect("localhost", "root");
          //mysqli_select_db($conn, "system");

  $sqlIDtransb ="SELECT * FROM `general_user`
                JOIN account ON general_user.account_id = account.account_id
                WHERE account.account = $user_b";
  $sqlIDtransc ="SELECT * FROM `general_user`
                JOIN account ON general_user.account_id = account.account_id
                WHERE account.account = $user_c";
  $rsIDb = mysqli_query($conn, $sqlIDtransb);
  $recordIDb = mysqli_fetch_row($rsIDb);
  $rsIDc = mysqli_query($conn, $sqlIDtransc);
  $recordIDc = mysqli_fetch_row($rsIDc);

  if (!empty($conn->connect_error)) {
    die('資料庫連線錯誤:' . $conn->connect_error);
  }

  //user_insert
  if($method == "insert"){
    //echo $user_b;
    //echo $recordID[25];
    if (isset($_POST['private_key'])) {
        $private_key = $_POST['private_key'];
        $conn = mysqli_connect('localhost', 'root', '12345678', 'system');
        if (!$conn) {
            die("連線失敗：" . mysqli_connect_error());
        }
        $sql = "SELECT * FROM general_user WHERE private_key = '$private_key'";
        $rs = mysqli_query($conn, $sql);
        if ($rs && mysqli_num_rows($rs) > 0) {
            $user_a=$_POST["user_a"];
            $user_b=$_POST["user_b"];
            $user_c=$_POST["user_c"];
            $title=$_POST["title"];
            $context=$_POST["context"];
            $profit_a=$_POST["profit_a"];
            $profit_b=$_POST["profit_b"];
            $profit_c=$_POST["profit_c"];
            $start_time  = date('Y/m/d H:i:s');
            if(isset($user_a)){
              $status_a = "接受";
            }
            if(isset($user_b)){
              $status_b = "待確認";
            }
            if(isset($user_c)){
              $status_c = "待確認";
            }
            $contract_status=$_POST["contract_status"];
            $sql = "INSERT INTO `article_contract` (`contract_id`, `post_id`, `user_A`, `user_B`, `user_C`, `title`, `context`, `profit_A`, `profit_B`, `profit_C`, `start_time`, `status_a`, `status_b`, `status_c`, `contract_status`)
                                            VALUES (NULL, '1', '$user_a', '$recordIDb[0]', $recordIDc[0], '$title', '$context', '$profit_a', '$profit_b', '$profit_c', '$start_time', '$status_a', '$status_b', '$status_c', '$contract_status');";
            //echo $sql;
        if (mysqli_query($conn, $sql)) {
            //echo "okok";
                mysqli_close($conn);
                header('location: user_contract_list.php');
                exit();
            } else {
                echo "新增合約內容至資料庫失敗：" . mysqli_error($conn);
            }
        } else {
            echo "私鑰不存在於資料庫中";
        }
    } else {
        echo "未提供私鑰";
    }
}
  //check(update)
  else if($method == "check"){
    $sql = query("select * from article_contract where contract_id = $contract_id_user;")[0];

    echo $sql['user_B'];
    //判斷合約狀態
    if(!isset($sql['user_C'])){
      echo "只有兩個人";
      //2-判斷回應身分&回應結果
      if($contract_check==1){
        echo"2-hello";
          $sqlCheck = "update article_contract set status_b = '接受',
                       contract_status='已簽訂'
                       where contract_id = '$contract_id_user';";
      }elseif($contract_check==0){
        $sqlCheck = "update article_contract set status_b = '駁回',
                      contract_status='已駁回'
                        where contract_id = '$contract_id_user';";
      }
    } else {
      echo "有三個人！";
      //3-判斷回應身分&回應結果
      if($contract_check==1){
        if($general_id==$sql['user_B']){
          $sqlCheck = "update article_contract set status_b = '接受'
                        where contract_id = '$contract_id_user';";
        }else{
          $sqlCheck = "update article_contract set status_c = '接受'
                        where contract_id = '$contract_id_user';";
        }
      }elseif($contract_check==0){
        if($general_id==$sql['user_B']){
          $sqlCheck = "update article_contract set status_b = '駁回'
                        where contract_id = '$contract_id_user';";
        }else{
          $sqlCheck = "update article_contract set status_c = '駁回'
                        where contract_id = '$contract_id_user';";
        }
      }

    }
    echo $sqlCheck;
    if (mysqli_query($conn, $sqlCheck)){
      //echo "okok";
      header('location:user_contract_list.php');
    }

  }

  //商家確認合約
  //merchant_check(update)
  else if($method == "merchant_check"){
    $sql = query("select * from profit_contract where contract_id = $contract_id_mer;")[0];

      //判斷回應結果
      if($contract_check==1){
        echo"yes";
          $sqlCheck = "update profit_contract set status_merchant = '接受',
                       contract_status='已簽訂'
                       where contract_id = '$contract_id_mer';";
          echo $sqlCheck;
      }elseif($contract_check==0){
        echo 'no';
        $sqlCheck = "update profit_contract set status_merchant = '駁回',
                      contract_status='已駁回'
                        where contract_id = '$contract_id_mer';";
      }
    if (mysqli_query($conn, $sqlCheck))
    echo 'okok';
      header('location:merchant_contract_list.php');
  }
  //管理者建立合約
 else if ($method == "manager_insert") {
    //echo $method;
    if (isset($_POST['private_key'])) {
        $private_key = $_POST['private_key'];
        //$conn=mysqli_connect("localhost","root");
              //mysqli_select_db($conn, "system");
        $conn = mysqli_connect('localhost', 'root', '12345678', 'system');
        if (!$conn) {
            die("連線失敗：" . mysqli_connect_error());
        }

        $sql = "SELECT * FROM manager WHERE private_key = '$private_key'";
        $rs = mysqli_query($conn, $sql);

        if ($rs && mysqli_num_rows($rs) > 0) {
            $manager_id = $_POST['manager_id'];
            $merchant_id = $_POST['merchant_id'];
            $title = $_POST['title'];
            $context = $_POST['context'];
            $profit_manager = $_POST['profit_manager'];
            $profit_merchant = $_POST['profit_merchant'];
            $start_time  = date('Y/m/d H:i:s');
            $contract_status = $_POST['contract_status'];

            $insertSql = "INSERT INTO profit_contract (contract_id, manager_id, merchant_id, title, context, profit_manager, profit_merchant, start_time, status_manager, status_merchant, contract_status)
                          VALUES (NULL, '$manager_id', '$merchant_id', '$title', '$context', '$profit_manager', '$profit_merchant', '$start_time', '接受', '待確認', '$contract_status')";

            if (mysqli_query($conn, $insertSql)) {
                mysqli_close($conn);
                header('location: manager_contract_list.php');
                exit();
            } else {
                echo "新增合約內容至資料庫失敗：" . mysqli_error($conn);
            }
        } else {
            echo "私鑰不存在於資料庫中";
        }
    } else {
        echo "未提供私鑰";
    }
}

?>