$(document).ready(function () {
    let base_url = window.location.origin;
    $('#js-question-list').DataTable({
        'processing': true,
        'serverSide': true,
        'ajax': {
            url: base_url + "/list-question",
            method: "POST",
            data: {
                "_token": $('meta[name="csrf-token"]').attr('content')
            },
            cache: false
        },
        "columns": [{
            "targets": 0,
            "data": "question_type",
            "render": function (data, type, row, meta) {
                if (row.question_type == 1) {
                    type = 'Question Text Answer Text';
                    return type;
                }
                else if (row.question_type == 2) {
                    type = 'Question Text Answer Image';
                    return type;
                }
                else if (row.question_type == 3) {
                    type = 'Question Text & Image Answer Text';
                    return type;
                }

            }
        },
        {
            "data": "question"
        },
        {
            "data": "score"
        },
        {
            "data": "actions"
        }
        ],
        "columnDefs": [{
            "searchable": true
        }]
    });
});

$(document).on('click', '.deletebtn', function () {
    var id = $(this).val();
    let base_url = window.location.origin;
    Swal.fire({
        text: 'Are you sure to delete..?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            // $(this).html(action);
            $.ajax({
                type: 'GET',
                url: base_url + "/delete-question/" + id,
                data: {
                    '_token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    $('#js-question-list').DataTable().ajax.reload();
                }
            });
        } else {
            $(this).prop('disabled', false);
        }
    });
});


$(document).on('click', '.editbtn', function () {
    var id = $(this).val();
    let base_url = window.location.origin;
    $.ajax({
        type: 'GET',
        url: base_url + "/get-question/" + id,
        data: {
            '_token': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
                
        }
    });
});


