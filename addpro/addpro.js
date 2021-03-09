document.getElementById("product-image-con").onclick = function () {
    document.getElementById("choose-image").click();
}

function fastpreview(uploader) {
    if (uploader.files && uploader.files[0]) {
        document.getElementById('product-pic').src = window.URL.createObjectURL(uploader.files[0]);
    }
}

document.getElementById('choose-image').onchange = function () {
    fastpreview(this);
}