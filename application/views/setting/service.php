<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            บริการ
            <small>ตั้งค่าระบบ</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-shopping-cart"></i> บริการ</a></li>
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
                        <h3 class="box-title">รายการบริการ</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#add-modal"><i class="fa fa-plus"></i> เพิ่มบริการ</button>
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered DataTable" width="100%">
                            <thead>
                            <th>รหัสบริการ</th>
                            <th>ชื่อเรียก</th>
                            <th>ราคา(บาท)</th>
                            <th>ประกัน(เดือน)</th>
                            <th></th>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($service as $row) {
                                    $pre = 'data-Serv_id="' . $row['Serv_id'] . '" ';
                                    $pre .= 'data-Serv_name="' . $row['Serv_name'] . '" ';
                                    $pre .= 'data-Serv_price="' . $row['Serv_price'] . '" ';
                                    $pre .= 'data-Serv_guarantee="' . $row['Serv_guarantee'] . '" ';
                                    ?>
                                    <tr>
                                        <td class="text-center"><?= $row['Serv_id'] ?></td>
                                        <td><?= $row['Serv_name'] ?></td>
                                        <td><?= $row['Serv_price'] ?></td>
                                        <td class="text-center"><?= $row['Serv_guarantee'] ?></td>
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
            $(this).find('[name="Serv_id"]').prop('readonly', true);
            $(this).find('[name="Serv_id"]').val($(e.relatedTarget).data('serv_id'));
            $(this).find('[name="Serv_name"]').val($(e.relatedTarget).data('serv_name'));
            $(this).find('[name="Serv_price"]').val($(e.relatedTarget).data('serv_price'));
            $(this).find('[name="Serv_guarantee"]').val($(e.relatedTarget).data('serv_guarantee'));
        });
    });
</script>

<div id="add-modal" class="modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">เพิ่มบริการ</h4>
            </div>
            <?= $form_open ?>
            <div class="modal-body">
                <div class="form-group">
                    <label class="control-label col-md-2">รหัสบริการ</label>
                    <div class="col-md-2">
                        <?= $input['Serv_id'] ?>
                    </div>
                    <label class="control-label col-md-2">ชื่อเรียก</label>
                    <div class="col-md-6">
                        <?= $input['Serv_name'] ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">ราคา</label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <?= $input['Serv_price'] ?>
                            <span class="input-group-addon">บาท</span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-2">ประกัน</label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <?= $input['Serv_guarantee'] ?>
                            <span class="input-group-addon">เดือน</span>
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
                <h4 class="modal-title">แก้ไขบริการ</h4>
            </div>
            <?= $form_open ?>
            <div class="modal-body">
                <div class="form-group">
                    <label class="control-label col-md-2">รหัสบริการ</label>
                    <div class="col-md-2">
                        <?= $input['Serv_id'] ?>
                    </div>
                    <label class="control-label col-md-2">ชื่อเรียก</label>
                    <div class="col-md-6">
                        <?= $input['Serv_name'] ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">ราคา</label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <?= $input['Serv_price'] ?>
                            <span class="input-group-addon">บาท</span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-2">ประกัน</label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <?= $input['Serv_guarantee'] ?>
                            <span class="input-group-addon">เดือน</span>
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

