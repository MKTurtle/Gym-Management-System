const getCellValue = (tr, idx) => tr.children[idx].innerText || tr.children[idx].textContent;

const comparer = (idx, asc) => (a, b) => ((v1, v2) =>
    v1 !== '' && v2 !== '' && !isNaN(v1) && !isNaN(v2) ? v1 - v2 : v1.toString().localeCompare(v2)
)(getCellValue(asc ? a : b, idx), getCellValue(asc ? b : a, idx));

// do the work...
document.querySelectorAll('th').forEach(th => th.addEventListener('click', (() => {
    const table = th.closest('table');
    const tbody = table.querySelector('tbody');


    Array.from(tbody.querySelectorAll('tr'))
        .sort(comparer(Array.from(th.parentNode.children).indexOf(th), this.asc = !this.asc))
        .forEach(tr => tbody.appendChild(tr));
})));

// a c
// b b
// c a


var table = document.getElementById('table');

var modal = document.getElementById("user-modal");
var addModal = document.getElementById("add-modal");
var pictureModal = document.getElementById("picture-modal");

var span = document.getElementsByClassName("modal-close-btn")[0];
var closeAddModal = document.getElementsByClassName("modal-close-btn")[1];
var closePhotoBtn = document.getElementsByClassName("modal-close-btn")[2];


var ele = document.forms["user-description"].getElementsByTagName('input');
var addModalElement = document.forms["add-user-form"].getElementsByTagName('input');

var save = document.getElementById('save');
var remove = document.getElementById('remove');

var userId = "";



for (var i = 1; i < table.rows.length; i++) {
    table.rows[i].onclick = function () {
        modal.style.display = "block";
        document.getElementById("userId").value = this.cells[0].innerHTML;
        document.getElementById("username").value = this.cells[1].innerHTML;
        document.getElementById("staff").value = this.cells[2].innerHTML;
        document.getElementById("account").value = this.cells[3].innerHTML;
        document.getElementById("position").value = this.cells[4].innerHTML;
        document.getElementById("staff-id").value = this.cells[5].innerHTML;

        document.getElementById("hidden-id").value = this.cells[0].innerHTML; // photo
        document.getElementById("user-photo").src = "./web/images/users/" + this.cells[0].innerHTML + ".png?" + new Date().getTime();

        userId = this.cells[0].innerHTML;
    };
}



span.onclick = function () {
    modal.style.display = "none";

    for (i = 0; i < ele.length; i++) {
        if (ele[i].type == 'text') {
            ele[i].setAttribute("disabled", "disabled");
            save.setAttribute("disabled", "disabled");
            remove.setAttribute("disabled", "disabled");
        }
    }
}

closeAddModal.onclick = function () {
    addModal.style.display = "none";

    for (i = 0; i < addModalElement.length; i++) {
        if (ele[i].type == 'text' || ele[i].type == 'password') {
            addModalElement[i].value = "";
        }
    }
}

closePhotoBtn.onclick = function () {
    pictureModal.style.display = "none";
}


// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";

        for (i = 0; i < ele.length; i++) {
            if (ele[i].type == 'text') {
                ele[i].setAttribute("disabled", "disabled");
                save.setAttribute("disabled", "disabled");
                remove.setAttribute("disabled", "disabled");
            }
        }
    }

    if (event.target == addModal) {
        addModal.style.display = "none";

        for (i = 0; i < addModalElement.length; i++) {
            if (ele[i].type == 'text' || ele[i].type == 'password') {
                addModalElement[i].value = "";
            }
        }
    }

    if (event.target == pictureModal) {
        pictureModal.style.display = "none";
    }
}

function edit() {

    var ele = document.forms["user-description"].getElementsByTagName('input');
    var save = document.getElementById('save');
    var remove = document.getElementById('remove');
    var account = document.getElementById('account');
    var position = document.getElementById('position');


    // LOOP THROUGH EACH ELEMENT.
    for (i = 0; i < ele.length; i++) {
        // CHECK THE ELEMENT TYPE.
        if (ele[i].type == 'text' || ele[i].type == 'password') {
            if (ele[i].hasAttribute("disabled")) {
                ele[i].removeAttribute("disabled");
                save.removeAttribute("disabled");
                remove.removeAttribute("disabled");
                account.removeAttribute("disabled");
                position.removeAttribute("disabled");
            } else {
                ele[i].setAttribute("disabled", "disabled");
                save.setAttribute("disabled", "disabled");
                remove.setAttribute("disabled", "disabled");
                account.setAttribute("disabled", "disabled");
                position.setAttribute("disabled", "disabled");
            }
        }
    }
}

function picture() {
    modal.style.display = "none";
    pictureModal.style.display = "block";

    var video = document.getElementById("vid-show"),
        canvas = document.getElementById("vid-canvas"),
        take = document.getElementById("vid-take");

    // [2] ASK FOR USER PERMISSION TO ACCESS CAMERA
    // WILL FAIL IF NO CAMERA IS ATTACHED TO COMPUTER
    navigator.mediaDevices.getUserMedia({ video: true })
        .then(function (stream) {
            // [3] SHOW VIDEO STREAM ON VIDEO TAG
            video.srcObject = stream;
            video.play();

            // [4] WHEN WE CLICK ON "TAKE PHOTO" BUTTON
            take.addEventListener("click", function () {
                // Create snapshot from video
                var draw = document.createElement("canvas");
                draw.width = video.videoWidth;
                draw.height = video.videoHeight;
                var context2D = draw.getContext("2d");
                context2D.drawImage(video, 0, 0, video.videoWidth, video.videoHeight);
                // Upload to server
                draw.toBlob(function (blob) {

                    let myForm = document.getElementById('myForm');
                    var data = new FormData(myForm);
                    data.append('upimage', blob);

                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', "userUpload.php", true);
                    xhr.onload = function () {
                        if (xhr.status == 403 || xhr.status == 404) {
                            alert("ERROR LOADING 3-UPLOAD.PHP");
                        } else {
                            pictureModal.style.display = "none";
                            document.getElementById("user-photo").src = "./web/images/users/" + userId + ".png?" + new Date().getTime();      
                            modal.style.display = "block";         
                                 
                        }
                    };
                    xhr.send(data);
                });
            });
        })
        .catch(function (err) {
            document.getElementById("vid-controls").innerHTML = "Please enable access and attach a camera";
        });
}

function search() {
    // Declare variables
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("table");
    tr = table.getElementsByTagName("tr");


    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[1];
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}

function addUser() {
    addModal.style.display = "block";
}