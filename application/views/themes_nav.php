<body class="hold-transition skin-red-light sidebar-mini">
    <div class="wrapper">

        <header class="main-header">
            <!-- Logo -->
            <a href="<?= base_url() ?>" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <!--Beauty & Art | Management-->
                <span class="logo-mini"><b>B</b>A</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>Beauty</b> & Art</span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                        <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-envelope-o"></i>
                                <span class="label label-success">4</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 4 messages</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <li><!-- start message -->
                                            <a href="#">
                                                <div class="pull-left">
                                                    <?= img('unknown.png', array('class' => 'img-circle', 'alt' => 'User Image')) ?>
                                                </div>
                                                <h4>
                                                    Support Team
                                                    <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li><!-- end message -->
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <?= img('unknown.png', array('class' => 'img-circle', 'alt' => 'User Image')) ?>
                                                </div>
                                                <h4>
                                                    AdminLTE Design Team
                                                    <small><i class="fa fa-clock-o"></i> 2 hours</small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <?= img('unknown.png', array('class' => 'img-circle', 'alt' => 'User Image')) ?>
                                                </div>
                                                <h4>
                                                    Developers
                                                    <small><i class="fa fa-clock-o"></i> Today</small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <?= img('unknown.png', array('class' => 'img-circle', 'alt' => 'User Image')) ?>
                                                </div>
                                                <h4>
                                                    Sales Department
                                                    <small><i class="fa fa-clock-o"></i> Yesterday</small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <?= img('unknown.png', array('class' => 'img-circle', 'alt' => 'User Image')) ?>
                                                </div>
                                                <h4>
                                                    Reviewers
                                                    <small><i class="fa fa-clock-o"></i> 2 days</small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="footer"><a href="#">See All Messages</a></li>
                            </ul>
                        </li>
                        <!-- Notifications: style can be found in dropdown.less -->
                        <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bell-o"></i>
                                <span class="label label-warning">10</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 10 notifications</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the page and may cause design problems
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-users text-red"></i> 5 new members joined
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-user text-red"></i> You changed your username
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="footer"><a href="#">View all</a></li>
                            </ul>
                        </li>
                        <!-- Tasks: style can be found in dropdown.less -->
                        <li class="dropdown tasks-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-flag-o"></i>
                                <span class="label label-danger">9</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 9 tasks</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <li><!-- Task item -->
                                            <a href="#">
                                                <h3>
                                                    Design some buttons
                                                    <small class="pull-right">20%</small>
                                                </h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">20% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li><!-- end task item -->
                                        <li><!-- Task item -->
                                            <a href="#">
                                                <h3>
                                                    Create a nice theme
                                                    <small class="pull-right">40%</small>
                                                </h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">40% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li><!-- end task item -->
                                        <li><!-- Task item -->
                                            <a href="#">
                                                <h3>
                                                    Some task I need to do
                                                    <small class="pull-right">60%</small>
                                                </h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">60% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li><!-- end task item -->
                                        <li><!-- Task item -->
                                            <a href="#">
                                                <h3>
                                                    Make beautiful transitions
                                                    <small class="pull-right">80%</small>
                                                </h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">80% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li><!-- end task item -->
                                    </ul>
                                </li>
                                <li class="footer">
                                    <a href="#">View all tasks</a>
                                </li>
                            </ul>
                        </li>
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <?= img('avatar2.png', array('class' => 'user-image', 'alt' => 'User Image')) ?>
                                <span class="hidden-xs"><?= $name ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <?= img('avatar2.png', array('class' => 'img-circle', 'alt' => 'User Image')) ?>
                                    <p>
                                        <?= $name ?>
                                        <small>ผู้ดูแลระบบ</small>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-right">
                                        <?= anchor('logout', 'ออกระบบ', array('class' => 'btn btn-default btn-flat')) ?>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <div class="pull-left image">
                        <?= img('avatar2.png', array('class' => 'img-circle', 'alt' => 'User Image')) ?>
                    </div>
                    <div class="pull-left info">
                        <p><?= $name ?></p>
                        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                </div>
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu">
                    <li class="header">เมนูหลัก</li>
                    <li>
                        <a href="#">
                            <i class="fa fa-th"></i>
                            <span>OPD List</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu menu-open" style="display: none;">
                            <li class=""><a href="<?= base_url('opd/id/1')?>"><i class="fa fa-circle-o"></i> OPD 1</a></li>
                            <li class=""><a href="<?= base_url('opd/id/2')?>"><i class="fa fa-circle-o"></i> OPD 2</a></li>
                            <li class=""><a href="<?= base_url('opd/id/3')?>"><i class="fa fa-circle-o"></i> OPD 3</a></li>
                            <li class=""><a href="<?= base_url('opd/id/4')?>"><i class="fa fa-circle-o"></i> OPD 4</a></li>
                            <li class=""><a href="<?= base_url('opd/id/5')?>"><i class="fa fa-circle-o"></i> OPD 5</a></li>
                            <li class=""><a href="<?= base_url('opd/id/6')?>"><i class="fa fa-circle-o"></i> OPD 6</a></li>
                            <li class=""><a href="<?= base_url('opd/id/7')?>"><i class="fa fa-circle-o"></i> OPD 7</a></li>
                            <li class=""><a href="<?= base_url('opd/id/8')?>"><i class="fa fa-circle-o"></i> OPD 8</a></li>
                            <li class=""><a href="<?= base_url('opd/id/9')?>"><i class="fa fa-circle-o"></i> OPD 9</a></li>
                            <li class=""><a href="<?= base_url('opd/id/10')?>"><i class="fa fa-circle-o"></i> OPD 10</a></li>
                            <li class=""><a href="<?= base_url('opd/id/11')?>"><i class="fa fa-circle-o"></i> OPD 11</a></li>
                            <li class=""><a href="<?= base_url('opd/id/12')?>"><i class="fa fa-circle-o"></i> OPD 12</a></li>
                            <li class=""><a href="<?= base_url('opd/id/13')?>"><i class="fa fa-circle-o"></i> OPD 13</a></li>
                            <li class=""><a href="<?= base_url('opd/id/14')?>"><i class="fa fa-circle-o"></i> OPD 14</a></li>
                            <li class=""><a href="<?= base_url('opd/id/15')?>"><i class="fa fa-circle-o"></i> OPD 15</a></li>
                            <li class=""><a href="<?= base_url('opd/id/16')?>"><i class="fa fa-circle-o"></i> OPD 16</a></li>
                            <li class=""><a href="<?= base_url('opd/id/17')?>"><i class="fa fa-circle-o"></i> OPD 17</a></li>
                            <li class=""><a href="<?= base_url('opd/id/18')?>"><i class="fa fa-circle-o"></i> OPD 18</a></li>
                            <li class=""><a href="<?= base_url('opd/id/19')?>"><i class="fa fa-circle-o"></i> OPD 19</a></li>
                        </ul>
                    </li>
                    <li class="">
                        <a href="<?= base_url('home/test')?>">
                            <i class="fa fa-edit"></i> <span>Register</span>
                        </a>
                    </li>
                    <li <?= ($page == '' || $page == 'home') ? 'class="active"' : ''; ?>><a href="<?= base_url('home') ?>"><i class="fa fa-home"></i> <span>หน้าหลัก</span></a></li>
                    <li <?= ($page == 'customer') ? 'class="active"' : ''; ?>><a href="<?= base_url('customer') ?>"><i class="fa fa-users"></i> <span>ลูกค้า</span></a></li>
                    <li <?= ($page == 'appointment') ? 'class="active"' : ''; ?>><a href="<?= base_url('appointment') ?>"><i class="fa fa-calendar"></i> <span>ตารางนัด</span></a></li>
                    <li class="header">ตั้งค่าระบบ</li>
                    <li <?= ($page == 'setting' && $subpage == 'service') ? 'class="active"' : ''; ?>><a href="<?= base_url('setting/service') ?>"><i class="fa fa-shopping-cart"></i> <span>บริการ</span></a></li>
                    <li <?= ($page == 'setting' && $subpage == 'admin') ? 'class="active"' : ''; ?>><a href="<?= base_url('setting/admin') ?>"><i class="fa fa-user"></i> <span>ผู้ดูแลระบบ</span></a></li>
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>

        <?php
        if (isset($debug) && $debug != NULL) {
            echo '<div class="content row" style="min-height: auto!important;">';
            echo '<pre class="col-md-10 col-md-offset-2">';
            print_r($debug);
            echo '</pre>';
            echo '</div>';
        }
        ?>

        <?php
        if (isset($alert) && $alert != NULL) {
            $icon = 'fa-check';
            if ($alert['type'] == 'danger') {
                $icon = 'fa-ban';
            } else if ($alert['type'] == 'warning') {
                $icon = 'fa-warning';
            } else if ($alert['type'] == 'success') {
                $icon = 'fa-check';
            }
            ?>
            <div id="alert" class="content-wrapper">
                <div class="alert alert-<?= $alert['type'] ?> alert-dismissable" style="margin-top: 10px;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <strong><i class="icon fa <?= $icon ?>"></i><?= $alert['title'] ?></strong>&nbsp;&nbsp;&nbsp;&nbsp;<?= $alert['body'] ?>
                </div>
            </div>
        <?php } ?>
