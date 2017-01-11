<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            ตารางนัด
            <small>ส่วนจัดการหลัก</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-calendar"></i> ตารางนัด</a></li>
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
                        <h3 class="box-title">ปฏิทินตารางนัด</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#add-modal"><i class="fa fa-plus"></i> เพิ่มตารางนัด</button>
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <!-- THE CALENDAR -->
                        <div id="calendar"></div>
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
        $(".textarea").wysihtml5();
        $(".select2").select2();
        $(".timepicker").timepicker({showInputs: false});
        $(".datepicker").datepicker({regional: 'th', autoConversionField: false});
        $(".DataTable").DataTable();
        $('#edit-modal').on('show.bs.modal', function (e) {
            $(this).find('[name="Cus_id"]').prop('readonly', true);
            $(this).find('[name="Cus_id"]').val($(e.relatedTarget).data('cus_id'));
            $(this).find('[name="Cus_name"]').val($(e.relatedTarget).data('cus_name'));
            $(this).find('[name="Cus_nick"]').val($(e.relatedTarget).data('cus_nick'));
            $(this).find('[name="Cus_tel"]').val($(e.relatedTarget).data('cus_tel'));
        });

        /* initialize the calendar
         -----------------------------------------------------------------*/
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            buttonText: {
                today: 'today',
                month: 'month',
                week: 'week',
                day: 'day'
            },
            //Random default events
            events: [
<?php
foreach ($appointment as $row) {
    $temp = explode(' ', $row['quotation_date']);
    $date = explode('-', $temp[0]);
    $time = explode(':', $temp[1]);
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

    echo '{title: "(' . $row['Serv_name'] . ') ' . $row['Cus_name'] . '",start: new Date(' . ($date[0] + 0) . ', ' . ($date[1] - 1) . ', ' . ($date[2] + 0) . ', ' . $time[0] . ', ' . $time[1] . '),allDay: false,backgroundColor: "' . $color . '",borderColor: "' . $color . '" },';
}
?>
            ],
            editable: false,
            droppable: true, // this allows things to be dropped onto the calendar !!!
            drop: function (date, allDay) { // this function is called when something is dropped

                // retrieve the dropped element's stored Event Object
                var originalEventObject = $(this).data('eventObject');

                // we need to copy it, so that multiple events don't have a reference to the same object
                var copiedEventObject = $.extend({}, originalEventObject);

                // assign it the date that was reported
                copiedEventObject.start = date;
                copiedEventObject.allDay = allDay;
                copiedEventObject.backgroundColor = $(this).css("background-color");
                copiedEventObject.borderColor = $(this).css("border-color");

                // render the event on the calendar
                // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

                // is the "remove after drop" checkbox checked?
                if ($('#drop-remove').is(':checked')) {
                    // if so, remove the element from the "Draggable Events" list
                    $(this).remove();
                }

            },
            dayClick: function (date, jsEvent, view) {
                $('#add-modal').modal('show');
                $(".datepicker").datepicker('setDate', new Date(date.format()));
            }
        });
    });
</script>

<div id="add-modal" class="modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">เพิ่มตารางนัด</h4>
            </div>
            <div class="modal-body">
                <div class="nav-tabs-custom">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#new" aria-controls="new" role="tab" data-toggle="tab">ลูกค้าใหม่</a></li>
                        <li role="presentation"><a href="#old" aria-controls="old" role="tab" data-toggle="tab">ลูกค้าเก่า</a></li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="new">
                            <?= $form_open_new ?>
                            <div class="form-group">
                                <label class="control-label col-md-2">รหัสการจอง</label>
                                <div class="col-md-5">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-book"></i></span>
                                        <?= $input['quotation_id'] ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">รหัสสมาชิก</label>
                                <div class="col-md-5">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <?= $input_customer['Cus_id'] ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">ชื่อ - นานสกุล</label>
                                <div class="col-md-5">
                                    <?= $input_customer['Cus_name'] ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">ชื่อเล่น</label>
                                <div class="col-md-5">
                                    <?= $input_customer['Cus_nick'] ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">เบอร์โทรศัพท์</label>
                                <div class="col-md-5">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                        <?= $input_customer['Cus_tel'] ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">บริการ</label>
                                <div class="col-md-5">
                                    <?= $input['Serv_id'] ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">วันที่นัด</label>
                                <div class="col-md-5">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <?= $input['quotation_date'] ?>
                                    </div>
                                </div>
                            </div>   
                            <div class="form-group">
                                <label class="control-label col-md-2">เวลานัด</label>
                                <div class="col-md-5">
                                    <div id="sandbox-container" style="position: relative;">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                            <?= $input['quotation_time'] ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">ราคาที่ตกลง</label>
                                <div class="col-md-5">
                                    <div class="input-group">
                                        <?= $input['quotation_price'] ?>
                                        <span class="input-group-addon">บาท</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">หมายเหตุ</label>
                                <div class="col-md-10">
                                    <?= $input['remark'] ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">สถานะ</label>
                                <div class="col-md-10">
                                    <?= $input['status'] ?>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="mode" value="add-new"/>
                                <button type="submit" class="btn btn-success pull-left">เพิ่ม</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
                            </div>
                            <?= $form_close ?>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="old">
                            <?= $form_open_old ?>
                            <div class="form-group">
                                <label class="control-label col-md-2">รหัสการจอง</label>
                                <div class="col-md-5">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-book"></i></span>
                                        <?= $input['quotation_id'] ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">ลูกค้า</label>
                                <div class="col-md-5">
                                    <?= $input['Cus_id'] ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">บริการ</label>
                                <div class="col-md-5">
                                    <?= $input['Serv_id'] ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">วันที่นัด</label>
                                <div class="col-md-5">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <?= $input['quotation_date'] ?>
                                    </div>
                                </div>
                            </div>   
                            <div class="form-group">
                                <label class="control-label col-md-2">เวลานัด</label>
                                <div class="col-md-5">
                                    <div id="sandbox-container" style="position: relative;">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                            <?= $input['quotation_time'] ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">ราคาที่ตกลง</label>
                                <div class="col-md-5">
                                    <div class="input-group">
                                        <?= $input['quotation_price'] ?>
                                        <span class="input-group-addon">บาท</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">หมายเหตุ</label>
                                <div class="col-md-10">
                                    <?= $input['remark'] ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">สถานะ</label>
                                <div class="col-md-10">
                                    <?= $input['status'] ?>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="mode" value="add"/>
                                <button type="submit" class="btn btn-success pull-left">เพิ่ม</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
                            </div>
                            <?= $form_close ?>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="edit-modal" class="modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">แก้ไขตารางนัด</h4>
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

