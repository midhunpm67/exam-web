$(document).ready(function () {
    let base_url = window.location.origin;
    let id = document.getElementById("id").value;
    $('#js-exam-question-list').DataTable({
        'processing': true,
        'serverSide': true,
        'ajax': {
            url: base_url + "/exam-question-list",
            method: "POST",
            data: {
                "id": id,
                "_token": $('meta[name="csrf-token"]').attr('content')
            },
            cache: false
        },
        "columns": [
            {
                "data": "number",
            },
            {
                "data": "question"
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

