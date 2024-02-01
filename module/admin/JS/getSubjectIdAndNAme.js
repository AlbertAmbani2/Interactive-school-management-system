function getSubjectNameAndId(){

    var e = document.getElementById("className");
    var classId = e.options[e.selectedIndex].value;
    //alert(classId);
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            document.getElementById("subjectName").innerHTML = xhttp.responseText;
        }
    };
    xhttp.open("GET", "searchSubjectName.php?key="+classId,true);
    xhttp.send();
}

function setSubjectId(){
    var e = document.getElementById("subjectName");
    var classId = e.options[e.selectedIndex].value;
    document.getElementById("subjectId").value = classId;

    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            document.getElementById("teacherId").innerHTML = xhttp.responseText;
        }
    };
    xhttp.open("GET", "getTeacherNameid.php?key="+classId,true);
    xhttp.send();
}

function getAllSubjectStudentAndSubmit(){
    var e = document.getElementById("subjectName");
    var subjectId = e.options[e.selectedIndex].value;
    var e = document.getElementById("subjectName");
    var subjectName = e.options[e.selectedIndex].text;
    var e = document.getElementById("className");
    var classId = e.options[e.selectedIndex].value;
    var e = document.getElementById("teacherId");
    var teacherId = e.options[e.selectedIndex].value;

    alert(subjectId+' '+subjectName + ' '+classId+' '+teacherId);
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            document.getElementById("teacherId").innerHTML = xhttp.responseText;
        }
    };
    xhttp.open("GET", "submitStudentsubject.php?subjectid="+subjectId+"&classid="+classId+"&teacherid="+teacherId+"&subjectname="+subjectName,true);
    xhttp.send();
}
