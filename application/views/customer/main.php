<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            ลูกค้า
            <small>ส่วนจัดการหลัก</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-users"></i> ลูกค้า</a></li>
            <li class="active">ส่วนจัดการหลัก</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Main row -->
        <div class="row">
            <section class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">รายชื่อลูกค้า</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#add-modal"><i class="fa fa-plus"></i> เพิ่มลูกค้า</button>
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered DataTable" width="100%">
                            <thead>
                            <th>รหัสลูกค้า</th>
                            <th>ชื่อ - นามสกุล</th>
                            <th>ชื่อเล่น</th>
                            <th>เบอร์โทรศัพท์</th>
                            <th></th>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($customer as $row) {
                                    $pre = 'data-Cus_id="' . $row['Cus_id'] . '" ';
                                    $pre .= 'data-Cus_name="' . $row['Cus_name'] . '" ';
                                    $pre .= 'data-Cus_nick="' . $row['Cus_nick'] . '" ';
                                    $pre .= 'data-Cus_tel="' . $row['Cus_tel'] . '" ';
                                    ?>
                                    <tr>
                                        <td><?= $row['Cus_id'] ?></td>
                                        <td><?= $row['Cus_name'] ?></td>
                                        <td><?= $row['Cus_nick'] ?></td>
                                        <td><?= $row['Cus_tel'] ?></td>
                                        <td class="text-center">
                                            <a href="<?= base_url('customer/detail/' . $row['Cus_id']) ?>" class="btn btn-sm btn-info"><i class="fa fa-info-circle"></i> ประวัติ</a>
                                            <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#edit-modal" <?= $pre ?>><i class="fa fa-pencil-square"></i> แก้ไข</button>
                                            <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> ลบ</button>
                                        </td>
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
        $(".datepicker").datepicker({regional: 'th', isBE: true, autoConversionField: false});
        $(".DataTable").DataTable({responsive: true});
        $('#edit-modal').on('show.bs.modal', function (e) {
            $(this).find('[name="Cus_id"]').prop('readonly', true);
            $(this).find('[name="Cus_id"]').val($(e.relatedTarget).data('cus_id'));
            $(this).find('[name="Cus_name"]').val($(e.relatedTarget).data('cus_name'));
            $(this).find('[name="Cus_nick"]').val($(e.relatedTarget).data('cus_nick'));
            $(this).find('[name="Cus_tel"]').val($(e.relatedTarget).data('cus_tel'));
        });
    });
</script>

<div id="add-modal" class="modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">เพิ่มลูกค้า</h4>
            </div>
            <?= $form_open ?>
            <div class="modal-body">
                <div class="form-group">
                    <label class="control-label col-md-2">รหัสสมาชิก</label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <?= $input['Cus_id'] ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">ชื่อ - นานสกุล</label>
                    <div class="col-md-5">
                        <?= $input['Cus_name'] ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">ชื่อเล่น</label>
                    <div class="col-md-5">
                        <?= $input['Cus_nick'] ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">เบอร์โทรศัพท์</label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                            <?= $input['Cus_tel'] ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="mode" value="add"/>
                <button type="submit" class="btn btn-success pull-left">เพิ่ม</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
            </div>
            <?= $form_close ?>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="edit-modal" class="modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">แก้ไขลูกค้า</h4>
            </div>
            <?= $form_open ?>
            <div class="modal-body">
                <div class="form-group">
                    <label class="control-label col-md-2">รหัสสมาชิก</label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <?= $input['Cus_id'] ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">ชื่อ - นานสกุล</label>
                    <div class="col-md-5">
                        <?= $input['Cus_name'] ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">ชื่อเล่น</label>
                    <div class="col-md-5">
                        <?= $input['Cus_nick'] ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">เบอร์โทรศัพท์</label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                            <?= $input['Cus_tel'] ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="mode" value="edit"/>
                <button type="submit" class="btn btn-success pull-left">บันทึก</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
            </div>
            <?= $form_close ?>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

