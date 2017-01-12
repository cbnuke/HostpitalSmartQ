<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            OPD <?= $checkOpdInfo['dep_id'] ?> : <?= $checkOpdInfo['dep_name_th'] ?>
            <small><?= $checkOpdInfo['dep_name_en'] ?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-edit"></i>  <?= $checkOpdInfo['dep_name_th'] ?></a></li>
            <li class="active"><?= $checkOpdInfo['dep_name_en'] ?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-sm-4">
                <!-- info box -->
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">ผู้ป่วยที่ลงทะเบียน</span>
                        <span class="info-box-number"><?= $all ?></span>
                    </div><!-- /.info-box-content -->
                </div>
            </div><!-- ./col -->
            <div class="col-sm-4">
                <!-- info box -->
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-check-square"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">ผู้ป่วยที่ตรวจแล้ว</span>
                        <span class="info-box-number"><?= $done ?></span>
                    </div><!-- /.info-box-content -->
                </div>
            </div><!-- ./col -->
            <div class="col-sm-4">
                <!-- info box -->
                <div class="info-box">
                    <span class="info-box-icon bg-blue"><i class="fa fa-plus-square"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">ผู้ป่วยที่ยังไม่ตรวจ</span>
                        <span class="info-box-number"><?= $wait ?></span>
                    </div><!-- /.info-box-content -->
                </div>
            </div><!-- ./col -->
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">ลำดับคิวผู้ป่วย</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#add-modal"><i class="fa fa-user-plus"></i> รับผู้ป่วย</button>
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered table-hover DataTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>HN</th>
                                    <th>Name</th>
                                    <th>Age</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($checkPatientInOpd as $row) { ?>
                                    <tr>
                                        <td class="text-center"><?= (!empty($row['qd_order_number'])) ? $row['qd_order_number'] : '<span style="display: none;">99999</span>' ?></td>
                                        <td><?= $row['pat_hn'] ?></td>
                                        <td><?= $row['pat_firstname'] . ' ' . $row['pat_lastname'] ?></td>
                                        <td><?= $row['pat_age'] ?></td>
                                        <td><?= $row['qd_status'] ?></td>
                                        <td class="text-center">
                                            <?php
                                            $pre_data = 'data-pat_hn="' . $row['pat_hn'] . '"';
                                            $pre_data .= 'data-qd_id="' . $row['qd_id'] . '"';
                                            $pre_data .= 'data-pat_firstname="' . $row['pat_firstname'] . '"';
                                            $pre_data .= 'data-pat_lastname="' . $row['pat_lastname'] . '"';
                                            $pre_data .= 'data-pat_tel="' . $row['pat_tel'] . '"';
                                            $pre_data .= 'data-pat_age="' . $row['pat_age'] . '"';
                                            ?>
                                            <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#edit-modal" <?= $pre_data ?>><i class="fa fa-edit"></i></button>
                                            <?php if ($row['qd_status'] == 'wait') { ?>
                                                <a href="<?= base_url('opd/up/' . $row['dep_id'] . '/' . $row['qd_id']) ?>" class="btn btn-sm btn-info"><i class="fa fa-chevron-circle-up"></i></a>
                                                <a href="<?= base_url('opd/down/' . $row['dep_id'] . '/' . $row['qd_id']) ?>" class="btn btn-sm btn-info"><i class="fa fa-chevron-circle-down"></i></a>
                                                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#send-modal" <?= $pre_data ?>><i class="fa fa-paper-plane"></i></button>
                                                <button class="btn btn-sm bg-maroon" data-toggle="modal" data-target="#appointment-modal" <?= $pre_data ?>><i class="fa fa-sticky-note"></i></button>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div><!-- /.box-body -->
                </div>
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<div id="add-modal" class="modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">เพิ่มผู้ป่วย</h4>
            </div>
            <form action="<?= base_url(str_replace(base_url(), '', current_url())) ?>" id="addForm" class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">HN :</label>
                        <div class="col-sm-10">
                            <input type="text" name="pat_hn" class="form-control" placeholder="LHospitalNumber">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="mode" value="add"/>
                    <button type="reset" class="btn btn-default pull-left" data-dismiss="modal">ยกเลิก</button>
                    <button type="submit" class="btn btn-primary">เพิ่ม</button>
                </div>
            </form>        
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="edit-modal" class="modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">แจกคิว</h4>
            </div>
            <form action="<?= base_url(str_replace(base_url(), '', current_url())) ?>" id="addForm" class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">HN :</label>
                        <div class="col-sm-10">
                            <input type="text" name="pat_hn" class="form-control" placeholder="LHospitalNumber">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="mode" value="wait"/>
                    <input type="hidden" name="qd_id"/>
                    <button type="reset" class="btn btn-default pull-left" data-dismiss="modal">ยกเลิก</button>
                    <button type="submit" class="btn btn-primary">แจก</button>
                </div>
            </form>        
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="send-modal" class="modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">ส่งผู้ป่วยต่อไปแผนกอื่น</h4>
            </div>
            <form action="<?= base_url(str_replace(base_url(), '', current_url())) ?>" id="addForm" class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">HN :</label>
                        <div class="col-sm-10">
                            <input type="text" name="pat_hn" class="form-control" placeholder="LHospitalNumber">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">OPD :</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="dep_id">
                                <?php foreach ($checkDepartment as $row) { ?>
                                    <option value="<?= $row['dep_id'] ?>"><?= $row['dep_name_th'] ?> (รอตรวจ <?= ($row['wait']) ?>)</option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="mode" value="send"/>
                    <input type="hidden" name="qd_id"/>
                    <button type="reset" class="btn btn-default pull-left" data-dismiss="modal">ยกเลิก</button>
                    <button type="submit" class="btn btn-primary">แจก</button>
                </div>
            </form>        
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="appointment-modal" class="modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">นัดหมายผู้ป่วย</h4>
            </div>
            <form action="<?= base_url(str_replace(base_url(), '', current_url())) ?>" id="addForm" class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">HN :</label>
                        <div class="col-sm-10">
                            <input type="text" name="pat_hn" class="form-control" placeholder="LHospitalNumber">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">วันที่นัด</label>
                        <div class="col-md-5">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="text" name="app_date" class="form-control datepicker">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-2">รายละเอียด</label>
                        <div class="col-md-10">
                            <textarea name="detail" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="mode" value="appointment"/>
                    <input type="hidden" name="dep_id" value="<?= $dep_id ?>"/>
                    <button type="reset" class="btn btn-default pull-left" data-dismiss="modal">ยกเลิก</button>
                    <button type="submit" class="btn btn-primary">นัดหมาย</button>
                </div>
            </form>        
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
    $(function () {
        $(".DataTable").DataTable({
            responsive: true
        });

        $(".datepicker").datepicker({regional: 'th', autoConversionField: false});

        $('#edit-modal').on('show.bs.modal', function (e) {
            $(this).find("[name='pat_hn']").val($(e.relatedTarget).data('pat_hn'));
            $(this).find("[name='qd_id']").val($(e.relatedTarget).data('qd_id'));
        });

        $('#send-modal').on('show.bs.modal', function (e) {
            $(this).find("[name='pat_hn']").val($(e.relatedTarget).data('pat_hn'));
            $(this).find("[name='qd_id']").val($(e.relatedTarget).data('qd_id'));
        });

        $('#appointment-modal').on('show.bs.modal', function (e) {
            $(this).find("[name='pat_hn']").val($(e.relatedTarget).data('pat_hn'));
        });
    });
</script>      




