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
    });
});