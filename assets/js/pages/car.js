$(function () {
    $(document).bind('dragover', function (e) {
        var dropZone = $('#dropzone'),
                timeout = window.dropZoneTimeout;
        if (!timeout) {
            dropZone.addClass('in');
        } else {
            clearTimeout(timeout);
        }
        var found = false,
                node = e.target;
        do {
            if (node === dropZone[0]) {
                found = true;
                break;
            }
            node = node.parentNode;
        } while (node != null);
        if (found) {
            dropZone.addClass('hover');
        } else {
            dropZone.removeClass('hover');
        }
        window.dropZoneTimeout = setTimeout(function () {
            window.dropZoneTimeout = null;
            dropZone.removeClass('in hover');
        }, 100);
    });
    $(document).bind('drop dragover', function (e) {
        e.preventDefault();
    });
    $('#fileupload').fileupload({
        dropZone: $('#dropzone')
    });
//    // Initialize the jQuery File Upload widget:
//    $('#fileupload').fileupload({
//        // Uncomment the following to send cross-domain cookies:
//        //xhrFields: {withCredentials: true},
//        url: 'server/php/'
//    });
//
//    // Enable iframe cross-domain access via redirect option:
//    $('#fileupload').fileupload(
//            'option',
//            'redirect',
//            window.location.href.replace(
//                    /\/[^\/]*$/,
//                    '/cors/result.html?%s'
//                    )
//            );
//
//
//    // Load existing files:
//    $('#fileupload').addClass('fileupload-processing');
//    $.ajax({
//        // Uncomment the following to send cross-domain cookies:
//        //xhrFields: {withCredentials: true},
//        url: $('#fileupload').fileupload('option', 'url'),
//        dataType: 'json',
//        context: $('#fileupload')[0]
//    }).always(function () {
//        $(this).removeClass('fileupload-processing');
//    }).done(function (result) {
//        $(this).fileupload('option', 'done')
//                .call(this, $.Event('done'), {result: result});
//    });


    console.log("Runing...");
    var tab_container, li_tab_1, li_tab_2, li_tab_3, li_tab_4;
    var li_previous, li_next;
    var current_tab;
    init();

//    tab_container.find('li a[href*="tab_2"]').parents().addClass('disabled');
//    tab_container.find('li a[href$="tab_2"]').html('test');
//    console.log(tab_4);

    /*
     * Event handle
     */
    $(".DataTableTab1").DataTable({
        "ajax": "car/ajax_customer/1",
        "columns": [
            {"data": "col1"},
            {"data": "col2"},
            {"data": "col3"},
            {"data": "col4"}
        ]
    });
    $(".DataTableTab2").DataTable({
        "ajax": "car/ajax_customer/2",
        "columns": [
            {"data": "col1"},
            {"data": "col2"},
            {"data": "col3"},
            {"data": "col4"}
        ]
    });
    //Disable tab click when css has disabled
    $("li a[data-toggle=tab]").on("click", function (e) {
        if ($(this).closest("li").hasClass("disabled")) {
            console.log("Tab disabled");
            e.preventDefault();
            return false;
        }
        if (e.target.href.endsWith("1")) {
            current_tab = 1;
        }
        if (e.target.href.endsWith("2")) {
            current_tab = 2;
        }
        if (e.target.href.endsWith("3")) {
            current_tab = 3;
        }
        if (e.target.href.endsWith("4")) {
            current_tab = 4;
        }
        updatePreviousNext();
    });
    //Click li_previous
    li_previous.click(function (e) {
        if (current_tab > 1) {
            current_tab -= 1;
            $('.nav-tabs > .active').prev('li').find('a').trigger('click');
            updatePreviousNext();
        } else {
            e.preventDefault();
            return false;
        }
    });
    //Click li_next
    li_next.click(function (e) {
        if (current_tab < 4) {
            current_tab += 1;
            switch (current_tab) {
                case 2:
                    li_tab_2.removeClass('disabled');
                    break;
                case 3:
                    li_tab_3.removeClass('disabled');
                    break;
                case 4:
                    li_tab_4.removeClass('disabled');
                    break;
            }
            $('.nav-tabs > .active').next('li').find('a').trigger('click');
            updatePreviousNext();
        } else {
            e.preventDefault();
            return false;
        }
    });

    //Custom prototype to check endsWith
    String.prototype.endsWith = function (s) {
        return this.length >= s.length && this.substr(this.length - s.length) == s;
    }

    function updatePreviousNext() {
        if (current_tab > 1) {
            li_previous.removeClass('disabled');
        } else {
            li_previous.addClass('disabled');
        }

        if (current_tab < 4) {
            li_next.removeClass('disabled');
        } else {
            li_next.addClass('disabled');
        }
    }

    function init() {
        tab_container = $('#tab_container');
        li_tab_1 = tab_container.find('li a[href*="tab_1"]').parents();
        li_tab_2 = tab_container.find('li a[href*="tab_2"]').parents();
        li_tab_3 = tab_container.find('li a[href*="tab_3"]').parents();
        li_tab_4 = tab_container.find('li a[href*="tab_4"]').parents();
        li_tab_2.addClass('disabled');
        li_tab_3.addClass('disabled');
        li_tab_4.addClass('disabled');
        current_tab = 1;
        li_previous = $('#previous');
        li_next = $('#next');
        li_previous.addClass('disabled');

        //Input
        cusmoterID1 = $('#cusmoterID1');
        cusmoterID2 = $('#cusmoterID2');
    }
});

var previos;
var cusmoterID1, cusmoterID2;

function CustomerInfo(PersonalID, Tab) {
    console.log('CustomerInfo');
    new_customer = false;
    if (previos != PersonalID) {
        previos = PersonalID;
        new_customer = true;
    }
    //Find the box parent        
    console.log(PersonalID);
    if (Tab == 1) {
        var box = $('#user_info1');
    } else if (Tab == 2) {
        var box = $('#user_info2');
    }
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
                    if (Tab == 1) {
                        cusmoterID1.val(PersonalID);
                    } else if (Tab == 2) {
                        cusmoterID2.val(PersonalID);
                    }
                    UpdateBoxCustomerInfo(obj, Tab);
                },
                complete: function (jqXHR) {
                    loading.addClass("hidden");
                    console.log('complete');
                },
                type: 'GET'
            });
        } else {
            loading.addClass("hidden");
            if (Tab == 1) {
                cusmoterID1.val('');
            } else if (Tab == 2) {
                cusmoterID2.val('');
            }
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
                if (Tab == 1) {
                    cusmoterID1.val(PersonalID);
                } else if (Tab == 2) {
                    cusmoterID2.val(PersonalID);
                }
                UpdateBoxCustomerInfo(obj, Tab);
            },
            complete: function (jqXHR) {
                loading.addClass("hidden");
                console.log('complete');
            },
            type: 'GET'
        });
    }
}

function UpdateBoxCustomerInfo(json, Tab) {
    console.log('UpdateBoxCustomerInfo');
    if (Tab == 1) {
        var box = $('#user_info1');
    } else if (Tab == 2) {
        var box = $('#user_info2');
    }
    box.find("#txt_PersonalImage").attr("src", json.data.PersonalImage);
    box.find("#txt_PersonalID").html(json.data.PersonalID);
    box.find("#txt_NameT").html(json.data.TitleThai + json.data.FirstNameT + " " + json.data.LastNameT);
    box.find("#txt_NameE").html(json.data.TitleEng + json.data.FirstNameE + " " + json.data.LastNameE);
    box.find("#txt_CurrentAddress").html(json.data.CurrentAddress);
    box.find("#txt_HomePhone").html(json.data.HomePhone);
    box.find("#txt_MobinePhone").html(json.data.MobinePhone);
    box.find("#txt_Nationality").html(json.data.Nationality);
    box.find("#txt_Religion").html(json.data.Religion);
    box.find("#txt_Sex").html(json.data.Sex);
    box.find("#txt_BirthDate").html(json.data.BirthDate);
    box.find("#txt_NickName").html(json.data.NickName);
    box.find("#txt_Occupation").html(json.data.Occupation);
    box.find("#txt_Comment").html(json.data.Comment);

//    $("#txt_PersonalImage").attr("src", json.data.PersonalImage);
//    $('#txt_PersonalID').html(json.data.PersonalID);
//    $('#txt_NameT').html(json.data.TitleThai + json.data.FirstNameT + " " + json.data.LastNameT);
//    $('#txt_NameE').html(json.data.TitleEng + json.data.FirstNameE + " " + json.data.LastNameE);
//    $('#txt_CurrentAddress').html(json.data.CurrentAddress);
//    $('#txt_HomePhone').html(json.data.HomePhone);
//    $('#txt_MobinePhone').html(json.data.MobinePhone);
//    $('#txt_Nationality').html(json.data.Nationality);
//    $('#txt_Religion').html(json.data.Religion);
//    $('#txt_Sex').html(json.data.Sex);
//    $('#txt_BirthDate').html(json.data.BirthDate);
//    $('#txt_NickName').html(json.data.NickName);
//    $('#txt_Occupation').html(json.data.Occupation);
//    $('#txt_Comment').html(json.data.Comment);
}

