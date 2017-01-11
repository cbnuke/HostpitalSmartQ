<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            ผู้ดูแลระบบ
            <small>ตั้งค่าระบบ</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-user"></i> ผู้ดูแลระบบ</a></li>
            <li class="active">ตั้งค่าระบบ</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Main row -->
        <div class="row">
            <section class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">รายชื่อผู้ดูแลระบบ</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#add-modal"><i class="fa fa-plus"></i> เพิ่มผู้ดูแลระบบ</button>
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered DataTable" width="100%">
                            <thead>
                            <th>User ID</th>
                            <th>ชื่อ - นามสกุล</th>
                            <th>เบอร์โทรศัพท์</th>
                            <th></th>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($admin as $row) {
                                    $pre = 'data-Admin_id="' . $row['Admin_id'] . '" ';
                                    $pre .= 'data-Admin_pass="' . $row['Admin_pass'] . '" ';
                                    $pre .= 'data-Admin_name="' . $row['Admin_name'] . '" ';
                                    $pre .= 'data-Admin_tel="' . $row['Admin_tel'] . '" ';
                                    ?>
                                    <tr>
                                        <td><?= $row['Admin_id'] ?></td>
                                        <td><?= $row['Admin_name'] ?></td>
                                        <td><?= $row['Admin_tel'] ?></td>
                                        <td class="text-center">
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
            $(this).find('[name="Admin_id"]').prop('readonly', true);
            $(this).find('[name="Admin_id"]').val($(e.relatedTarget).data('admin_id'));
            $(this).find('[name="Admin_pass"]').val($(e.relatedTarget).data('admin_pass'));
            $(this).find('[name="Admin_name"]').val($(e.relatedTarget).data('admin_name'));
            $(this).find('[name="Admin_tel"]').val($(e.relatedTarget).data('admin_tel'));
        });
    });
</script>

<div id="add-modal" class="modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">เพิ่มผู้ดูแลระบบ</h4>
            </div>
            <?= $form_open ?>
            <div class="modal-body">
                <div class="form-group">
                    <label class="control-label col-md-2">User ID</label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <?= $input['Admin_id'] ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">Password</label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            <?= $input['Admin_pass'] ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">ชื่อ</label>
                    <div class="col-md-5">
                        <?= $input['Admin_name'] ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">เบอร์โทรศัพท์</label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                            <?= $input['Admin_tel'] ?>
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
                <h4 class="modal-title">แก้ไขผู้ดูแลระบบ</h4>
            </div>
            <?= $form_open ?>
            <div class="modal-body">
                <div class="form-group">
                    <label class="control-label col-md-2">User ID</label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <?= $input['Admin_id'] ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">Password</label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            <?= $input['Admin_pass'] ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">ชื่อ</label>
                    <div class="col-md-5">
                        <?= $input['Admin_name'] ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">เบอร์โทรศัพท์</label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                            <?= $input['Admin_tel'] ?>
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

