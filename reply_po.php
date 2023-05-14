<?php
session_start();
$general_id = $_SESSION['general_id'];
require_once __DIR__ . '/helpers/helper.php';
require_once __DIR__ . '/api/models/Reply.php';
$categories = query("SELECT * FROM dictionary WHERE dictionary_kind = '文章'");
$merchants = query("SELECT * FROM merchant");
$now = now();
$r = (new Reply());

if ($_POST['is_submit']) {
    if ($_POST['post_id']) {

    } else {

        // insert
        if ($_POST['mode'] == 'publish') {
            ;
            query("insert into post (general_id, title, context, price, category_id, submit_time) VALUES ($general_id, \"{$_POST['title']}\", \"{$_POST['context']}\", {$_POST['price']}, {$_POST['category_id']}, \"{$now}\")");
        } else {
            query("insert into post (general_id, title, context, price, category_id) VALUES ($general_id, \"{$_POST['title']}\", \"{$_POST['context']}\", {$_POST['price']}, {$_POST['category_id']})");
            header('location: index.php');
        }
    }
}

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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

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
                    <h1 class="m-0 display-5 font-weight-semi-bold"><span
                            class="text-primary font-weight-bold border px-3 mr-1">輔來輔厲害</span></h1>
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
                <a href="user_wallet.php" class="btn border">
                    <i class="fas fa-piggy-bank text-primary"></i>
                    <span class="badge">錢包</span>
                </a>
                <a href="#" class="btn border" data-toggle="dropdown">
                    <i class="fas fa-user text-primary"></i>
                    <span class="badge" margin="3px">個人</span>
                    <i class="fas fa-caret-down text-primary"></i>
                    <div class="dropdown-menu position-absolute bg-secondary">
                        <a href="user_information.php" class="dropdown-item">個人資料</a>
                        <a href="user_heart.php" class="dropdown-item">我的收藏</a>
                        <a href="user_follow.php" class="dropdown-item">我的追蹤</a>
                        <a href="user_contract.php" class="dropdown-item">我的合約</a>
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
                <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100"
                    data-toggle="collapse" href="#navbar-vertical"
                    style="height: 65px; margin-top: -1px; padding: 0 30px;">
                    <h6 class="m-0">總覽</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <nav class="collapse show navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0"
                    id="navbar-vertical">
                    <div class="navbar-nav w-100 overflow-hidden" style="height: 410px">
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link" data-toggle="dropdown">文章類別 <i
                                    class="fa fa-angle-down float-right mt-1"></i></a>
                            <div class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0">
                                <?php foreach ($categories as $category) { ?>
                                    <a href="" class="dropdown-item">
                                        <?php echo $category['dictionary_name']; ?>
                                    </a>
                                <?php } ?>
                            </div>
                        </div>
                        <nav class="collapse show navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0"
                            id="navbar-vertical">
                            <div class="navbar-nav w-100 overflow-hidden" style="height: 410px">
                                <div class="nav-item dropdown">
                                    <a href="#" class="nav-link" data-toggle="dropdown">特約商店<i
                                            class="fa fa-angle-down float-right mt-1"></i></a>
                                    <div
                                        class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0">
                                        <?php foreach ($merchants as $merchant) { ?>
                                            <a href="#" class="dropdown-item">
                                                <?php echo $merchant['name']; ?>
                                            </a>
                                        <?php } ?>
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
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                </nav>
                <center>
                    <div id="header-carousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <h1><class="section-title text-center text-primary text-uppercase">發表評論</h1>
                            <div class="container rounded bg-white mt-5 mb-5">
                                <div class="row">
                                    <div class="col-md-3 border-right">

                                    </div>
                                    <div class="col-md-5 border-right">
                                        <div class="p-3 py-5">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <h4 class="text-right">寫下評論吧~</h4>
                                            </div>

                                            <div class="row mt-3">

                                                <div class="col-md-12"><label class="labels"></label>
                                                    <input name="context" id="context" type="text" class="form-control"
                                                        placeholder="溫馨小提醒，情緒性、猥褻、引戰言論，官方有權刪除" value="">
                                                </div>
                                            </div>


                                            <div class="mt-5 text-center">
                                                <button id="add_reply" class="btn btn-primary profile-button"
                                                    type="button">發布</button>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </center>
            </div>

        </div>
    </div>
    </div>
    </div>




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
<script>
    $(document).ready(async function () {

        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        const userInfo = await getUserInfo() || {};
        const report = await loadReport();

        $('#add_reply').on('click', function () {
            const context = $('#context').val();
            $.ajax({
                url: getAjaxUrl('reply', 'addReply'),
                method: 'POST',
                data: JSON.stringify({ post_id: urlParams.get('post_id'), context }),
                dataType: 'JSON',
                success: function (res) {
                    window.location.href = 'post.php?post_id=' + urlParams.get('post_id');
                    // console.log(context);
                }
            });
        })

        async function loadReport() {
            if (!urlParams.has('reply_id')) {
                return;
            }
            // return await $.ajax({
            //     url: getAjaxUrl('post', 'getPost'),
            //     data: { post_id: urlParams.get('post_id') },
            //     dataType: 'JSON'
            // });
        }

        function changeCommonModal(option) {
            const { title, body } = option;
            $('#common_modal_title').html(title);
            $('#common_modal_body').html(body);
        }
    })
</script>

</html>