function Translate() {
    var text_area = document.getElementById("pig-latin")
    var text_area_english = document.getElementById("english")
    var dialect = document.getElementById("dialect")
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function () {
        let parsed_data = JSON.parse(xhttp.response);
        text_area.value = parsed_data["pig-latin"]
    }
    xhttp.open("GET", "/homepage/translate?value=" + text_area_english.value + "&dialect=" + dialect.value, true);
    xhttp.send();
}