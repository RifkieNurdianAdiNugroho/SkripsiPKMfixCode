"use strict";

// Class definition
var KTLandingPage = function() {
    // Private methods
    var initTyped = function() {
        var typed = new Typed("#kt_landing_hero_text", {
            strings: ["The Best Theme Ever", "The Most Trusted Theme", "#1 Selling Theme"],
            typeSpeed: 50
        });
    }

    // Public methods
    return {
        init: function() {
            //initTyped();
        }
    }
}();

// Webpack support
if (typeof module !== 'undefined') {
    module.exports = KTLandingPage;
}

// On document ready
KTUtil.onDOMContentLoaded(function() {
    KTLandingPage.init();
});


// Detail Event Collapse
$("#aboutCollapse").click(function() {
    $(this).addClass("active");
    $("#liveMeetingCollapse").removeClass("active");
    $("#agendaCollapse").removeClass("active");
    $("#speakerCollapse").removeClass("active");
    $("#sponsorCollapse").removeClass("active");
    $("#organizerCollapse").removeClass("active");

    $("#sponsorship").hide();
    $("#defaultTitle").fadeIn();
    $("#organizerTitle").hide();

    $("#about").fadeIn();
    $("#liveMeeting").hide();
    $("#agenda").hide();
    $("#speaker").hide();
    $("#sponsor").hide();
    $("#organizer").hide();
});

$("#liveMeetingCollapse").click(function() {
    $(this).addClass("active");
    $("#aboutCollapse").removeClass("active");
    $("#agendaCollapse").removeClass("active");
    $("#speakerCollapse").removeClass("active");
    $("#sponsorCollapse").removeClass("active");
    $("#organizerCollapse").removeClass("active");

    $("#sponsorship").hide();
    $("#defaultTitle").fadeIn();
    $("#organizerTitle").hide();

    $("#about").hide();
    $("#liveMeeting").fadeIn();
    $("#agenda").hide();
    $("#speaker").hide();
    $("#sponsor").hide();
    $("#organizer").hide();
});

$("#agendaCollapse").click(function() {
    $(this).addClass("active");
    $("#aboutCollapse").removeClass("active");
    $("#liveMeetingCollapse").removeClass("active");
    $("#speakerCollapse").removeClass("active");
    $("#sponsorCollapse").removeClass("active");
    $("#organizerCollapse").removeClass("active");

    $("#sponsorship").hide();
    $("#defaultTitle").fadeIn();
    $("#organizerTitle").hide();

    $("#about").hide();
    $("#agenda").fadeIn();
    $("#liveMeeting").hide();
    $("#speaker").hide();
    $("#sponsor").hide();
    $("#organizer").hide();
});

$("#speakerCollapse").click(function() {
    $(this).addClass("active");
    $("#liveMeetingCollapse").removeClass("active");
    $("#agendaCollapse").removeClass("active");
    $("#aboutCollapse").removeClass("active");
    $("#sponsorCollapse").removeClass("active");
    $("#organizerCollapse").removeClass("active");

    $("#sponsorship").hide();
    $("#defaultTitle").fadeIn();
    $("#organizerTitle").hide();

    $("#speaker").fadeIn();
    $("#liveMeeting").hide();
    $("#agenda").hide();
    $("#about").hide();
    $("#sponsor").hide();
    $("#organizer").hide();
});

$("#sponsorCollapse").click(function() {
    $(this).addClass("active");
    $("#liveMeetingCollapse").removeClass("active");
    $("#agendaCollapse").removeClass("active");
    $("#aboutCollapse").removeClass("active");
    $("#speakerCollapse").removeClass("active");
    $("#organizerCollapse").removeClass("active");

    $("#sponsorship").fadeIn();
    $("#defaultTitle").hide();
    $("#organizerTitle").hide();

    $("#sponsor").fadeIn();
    $("#liveMeeting").hide();
    $("#agenda").hide();
    $("#about").hide();
    $("#speaker").hide();
    $("#organizer").hide();
});

$("#organizerCollapse").click(function() {
    $(this).addClass("active");
    $("#liveMeetingCollapse").removeClass("active");
    $("#agendaCollapse").removeClass("active");
    $("#aboutCollapse").removeClass("active");
    $("#speakerCollapse").removeClass("active");
    $("#sponsorCollapse").removeClass("active");

    $("#sponsorship").hide();
    $("#defaultTitle").hide();
    $("#organizerTitle").fadeIn();

    $("#organizer").fadeIn();
    $("#liveMeeting").hide();
    $("#agenda").hide();
    $("#about").hide();
    $("#speaker").hide();
    $("#sponsor").hide();
});

// Sponsor
$("#platinum").click(function() {
    $(this).addClass("active");
    $("#gold").removeClass("active");
    $("#silver").removeClass("active");
    $("#bronze").removeClass("active");

    $("#platinumCollapse").fadeIn();
    $("#goldCollapse").hide();
    $("#silverCollapse").hide();
    $("#bronzeCollapse").hide();
});

$("#gold").click(function() {
    $(this).addClass("active");
    $("#platinum").removeClass("active");
    $("#silver").removeClass("active");
    $("#bronze").removeClass("active");

    $("#goldCollapse").fadeIn();
    $("#platinumCollapse").hide();
    $("#silverCollapse").hide();
    $("#bronzeCollapse").hide();
});

$("#silver").click(function() {
    $(this).addClass("active");
    $("#platinum").removeClass("active");
    $("#gold").removeClass("active");
    $("#bronze").removeClass("active");

    $("#silverCollapse").fadeIn();
    $("#platinumCollapse").hide();
    $("#goldCollapse").hide();
    $("#bronzeCollapse").hide();
});

$("#bronze").click(function() {
    $(this).addClass("active");
    $("#platinum").removeClass("active");
    $("#gold").removeClass("active");
    $("#silver").removeClass("active");

    $("#bronzeCollapse").fadeIn();
    $("#platinumCollapse").hide();
    $("#goldCollapse").hide();
    $("#silverCollapse").hide();
});

// Accordion
// $(function() {
//     $('.heading-accordion').on('click', function() {
//         var hdr = $(this);
//         hdr.siblings('.content-accordion').slideToggle();
//         hdr.parent().toggleClass('active');
//         hdr.parent().siblings().find('.content-accordion').slideUp();
//         hdr.parent().siblings().removeClass('active');
//         if (hdr.parent().hasClass('active')) {
//             hdr.parent().find('svg').remove();
//             hdr.parent().siblings().find('svg').remove();
//             hdr.prepend('<i class="fas fa-minus"></i>');
//             hdr.parent().siblings().find('.heading-accordion').prepend('<i class="fas fa-plus"></i>');
//         } else {
//             hdr.parent().find('svg').remove();
//             hdr.prepend('<i class="fas fa-plus"></i>');
//         }
//     });
// });

// Collapse Organizer
$("#overviewTab").click(function() {
    $(this).addClass("active");
    $("#liveEventTab").removeClass("active");
    $("#pastEventTab").removeClass("active");

    $("#overviewOrganizer").fadeIn();
    $("#liveEventOrganizer").hide();
    $("#pastEventOrganizer").hide();
});

$("#liveEventTab").click(function() {
    $(this).addClass("active");
    $("#overviewTab").removeClass("active");
    $("pastEventTab").removeClass("active");

    $("#liveEventOrganizer").fadeIn();
    $("#overviewOrganizer").hide();
    $("#pastEventOrganizer").hide();
});

$("#pastEventTab").click(function() {
    $(this).addClass("active");
    $("#liveEventTab").removeClass("active");
    $("#overviewTab").removeClass("active");

    $("#pastEventOrganizer").fadeIn();
    $("#liveEventOrganizer").hide();
    $("#overviewOrganizer").hide();
});

// Sponsor
$("#overviewTabSponsor").click(function() {
    $(this).addClass("active");
    $("#informasiTabSponsor").removeClass("active");
    $("#sponsorTabSponsor").removeClass("active");

    $("#sponsorSponsor").hide();
    $("#overviewSponsor").fadeIn();
    $("#informasiSponsor").hide();
});
$("#informasiTabSponsor").click(function() {
    $(this).addClass("active");
    $("#overviewTabSponsor").removeClass("active");
    $("#sponsorTabSponsor").removeClass("active");

    $("#overviewSponsor").hide();
    $("#sponsorSponsor").hide();
    $("#informasiSponsor").fadeIn();
});
$("#sponsorTabSponsor").click(function() {
    $(this).addClass("active");
    $("#overviewTabSponsor").removeClass("active");
    $("#informasiTabSponsor").removeClass("active");

    $("#overviewSponsor").hide();
    $("#informasiSponsor").hide();
    $("#sponsorSponsor").fadeIn();
});

// Transaksi
$("#waitTrans").click(function() {
    $(this).addClass("active");
    $("#successTrans").removeClass("active");
    $("#failTrans").removeClass("active");

    $("#waitTransTab").fadeIn();
    $("#successTransTab").hide();
    $("#failTransTab").hide();
});
$("#successTrans").click(function() {
    $(this).addClass("active");
    $("#waitTrans").removeClass("active");
    $("#failTrans").removeClass("active");

    $("#successTransTab").fadeIn();
    $("#waitTransTab").hide();
    $("#failTransTab").hide();
});
$("#failTrans").click(function() {
    $(this).addClass("active");
    $("#waitTrans").removeClass("active");
    $("#successTrans").removeClass("active");

    $("#failTransTab").fadeIn();
    $("#waitTransTab").hide();
    $("#successTransTab").hide();
});