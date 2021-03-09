document.getElementById("profile-image-con").onclick = function () {
    document.getElementById("signform-user-image").click();
}

function fastpreview(uploader) {
    if (uploader.files && uploader.files[0]) {
        document.getElementById('profile-pic').src = window.URL.createObjectURL(uploader.files[0]);
    }
}

document.getElementById('signform-user-image').onchange = function () {
    fastpreview(this);
}

// if (document.getElementById('signform-user-email').value === "<br /><b>Notice</b>:  Undefined index: reemail in <b>E:\\xampp\\htdocs\\Projects\\Shopping_cart\\mine\\signup.php</b> on line <b>18</b><br />") {
//     document.getElementById('signform-user-email').value = "";
//     document.getElementById('signform-user-name').value = "";
// }
