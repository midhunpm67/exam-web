$("#update-question-from").validate({
    normalizer: function (value) {
        return $.trim(value);
    },
    ignore: [],
    rules: {
        question1: {
            required: true,
        },
        option11: {
            required: function () {
                var value = document.getElementById("question_type").value;
                return (value == 1 || value == 3) ? true : false;
            }
        },
        option12: {
            required: function () {
                var value = document.getElementById("question_type").value;
                return (value == 1 || value == 3) ? true : false;
            }
        },
        option13: {
            required: function () {
                var value = document.getElementById("question_type").value;
                return (value == 1 || value == 3) ? true : false;
            }
        },
        option14: {
            required: function () {
                var value = document.getElementById("question_type").value;
                return (value == 1 || value == 3) ? true : false;
            }
        },
        score: {
            required: true,
        },


    },
    messages: {
        question1: {
            required: "Question field is required"
        }
    },

    submitHandler: function (form) {

        $.ajax({
            dataType: 'json',
            type: 'post',
            data: new FormData($(form)[0]),
            url: base_url + "/update-question",
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
                            window.location.reload();
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