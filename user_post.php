<?php
    session_start();
    $general_id = $_SESSION['general_id'];
    require_once __DIR__ . '/helpers/helper.php';

    $posts = query("SELECT post.*, dictionary.dictionary_name as category_name, general_user.nickname as general_user_name, (SELECT COUNT(*) FROM heart WHERE heart.post_id = post.post_id ) as heart, (SELECT COUNT(*) FROM reply WHERE reply.post_id = post.post_id ) as replyCount, (SELECT COUNT(*) FROM collection WHERE collection.post = post.post_id ) as collectionCount FROM post inner join dictionary on dictionary.dictionary_id = post.category_id and post.submit_time is not null inner join general_user on general_user.general_id = post.general_id WHERE general_user.general_id = '$general_id'");
    $categories = query("SELECT * FROM dictionary WHERE dictionary_kind = '文章'");
    $merchants = query("SELECT * FROM merchant");
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
                <a href="index.php" class="text-decoration-none">
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
                <a href="user_post_new.php" class="btn border">
                    <i class="fas fa-pen-nib text-primary"></i>
                    <span class="badge">發文</span>
                </a>
                <a href="wallet.php" class="btn border">
                    <i class="fas fa-piggy-bank text-primary"></i>
                    <span class="badge">錢包</span>
                </a>
                 <a href="#" class="btn border"data-toggle="dropdown">
                    <i class="fas fa-user text-primary"></i>
                    <span class="badge" margin="3px">個人</span>
                    <i class="fas fa-caret-down text-primary"></i>
                    <div class="dropdown-menu position-absolute bg-secondary">
                        <a href="user_information.php" class="dropdown-item">個人資料</a>
                        <a href="user_heart.php" class="dropdown-item">我的收藏</a>
                        <a href="user_follow.php" class="dropdown-item">我的追蹤</a>
                        <a href="user_contract_list.php" class="dropdown-item">我的合約</a>
                        <a href="user_post.php" class="dropdown-item">我的文章</a>
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
                    <h6 class="m-0">總覽</h6>

                </a>

                <nav class="collapse show navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0" id="navbar-vertical">
                    <div class="navbar-nav w-100 overflow-hidden" style="height: 410px">
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link" data-toggle="dropdown">文章類別 <i class="fa fa-angle-down float-right mt-1"></i></a>
                            <div class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0">
                                 <a href="index.php" class="dropdown-item">全部文章</a>
                                <?php foreach ($categories as $category) { ?>
                                <a href="post_view.php?dictionary_id=<?php echo $category['dictionary_id'] ?>" class="dropdown-item"><?php echo $category['dictionary_name']; ?></a>
                                <?php  } ?>
                            </div>
                        </div>
                <nav class="collapse show navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0" id="navbar-vertical">
                    <div class="navbar-nav w-100 overflow-hidden" style="height: 410px">
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link" data-toggle="dropdown">特約商店<i class="fa fa-angle-down float-right mt-1"></i></a>
                            <div class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0">
                                <?php foreach ($merchants as $merchant) { ?>
                                <a href="" class="dropdown-item"><?php echo $merchant['name']; ?></a>
                                <?php  } ?>
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
                            <h2 align="center" style="margin-top: 10px;">我的文章</h2>
                        </div>
                    </div>
                </nav>
            
                <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                    
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                </nav>        
                <div id="header-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="container d-flex justify-content-center mt-50 mb-50">
            
                            <div class="row">
                                
                                <?php foreach ($posts as $post) { ?>
                        
                                <div class="col-md-12">
                                    
                                    <div class="card blog-horizontal">
                                        <div class="card-body">
                  
    
                                            <div class="mb-3">
                                                <h5 class="d-flex font-weight-semibold flex-nowrapc="true""><?php echo $post['title'] ?>
    
                                                    <span class="text-danger-400 ml-auto"><?php echo $post['price'] ?> coin</span>
                                                </h5>
    
                                                <ul class="list-inline list-inline-dotted text-muted mb-0">
                                                    <li class="list-inline-item"><a href="user_information.php" class="text-muted" data-abc="true"><?php echo $post['general_user_name'] ?></a></li>
                                                    <li class="list-inline-item"><?php echo "#" . $post['category_name'] ?></li>
                                                    <li class="list-inline-item"><?php echo $post['submit_time'] ?></li>
                                                </ul>
                                            </div>
    
                                            <p><?php echo $post['context'] ?></p>
                                        </div>
                    
                                        <div class="card-footer d-flex justify-content-between bg-light border">
                                            <a href="post.php?post_id=<?php echo $post['post_id'] ?>" class="btn btn-sm text-dark p-0"><i class="fas fa-heart text-primary mr-1"> <?php echo $post['heart'] ?></i></a>
                                            <a href="post.php?post_id=<?php echo $post['post_id'] ?>" class="btn btn-sm text-dark p-0"><i class="fas fa-comment text-primary mr-1"> <?php echo $post['replyCount'] ?></i></a>
                                            <a href="post.php?post_id=<?php echo $post['post_id'] ?>" class="btn btn-sm text-dark p-0"><i class="fas fa-bookmark text-primary mr-1"> <?php echo $post['collectionCount'] ?></i></a>
                                        </div>
                                    </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
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

    <!-- Offer End -->


    <!-- Products Start -->

    </div>

    <!-- Products End -->


    <!-- Subscribe Start -->

    <!-- Subscribe End -->


    <!-- Products Start -->

    <!-- Products End -->


    <!-- Vendor Start -->

    <!-- Vendor End -->


    <!-- Footer Start -->

    <!-- Footer End -->


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