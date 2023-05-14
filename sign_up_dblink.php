<?php
    session_start();
    // $method = $_POST["method"];
    $merchant_id = $_POST["merchant_id"];
    $name = $_POST["name"];
    $category = $_POST["category"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $account = $_POST["account"];
    $password = $_POST["password"];
    $subject = $_POST["subject"];
    $gender = $_POST["gender"];
    $number = $_POST["number"];
    $nickname = $_POST["nickname"];
    $identity = $_POST["identity"];
    if (strlen($number) == "9"){
        $identity = "學生";
    }else{
        $identity = "老師";
    }

    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    require_once 'libs/PHPMailer/src/PHPMailer.php';
    require_once 'libs/PHPMailer/src/SMTP.php';
    require_once 'libs/PHPMailer/src/Exception.php';
    
    //亂碼產生
    function generateRandomString($length) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
        }

        $public_key = generateRandomString(256);
        $private_key = generateRandomString(256); 

    // 創建 PHPMailer 對象
    $mail = new PHPMailer\PHPMailer\PHPMailer();


    $link=mysqli_connect("localhost","root","12345678", "system");
    $sql_a="SELECT * FROM account";
    $result=mysqli_query($link,$sql_a);
    $id_a = mysqli_num_rows($result);
    $account_id= $id_a + 1;
    $sql_ai="insert into account (account_id, account, password, identity) values ('$account_id','$account','$password','$identity')";
    if(mysqli_query($link,$sql_ai)){
        if($identity == "商家"){
            $sql_mi="insert into merchant (merchant_id, account_id, name, category, phone, email, bank_account, balance, public_key,private_key) values ('$merchant_id','$account_id','$name','$category','$phone','$email', null,'0','$public_key','$private_key')";

            if(mysqli_query($link,$sql_mi)){
                $_SESSION['merchant_id'] = $merchant_id;

                try {
                    // SMTP 配置
                    $mail->isSMTP();
                    $mail->Host = 'smtp.office365.com'; // 微軟 的 SMTP 服務器地址
                    $mail->SMTPAuth = true;
                    $mail->Username = '408402224@m365.fju.edu.tw'; // 您的 Gmail 信箱
                    $mail->Password = 'QAZwsx147'; // 您的 Gmail 密码
                    $mail->SMTPSecure = 'tls';
                    $mail->Port = 587;

                    // 信件内容
                    $mail->setFrom('408402224@m365.fju.edu.tw', 'manager');      //寄送人信箱
                    $user_name = mb_encode_mimeheader($name, 'UTF-8', 'B');
                    $mail->CharSet = "UTF-8";
                    $mail->Encoding = 'base64';
                    $mail->addAddress($email, $user_name);     //使用者信箱
                    $mail->Subject = mb_encode_mimeheader('註冊成功通知信', 'UTF-8', 'B');
                    $body = '感謝您註冊本系統「輔來輔厲害」，以下為您的公鑰與私鑰，麻煩您妥善保存！公鑰：'.$public_key.'私鑰：'.$private_key;
                    $mail->Body = mb_convert_encoding($body, 'UTF-8', 'auto');

                    // 發送信件
                    $mail->send(); 
                    $url="merchant_index.php";
                    echo "<script>alert('註冊成功！已寄送註冊成功信至註冊信箱，請前往註冊信箱複製加密公私鑰並妥善保管！');top.location='".$url."';</script>";die;
                    header('location:merchant_index.php'); 
                    } catch (Exception $e) {
                        echo '信件發送失敗: ', $mail->ErrorInfo;
                    }
                }
        }else{
            
            $sql_g="SELECT * FROM general_user";
            $result=mysqli_query($link,$sql_g);
            $id_g = mysqli_num_rows($result);
            $general_id= $id_g + 1;
            $sql_gi="insert into general_user (general_id, account_id, name, subject, nickname, phone, email, gender, number, bank_account, balance, public_key,private_key) values ('$general_id','$account_id','$name','$subject', '$nickname','$phone','$email', '$gender', '$number', null, '0', '$public_key','$private_key')";

            if(mysqli_query($link,$sql_gi)){
                $_SESSION['general_id'] = $general_id;

                try {
                    // SMTP 配置
                    $mail->isSMTP();
                    $mail->Host = 'smtp.office365.com'; // 微軟 的 SMTP 服務器地址
                    $mail->SMTPAuth = true;
                    $mail->Username = '408402224@m365.fju.edu.tw'; // 您的 Gmail 信箱
                    $mail->Password = 'QAZwsx147'; // 您的 Gmail 密码
                    $mail->SMTPSecure = 'tls';
                    $mail->Port = 587;

                    // 信件内容
                    $mail->setFrom('408402224@m365.fju.edu.tw', 'manager');      //寄送人信箱
                    $user_name = mb_encode_mimeheader($name, 'UTF-8', 'B');
                    $mail->CharSet = "UTF-8";
                    $mail->Encoding = 'base64';
                    $mail->addAddress($email, $user_name);     //使用者信箱
                    $mail->Subject = mb_encode_mimeheader('註冊成功通知信', 'UTF-8', 'B');
                    $body = '感謝您註冊本系統「輔來輔厲害」，以下為您的公鑰與私鑰，麻煩您妥善保存！公鑰：'.$public_key.'私鑰：'.$private_key;
                    $mail->Body = mb_convert_encoding($body, 'UTF-8', 'auto');

                    // 發送信件
                    $mail->send(); 
                    $url="index.php";
                    echo "<script>alert('註冊成功！已寄送註冊成功信至註冊信箱，請前往註冊信箱複製加密公私鑰並妥善保管！');top.location='".$url."';</script>";die;
                    } catch (Exception $e) {
                    echo '信件發送失敗: ', $mail->ErrorInfo;
                }
            }
            
        }
      }else{
        echo "error";
    }


?>