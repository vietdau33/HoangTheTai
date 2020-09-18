<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="manifest" href="<?=BASE_URL?>/manifest.json">
    <title><?=__('title')?></title>
    <link rel="stylesheet" href="<?=PUBLIC_URL?>vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=PUBLIC_URL?>vendor/alertifyjs/css/alertify.min.css">
    <link rel="stylesheet" href="<?=PUBLIC_URL?>vendor/alertifyjs/css/themes/default.min.css">
    <link rel="stylesheet" href="<?=PUBLIC_URL?>vendor/alertifyjs/css/themes/semantic.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;400;500;600;700&display=swap">
    <link rel="stylesheet" href="<?=PUBLIC_URL?>css/app.css">
    <link rel="stylesheet" href="<?=PUBLIC_URL?>css/media.css">
    <script src="<?=PUBLIC_URL?>vendor/jquery/jquery.min.js"></script>
    <script>var base_url = '<?=BASE_URL?>';</script>
</head>
<body>
    <div id="bg_body_full" class="bg_login"></div>
    <?php if(isset($allowShowBgHeader) && $allowShowBgHeader && !true) : ?>
        <div id="bg_header_full" class="text-center pt-4">
            <h4><?=__('title')?></h4>
        </div>
    <?php endif; ?>

    <div id="__contents">
        <?php if(!isset($isLogin) || !$isLogin) : ?>
            <div class="container-fluid header">
                <div class="row h-100 align-items-center">
                    <div class="col-sm-3 col-9 text-center">
                <span>
                    <?=__('welcome')?> <span class="pr-2 __usernameUser"><?=$this->userLogin->get('username')?></span>
                    <a href="<?=BASE_URL?>/login/logout" class="ml-2 __logoutUser"><?=__('logout')?></a>
                </span>
                    </div>
                    <div class="col-sm-9 col-3">
                        <div class="icon-open-menu">
                            <i class="fa fa-bars"></i>
                        </div>
                        <div class="bg-menu"></div>
                        <?=
                            $this->render(
                                    $this->get('controller') == 'admin' ? 'admin.menu' : 'home.menu' ,
                                    ['isChangePassword' => $isChangePassword ?? false]
                            )
                        ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="area_content">
            <?=$contents?>
        </div>
    </div>

    <script src="<?=PUBLIC_URL?>vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?=PUBLIC_URL?>vendor/bootstrap/js/popper.min.js"></script>
    <script src="<?=PUBLIC_URL?>vendor/alertifyjs/alertify.min.js"></script>
    <script src="<?=PUBLIC_URL?>js/function.js"></script>
    <script src="<?=PUBLIC_URL?>js/app.js"></script>
</body>
</html>