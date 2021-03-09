function deletecartitem2(val) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("checkout-cart-list").innerHTML = this.responseText;
        }
    }
    xhttp.open("GET", "backajax.php?delcart2=" + val, true);
    xhttp.send();

    var xhttp2 = new XMLHttpRequest();
    xhttp2.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("checkout-carttotal").innerHTML = this.responseText;
        }
    }
    xhttp2.open("GET", "backajax.php?carttotal=1", true);
    xhttp2.send();
}

function placeorder() {
    document.getElementById("sub-place-order").click();
}

// document.getElementById("each-all-id").getAttribute("data-each-id").onmouseover = function () {
//     alert('abc');
// }
