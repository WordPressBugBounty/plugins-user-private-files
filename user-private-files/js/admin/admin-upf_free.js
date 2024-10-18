jQuery(document).ready(function ($) {

    //Code for multiple selection
    $(".chosen-select").chosen({
        no_results_text: "Oops, nothing found!"
    });

    //Code for toggle buttons
    $('.upfp_toggle_setting').on('click', function () {
        $(this).toggleClass("parent_toggle");
        $(this).find('.upfp_round').toggleClass("child_toggle");
        if ($(this).find('input[type="checkbox"]').is(":checked")) {
            $(this).find('input[type="checkbox"]').attr('checked', false);
        }
        else {
            $(this).find('input[type="checkbox"]').attr('checked', true);
        }
    });

    //code for showing pop-ups
    $('#upfp_icon1').on('click', function () {
        $("#upfp_popup-container-1").css("display", "flex");
    });

    $('#upfp_icon2').on('click', function () {
        $("#upfp_popup-container-2").css("display", "flex");
    });

    //code for closing pop-ups
    $('#upfp_close-popup1, #upfp_popup-container-1').on('click', function () {
        $("#upfp_popup-container-1").css("display", "none");
    });

    $('#upfp_close-popup2, #upfp_popup-container-2').on('click', function () {
        $("#upfp_popup-container-2").css("display", "none");
    });

    $('.upfp_toggle_btn').on('click', function () {
        $(this).closest('.upfp_inner-container').next('.upfp_toggle_wrapper').toggleClass('upfp-hidden');
    });

    $('.upfp_info_btn').on('click', function () { 
        $(this).next(".upfp_settings_info_popup").show();
    });

    $('.upfp_close_info_pp').on('click', function () { 
        $(this).closest(".upfp_settings_info_popup").hide();
    });

    $('.upfp_settings_info_popup').on('click', function(event) {
        $(".upfp_settings_info_popup").hide();
    });

    $('.upf_inner').on('click', function(event) {
        event.stopPropagation();
    });

    /* -------- Upload tab ----------*/
    $('#upfp_add_new_file_type_btn').on('click', function (e) {
        e.preventDefault();
        $('.addNewFileType_popup input').val('');
        $('.addNewFileType_popup').show();
    });

    $('.addNewFileType_closePopup').on('click', function () {
        $('.addNewFileType_popup').hide();
    });

    $('.upfp_upload_wrapper').on('change', '.upfp_custom_file_allowed', function (e) {
        var targetDiv = $(this).closest('.upfp_file_type_wrapper');
        targetDiv.find('.upfp_custom_file_allowed').prop('checked', false);
        $(this).prop('checked', true);

    })

    $('#upfp_srvr_fldr_logs').on('click', function(e) {
        e.preventDefault();
        $('.upfp_srvr_folder_wrapper').find('.upf_setting_msg').toggleClass('upfp-hidden');
    })

    /* -------- Register tab ----------*/
    $('#upfp_register_option_page').on('click', '#upfp_rf_add_new_btn', function (e) {

        $('.upf_rf_new_field_popup').find("form")[0].reset();
        $('.upf_rf_new_field_popup').show();
    })

    $('.upf_rf_new_field_closePopup').on('click', function (e) {
        $('.upf_rf_new_field_popup').find("form")[0].reset();
        $('.upf_rf_new_field_popup').hide();
    })
    
});