function proimg() {
    document.getElementById("choose-image").click();
}

function fastpreview(uploader) {
    if (uploader.files && uploader.files[0]) {
        document.getElementById('product-pic').src = window.URL.createObjectURL(uploader.files[0]);
    }
}

function chgimg() {
    fastpreview(this);
}

function incquan(me) {
    me.parentNode.querySelector('#pro-quantity').stepUp();
    document.getElementById("pro-quantity").onkeyup();
}

function decquan(me) {
    me.parentNode.querySelector('#pro-quantity').stepDown();
    document.getElementById("pro-quantity").onkeyup();
}

function valquan(me) {
    var quantity = me.value;
    var price = Number(parseFloat(document.getElementById("get-price").innerHTML).toFixed(2));
    var total = quantity * Number(price);
    document.getElementById("total-price").value = total.toFixed(2);
}