$(document).ready(function () {
    let base_url = window.location.origin;
    $('#js-exam-list').DataTable({
        'processing': true,
        'serverSide': true,
        'ajax': {
            url: base_url + "/exam-list-table",
            method: "POST",
            data: {
                "_token": $('meta[name="csrf-token"]').attr('content')
            },
            cache: false
        },
        "columns": [
        {
            "data": "name"
        },
        {
            "data": "time"
        },
        {
            "data": "status"
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
            $.ajax({
                type: 'GET',
                url: base_url + "/delete-exam/"+id,
                data: {
                    '_token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    $('#js-exam-list').DataTable().ajax.reload();
                }
            });
        } else {
            $(this).prop('disabled', false);
        }
    });
});