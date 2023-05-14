<?php
session_start();
$general_id = $_SESSION['general_id'];
require_once __DIR__ . '/helpers/helper.php';
require_once __DIR__ . '/api/models/Post.php';
require_once __DIR__ . '/api/models/Reply.php';
$p = (new Post());
$r = (new Reply());
$post = $p->getPost();
$reply = $r->getReplysByPostId();
$p_heart = $p->checkSelfHeart();
$p_collection = $p->checkSelfCollection();
// $r_heart = $r->checkSelfHeart();
// $categories = query("SELECT * FROM dictionary WHERE dictionary_kind = '" . 文章 . "'");
// $post_id = $_GET['post_id'];
// $posts = query("SELECT post.*, general_user.nickname as nickname FROM post INNER JOIN general_user ON post.general_id = general_user.general_id WHERE post.post_id = '$post_id'")[0];
// $donate = query("SELECT * FROM donate INNER JOIN post ON post.post_id = donate.donate_post WHERE donate.donate_user = '$general_id'")[0] ?? [];
//$p_heart = query("SELECT * FROM heart WHERE send_user = '$general_id' and post_id = '$post_id'")[0] ?? [];

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
    <style>
        .reply_left {
            float: left;
            width: 6%;
            margin-bottom: 10px;
            margin-right: 2%;
        }

        .reply_center {
            float: left;
            width: 79%;
            margin-bottom: 10px;
            margin-right: 2%;
        }

        .reply_right {
            float: left;
            width: 9%;
            margin-bottom: 10px;
            margin-right: 2%;
            flex-direction: column;
            display: flex;
            align-content: space-between;
        }

        .reply_user {
            position: fixed;
            top: 0;
            border-width: 0;
        }

        .reply_context {
            position: relative;
            text-align: left;
        }

        .reply_time {
            position: relative;
            bottom: 0;
            border-width: 0;
            text-align: left;
        }

        .reply_heart {
            height: 6%;
            top: 0;
            margin-bottom: 2%;
            align-items: flex-start
        }

        .reply_right_center {
            position: absolute;
            bottom: 0;
            margin-bottom: 2%;
        }

        .reply_report {
            position: absolute;
            height: 6%;
            bottom: 0;
            margin-bottom: 2%;
            align-items: flex-end;
        }
    </style>
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
                <a href="wallet.php" class="btn border">
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
    </div>
    <center>
        <div class="col-lg-9">
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
                            <div class="col-md-12">

                                <div class="card blog-horizontal">
                                    <div class="card-body">
                                        <div class="card-img-actions mr-sm-3 mb-3">
                                            <img src="img/熊熊1.jpg" class="img-fluid card-img" alt="">
                                        </div>

                                        <div class="mb-3">
                                            <h5 class="d-flex font-weight-semibold flex-nowrap my-1">
                                                <a id="post_title" href="#" class="text-default mr-2" data-abc="true">
                                                    <?php
                                                    echo $post['postInfo']['title'];
                                                    ?>
                                                </a>

                                            </h5>

                                            <h5 class="d-flex font-weight-semibold flex-nowrap my-1">
                                                <span class="text-danger-400 ml-auto">
                                                    <?php echo "<input type=submit class='btn border' id = 'report_post' style='background-color: #46A3FF; color: black; border-radius: 7%;' value='檢舉'>"; ?>
                                                </span>
                                            </h5>

                                            <ul class="list-inline list-inline-dotted text-muted mb-0">
                                                <li class="list-inline-item">
                                                    <a href="#" class="text-muted" data-abc="true">
                                                        <?php
                                                        echo $post['postInfo']['nickname'];
                                                        ?>
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <?php
                                                    echo $post['postInfo']['submit_time'];
                                                    ?>
                                                </li>
                                            </ul>
                                        </div>
                                        <?php
                                        echo "<p>" . $post['postInfo']['context'] . "</p>";
                                        ?>

                                        <?php
                                        if (!$post['isUnlocked'] && !$p->checkSelfPost()) {
                                            echo '<button id="unlockButton" type="button" class="btn btn-success" data-toggle="modal" data-target="#unlock_modal">本篇文章價值 ' . $post['postInfo']['price'] . ' coin，點此解鎖文章。</button>';
                                        }
                                        ?>
                                    </div>

                                    <div
                                        class="card-footer d-flex justify-content-around align-items-center bg-light border">
                                        <?php
                                        echo "<button type='button' class='btn btn-light'>
                                            <i id='" . (!empty($p_heart) ? 'delete_p_heart' : 'add_p_heart') . "' style='font-size:24px;color:blue!important;' class='" . (!empty($p_heart) ? 'fas' : 'far') . " fa-heart text-primary mr-1'></i>
                                            </button>";

                                        echo "<button type='button' class='btn btn-light'>
                                        <i id='" . (!empty($p_collection) ? 'delete_collection' : 'add_collection') . "' style='font-size:24px;color:blue!important;' class='" . (!empty($p_collection) ? 'fas' : 'far') . " fa-bookmark text-primary mr-1'></i>
                                        </button>";

                                        // if ($post['isUnlocked'] && !$p->checkSelfPost()) { 
                                        if ($post['isUnlocked']) {
                                            echo '<i id="add_reply" class="fas fa-comments text-primary mr-1" style="color:blue!important;font-size:24px;"></i>';
                                            if (!$p->checkSelfPost()) {
                                                echo '<button id="donateButton" type="button" class="btn border" style="background-color: #46A3FF; color: black; border-radius: 7%;" data-toggle="modal" data-target="#donate_modal">打賞</button>';
                                            }
                                            echo '</div>';

                                            //留言
                                            foreach ($reply as $replys) { 
                                                
                                                $heartChecked = $r->checkSelfHeart($replys["reply_id"]);
                                                echo 
                                                "<div class'card-footer'>
                                                    <div class='align-items-left'>
                                                        <div class='reply_left'>
                                                            <i class='fa fa-user-circle fa-2x' aria-hidden='true'
                                                                style='font-size:32px;'></i>
                                                        </div>

                                                        <div class='reply_center'>
                                                            <div class='reply_uesr'>
                                                                <h5 class='d-flex font-weight-semibold flex-nowrap my-1'>
                                                                    ".$replys['nickname']."
                                                                </h5>
                                                            </div>
                                                            <div class='reply_context'>
                                                                ".$replys["context"]."
                                                            </div>
                                                            <div class='reply_time'>
                                                                ".$replys["reply_time"]."
                                                            </div>
                                                        </div>
                                                        <div class='reply_right'>
                                                            <div class='reply_heart'>
                                                                <button id='" . ($heartChecked ? 'delete_r_heart' : 'add_r_heart') . "' data-reply_id='" . $replys["reply_id"] . "' type='button' class='btn btn-light'>
                                                                    <i style='font-size:24px;color:blue!important;' class='" . ($heartChecked ? 'fas' : 'far') . " fa-heart text-primary mr-1'></i>
                                                                </button>
                                                            </div>
                                                            <button id='report_reply' class='btn btn-button' data-reply_id='" . $replys["reply_id"] . "'bugger>檢舉</button>
                                                        </div>
                                                    </div>
                                                </div>";

                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    </center>
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
    <script>
        $(document).ready(async function () {

            const queryString = window.location.search;
            const urlParams = new URLSearchParams(queryString);
            const userInfo = await getUserInfo() || {};
            const post = await loadPost();

            $('#unlockButton').on('click', function () {
                const amount = post?.postInfo?.price || 0;
                openModal({
                    $title: '確認要解鎖嗎?',
                    $body: `即將支付解鎖費用 ${amount} coins。`,
                    confirmCallback: function () {
                        $.ajax({
                            url: getAjaxUrl('post', 'addDonate'),
                            method: 'POST',
                            data: JSON.stringify({ post_id: urlParams.get('post_id'), amount }),
                            dataType: 'JSON',
                            success: function (res) {
                                const { state, message = '', extra = {} } = res;
                                if (message === 'BALANCE_IS_NOT_ENOUGH') {
                                    pushToast({ title: '餘額不足', type: 'error', message: `您的餘額為 ${extra?.balance || 0} coin，無法解鎖本篇文章。` });
                                    closeModal();
                                } else {
                                    location.reload();
                                }
                            }
                        });
                    }
                })
            })

            $('#donateButton').on('click', function () {

                const $body = $(`<form>
                    <div class="form-group">
                        <label for="donateAmount">打賞金額</label>
                        <input type="number" class="form-control" id="donateAmount" aria-describedby="donateHelp">
                        <small id="donateHelp" class="form-text text-muted">請輸入打賞金額</small>
                    </div>
                </form>
                `);

                openModal({
                    $title: '確認要打賞嗎?',
                    $body,
                    confirmCallback: function () {
                        const amount = parseInt($body.find('#donateAmount').val());
                        if (!amount || amount <= 0) {
                            pushToast({ title: '請填寫相關欄位', type: 'error', message: '金額為必填，且必須大於0。' });
                            return;
                        }
                        $.ajax({
                            url: getAjaxUrl('post', 'addDonate'),
                            method: 'POST',
                            data: JSON.stringify({ post_id: urlParams.get('post_id'), amount }),
                            dataType: 'JSON',
                            success: function (res) {
                                const { state, message = '', extra = {} } = res;
                                if (message === 'BALANCE_IS_NOT_ENOUGH') {
                                    pushToast({ title: '餘額不足', type: 'error', message: `您的餘額為 ${extra?.balance || 0} coin，無法進行打賞。` });
                                } else {
                                    pushToast({ title: '打賞完成', type: 'ok', message: `打賞完成，您的餘額為 ${extra?.balance || 0} coin。\n\n輔來輔厲害代表 ${userInfo?.nickname || userInfo?.name || '使用者'} 感謝您對本平台的支持，您的打賞是本平台持續維運的動力！` });
                                    closeModal();
                                }
                            }
                        });
                    }
                })
            })

            $('#add_p_heart').on('click', function () {
                $.ajax({
                    url: getAjaxUrl('post', 'addHeart'),
                    method: 'POST',
                    data: JSON.stringify({ post_id: urlParams.get('post_id') }),
                    dataType: 'JSON',
                    success: function (res) {
                        location.reload();
                    }
                });
            })
            $('#delete_p_heart').on('click', function () {
                $.ajax({
                    url: getAjaxUrl('post', 'deleteHeart'),
                    method: 'POST',
                    data: JSON.stringify({ post_id: urlParams.get('post_id') }),
                    dataType: 'JSON',
                    success: function (res) {
                        location.reload();
                    }
                });
            })
            $('#add_collection').on('click', function () {
                $.ajax({
                    url: getAjaxUrl('post', 'addCollection'),
                    method: 'POST',
                    data: JSON.stringify({ post_id: urlParams.get('post_id') }),
                    dataType: 'JSON',
                    success: function (res) {
                        location.reload();
                    }
                });
            })
            $('#delete_collection').on('click', function () {
                $.ajax({
                    url: getAjaxUrl('post', 'deleteCollection'),
                    method: 'POST',
                    data: JSON.stringify({ post_id: urlParams.get('post_id') }),
                    dataType: 'JSON',
                    success: function (res) {
                        location.reload();
                    }
                });
            })
            $('#add_reply').on('click', function () {
                $.ajax({
                    //  url: getAjaxUrl('reply', 'addreply'),
                    method: 'POST',
                    //data: JSON.stringify({ post_id: urlParams.get('post_id') }),
                    // dataType: 'JSON',
                    success: function (res) {
                        window.location.href = 'reply_po.php?post_id=' + urlParams.get('post_id');
                    }
                });
            })
            $('#add_r_heart').on('click', function () {
                var replyId = $(this).data('reply_id');
                $.ajax({
                    url: getAjaxUrl('reply', 'addHeart'),
                    method: 'POST',
                    data: JSON.stringify({ reply_id: replyId }),
                    dataType: 'JSON',
                    success: function (res) {
                        location.reload();
                    }
                });
            })
            $('#delete_r_heart').on('click', function () {
                var replyId = $(this).data('reply_id');
                $.ajax({
                    url: getAjaxUrl('reply', 'deleteHeart'),
                    method: 'POST',
                    data: JSON.stringify({ reply_id: replyId }),
                    dataType: 'JSON',
                    success: function (res) {
                        location.reload();
                    }
                });
            })
            $('#report_post').on('click', function () {
                $.ajax({
                    //  url: getAjaxUrl('report', 'addreply'),
                    method: 'POST',
                    //data: JSON.stringify({ post_id: urlParams.get('post_id') }),
                    // dataType: 'JSON',
                    success: function (res) {
                        window.location.href = 'report_post.php?post_id=' + urlParams.get('post_id');
                    }
                });
            })
            $('#report_reply').on('click', function () {
                window.location.href = 'report_reply.php?reply_id=' + $(this).data('reply_id');
            })

            async function loadPost() {
                if (!urlParams.has('post_id')) {
                    return;
                }
                return await $.ajax({
                    url: getAjaxUrl('post', 'getPost'),
                    data: { post_id: urlParams.get('post_id') },
                    dataType: 'JSON'
                });
            }

            function changeCommonModal(option) {
                const { title, body } = option;
                $('#common_modal_title').html(title);
                $('#common_modal_body').html(body);
            }
        })
    </script>
</body>

</html>