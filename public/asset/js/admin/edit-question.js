let base_url = window.location.origin;

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
}


