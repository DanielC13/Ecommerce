var prev = window.pageYOffset;
window.onscroll = function () {
    var curr = window.pageYOffset;
    if (prev > curr) {
        document.getElementById("nav").style.top = "0";
        document.getElementById("nav").style.opacity = "1";
    } else {
        document.getElementById("nav").style.top = "-52px";
        document.getElementById("nav").style.opacity = "0";
    }
    prev = curr;
};

function showmenu() {
    document.getElementById('side-menu').style.left = "0px";
    document.getElementById('closepanel').style.visibility = "visible";
}

function hidemenu() {
    document.getElementById('side-menu').style.left = "-400px";
    document.getElementById('closepanel').style.visibility = "hidden";
}

function panelhide(me) {
    document.getElementById('side-menu').style.left = "-400px";
    document.getElementById('side-cart').style.right = "-700px";
    me.style.visibility = "hidden";
}

function showcart() {
    document.getElementById('side-cart').style.right = "0px";
    document.getElementById('closepanel').style.visibility = "visible";
}

function hidecart() {
    document.getElementById('side-cart').style.right = "-700px";
    document.getElementById('closepanel').style.visibility = "hidden";
}

document.getElementById("btn-continue-shopping").onclick = function () {
    document.getElementById('side-cart').style.right = "-700px";
    document.getElementById('closepanel').style.visibility = "hidden";
    if (window.location.pathname !== "/Projects/shopping_cart/mine/index.php") {
        window.location.href = "index.php";
    }
}

document.getElementById("btn-proceed-to-checkout").onclick = function () {
    window.location.href = "checkout.php";
}

function deletecartitem(val) {
    // alert("each-cart-" + val + "");
    var num = Number(document.getElementById('count-cart').innerHTML);
    num -= 1;
    document.getElementById('count-cart').innerHTML = num;

    if (document.getElementById("butt-edit-" + val + "")) {
        document.getElementById("butt-edit-" + val + "").style = "background-color: white;";
        document.getElementById("butt-edit-" + val + "").innerHTML = "View Product";
        document.getElementById("butt-edit-" + val + "").onclick = function () {
            window.location.href = "viewpro.php?id=" + val + " ";
        }
    }

    var xhttp2 = new XMLHttpRequest();
    xhttp2.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("cart-list").innerHTML = this.responseText;

        }
    }
    xhttp2.open("GET", "backajax.php?delcart=" + val, true);
    xhttp2.send();

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("carttotal").innerHTML = this.responseText;
        }
    }
    xhttp.open("GET", "backajax.php?carttotal=1", true);
    xhttp.send();
}