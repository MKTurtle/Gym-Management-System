var head = document.getElementsByTagName('HEAD')[0];
var link = document.createElement('link');
link.rel = 'stylesheet';
link.type = 'text/css';
link.href = 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css';
head.appendChild(link);

var trylang = document.getElementById('member-type');
var name = document.getElementById('name');

trylang.onchange = function () {

    if (trylang.value == "member") {
        $("#name").autocomplete({
            source: "./crud/autocomplete.php",
            disabled: false,
            minLength: 1

        });
    } else {
        $("#name").autocomplete({
            disabled: true
        });
    }
}

function hidePromo() {
    var memberType = document.getElementById("membertype").value;

    var promo = document.getElementById("promoInfo");
    var price = document.getElementById("priceInfo");
    
    if (memberType == "nonMember") {
        promo.style.display = "block";
        price.style.display = "block";
    } else {
        promo.style.display = "none";
        price.style.display = "none";
    }
}

function changePromo() {
    var promo = document.getElementById("promo").value;

    var price = 180;

    if (promo == "student") {
        price = 80;
    }

    document.getElementById("price").value = price;
}


