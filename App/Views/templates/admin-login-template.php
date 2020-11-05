<?php use App\Controllers\AdminController; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.9.0/css/all.css">

    <link rel="stylesheet" href="/assets/css/color.css?v=0.1">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css" />

    <title>เข้าสู่ระบบ - ระบบบริหารงาน</title>
    <style>
        :root {
            --input-padding-x: 1.5rem;
            --input-padding-y: .75rem;
        }

        /* thai */
        @font-face {
            font-family: 'Prompt';
            font-style: normal;
            font-weight: 200;
            font-display: swap;
            src: local('Prompt ExtraLight'), local('Prompt-ExtraLight'), url(https://fonts.gstatic.com/s/prompt/v4/-W_8XJnvUD7dzB2Cr_sIfWMuQ5Q.woff2) format('woff2');
            unicode-range: U+0E01-0E5B, U+200C-200D, U+25CC;
        }

        * {
            font-family: Prompt, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"
        }

        .form-label-group {
            position: relative;
            margin-bottom: 1rem;
            filter: drop-shadow(0px 3px 2px rgba(0, 0, 0, 0.075));
        }

        .form-label-group input {
            height: auto;
            border-radius: 2rem;
        }

        .form-label-group>input,
        .form-label-group>label {
            padding: var(--input-padding-y) var(--input-padding-x);
        }

        .form-label-group>label {
            position: absolute;
            top: 0;
            left: 0;
            display: block;
            width: 100%;
            margin-bottom: 0;
            /* Override default `<label>` margin */
            line-height: 1.5;
            color: #495057;
            border: 1px solid transparent;
            border-radius: .25rem;
            transition: all .1s ease-in-out;
        }

        .form-label-group input::-webkit-input-placeholder {
            color: transparent;
        }

        .form-label-group input:-ms-input-placeholder {
            color: transparent;
        }

        .form-label-group input::-ms-input-placeholder {
            color: transparent;
        }

        .form-label-group input::-moz-placeholder {
            color: transparent;
        }

        .form-label-group input::placeholder {
            color: transparent;
        }

        .form-label-group input:not(:placeholder-shown) {
            padding-top: calc(var(--input-padding-y) + var(--input-padding-y) * (2 / 3));
            padding-bottom: calc(var(--input-padding-y) / 3);
        }

        .form-label-group input:not(:placeholder-shown)~label {
            padding-top: calc(var(--input-padding-y) / 3);
            padding-bottom: calc(var(--input-padding-y) / 3);
            font-size: 12px;
            color: #777;
        }
    </style>
</head>

<body style="
    background-position: center;
    position: relative;
    height: 100%;
    background-image: radial-gradient(white, var(--bs-secondary));
    background-size: cover;">
    <main class="row mx-0 vh-100 justify-content-center align-items-center">
        <div class="col-12 col-sm-8 col-md-7 col-lg-6 col-xl-4">
            <div class="card border-0 bg-transparent">
                <div class="card-body">
                    <!-- <img src="https://kpi-shop.com/wp-content/uploads/2019/10/logo-kpi-svg.svg" class="w-100 d-block mx-auto" style="max-width: 250px;" alt="Logo" id="logo"> -->
                    <h1 class="h3 text-center [mt-5] font-weight-bold">ระบบบริหารเว็บไซต์</h1>
                    <h5 class="text-black-50 font-weight-light mb-5 text-center"><?= AdminController::$webName ?></h5>
                    <?php if (isset($_POST['submit'])) : ?>
                        <div class="alert alert-danger mb-4 alert-dismissible fade show text-center" role="alert" style="margin-top: -1rem;">
                            <?= $output['text'] ?>
                            <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <script>
                            console.error(`<?= print_r($output['log'], true) ?>`);
                        </script>
                    <?php endif; ?>
                    <form action="/Admin/login" method="post">
                        <div class="form-label-group mx-auto" style="max-width: 400px;">
                            <input type="text" name="username" placeholder="รหัสบัตรประจำตัวประชาชน" value="<?= $output['input']['username'] ?? null?>" class="form-control bg-white " id="username" required>
                            <label class="" for="username" style="cursor: text;">Username</label>
                        </div>
                        <div class="form-label-group mx-auto input-group" style="max-width: 400px;">
                            <input type="password" name="password" placeholder="รหัสผ่าน" class="form-control bg-white  border-right-0" id="password" required="">
                            <label class="" style="z-index: 9;" for="password" style="cursor: text;">Password</label>
                            <!-- <span class="input-group-append" style="z-index: 10;"> -->
                                <button id="togglePass" type="button" class="btn border-top border-right border-bottom" style="z-index: 10; background-color: white; border-top-right-radius: 50%; border-bottom-right-radius: 50%; "><i class="fas fa-search"></i></button>
                            <!-- </span> -->
                        </div>
                        <div class="text-center mb-2 d-flex flex-column align-items-center">
                            <input type="submit" class="btn btn-lg btn-dark px-md-5 rounded-pill mt-4 mb-4" value="เข้าสู่ระบบ" name="submit">
                            <a href="/" class="text-black-50 text-decoration-none">กลับสู่หน้าเว็บ</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <footer class="fixed-bottom container-fluid text-center small mb-3 text-black-50">
        &copy; <?= date('Y') ?> <a href="//easyweb-thailand.com" class="text-black-50">Easyweb-Thailand.com</a>
    </footer>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <!-- <script src="/assets/js/jquery.inputmask.min.js"></script> -->
    <script>
        $('#togglePass').on('click', function(e) {
            var $input = $('#password');
            if ($input.prop('type') === 'password') {
                $input.prop('type', 'text');
            } else {
                $input.prop('type', 'password')
            }
        });

        $(function() {
            // $('#username').inputmask({ mask: "9-9999-99999-99-9", nullable: false });  //static mask
        });
    </script>
</body>

</html>