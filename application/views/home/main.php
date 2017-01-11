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
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3><?= $reserve ?></h3>
                        <p>จองคิวไว้</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-book"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-teal">
                    <div class="inner">
                        <h3><?= $waiting ?></h3>
                        <p>รอคิว</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-pause"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3><?= $cancel ?></h3>
                        <p>ยกเลิก</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-ban"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3><?= $complete ?></h3>
                        <p>สำเร็จ</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-check"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div><!-- ./col -->
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
        
        $(".textarea").wysihtml5();
        $(".timepicker").timepicker({showInputs: false});
        $(".datepicker").datepicker({autoConversionField: false});

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        });
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
            checkboxClass: 'icheckbox_minimal-red',
            radioClass: 'iradio_minimal-red'
        });
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
        });

        $('#cancel').on('show.bs.modal', function (e) {
            $(this).find("#quotation_id").val($(e.relatedTarget).data('quotation_id'));
            $(this).find("#quotation_date").html($(e.relatedTarget).data('quotation_date'));
            $(this).find("#Serv_name").html($(e.relatedTarget).data('serv_name'));
            $(this).find("#Cus_name").html($(e.relatedTarget).data('cus_name'));
            $(this).find("#Cus_tel").html($(e.relatedTarget).data('cus_tel'));
        });

        $('#complete').on('show.bs.modal', function (e) {
            $(this).find("#quotation_detail").html('บริการ:' + $(e.relatedTarget).data('serv_name') + ' ' + $(e.relatedTarget).data('cus_name'));
            $(this).find("[name='quotation_id']").val($(e.relatedTarget).data('quotation_id'));
        });



        //Initialize Select2 Elements
        $(".select2").select2();

        $(".knob").knob({
            /*change : function (value) {
             //console.log("change : " + value);
             },
             release : function (value) {
             console.log("release : " + value);
             },
             cancel : function () {
             console.log("cancel : " + this.value);
             },*/
            draw: function () {

                // "tron" case
                if (this.$.data('skin') == 'tron') {

                    var a = this.angle(this.cv)  // Angle
                            , sa = this.startAngle          // Previous start angle
                            , sat = this.startAngle         // Start angle
                            , ea                            // Previous end angle
                            , eat = sat + a                 // End angle
                            , r = true;

                    this.g.lineWidth = this.lineWidth;

                    this.o.cursor
                            && (sat = eat - 0.3)
                            && (eat = eat + 0.3);

                    if (this.o.displayPrevious) {
                        ea = this.startAngle + this.angle(this.value);
                        this.o.cursor
                                && (sa = ea - 0.3)
                                && (ea = ea + 0.3);
                        this.g.beginPath();
                        this.g.strokeStyle = this.previousColor;
                        this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false);
                        this.g.stroke();
                    }

                    this.g.beginPath();
                    this.g.strokeStyle = r ? this.o.fgColor : this.fgColor;
                    this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false);
                    this.g.stroke();

                    this.g.lineWidth = 2;
                    this.g.beginPath();
                    this.g.strokeStyle = this.o.fgColor;
                    this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
                    this.g.stroke();

                    return false;
                }
            }
        });
        /* END JQUERY KNOB */

        /*
         * DONUT CHART
         * -----------
         */

        var donutData = [
<?php
foreach ($service as $row) {
    $color = '#357ca5';
    if ($row['Serv_id'] == 1) {
        $color = '#30bbbb';
    } else if ($row['Serv_id'] == 2) {
        $color = '#00a7d0';
    } else if ($row['Serv_id'] == 3) {
        $color = '#008d4c';
    } else if ($row['Serv_id'] == 4) {
        $color = '#ca195a';
    } else if ($row['Serv_id'] == 5) {
        $color = '#555299';
    }
    echo '{label: "' . $row['Serv_name'] . '", data: ' . $row['num'] . ', color: "' . $color . '"},';
}
?>
        ];
        $.plot("#donut-chart", donutData, {
            series: {
                pie: {
                    show: true,
                    radius: 1,
                    innerRadius: 0.5,
                    label: {
                        show: true,
                        radius: 2 / 3,
                        formatter: labelFormatter,
                        threshold: 0.1
                    }

                }
            },
            legend: {
                show: false
            }
        });
        /*
         * END DONUT CHART
         */

    });

    /*
     * Custom Label formatter
     * ----------------------
     */
    function labelFormatter(label, series) {
        return '<div style="font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;">'
                + label
                + "<br>"
                + Math.round(series.percent) + "%</div>";
    }
</script>
<div id="complete" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <?= $form_complete ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">คุณบริการเรียบร้อยแล้ว ใช่หรือไม่</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="control-label col-md-2">รหัสการจอง</label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-book"></i></span>
                            <?= $input_complete['quotation_id'] ?>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <span id="quotation_detail"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">วันที่บริการ</label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <?= $input_complete['real_date'] ?>
                        </div>
                    </div>
                </div>   
                <div class="form-group">
                    <label class="control-label col-md-2">เวลาบริการ</label>
                    <div class="col-md-5">
                        <div id="sandbox-container" style="position: relative;">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                <?= $input_complete['real_date_time'] ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">ราคาที่คิดจริง</label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <?= $input_complete['real_price'] ?>
                            <span class="input-group-addon">บาท</span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">ระยะประกัน</label>
                    <div class="col-md-5">
                        <div class="input-group">
                            <?= $input_complete['rear_guarantee'] ?>
                            <span class="input-group-addon">เดือน</span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">หมายเหตุ</label>
                    <div class="col-md-10">
                        <?= $input_complete['remark'] ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary pull-left">ยืนยัน</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
            </div>
            <?= $form_close ?>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<div id="cancel" class="modal fade modal-danger">
    <div class="modal-dialog">
        <div class="modal-content">
            <?= $form_cancel ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">คุณต้องการยกเลิกนัด ใช่หรือไม่</h4>
            </div>
            <div class="modal-body">
                <dl class="dl-horizontal">
                    <dt>บริการ</dt>
                    <dd id="Serv_name"></dd>
                    <dt>วันที่เวลานัด</dt>
                    <dd id="quotation_date"></dd>
                    <dt>ลูกค้า</dt>
                    <dd id="Cus_name"></dd>
                    <dt>เบอร์ติดต่อ</dt>
                    <dd id="Cus_tel"></dd>
                </dl>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="quotation_id" name="quotation_id" />
                <button type="submit" class="btn btn-outline pull-left">ยืนยัน</button>
                <button type="button" class="btn btn-outline" data-dismiss="modal">ยกเลิก</button>
            </div>
            <?= $form_close ?>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>