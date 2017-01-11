<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Hostpital SmartQ | Management</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.6 -->
        <?= css('bootstrap.min.css') ?>
        <!-- Font Awesome -->
        <?= css('font-awesome.min.css') ?>
        <!-- Theme style -->
        <?= css('AdminLTE.min.css') ?>
        <!-- Animate css -->
        <?= css('animate.css') ?>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo animated bounce">
                <?= anchor('login', '<b>Hostpital</b> SmartQ') ?>
            </div><!-- /.login-logo -->
            <div class="login-box-body">
                <p class="login-box-msg">ตรวจสอบสิทธิ์การใช้งาน</p>
                <?= form_open() ?>
                <div class="form-group has-feedback">
                    <input type="text" name="user" class="form-control" placeholder="Employee ID" autofocus="">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" name="pass" class="form-control" placeholder="Password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <?php if ($login_fail) { ?>
                    <div class="row animated shake">
                        <div class="col-xs-12">
                            <div class="callout callout-danger">
                                <p>Username หรือ Password ไม่ถูกต้อง</p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <div class="row">
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">เข้าระบบ</button>
                    </div><!-- /.col -->
                </div>
                <?= form_close() ?>
            </div><!-- /.login-box-body -->
        </div><!-- /.login-box -->
    </body>
</html>
