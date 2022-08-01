let base_url = window.location.origin;

$(document).ready(function () {
    $(".type1").hide();
    $(".option-type2").hide();
    $(".option-type1").hide();
    $(".type2").hide();
    $(".score").hide();
});

$('.question-select').on('change', function (e) {
    var value = document.getElementById("question_type").value;
    if (value == 1) {
        $(".option-type1").load(window.location.href + " .option-type1");
        $(".type1").load(window.location.href + " .type1");
        $(".score").load(window.location.href + " .score");
        $(".type1").show();
        $(".option-type1").show();
        $(".option-type2").hide();
        $(".type2").hide();
        $(".score").show();
        document.getElementById("radio1").checked = true;
    }
    if (value == 2) {
        $(".option-type2").load(window.location.href + " .option-type2");
        $(".type1").load(window.location.href + " .type1");
        $(".score").load(window.location.href + " .score");
        $(".type1").show();
        $(".option-type2").show();
        $(".option-type1").hide();
        $(".type2").hide();
        $(".score").show();
        document.getElementById("radio2").checked = true;
    }
    if (value == 3) {
        $(".option-type1").load(window.location.href + " .option-type1");
        $(".type1").load(window.location.href + " .type1");
        $(".type2").load(window.location.href + " .type2");
        $(".score").load(window.location.href + " .score");
        $(".option-type1").show();
        $(".type2").show();
        $(".type1").show();
        $(".option-type2").hide();
        $(".score").show();
        document.getElementById("radio1").checked = true;
    }
});



///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


$("#add-question-from").validate({

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
        option21: {
            required: function () {
                var value = document.getElementById("question_type").value;
                return (value == 2) ? true : false;
            }
        },
        option22: {
            required: function () {
                var value = document.getElementById("question_type").value;
                return (value == 2) ? true : false;
            }
        },
        option23: {
            required: function () {
                var value = document.getElementById("question_type").value;
                return (value == 2) ? true : false;
            }
        },
        option24: {
            required: function () {
                var value = document.getElementById("question_type").value;
                return (value == 2) ? true : false;
            }
        },
        questionImage: {
            required: function () {
                var value = document.getElementById("question_type").value;
                return (value == 3) ? true : false;
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
            url: base_url + "/create-question",
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
            errorPlacement: function(error, element) {
                error.insertBefore(element);
            }
        })
    }
});

