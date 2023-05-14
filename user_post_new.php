<?php
    session_start();
    $general_id = $_SESSION['general_id'];
    require_once __DIR__ . '/helpers/helper.php';


    $categories = query("SELECT * FROM dictionary WHERE dictionary_kind = '".文章."'");
    $merchants = query("SELECT * FROM merchant");
    $now = now();

    if ($_POST['is_submit']) {
        if ($_POST['post_id']) {
            // update
            if ($_POST['mode'] == 'publish') {
                query("update post set title=\"{$_POST['title']}\",context=\"{$_POST['context']}\",category_id={$_POST['category_id']},price={$_POST['price']},submit_time=\"{$now}\" where post_id={$_POST['post_id']}");
            } else {
                query("update post set title=\"{$_POST['title']}\",context=\"{$_POST['context']}\",category_id={$_POST['category_id']},price={$_POST['price']} where post_id={$_POST['post_id']}");
                header('location: index.php');
                
            }   
        } else {
  
            // insert
            if ($_POST['mode'] == 'publish') {
                if($_POST['havePartner'] == '1'){
                    
                }
                else{
                    query("insert into post (general_id, title, context, price, category_id, submit_time) VALUES ($general_id, \"{$_POST['title']}\", \"{$_POST['context']}\", {$_POST['price']}, {$_POST['category_id']}, \"{$now}\")");
                }
            } else {    
                query("insert into post (general_id, title, context, price, category_id) VALUES ($general_id, \"{$_POST['title']}\", \"{$_POST['context']}\", {$_POST['price']}, {$_POST['category_id']})");
                header('location: index.php');
            }   
        }
    }

    // try to fetch un submit post
    $post = query("SELECT * FROM post where submit_time is null and general_id = '$general_id'")[0] ?? [];

  
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>輔來輔厲害</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">

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
    
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row align-items-center py-3 px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a href="index.php" class="text-decoration-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">輔來輔厲害</span></h1>
                </a>
            </div>
            <div class="col-lg-6 col-6 text-left">
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
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <nav class="collapse show navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0" id="navbar-vertical">
                    <div class="navbar-nav w-100 overflow-hidden" style="height: 410px">
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link" data-toggle="dropdown">文章類別 <i class="fa fa-angle-down float-right mt-1"></i></a>
                            <div class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0">
                                <a href="index.php" class="dropdown-item">全部文章</a>
                                <?php foreach ($categories as $category) { ?>
                                <a href="post_view.php?category_id=<?php echo $category['dictionary_id']?>" class="dropdown-item"><?php echo $category['dictionary_name']; ?></a>
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
                            
                        </div>
                    </div>
                </nav>
                <div class="container-xxl py-5">
                    <div class="container">
                        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                            <h1 class="mb-5">文章 <span class="text-primary text-uppercase">發表</span></h1>
                        </div>
                        <div class="row g-5">
                            
                        <div class="container height-100 d-flex justify-content-center align-items-center">
                            <div class="col-lg-6">
                                <div class="wow fadeInUp" data-wow-delay="0.2s">
                                    <form id="postForm" method="POST" enctype="multipart/form-data">
                                        <input type="text" name="is_submit" value="1" hidden>
                                        <input type="text" name="post_id" value="<?php echo $post['post_id'] ?>" hidden>
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <label for="category">文章類別看板:</label>
                                                    <select class="form-select" id="category" name="category_id">

                                                    <?php foreach ($categories as $category) { ?>
                                                        <option <?php echo  $post['category_id'] == $category['dictionary_id'] ? 'selected': '' ?> value="<?php echo $category['dictionary_id'] ?>"><?php echo $category['dictionary_name'] ?></option>
                                                    <?php } ?>
                                                
                                                    </select>
                                                  </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-floating">
                                                    <label for="title">標題:</label>
                                                    <input type="text" class="form-control" id="title" name="title" placeholder="title" value="<?php echo @$post['title'] ?>">
                                                </div>
                                            </div>
                                            
                                            <div class="col-12">
                                                <div class="form-floating">
                                                    <label for="context">文章內容:</label>
                                                    <textarea class="form-control" placeholder="content" id="context" name="context" style="height: 200px"><?php echo @$post['context'] ?></textarea>
                                                </div>
                                            </div>

                                    
                                            <div class="col-md-12 pt-3 pb-3">
                                                <div class="form-floating">
                                                    <label for="price">閱讀文章需付的coin</label>
                                                    <select class="form-select" id="price" name="price">
                                                        <option <?php echo $post['price'] == 0 ? 'selected' : '' ?> value="0">免費</option>
                                                        <option <?php echo $post['price'] == 20 ? 'selected' : '' ?> value="20">20 coin</option>
                                                        <option <?php echo $post['price'] == 50 ? 'selected' : '' ?> value="50">50 coin</option>
                                                        <option <?php echo $post['price'] == 100 ? 'selected' : '' ?> value="100">100 coin</option>
                                                        <option <?php echo $post['price'] == 150 ? 'selected' : '' ?>  value="150">150 coin</option>
                                                        <option <?php echo $post['price'] == 200 ? 'selected' : '' ?> value="200">200 coin</option>
                                                    </select>
                                                  </div>
                                            </div>

                                            <div class="col-6">
                                                <input class="btn btn-primary w-100 py-3" type="submit" value="儲存草稿" />
                                            </div>
                                            <div class="col-6">
                                                <input class="btn btn-primary w-100 py-3" type="button" onclick="myFunction()" value="發布"/>
                                                <p id="demo"></p>
                                            </div>
                                            

                                        </div>
                                    </form>
                                </div>
                             </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

    <!-- Navbar End -->
    

  


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>

    <script>
        function myFunction() {

            $.confirm({
                title: "提示",
                content: "是否有共同發表者",
                buttons: {
                    ok: {text: '有'},
                    cancel: {text: '無'}
                },
                onAction: function (btnName) {
                    let havePartner = btnName == 'ok' ? true : false;
                    
                    $.confirm({
                        title: "提示",
                        content: "內容無誤，確定發布",
                        buttons: {
                            ok: {text: '是'},
                            cancel: {text: '否'}
                        },
                        onAction: function (btnName) {
                            if (btnName == 'ok') {
                                let data = $("#postForm").serialize() + '&mode=publish' + '&havePartner=' + (havePartner?1:0);
                                $.ajax({
                                    url: 'user_post_new.php',
                                    method: 'post',
                                    data: data,
                                }).then(function () {
                                    if (havePartner) {
                                        // contract page
                                        window.location.href = 'user_contract_sign2.php?title='+ $('#title').val() +'&category_id='+ $('#category').val() +'&context='+ $('#context').val() +'&price='+ $('#price').val();
                                    } else {
                                        window.location.href = 'user_post.php'
                                    }
                                });
                            }
                        }
                    })
                }
            })
        }
    </script>
</body>

</html>