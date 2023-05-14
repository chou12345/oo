<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
//$general_id=$_SESSION['general_id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>輔來輔厲害</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

    <!--aos animation-->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row align-items-center py-3 px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a href="manager_index.php" class="text-decoration-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold px-3 mr-1">輔來輔厲害</span></h1>
                </a>
            </div>
            <div class="col-lg-6 col-6 text-left" style="opacity:0;">
                <form action="">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="搜尋文章">
                        <div class="input-group-append">
                            <span class="input-group-text bg-transparent text-primary">
                                <i class="fa fa-search"></i>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-3 col-6 text-right">
                <a href="wallet.php" class="btn border">
                    <i class="fas fa-piggy-bank text-primary"></i>
                    <span class="badge">錢包</span>
                </a>
                <a href="#" class="btn border"data-toggle="dropdown">
                    <i class="fas fa-user text-primary"></i>
                    <span class="badge" margin="3px">管理者</span>
                    <i class="fas fa-caret-down text-primary"></i>
                    <div class="dropdown-menu position-absolute bg-secondary">
                        <a href="manager_index.php" class="dropdown-item">管理員首頁</a>
                        <a href="manager_contract_list.php" class="dropdown-item">我的合約</a>
                        <a href="manager_contract_sign.php" class="dropdown-item">新增合約</a>
                        <a href="log_out.php" class="dropdown-item">登出</a>
                        </div>
                </a>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid mb-5">
        <div class="row border-top px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
                    <h6 class="m-0">管理者管理</h6>

                </a>

               <nav class="collapse show navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0" id="navbar-vertical">
                    <div class="navbar-nav w-100 overflow-hidden" style="height: 410px">
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link" data-toggle="dropdown">審核<i class="fa fa-angle-down float-right mt-1"></i></a>
                            <div class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0">
                                <a href="report_post_view.php" class="dropdown-item">審核貼文</a>
                                <a href="report_reply_view.php" class="dropdown-item">審核留言</a>
                            </div>
                        </div>
                         <nav class="collapse show navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0" id="navbar-vertical">
                    <div class="navbar-nav w-100 overflow-hidden" style="height: 410px">
                            <div class="nav-item dropdown">
                             <a href="#" class="nav-link" data-toggle="dropdown">平台內容管理<i class="fa fa-angle-down float-right mt-1"></i></a>
                            <div class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0">
                                <a href="article_category.php" class="dropdown-item">文章類別</a>
                                <a href="article_view.php" class="dropdown-item">文章內容</a>
                            </div>
                        </div>
                    </div>
                </nav>
                    </div>
                </nav>
            </div>

            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1"></span></h1>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <h2 align="center" style="margin-top: 10px;">審核貼文</h2>
                        </div>
                       
                            <!-- <div class="navbar-nav ml-auto py-0">
                            <a href="" class="nav-item nav-link">登入</a>
                            <a href="" class="nav-item nav-link">註冊</a>
                        </div> -->

                    </div>
                </nav>
        

            
                <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                    <a href="manager_index.php" class="text-decoration-none d-block d-lg-none">
                        <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">輔來輔厲害</span></h1>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
    <div class="navbar-nav mr-auto py-0">
    
    
    <div class="navbar-nav mr-auto py-0">
    <a href="report_post_view.php" class="nav-item nav-link active">審核貼文</a>
    </div>


<!--
                        <div class="navbar-nav ml-auto py-0">
                            <a href="" class="nav-item nav-link"><i class="fas fa-pen text-primary">修改資料</i>
                            </a>
-->
<!--                            <a href="" class="nav-item nav-link"></a>-->
                        </div>

                    </div>
                </nav>
<form action="report_post_dblink.php" method="post">
<input type=hidden name="method" value="query"> 
<div id="header-carousel" class="carousel slide" data-ride="carousel">
<table class="table table-bordered table-hover" width="1000px" height="250px" style="text-align: center">
<thead bgcolor="#ACD6FF">
            <tr>
                <th scope="col" width="150px" vertical-align:middle>發文者ID</th>
                <!-- <th scope="col" width="150px" vertical-align:middle>檢舉者ID</th> -->
                 <th scope="col" width="150px" vertical-align:middle>原因</th>
                <th scope="col" width="150px" vertical-align:middle>主題</th>
                <th scope="col" width="150px" vertical-align:middle>內容</th>
                <th scope="col" width="150px" vertical-align:middle>審核</th>
                
<!--                <th scope="col" width="150px" vertical-align:middle>T/F</th>-->
    </tr>
  </thead>
            <tbody>
              <?php
                        $link=mysqli_connect("localhost","root","12345678","system");
                        //$link=mysqli_connect("localhost","root");
                              //mysqli_select_db($link, "system");
                         date_default_timezone_set('Asia/Taipei');
                        $deal_time = date('Y/m/d H:i:s');
                        $sql3="select * from report join post on post.post_id = report.report_post
                              join general_user on general_user.general_id = post.general_id 
                              join dictionary on dictionary.dictionary_id = report.report_category
                              WHERE report.status <> '已駁回' AND report.status <> '已刪除'
                              ";
                        $rs=mysqli_query($link,$sql3);
                        while($record=mysqli_fetch_assoc($rs))
	  {
//                                         $record['report_object']
                            echo"<tr><td>".$record['number']."</th>
                                     <td>".$record['reason']."</th>
                                     <td>".$record['title']."</td>
                                     <td>".$record['context']."</td>
                                     <td>
                <form method='post'>
            <input type='hidden' name='report_id' value='".$record['report_id']."'>
                    <button type='submit' name='cancel' value='".$record['report_id']."'class='btn btn' style='background-color: #acd6ff;'><b>駁回</b></button><br><br>
            <input type='hidden' name='report_post' value='".$record['report_post']."'>
            <input type='hidden' name='post_id' value='".$record['post_id']."'> 
                    <button type='submit' name='delete' value='".$record['post_id']."'class='btn btn' style='background-color: #ffd2d2;'><b>刪除</b></button></td></tr>";
                                     
                                     
                                     
//                                     <a href='report_post_update.php?method=delete1 class='fas fa-pen text-primary'>駁回</a><br><br>
//                                     <a href='report_post_dblink.php? method=delete&report_id=$record[0]class='fas fa-pen text-primary'>刪除</a></td>"; 
                        }
                ?>
            
            
  </tbody>
                </table>


                    </div>

                    </form>
                </div>

                    
                </div>
      
    </div>
    <!-- Navbar End -->


    <!-- Featured Start -->

    <div class="container-fluid pt-5">
    </div>

    <!-- Featured End -->


    <!-- Categories Start -->

    <div class="container-fluid pt-5">
    </div>

    <!-- Categories End -->


    <!-- Offer Start -->

    <div class="container-fluid offer pt-5">
       
    </div>

   
  


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>