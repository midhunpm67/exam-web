$('#student-register').on('change', function (e) {
    e.preventDefault();
    $("#student-register").validate({
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
        // errorPlacement: function (error, element) {
        //     selector = '#error-' + element.attr('name');
        //     if ($(selector).length) {
        //         $(selector).html(error);
        //     }
        // }

    });
});

$('#student-register').on('submit', function (e) {
    e.preventDefault();

    let name = $('#name').val();
    let email = $('#email').val();
    let password = $('#password').val();
    let base_url = window.location.origin;
   
    document.getElementById('register-btn').disabled = true;
    $('#register-btn').text("Please Wait..");
    if (email) {
        $.ajax({
            method: 'POST',
            url: base_url + "/register",
            data: {
                'name': name,
                'email': email,
                'password': password,
                '_token': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
               console.log(response);
               if (response) {
                Swal.fire({
                    icon: 'success',
                    title: "Mail sent successfully",
                    timer: 1500
                }).then((result) => {
                    var url = '/login?'+response.token;
                    window.location.href = url;
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: "oops..! something has gone wrong",
                    timer: 1500
                }).then((result) => {
                    window.location.reload();
                });
            }
            }
        });
    }
});

