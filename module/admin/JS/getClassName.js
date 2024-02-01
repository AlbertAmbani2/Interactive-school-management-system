function getClassNameAndId(){
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            var classNameDropdown = document.getElementById("className");
            classNameDropdown.innerHTML = xhttp.responseText;

            // After populating Class ID dropdown, trigger the Subject Name dropdown population
            getSubjectNameAndId();
        }
    };
    xhttp.open("GET", "searchClassName.php?",true);
    xhttp.send();
}
