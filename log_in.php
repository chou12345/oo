<?php
session_start();

if (isset($_POST['account'])) {
	$account = $_POST['account'];
	$password = $_POST['password'];

	$link = mysqli_connect("localhost", "root", "12345678", "system");
	$sql = "select * from account where account = '$account' and password = '$password'";
	$rs = mysqli_query($link, $sql);
	if ($record = mysqli_fetch_assoc($rs)) {
		$account_id = $record['account_id'];
		$identity = $record['identity'];
		if ($identity == "商家") {
			$sql_check = "select * from merchant where account_id = '$account_id'";
			$rs_check = mysqli_query($link, $sql_check);
			if ($record_check = mysqli_fetch_assoc($rs_check)) {
				$_SESSION['merchant_id'] = $record_check['merchant_id'];
				$_SESSION['identity'] = 'merchant';
				header('location:merchant_index.php');
			}

		} else if ($identity == "管理者") {
			$sql_check = "select * from manager where account_id = '$account_id'";
			$rs_check = mysqli_query($link, $sql_check);
			if ($record_check = mysqli_fetch_assoc($rs_check)) {
				$_SESSION['manager_id'] = $record_check['manager_id'];
				$_SESSION['identity'] = 'manager';
				header('location:manager_index.php');
			}
		} else {
			$sql_check = "select * from general_user where account_id = '$account_id'";
			$rs_check = mysqli_query($link, $sql_check);
			if ($record_check = mysqli_fetch_assoc($rs_check)) {
				$_SESSION['general_id'] = $record_check['general_id'];
				$_SESSION['identity'] = 'general';
				header('location:index.php');
			}

		}
		if (isset($record_check)) {
			$_SESSION['user_info'] = $record;
			$_SESSION['user_check_info'] = $record_check;
		}
	} else {
		$sql1 = "select * from account where account = '$account'";
		$rs1 = mysqli_query($link, $sql1);
		if ($record1 = mysqli_fetch_assoc($rs1)) { ?>
			<script> alert("密碼錯誤"); </script>
		<?php } else { ?>
			<script> alert("帳號不存在"); </script>
		<?php }
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords"
		content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/pages-sign-in.html" />

	<title>輔來輔厲害</title>

	<link href="css/style.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body style="background-color:#cbdef6;">
	<main class="d-flex w-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="text-center mt-4">
							<h1 class="h2">輔來輔厲害</h1>
							<br>
						</div>

						<div class="card">
							<div class="card-body">
								<div class="m-sm-4">
									<div class="text-center">
										<h3>登入</h3>
									</div>
									<br>
									<form method="post">
										<div class="mb-3">
											<label class="form-label">帳號 (一般使用者請以LDAP帳號登入)</label>
											<input class="form-control form-control-lg" type="account" name="account">
										</div>
										<div class="mb-3">
											<label class="form-label">密碼</label>
											<input class="form-control form-control-lg" type="password" name="password">
											<a style="margin-top: 15px; color:#46A3FF;"
												href="https://whoami.fju.edu.tw/pw_forget.php">忘記密碼？</a>

										</div>

										<div class="text-center mt-3">
											<a href="sign_up_role.php"><input type="button" class="btn border"
													style="background-color:#46A3FF; color: black; border-radius: 7%;"
													value="註冊"><b></b></a>
											<input type=submit class="btn border"
												style="background-color:#46A3FF; color: black; border-radius: 7%;"
												value="登入"><b></b>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>

	<script src="js/app.js"></script>

</body>

</html>