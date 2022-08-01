$('#addTeacher').on('hidden.bs.modal', function (e) {
    e.preventDefault();
    var $alertas = $('#addTeacher');
    $alertas.validate().resetForm();
    $alertas.find('.error').removeClass('error');
});

$('#teacher-register').on('change', function (e) {
    e.preventDefault();
    $("#teacher-register").validate({
        rules: {
            name: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 6
            },
            confirmPassword: {
                required: true,
                equalTo: "#password",
                minlength: 6
            }
        },
        errorPlacement: function (error, element) {
            selector = '#error-' + element.attr('name');
            if ($(selector).length) {
                $(selector).html(error);
            }
        }
    });
});



// $('#teacher-register').on('submit', function (e) {
//     e.preventDefault();
//     let password = $('#password').val();
//     let base_url = window.location.origin;
//     if (password) {
//         $.ajax({
//             type: 'POST',
//             url: base_url + "/edit-teacher",
//             data: {
//                 'data': $('form').serialize(),
//                 '_token': $('meta[name="csrf-token"]').attr('content')
//             },
//             success: function (response) {
//                 console.log(response);
//             }
//         });
//     }
// });
