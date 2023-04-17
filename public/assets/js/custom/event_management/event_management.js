$('#startDateEvent').flatpickr();
$('#endDateEvent').flatpickr();


$(document).ready(function() {
    $("input[name$='typeTicket']").click(function() {
        var demovalue = $(this).val();

        $("div.myDiv").hide();
        $("#show" + demovalue).show();
    });
});


$('#startDateTicket').flatpickr();
$('#endDateTicket').flatpickr();

$('#ticket_start_date_free').flatpickr();
$('#ticket_end_date_free').flatpickr();

$('#ticket_start_date_paid').flatpickr();
$('#ticket_end_date_paid').flatpickr();


$(document).ready(function() {
    let checkBoxStatusEvent = $("input[name='checkBoxStatusEvent']");
    toggle();
    $("#checkBoxStatusEvent").click(function() {
        toggle();
    });

    function toggle() {
        if (checkBoxStatusEvent.prop("checked")) {
            checkBoxStatusEvent.val(1);
            $('#enableBoxStatusEventText').removeClass("d-none");
            $('#disableBoxStatusEventText').addClass("d-none");

        } else {
            checkBoxStatusEvent.val(0);
            $('#enableBoxStatusEventText').addClass("d-none");
            $('#disableBoxStatusEventText').removeClass("d-none");
        }
    }
});


$(document).ready(function() {
    let checkBoxStatusTicket = $("input[name='ticket_status_free']");
    toggle();
    $("#ticket_status_free").click(function() {
        toggle();
    });

    function toggle() {
        if (checkBoxStatusTicket.prop("checked")) {
            checkBoxStatusTicket.val(1);
            $('#enableBoxStatusTicketText').removeClass("d-none");
            $('#disableBoxStatusTicketText').addClass("d-none");

        } else {
            checkBoxStatusTicket.val(0);
            $('#enableBoxStatusTicketText').addClass("d-none");
            $('#disableBoxStatusTicketText').removeClass("d-none");
        }
    }
});


$(document).ready(function() {
    // EDIT Status Ticket Free
    let checkBoxStatusTicketEdit = $("input[name='checkBoxStatusTicketEdit']");
    toggle();
    $("#checkBoxStatusTicketEdit").click(function() {
        toggle();
    });

    function toggle() {
        if (checkBoxStatusTicketEdit.prop("checked")) {
            checkBoxStatusTicketEdit.val(1);
            $('#enableBoxStatusTicketTextEdit').removeClass("d-none");
            $('#disableBoxStatusTicketTextEdit').addClass("d-none");

        } else {
            checkBoxStatusTicketEdit.val(0);
            $('#enableBoxStatusTicketTextEdit').addClass("d-none");
            $('#disableBoxStatusTicketTextEdit').removeClass("d-none");
        }
    }
    // End
});



$(document).ready(function() {
    // Status Ticket Paid
    let checkBoxStatusTicketPaid = $("input[name='checkBoxStatusTicketPaid']");
    toggle();
    $("#checkBoxStatusTicketPaid").click(function() {
        toggle();
    });

    function toggle() {
        if (checkBoxStatusTicketPaid.prop("checked")) {
            checkBoxStatusTicketPaid.val(1);
            $('#enableBoxStatusTicketPaidText').removeClass("d-none");
            $('#disableBoxStatusTicketPaidText').addClass("d-none");

        } else {
            checkBoxStatusTicketPaid.val(0);
            $('#enableBoxStatusTicketPaidText').addClass("d-none");
            $('#disableBoxStatusTicketPaidText').removeClass("d-none");
        }
    }
    // End
});


var itemFree = $('input[name="ticket_name[]"]').length;
let fr = parseInt(itemFree) + 1;
var scntDiv = $('#t_body_ticket');
// var i = $('#t_body_ticket tr').size() + 1;
$('#addFreeTicketSubmit').click(function() {
    var cek_status_free = $("input[name='ticket_status_free']").val();
    var status_free = '<span class="text-danger">disabled</span>';
    if (cek_status_free == '1') {
        status_free = '<span class="text-success">enabled</span>';
    }
    scntDiv.append(`
<tr id="free_ticket` + fr + `">
        <td>
           <a onclick="rmFree(` + fr + `)" style="cursor:pointer" class="fa fa-trash"></a>
        </td>
        <td data-list-crm-filter="first_name">
            ` + $('#ticket_name_free').val() + `
            <input type="hidden" name="ticket_name[]" value="` + $('#ticket_name_free').val() + `">
        </td>
        <td>
            Rp.0
        </td>
        <td>
            ` + $('#ticket_quota_free').val() + `
            <input type="hidden" name="ticket_quota[]" value="` + $('#ticket_quota_free').val() + `">
            <input type="hidden" name="ticket_price[]" value="` + $('#ticket_price_free').val() + `">
            <input type="hidden" name="ticket_description[]" value="` + $('#ticket_description_free').val() + `">
        </td>
        <td>
            <span>Free</span>
            <input type="hidden" name="ticket_type[]" value="free">
        </td>
        <td>
            ` + $('#ticket_start_date_free').val() + `
            <input type="hidden" name="ticket_start_exp[]" value="` + $('#ticket_start_date_free').val() + `">
        </td>
        <td>
            ` + $('#ticket_end_date_free').val() + `
            <input type="hidden" name="ticket_end_exp[]" value="` + $('#ticket_end_date_free').val() + `">
        </td>
        <td>
            ` + $('#ticket_description_free').val() + `
        </td>
        <td>
            ` + status_free + `
            <input type="hidden" name="ticket_status[]" value="` + cek_status_free + `">
        </td>
</tr>`);
    fr++;
    $("#addFreeTicket").modal("hide");
    return false;
});


var itemPaid = $('input[name="ticket_name[]"]').length;
let pd = parseInt(itemPaid) + 1;
var scntDivPaid = $('#t_body_ticket');
$('#addPaidTicketsubmit').click(function() {
    var cek_status_paid = $("input[name='checkBoxStatusTicketPaid']").val();
    var status_paid = '<span class="text-danger">disabled</span>';
    if (cek_status_paid == '1') {
        status_paid = '<span class="text-success">enabled</span>';
    }
    scntDivPaid.append(`
<tr id="paid_ticket` + pd + `">
        <td>
            <a onclick="rmPaid(` + pd + `)" style="cursor:pointer" class="fa fa-trash"></a>
        </td>
        <td data-list-crm-filter="first_name">
            ` + $('#ticket_name_paid').val() + `
            <input type="hidden" name="ticket_name[]" value="` + $('#ticket_name_paid').val() + `">
        </td>
        <td>
            Rp. ` + $('#ticket_price_paid').val() + `
        </td>
        <td>
            ` + $('#ticket_quota_paid').val() + `
            <input type="hidden" name="ticket_quota[]" value="` + $('#ticket_quota_paid').val() + `">
        </td>
        <td>
            <span>Paid</span>
            <input type="hidden" name="ticket_type[]" value="paid">
        </td>
        <td>
            ` + $('#ticket_start_date_paid').val() + `
            <input type="hidden" name="ticket_start_exp[]" value="` + $('#ticket_start_date_paid').val() + `">
            <input type="hidden" name="ticket_price[]" value="` + $('#ticket_price_paid').val() + `">
             <input type="hidden" name="ticket_description[]" value="` + $('#ticket_description_paid').val() + `">
        </td>
        <td>
            ` + $('#ticket_end_date_paid').val() + `
            <input type="hidden" name="ticket_end_exp[]" value="` + $('#ticket_end_date_paid').val() + `">
        </td>
        <td>
            ` + $('#ticket_description_paid').val() + `
        </td>
        <td>
            <span class="text-success">` + status_paid + `</span>
            <input type="hidden" name="ticket_status[]" value="` + cek_status_paid + `">
        </td>
</tr>`);
    pd++;
    $("#addPaidTicket").modal("hide");
    return false;
});


var itemSpPaid = $('input[name="event_speaker_name[]"]').length;
let sp = parseInt(itemSpPaid) + 1;
var src = '';
var filesSpeakerGetIt = '';
var filesSpeaker = '';

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
        filesSpeakerGetIt = input.files;
    }
}
var imageUpload = [];
var scntDivPaidSpeaker = $('#t_body_speaker');
$('#addSpeakerButton').click(function() {
    var filesSpeaker = 'filesSpeaker' + '-' + sp;
    scntDivPaidSpeaker.append(`
    <tr id="speaker_` + sp + `">
        <td>
            <div class="d-flex align-items-center">
                <!--begin:: Avatar -->
                <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                    <a href="javascript::void(0)">
                        <div class="symbol-label">
                            <img src="` + src + `"` + $('#speakerName').val() + `" class="w-100" />
                            <input type="file" id="` + filesSpeaker + `" name="event_speaker_image[]" style="display:none;">
                        </div>
                    </a>
                </div>
                <!--end::Avatar-->
                <div class="ms-5">
                    <!--begin::Title-->
                    <a href="javascript::void(0)" class="text-gray-800 text-hover-primary fs-5 fw-bolder">` + $('#speakerName').val() + `</a>
                    <input type="text" value="` + $('#speakerName').val() + `" name="event_speaker_name[]" style="display:none;">
                    <!--end::Title-->
                </div>
            </div>
        </td>
        <td>
            ` + $('#speakerProfession').val() + `
             <input type="text" value="` + $('#speakerProfession').val() + `" name="event_speaker_profession[]" style="display:none;">
        </td>
        <td class="text-end">
            <a onclick="rmSp(` + sp + `)" style="cursor:pointer" class="fa fa-trash"></a>
        </td>
    </tr>`);
    //imageUpload.splice( sp, 0, filesSpeakerGetIt );
    document.getElementById(filesSpeaker).files = filesSpeakerGetIt;
    //filesSpeaker.files = filesSpeakerGetIt;
    console.log(document.getElementById(filesSpeaker).files);
    sp++;
    src = '';
    filesSpeakerGetIt = '';
    $("#addSpeaker").modal("hide");
    return false;
});


// reminder
var itemReminder = $('input[name="h_reminder_type[]"]').length;
let rmndr = parseInt(itemReminder) + 1;
var scntDivReminder = $('#t_reminder_body');
// var i = $('#t_body_ticket tr').size() + 1;
$('#addReminderSubmit').click(function() {
    scntDivReminder.append(`
<tr id="reminder` + rmndr + `">
        <td>
           <a onclick="rmndrDel(` + rmndr + `)" style="cursor:pointer" class="fa fa-trash"></a>
        </td>
        <td>
            ` + $('#type_reminder').val() + `
            <input type="hidden" name="h_reminder_type[]" value="` + $('#type_reminder').val() + `">
        </td>
        <td>
            ` + $('#value_reminder').val() + `
            <input type="hidden" name="h_value_reminder[]" value="` + $('#value_reminder').val() + `">
        </td>
        <td>
            ` + $('#value_type_reminder').val() + `
            <input type="hidden" name="h_value_type_reminder[]" value="` + $('#value_type_reminder').val() + `">
        </td>
</tr>`);
    rmndr++;
    $("#addReminderModal").modal("hide");
    return false;
});


function rmPaid(i) {
    $('#paid_ticket' + i).remove();
}

function rmFree(i) {
    $('#free_ticket' + i).remove();
}

function mdFree(i) {
    $('#free_ticket' + i).remove();
}

function rmSp(i) {
    $('#speaker_' + i).remove();
}

function rmndrDel(i) {
    $('#reminder' + i).remove();
}