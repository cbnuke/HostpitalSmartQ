<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            รายชื่อผู้ป่วย
            <small>ส่วนจัดการ</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-edit"></i> รายชื่อผู้ป่วย</a></li>
            <li class="active">ส่วนจัดการ</li>
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
                        <span class="info-box-text">ผู้ป่วยทั้งหมด</span>
                        <span class="info-box-number">0</span>
                    </div><!-- /.info-box-content -->
                </div>
            </div><!-- ./col -->
            <div class="col-sm-4">
                <!-- info box -->
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-plus-square"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">ผู้ป่วยใหม่วันนี้</span>
                        <span class="info-box-number">0</span>
                    </div><!-- /.info-box-content -->
                </div>
            </div><!-- ./col -->
            <div class="col-sm-4">
                <!-- info box -->
                <div class="info-box">
                    <span class="info-box-icon bg-blue"><i class="fa fa-plus-square"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">ผู้ป่วยใหม่เดือนนี้</span>
                        <span class="info-box-number">0</span>
                    </div><!-- /.info-box-content -->
                </div>
            </div><!-- ./col -->
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">รายชื่อผู้ป่วย</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#add-modal"><i class="fa fa-user-plus"></i> เพิ่มผู้ป่วยใหม่</button>
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered table-hover DataTable">
                            <thead>
                                <tr>
                                    <th>HN</th>
                                    <th>Name</th>
                                    <th>Age</th>
                                    <th>Tel</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($checkPatient as $row) { ?>
                                    <tr>
                                        <td><?= $row['pat_hn'] ?></td>
                                        <td><?= $row['pat_firstname'] . ' ' . $row['pat_lastname'] ?></td>
                                        <td><?= $row['pat_age'] ?></td>
                                        <td><?= $row['pat_tel'] ?></td>
                                        <td class="text-center">
                                            <?php
                                            $pre_data = 'data-pat_hn="' . $row['pat_hn'] . '"';
                                            $pre_data .= 'data-pat_pass="' . $row['pat_pass'] . '"';
                                            $pre_data .= 'data-pat_firstname="' . $row['pat_firstname'] . '"';
                                            $pre_data .= 'data-pat_lastname="' . $row['pat_lastname'] . '"';
                                            $pre_data .= 'data-pat_tel="' . $row['pat_tel'] . '"';
                                            $pre_data .= 'data-pat_age="' . $row['pat_age'] . '"';
                                            ?>
                                            <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#edit-modal" <?= $pre_data ?>><i class="fa fa-edit"></i></button>
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
            <form action="<?= base_url('register') ?>" id="addForm" class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">HN :</label>
                        <div class="col-sm-10">
                            <input type="text" name="pat_hn" class="form-control" placeholder="LHospitalNumber">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">ID</label>
                        <div class="col-sm-10">
                            <input type="text" name="pat_pass" class="form-control" placeholder="ID number">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">FirstName</label>
                        <div class="col-sm-10">
                            <input type="text" name="pat_firstname" class="form-control" placeholder="Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">LastName</label>
                        <div class="col-sm-10">
                            <input type="text" name="pat_lastname" class="form-control" placeholder="LastName">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Age</label>
                        <div class="col-sm-10">
                            <input type="text" name="pat_age" class="form-control" placeholder="Age">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Telephone number</label>
                        <div class="col-sm-10">
                            <input type="text" name="pat_tel" class="form-control" placeholder="Telephone number">
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
                <h4 class="modal-title">แก้ไขผู้ป่วย</h4>
            </div>
            <form action="<?= base_url('register') ?>" id="addForm" class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">HN :</label>
                        <div class="col-sm-10">
                            <input type="text" name="pat_hn" class="form-control" placeholder="HospitalNumber" readonly="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">ID</label>
                        <div class="col-sm-10">
                            <input type="text" name="pat_pass" class="form-control" placeholder="ID number" readonly="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">FirstName</label>
                        <div class="col-sm-10">
                            <input type="text" name="pat_firstname" class="form-control" placeholder="Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">LastName</label>
                        <div class="col-sm-10">
                            <input type="text" name="pat_lastname" class="form-control" placeholder="LastName">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Age</label>
                        <div class="col-sm-10">
                            <input type="text" name="pat_age" class="form-control" placeholder="Age">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Telephone number</label>
                        <div class="col-sm-10">
                            <input type="text" name="pat_tel" class="form-control" placeholder="Telephone number">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="mode" value="edit"/>
                    <button type="reset" class="btn btn-default pull-left" data-dismiss="modal">ยกเลิก</button>
                    <button type="submit" class="btn btn-primary">บันทึก</button>
                </div>
            </form>        
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


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

        $('#edit-modal').on('show.bs.modal', function (e) {
            $(this).find("[name='pat_hn']").val($(e.relatedTarget).data('pat_hn'));
            $(this).find("[name='pat_pass']").val($(e.relatedTarget).data('pat_pass'));
            $(this).find("[name='pat_firstname']").val($(e.relatedTarget).data('pat_firstname'));
            $(this).find("[name='pat_lastname']").val($(e.relatedTarget).data('pat_lastname'));
            $(this).find("[name='pat_age']").val($(e.relatedTarget).data('pat_age'));
            $(this).find("[name='pat_tel']").val($(e.relatedTarget).data('pat_tel'));
        });
    });
</script>      




