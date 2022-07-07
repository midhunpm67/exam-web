$(document).ready(function () {
    let base_url = window.location.origin;
    $('#js-teacher-list').DataTable({
        'processing': true,
        'serverSide': true,
        'ajax': {
            url: base_url + "/list-teacher",
            method: "POST",
            data: {
                "_token": $('meta[name="csrf-token"]').attr('content')
            },
            cache: false
        },
        "columns": [{
            "data": "_id"
        },
        {
            "data": "name"
        },
        {
            "data": "email"
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
                url: base_url + "/delete-teacher/" + id,
                data: {
                    '_token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    $('#js-teacher-list').DataTable().ajax.reload();
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
        url: base_url + "/get-data-byId/" + id,
        data: {
            '_token': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            document.getElementById('modalfullname').value = response.name;
            document.getElementById('modalemail').value = response.email;
            $('#js-teacher-list').DataTable().ajax.reload();
        }
    });
});
