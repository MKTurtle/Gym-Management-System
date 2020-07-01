function sortByDate() {

    let myForm = document.getElementById('myForm');
    var data = new FormData(myForm);
    var xhr = new XMLHttpRequest();

    xhr.open('POST', "./crud/dashboardMember.php", true);
    xhr.onload = function () {
        if (xhr.status == 403 || xhr.status == 404) {
            alert("ERROR LOADING 3-UPLOAD.PHP");
        } else {
            document.getElementById("txt-member").innerHTML = this.responseText;
        }
    };
    xhr.send(data);


    var xhr = new XMLHttpRequest();

    xhr.open('POST', "./crud/dashboardWalk.php", true);
    xhr.onload = function () {
        if (xhr.status == 403 || xhr.status == 404) {
            alert("ERROR LOADING 3-UPLOAD.PHP");
        } else {
            document.getElementById("txt-walk").innerHTML = this.responseText;
        }
    };
    xhr.send(data);
}