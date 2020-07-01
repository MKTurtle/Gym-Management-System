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

function search() {
    // Declare variables
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("table");
    tr = table.getElementsByTagName("tr");


    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[3];
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




var table = document.getElementById('table');

var editModal = document.getElementById("edit-modal");
var addModal = document.getElementById("add-modal");
var expiredModal = document.getElementById("expired-modal");
var pictureModal = document.getElementById("picture-modal");
var membershipModal = document.getElementById("membership-modal");

var closeEditBtn = document.getElementsByClassName("modal-close-btn")[0];
var closeAddBtn = document.getElementsByClassName("modal-close-btn")[1];
var closePhotoBtn = document.getElementsByClassName("modal-close-btn")[2];
var closeExpiredBtn = document.getElementsByClassName("modal-close-btn")[3];

var ele = document.forms["member-description"].getElementsByTagName('input');
var addModalElement = document.forms["add-user-form"].getElementsByTagName('input');

var save = document.getElementById('save');
var remove = document.getElementById('remove');

var memberId = "";


for (var i = 1; i < table.rows.length; i++) {
    table.rows[i].onclick = function () {
        editModal.style.display = "block";
        document.getElementById("member-id").value = this.cells[0].innerHTML;
        document.getElementById("rfid").value = this.cells[1].innerHTML;
        document.getElementById("membership-date").value = this.cells[2].innerHTML;

        document.getElementById("name").value = this.cells[3].innerHTML;
        document.getElementById("namee").value = this.cells[3].innerHTML;

        document.getElementById("hidden-id").value = this.cells[0].innerHTML;
        document.getElementById("member-photo").src = "./web/images/members/" + this.cells[0].innerHTML + ".png?" + new Date().getTime();

        memberId = this.cells[0].innerHTML;

        
    };
}





closeEditBtn.onclick = function () {
    editModal.style.display = "none";

    for (i = 0; i < ele.length; i++) {
        if (ele[i].type == 'text') {
            ele[i].setAttribute("disabled", "disabled");
            save.setAttribute("disabled", "disabled");
            remove.setAttribute("disabled", "disabled");
        }
    }
}

closeAddBtn.onclick = function () {
    addModal.style.display = "none";

    for (i = 0; i < addModalElement.length; i++) {
        if (ele[i].type == 'text' || ele[i].type == 'password') {
            addModalElement[i].value = "";
        }
    }
}

closeExpiredBtn.onclick = function () {
    expiredModal.style.display = "none";
}

closePhotoBtn.onclick = function () {
    pictureModal.style.display = "none";
}


// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {

    if (event.target == editModal) {
        editModal.style.display = "none";
    }

    if (event.target == addModal) {
        addModal.style.display = "none";

        for (i = 0; i < addModalElement.length; i++) {
            if (ele[i].type == 'text' || ele[i].type == 'password') {
                addModalElement[i].value = "";
            }
        }
    }

    if (event.target == expiredModal) {
        expiredModal.style.display = "none";
    }

    if (event.target == pictureModal) {
        pictureModal.style.display = "none";

        stream.getTracks().forEach(track => track.stop())
    }
}

function edit() {

    var ele = document.forms["member-description"].getElementsByTagName('input');
    var save = document.getElementById('save');
    var remove = document.getElementById('remove');

    // LOOP THROUGH EACH ELEMENT.
    for (i = 0; i < ele.length; i++) {
        // CHECK THE ELEMENT TYPE.
        if (ele[i].type == 'text' || ele[i].type == 'date') {
            if (ele[i].hasAttribute("disabled")) {
                ele[i].removeAttribute("disabled");

                save.removeAttribute("disabled");
                remove.removeAttribute("disabled");

                
            } else {
                ele[i].setAttribute("disabled", "disabled");
                save.setAttribute("disabled", "disabled");
                remove.setAttribute("disabled", "disabled");
            }
        }
    }
}

function addMembership() {

    var promo = document.getElementById("promo").value;
    var extend = document.getElementById("extend").value;

    var price = 1800;

    if (promo == "student") {
        price = 1100;
    }

    var totalPrice = price * extend;

    document.getElementById("total-price").value = totalPrice;
}

function newMembership() {

    var membershipDate = document.getElementById("membership").value;

    var membershipSubscription  = monthDiff(new Date(), new Date(membershipDate))

    var promo = document.getElementById("member-promo").value;
    var price = 1800;

    if (promo == "student") {
        price = 1100;
    }

    var totalPrice = membershipSubscription * price;

    

    if (totalPrice < 0 ) {
        totalPrice = 0;
    }

    if (Number.isNaN(totalPrice)) {
        totalPrice = 0;
    }

    console.log(totalPrice);

    document.getElementById("total").value = totalPrice;
}

function monthDiff(dateFrom, dateTo) {
    //var tryyyy = document.getElementById("membership-date").value
    //console.log(monthDiff(new Date(), new Date(tryyyy)))

    return dateTo.getMonth() - dateFrom.getMonth() + 
      (12 * (dateTo.getFullYear() - dateFrom.getFullYear()))
}

function picture() {
    editModal.style.display = "none";
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
                    xhr.open('POST', "memberUpload.php", true);
                    xhr.onload = function () {
                        if (xhr.status == 403 || xhr.status == 404) {
                            alert("ERROR LOADING 3-UPLOAD.PHP");
                        } else {
                            pictureModal.style.display = "none";
                            document.getElementById("member-photo").src = "./web/images/members/" + memberId + ".png?" + new Date().getTime();      
                            editModal.style.display = "block";         
                                 
                            stream.getTracks().forEach(track => track.stop())
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

function addUser() {
    addModal.style.display = "block";
}

var trylang = document.getElementById("rfid");

input.addEventListener("keyup", function (event) {
    if (event.keyCode === 13) {
        event.preventDefault();
        document.getElementById("save").click();
    }
});

