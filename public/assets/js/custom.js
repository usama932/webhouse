/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 * 
 */

"use strict";
$('form.frm-submit-data').on('submit',function(e){
    var $this = $(this);
    e.preventDefault();
    var btn = $this.find('[type="submit"]');
            $.ajax({
                url: $(this).attr('action'),
                type: "POST",
                data: new FormData(this),
                dataType: "json",
                contentType: false,
                processData: false,
                cache: false,
                beforeSend: function () {
                    btn.button('loading');
                },
                success: function (data) {
                    console.log(data)
                    $('.error').html("");
                    if (data.status == "fail") {
                        $.each(data.error, function (index, value) {
                            console.log("[name='" + index + "']")
                            $this.find("[name='" + index + "']").addClass('is-invalid').parents('.form-group').find('.invalid-feedback').html(value);
                        });
                        btn.button('reset');
                    } else {
                        if (data.url) {
                            window.location.href = data.url;
                        } else if (data.status == "access_denied") {
                            window.location.href = base_url + "dashboard";
                        } else {
                            location.reload(true);
                        }
                    }
                },
                error: function () {
                    btn.button('reset');
                }
            });
        });

// $("form.frm-submit-data").each(function(i, el)
// {
//     console.log('ok')
//     var $this = $(el);
//     $this.on('submit', function(e){
//         e.preventDefault();
//         var btn = $this.find('[type="submit"]');
//         $.ajax({
//             url: $(this).attr('action'),
//             type: "POST",
//             data: new FormData(this),
//             dataType: "json",
//             contentType: false,
//             processData: false,
//             cache: false,
//             beforeSend: function () {
//                 btn.button('loading');
//             },
//             success: function (data) {
//                 console.log(data)
//                 $('.error').html("");
//                 if (data.status == "fail") {
//                     $.each(data.error, function (index, value) {
//                         $this.find("[name='" + index + "']").parents('.form-group').find('.error').html(value);
//                     });
//                     btn.button('reset');
//                 } else {
//                     if (data.url) {
//                         window.location.href = data.url;
//                     } else if (data.status == "access_denied") {
//                         window.location.href = base_url + "dashboard";
//                     } else {
//                         location.reload(true);
//                     }
//                 }
//             },
//             error: function () {
//                 btn.button('reset');
//             }
//         });
//     });
// });
