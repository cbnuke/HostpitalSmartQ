$(function () {
    console.log("Runing...");

    /*
     * Event handle
     */
    $(".textarea").wysihtml5({"image": false});
    $(".datepicker").datepicker({regional: 'th', isBE: true, autoConversionField: false});
    $(".DataTable").DataTable({
        "ajax": "customer/ajax_customer",
        "columns": [
            {"data": "col1"},
            {"data": "col2"},
            {"data": "col3"},
            {"data": "col4"}
        ]
    });
    $("#imgCusSelect").change(function (e) {
        files = e.target.files;
        if (files[0].type.match('image.*')) {
            var reader = new FileReader();
            // Closure to capture the file information.
            reader.onload = (function (theFile) {
                return function (e) {
                    // Render thumbnail.
                    $("#imgCus").attr("src", e.target.result);
                };
            })(files[0]);
            // Read in the image file as a data URL.
            reader.readAsDataURL(files[0]);
        }
    });
    $("#imgCusSelectEdit").change(function (e) {
        files = e.target.files;
        if (files[0].type.match('image.*')) {
            var reader = new FileReader();
            // Closure to capture the file information.
            reader.onload = (function (theFile) {
                return function (e) {
                    // Render thumbnail.
                    $("#imgCusEdit").attr("src", e.target.result);
                };
            })(files[0]);
            // Read in the image file as a data URL.
            reader.readAsDataURL(files[0]);
        }
    });
    $('#addForm').ajaxForm({
        beforeSend: function () {
            $('#example-modal').modal('hide');
            $('#progress-modal').modal({
                backdrop: 'static',
                keyboard: false,
                show: true
            });
        },
        uploadProgress: function (event, position, total, percentComplete) {
            $('#progress_bar').css('width', percentComplete + '%');
        },
        complete: function (xhr) {
            console.log(xhr.responseText);
            if (xhr.responseText == "success") {
                $('#progress-modal .modal-title').html('เพิ่มลูกค้าสำเร็จ');
                $('#progress-modal .modal-body').html('<i class="text-center fa fa-check-circle fa-4x"></i>');
                $(".DataTable").DataTable().ajax.reload();
                $('#addForm').clearForm();
                $('#add-modal').modal('hide');
            } else {
                $('#progress-modal .modal-title').html('เพิ่มลูกค้าไม่สำเร็จ');
                $('#progress-modal .modal-body').html('<i class="text-center fa fa-ban fa-4x"></i>');
            }
            $('#progress-modal').modal('hide');
        }
    });
    $('#editForm').ajaxForm({
        beforeSend: function () {
            $('#example-modal').modal('hide');
            $('#progress-modal').modal({
                backdrop: 'static',
                keyboard: false,
                show: true
            });
        },
        uploadProgress: function (event, position, total, percentComplete) {
            $('#progress_bar').css('width', percentComplete + '%');
        },
        complete: function (xhr) {
            console.log(xhr.responseText);
            if (xhr.responseText == "success") {
                $('#progress-modal .modal-title').html('แก้ไขลูกค้าสำเร็จ');
                $('#progress-modal .modal-body').html('<i class="text-center fa fa-check-circle fa-4x"></i>');
                $(".DataTable").DataTable().ajax.reload();
            } else {
                $('#progress-modal .modal-title').html('แก้ไขลูกค้าไม่สำเร็จ');
                $('#progress-modal .modal-body').html('<i class="text-center fa fa-ban fa-4x"></i>');
            }
            $('#progress-modal').modal('hide');
        }
    });
    $('#edit-modal').on('show.bs.modal', function (e) {
        $(this).find("#imgCusEdit").attr('src', $(e.relatedTarget).data('personalimage'));
        $(this).find("[name='PersonalID']").val($(e.relatedTarget).data('personalid'));
        $(this).find("#co_TitleThai").combobox('setValue', $(e.relatedTarget).data('titlethai'));
        $(this).find("#co_TitleEng").combobox('setValue', $(e.relatedTarget).data('titleeng'));
        $(this).find("[name='FirstNameT']").val($(e.relatedTarget).data('firstnamet'));
        $(this).find("[name='LastNameT']").val($(e.relatedTarget).data('lastnamet'));
        $(this).find("[name='FirstNameE']").val($(e.relatedTarget).data('firstnamee'));
        $(this).find("[name='LastNameE']").val($(e.relatedTarget).data('lastnamee'));
        $(this).find("[name='NickName']").val($(e.relatedTarget).data('nickname'));
        $(this).find("[name='BirthDate']").val($(e.relatedTarget).data('birthdate'));
        $(this).find("#co_Sex").combobox('setValue', $(e.relatedTarget).data('sex'));
        $(this).find("[name='Occupation']").val($(e.relatedTarget).data('occupation'));
        $(this).find("#co_Nationality").combobox('setValue', $(e.relatedTarget).data('nationality'));
        $(this).find("#co_Religion").combobox('setValue', $(e.relatedTarget).data('religion'));
        $(this).find("[name='HomePhone']").val($(e.relatedTarget).data('homephone'));
        $(this).find("[name='MobinePhone']").val($(e.relatedTarget).data('mobinephone'));
        $(this).find("[name='CurrentAddress']").val($(e.relatedTarget).data('currentaddress'));
        $(this).find("[name='EMailAddress']").val($(e.relatedTarget).data('emailaddress'));
        $(this).find("[name='MilitaryStatus']").val($(e.relatedTarget).data('militarystatus'));
        $(this).find("[name='Comment']").data("wysihtml5").editor.setValue($(e.relatedTarget).data('comment'));
    });
});

/*
 * Defind function
 */
var previos;

function CustomerInfo(PersonalID) {
    new_customer = false;
    if (previos != PersonalID) {
        previos = PersonalID;
        new_customer = true;
    }
    //Find the box parent        
    console.log(PersonalID);
    var box = $('#user_info');
    var loading = box.find(".overlay");
    //Find the body and the footer
    var bf = box.find(".box-body, .box-footer");
    if (!box.hasClass("collapsed-box")) {
        if (new_customer == true) {
            loading.removeClass("hidden");
            $.ajax({
                url: 'customer/ajax_customer_info/' + PersonalID,
                data: {
                    format: 'json'
                },
                error: function (jqXhr) {
                    console.log('error');
                },
                success: function (data) {
                    console.log('success');
                    var obj = jQuery.parseJSON(data);
                    UpdateBoxCustomerInfo(obj);
                },
                complete: function (jqXHR) {
                    loading.addClass("hidden");
                    console.log('complete');
                },
                type: 'GET'
            });
        } else {
            loading.addClass("hidden");
            bf.slideUp(300, function () {
                box.addClass("collapsed-box");
            });
        }
    } else {
        loading.removeClass("hidden");
        bf.slideDown(300, function () {
            box.removeClass("collapsed-box");
        });

        $.ajax({
            url: 'customer/ajax_customer_info/' + PersonalID,
            data: {
                format: 'json'
            },
            error: function (jqXhr) {
                console.log('error');
            },
            success: function (data) {
                console.log('success');
                var obj = jQuery.parseJSON(data);
                UpdateBoxCustomerInfo(obj);
            },
            complete: function (jqXHR) {
                loading.addClass("hidden");
                console.log('complete');
            },
            type: 'GET'
        });
    }
}
function UpdateBoxCustomerInfo(json) {
    console.log('UpdateBoxCustomerInfo');
    $("#txt_PersonalImage").attr("src", json.data.PersonalImage);
    $('#txt_PersonalID').html(json.data.PersonalID);
    $('#txt_NameT').html(json.data.TitleThai + json.data.FirstNameT + " " + json.data.LastNameT);
    $('#txt_NameE').html(json.data.TitleEng + json.data.FirstNameE + " " + json.data.LastNameE);
    $('#txt_CurrentAddress').html(json.data.CurrentAddress);
    $('#txt_HomePhone').html(json.data.HomePhone);
    $('#txt_MobinePhone').html(json.data.MobinePhone);
    $('#txt_Nationality').html(json.data.Nationality);
    $('#txt_Religion').html(json.data.Religion);
    $('#txt_Sex').html(json.data.Sex);
    $('#txt_BirthDate').html(json.data.BirthDate);
    $('#txt_NickName').html(json.data.NickName);
    $('#txt_Occupation').html(json.data.Occupation);
    $('#txt_Comment').html(json.data.Comment);
}
