function chk(evt) {
    if (evt.checked) {
        document.getElementById("txtpass").type = "text";
    } else {
        document.getElementById("txtpass").type = "password";
    }
}