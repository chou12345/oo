<?php
    $method = "insert";
    $subject = "";
    $name = "";
    $nickname = "";
    $phone = "";
    $email = "";
    $gender = "";
    $number = "";
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

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
				<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100" >
					<div class="d-table-cell align-middle">

						<div class="text-center mt-4">
							<h1 class="h2">輔來輔厲害</h1>
							<br>
						</div>

						<div class="card" >
							<div class="card-body">
								<div class="m-sm-4">
									<div class="text-center">
										<h3>建立個人資料</h3>
									</div>
									<br>
									<form method="POST" action = "sign_up_dblink.php">
                                        <div class="mb-3">
											<label class="form-label">姓名</label>
                                            <input class="form-control form-control-lg" type=text name="name" value="<?php echo $name ?>">
										</div>
										<div class="mb-3">
											<label class="form-label">學系</label>
											<input class="form-control form-control-lg" type=text name="subject" value="<?php echo $subject ?>">
										</div>
                                        <div class="mb-3">
											<label class="form-label">暱稱</label>
											<input class="form-control form-control-lg" type=text name="nickname" value="<?php echo $nickname ?>">
										</div>
										<div class="mb-3">
											<label class="form-label">聯絡電話</label>
											<input class="form-control form-control-lg" type=text name="phone" value="<?php echo $phone ?>">
										</div>
                                        <div class="mb-3">
											<label class="form-label">信箱</label>
											<input class="form-control form-control-lg" type=text name="email" value="<?php echo $email ?>">
										</div>
                                        <div class="mb-3">
											<label class="form-label">性別</label>
											<input class="form-control form-control-lg" type=text name="gender" value="<?php echo $gender ?>" placeholder = "請輸入男性或是女性">
										</div>
                                        <div class="mb-3">
											<label class="form-label">學號/教師編號</label>
											<input class="form-control form-control-lg" type=text name="number" value="<?php echo $number ?>">
										</div>
                                        <div class="mb-3">
											<label class="form-label">登入帳號 (請輸入LDAP帳號與密碼)</label>
											<input class="form-control form-control-lg" type=text name="account" value="<?php echo $account ?>">
										</div>
                                        <div class="mb-3">
											<label class="form-label">登入密碼 (請輸入LDAP密碼)</label>
											<input class="form-control form-control-lg" type=password name="password" value="<?php echo $password ?>">
										</div>
										<div class="text-center mt-3">
											<input type=submit class="btn border" style="background-color: 	#46A3FF; color: black; border-radius: 7%;" value="註冊"><b></b>
										</div>
										<br>
										<br>

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