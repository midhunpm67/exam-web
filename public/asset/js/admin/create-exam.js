// $("#demoform").submit(function() {
//     alert($('[name="duallistbox_demo1[]"]').val());


// });

$("#demoform").validate({

    normalizer: function (value) {
        return $.trim(value);
    },
    ignore: [],
    rules: {
        exam: {
            required: true,
        },
        time: {
            required: true,
            number: true,
            min: 1
        }
    },
    messages: {
        exam: {
            required: "exam name is required"
        },
        time: {
            required: "time is required",
            number: "Please enter a valid time"
        }
    },

    submitHandler: function (form) {
        let base_url = window.location.origin;
        $.ajax({
            dataType: 'json',
            type: 'post',
            data: new FormData($(form)[0]),
            url: base_url + "/create-exam",
            processData: false,
            cache: false,
            contentType: false,
            success: function (result) {
                if (result.status == 1) {
                    Swal.fire({
                        icon: 'success',
                        text: result.message,
                        customClass: {
                            confirmButton: "btn btn-primary",
                        },
                    }).then((result) => {
                        if (result.isConfirmed) {
                          window.location.href = base_url+"/exam-list"
                        }
                    })
                }
                else {
                    Swal.fire({
                        icon: 'error',
                        text: result.message,
                        customClass: {
                            confirmButton: "btn btn-primary",
                        },
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.reload();
                        }
                    })
                }
            },
            errorPlacement: function (error, element) {
                error.insertBefore(element);
            }
        })
    }
});


























