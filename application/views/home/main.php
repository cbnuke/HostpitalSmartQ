<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            หน้าหลัก
            <small>ส่วนจัดการหลัก</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
            <li class="active">ส่วนจัดการหลัก</li>
        </ol>
    </section>


    <!-- Main content -->
    <section class="content">
        <?php if ($flag != NULL) { ?>
            <div class="row">
                <div class="col-md-12">
                    <?php if ($flag) { ?>
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-check"></i> สำเร็จ!</h4>
                            ส่งผู้ป่วยสำเร็จ
                        </div>
                    <?php } ?>
                    <?php if (!$flag) { ?>
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-times"></i> ไม่สำเร็จ!</h4>
                            ส่งผู้ป่วยไม่สำเร็จ
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="box box-default collapsed-box">
                    <div class="box-header with-border">
                        <h3 class="box-title">ส่งผู้ป่วย</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                            </button>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form class="form-horizontal" method="POST">
                            <div class="box-body">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">HN</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="hn" class="form-control" id="inputEmail3" placeholder="Hospital Number">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">OPD</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="qd_id">
                                            <?php foreach ($checkDepartment as $row) { ?>
                                                <option value="<?= $row['dep_id'] ?>"><?= $row['dep_name_th'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">SMS</label>
                                    <div class="col-sm-10">
                                        <div class="form-group">
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="qh_sms" value="1">
                                                    รับ (10บาท)
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="qh_sms"  value="0" checked="">
                                                    ไม่รับ
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <input type="hidden" name="mode" value="add"/>
                                <button type="reset" class="btn btn-default">ยกเลิก</button>
                                <button type="submit" class="btn btn-info pull-right">เพิ่ม</button>
                            </div>
                            <!-- /.box-footer -->
                        </form>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
        <div class="row">
            <?php
            $color = array();
            array_push($color, 'bg-primary');
            array_push($color, 'bg-navy');
            array_push($color, 'bg-info');
            array_push($color, 'bg-teal');
            array_push($color, 'bg-success');
            array_push($color, 'bg-purple');
            array_push($color, 'bg-warning');
            array_push($color, 'bg-orange');
            array_push($color, 'bg-danger');
            array_push($color, 'bg-maroon');
            array_push($color, 'bg-gray');
            array_push($color, 'bg-black');

            foreach ($checkDepartment as $index => $row) {
                $css_bg = $color[$index % 12];
                ?>
                <div class="col-md-3">
                    <!-- small box -->
                    <div class="small-box <?= $css_bg ?>">
                        <div class="inner">
                            <h3><?= $row['wait'] . '/' . $row['done'] ?></h3>
                            <p>OPD <?= $row['dep_id'] ?> : <?= $row['dep_name_th'] . ' (' . $row['dep_name_en'] . ')' ?></p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-book"></i>
                        </div>
                        <a href="<?= base_url('opd/id/' . $row['dep_id']) ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div><!-- ./col -->
            <?php } ?>
        </div><!-- /.row -->
        <!-- Main row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<script>
    $(function () {
        $(".DataTable").DataTable({
            "order": [],
            "columnDefs": [{
                    "targets": 'no-sort',
                    "orderable": false,
                }],
            responsive: true
        });
    });
</script>