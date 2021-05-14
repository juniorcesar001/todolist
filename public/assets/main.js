$("#gridCheck1").on("click", function (){
    console.log("Clickou!!")
    if ($(this).is(":checked")){
        $("#datetime-input").attr("disabled", true);
    }else {
        $("#datetime-input").attr("disabled", false);
    }
})