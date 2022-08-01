let base_url = window.location.origin;
$(document).on('click', '#addQuestion', function () {
    let base_url = window.location.origin;
    let exam_id = document.getElementById("id").value;
    $('#js-question-list').DataTable({
        'processing': true,
        'serverSide': true,
        'bDestroy': true,
        'ajax': {
            url: base_url + "/add-question-list",
            method: "POST",
            data: {
                "exam_id": exam_id,
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


$(document).on('click', '.question-add-btn', function () {
    let item = " ";
    var id = $(this).val();
    let base_url = window.location.origin;
    let exam_id = document.getElementById("id").value;
    $.ajax({
        type: 'POST',
        url: base_url + "/add-exam-question",
        data: {
            'id': id,
            'exam_id': exam_id,
            '_token': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            if (response) {
                $('#js-exam-question-list').DataTable().ajax.reload();
                $('#js-question-list').DataTable().ajax.reload();
                item = makeQuestion(response.question.question, response.question_id);
                if (response.question.question_type == 3) {
                    item += makeQuestionImage(response.question.questionImage,response.question_id);
                }
                $.each(response.question.answer_options, function (key, value) {
                    if (response.question.question_type == 1 || response.question.question_type == 3) {
                        item += makeOption1(response.question.answer_options, key, response.question_id);
                    } else if (response.question.question_type == 2) {
                        item += makeOption2(response.question.answer_options, key, response.question_id);
                    }
                });
                item += makeButtons(response.question_id);
                console.log(response);
                $('#dispData').append(item);
                // document.getElementById('dispData').innerHTML = item;
                // $('#dispData').appendTo('#dispData'); 
            }
        }
    });
});
$(document).on('click', '.question-remove-btn', function () {
    var id = $(this).val();
    let base_url = window.location.origin;
    let exam_id = document.getElementById("id").value;
    $.ajax({
        type: 'POST',
        url: base_url + "/remove-exam-question",
        dataSrc: " ",
        data: {
            'id': id,
            'exam_id': exam_id,
            '_token': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            if (response) {
                $("."+id).hide();
                $('#js-exam-question-list').DataTable().ajax.reload();
                $('#js-question-list').DataTable().ajax.reload();
            }
        }
    });
});
function makeOption1(response, key, question_id) {
    let checked = " ";
    if (response[key]['is_correct_answer'] == true) {
        checked = "checked"
    }
    return `<div class="form-group row mt-3 ${question_id}">
    <div class="col-sm-2">
        <label for="inputEmail3" class="col-form-label">Option:${key + 1} </label>
    </div>
    <div class="col-sm-8">
        <input type="text" class="form-control" id="option1${key + 1}" name="option1${key + 1}"
            placeholder="option" value="${response[key]['text']}"> 
    </div>
    <div class="col-sm-2">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="correct${question_id}" ${checked}>
            <label for="radio" class="col-form-label">is it correct..?</label>
        </div>
    </div>
</div>`;
}
function makeOption2(response, key, question_id) {
    let checked = " ";
    if (response[key]['is_correct_answer'] == true) {
        checked = "checked"
    }
    return `<div class="form-group mt-3 ${question_id}">
    <div class="col-sm-2">
        <label for="inputEmail3" class="col-form-label">Option:${key + 1} </label>
    </div>
    <div class="col-sm-8">
            <div>
            <img src="${base_url}/storage/image/question/${response[key]['image']}"
                alt="" style="width: 20%;height:20%" class="mt-2"
                class="img-thumbnail">
            </div>
    </div>
    <div class="col-sm-2">
    <div class="form-check">
    <input class="form-check-input" type="radio" name="correct${question_id}" ${checked}>
    <label for="radio" class="col-form-label">is it correct..?</label>
</div>
    </div>
</div>`;
}

function makeQuestion(response, question_id) {
    return `<hr class="new ${question_id}">
    <div class="form-group row type1 mt-5 ${question_id}">
    <div class="col-sm-2">
        <label for="inputEmail3" class="col-form-label">Question</label>
    </div>
    <div class="col-sm-10">
        <input type="text" class="form-control" id="question1" name="question1" placeholder="question" value="${response}">
    </div>
    <span id="error-question1" class="invalid-feedback"></span>
    <p class="question" style="color: red"></p>
</div>`;
}

function makeQuestionImage(response, question_id) {
    return `<div class="d-flex justify-content-center">
    <img src="${base_url}/storage/image/question/${response}"
        alt="" style="width: 15%;height:15%" class="mt-2 ${question_id}">
    </div>`;
}

function makeButtons(question_id) {
    return `<div class="d-flex justify-content-center ${question_id}">
    <button type="button" class="btn btn-primary mr-2 remove-question-view ${question_id}" value="${question_id}" name="btn${question_id}">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
  </svg> Review
                </button>
    <button type="button" class="btn btn-primary ${question_id}" data-toggle="modal" data-target=".bd-example-modal-lg"
                    id="addQuestion">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-question-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                        <path
                            d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                    </svg> Edit Question
                </button>
    </div>`;
}

$(document).on('click', '.remove-question-view', function () {
    var id = $(this).val(); 
    $("."+id).hide();
});