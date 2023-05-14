<?php
session_start();
$general_id = $_SESSION['general_id'];
require_once __DIR__ . '/helpers/helper.php';
require_once __DIR__ . '/api/models/Report.php';
$categories = query("SELECT * FROM dictionary WHERE dictionary_kind = '檢舉'");
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
                                        <h3>檢舉文章</h3>
                                    </div>
                                    <br>
                                    <form id="postForm" method="POST" enctype="multipart/form-data">
                                        <input type="text" name="is_submit" value="1" hidden>
                                        <input type="text" name="report_post" value="<?php echo $_GET['post_id'] ?>"
                                            hidden>
                                        <input type="text" name="reporter" value="<?php echo $_SESSION['general_id'] ?>"
                                            hidden>
                                        <input type="text" name="report_object" value="<?php echo "文章"; ?>" hidden>
                                        <input type="text" name="report_time" value="<?php echo $now ?>" hidden>
                                        <input type="text" name="status" value="<?php echo "未處理"; ?>" hidden>
                                        <div class="mb-3">
                                            <label for="category">檢舉類別:</label>
                                            <select class="form-select" id="category" name="category_id">

                                                <?php foreach ($categories as $category) { ?>
                                                    <option <?php echo $post['category_id'] == $category['dictionary_id'] ? 'selected' : '' ?> value="<?php echo $category['dictionary_id'] ?>">
                                                        <?php echo $category['dictionary_name'] ?></option>
                                                <?php } ?>

                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">檢舉原因：</label>
                                            <input class="form-control form-control-lg" type="text" id="reason"
                                                name="reason">

                                        </div>

                                        <div class="text-center mt-3">
                                            <button id="report_post" class="btn btn-danger">送出</button>
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
</body>
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

        $('#report_post').on('click', function () {
            const reason = $('#reason').val();
            const category = $('#category').val();
            $.ajax({
                url: getAjaxUrl('report', 'reportPost'),
                method: 'POST',
                data: JSON.stringify({ post_id: urlParams.get('post_id'), reason, category }),
                dataType: 'JSON',
                success: function (res) {
                    window.location.href = '/index.php';
                }
            });
        })

        function changeCommonModal(option) {
            const { title, body } = option;
            $('#common_modal_title').html(title);
            $('#common_modal_body').html(body);
        }
    })
</script>

</html>