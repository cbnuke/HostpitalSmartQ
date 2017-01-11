<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            ลูกค้า
            <small>ประวัติการใช้บริการ</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= base_url('customer') ?>"><i class="fa fa-users"></i> ลูกค้า</a></li>
            <li class="active">ประวัติการใช้บริการ</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Main row -->
        <div class="row">
            <section class="col-md-4">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">ข้อมูลลูกค้า</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <dl class="dl-horizontal">
                            <dt>รหัสลูกค้า</dt>
                            <dd><?= $info['Cus_id'] ?></dd>
                            <dt>ชื่อ</dt>
                            <dd> คุณ 
                                <?= $info['Cus_name'] ?>
                                <?= ($info['Cus_nick'] != NULL) ? ' (' . $info['Cus_nick'] . ')' : '' ?>
                            </dd>
                            <dt>เบอร์โทรศัพท์</dt>
                            <dd>
                                <?= $info['Cus_tel'] ?><br>
                                <a href="tel:<?= $info['Cus_tel'] ?>" class="btn btn-success btn-sm"><i class="fa fa-phone"></i></a>
                            </dd>
                        </dl>
                    </div><!-- /.box-body -->
                </div>
            </section>

            <section class="col-md-8">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">ประวัติการใช้บริการ</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered DataTable" width="100%">
                            <thead>
                            <th>ลำดับ</th>
                            <th>บริการ</th>
                            <th>ระยะประกัน</th>
                            <th>สถานะประกัน</th>
                            <th></th>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($list_complete as $key => $row) {
                                    $pre = "data-Serv_name=\"" . $row['Serv_name'] . "\" ";
                                    $pre .= "data-expire=\"" . $this->datetime->DBToHuman($row['expire']) . "\" ";
                                    $pre .= "data-quotation_id=\"" . $row['quotation_id'] . "\" ";
                                    ?>
                                    <tr>
                                        <td class="text-center"><?= $key + 1 ?></td>
                                        <td><?= $row['Serv_name'] ?></td>
                                        <td>
                                            ประกัน: <strong><?= $row['rear_guarantee'] ?></strong> เดือน<br>
                                            หมดวันที่: <strong><?= $this->datetime->DBToHuman($row['expire']) ?></strong>
                                        </td>
                                        <td class="text-center">
                                            <?php if ($row['guarantee_use'] == 0) { ?>
                                                <span class="label label-success">ยังไม่ใช้ประกัน</span>
                                            <?php } else if ($row['guarantee_use'] == 1) { ?>
                                                <span class="label label-danger">ใช้ประกันแล้ว</span>
                                            <?php } ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if ($row['guarantee_use'] == 0) { ?>
                                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#complete" <?= $pre ?>><i class="fa fa-check"></i> ใช้ประกัน</button>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div><!-- /.box-body -->
                </div>

                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title">ประวัติการจองนัด</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered DataTable" width="100%">
                            <thead>
                            <th>ลำดับ</th>
                            <th>บริการ</th>
                            <th>สถานะ</th>
                            <th>วันที่นัด</th>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($list_reserve as $key => $row) {
                                    ?>
                                    <tr>
                                        <td class="text-center"><?= $key + 1 ?></td>
                                        <td><?= $row['Serv_name'] ?></td>
                                        <td class="text-center"><?= $row['status'] ?></td>
                                        <td><strong><?= $this->datetime->DBToHuman($row['quotation_date']) ?></strong></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div><!-- /.box-body -->
                </div>
            </section>
        </div><!-- /.row (main row) -->

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script>
    $(function () {
        /*
         * Event handle
         */
        $(".timepicker").timepicker({showInputs: false});
        $(".datepicker").datepicker({regional: 'th', autoConversionField: false});
        $(".DataTable").DataTable({responsive: true});
        $('#complete').on('show.bs.modal', function (e) {
            $(this).find('[name="quotation_id"]').val($(e.relatedTarget).data('quotation_id'));
            $(this).find('[name="Serv_name"]').val($(e.relatedTarget).data('serv_name'));
            $(this).find('#expire').html("หมดวันที่: " + $(e.relatedTarget).data('expire'));
        });
    });
</script>

<div id="complete" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <?= $form_open ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">คุณต้องการใช้ประกัน ใช่หรือไม่</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="control-label col-md-3">บริการ</label>
                    <div class="col-md-4">
                        <input type="text" name="Serv_name" class="form-control" readonly=""/>
                    </div>
                    <span id="expire"></span>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3">วันที่ใช้ประกัน</label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <?= $input['guarantee_use_date'] ?>
                        </div>
                    </div>
                </div>   
                <div class="form-group">
                    <label class="control-label col-md-3">เวลาใช้ประกัน</label>
                    <div class="col-md-5">
                        <div id="sandbox-container" style="position: relative;">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                <?= $input['guarantee_use_time'] ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="quotation_id"/>
                <button type="submit" class="btn btn-primary pull-left">ยืนยัน</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
            </div>
            <?= $form_close ?>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

