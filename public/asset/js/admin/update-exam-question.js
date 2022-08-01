let base_url = window.location.origin;
$("#update-exam-question").validate(
    
    {
    normalizer: function (value) {
        return $.trim(value);
    },
    ignore: [],
    rules: {
    },
    submitHandler: function (form) {
        $.ajax({
            dataType: 'json',
            type: 'post',
            data: new FormData($(form)[0]),
            url: base_url + "/update-exam-question",
            processData: false,
            cache: false,
            contentType: false,
            success: function (result) {

            },
            errorPlacement: function (error, element) {
                error.insertBefore(element);
            }
        })
    }
});


