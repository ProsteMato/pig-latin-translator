function Func() {
    setTimeout(function() {
        //your code to be executed after 1 second
        var text_area = document.getElementById("pig-latin")
        var text_area_english = document.getElementById("english")
        text_area.value = text_area_english.value
        console.log("aa")
    }, 500);
}