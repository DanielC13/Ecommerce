function sortlist(head) {
    var wut = head.getAttribute("data-order-header");
    var type = head.getAttribute("data-sort-type");
    var xhttp = new XMLHttpRequest();
    if (type == "asc") {
        head.setAttribute("data-sort-type", "desc");
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("order-list-con").innerHTML = this.responseText;
            }
        }
        xhttp.open("GET", "backajax.php?sortlist=" + wut + "&sorttype=asc", true);
        xhttp.send();
    } else if (type == "desc") {
        head.setAttribute("data-sort-type", "asc");
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("order-list-con").innerHTML = this.responseText;
            }
        }
        xhttp.open("GET", "backajax.php?sortlist=" + wut + "&sorttype=desc", true);
        xhttp.send();
    }
}

function search(word) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("order-list-con").innerHTML = this.responseText;
        }
    }
    xhttp.open("GET", "backajax.php?search=" + word, true);
    xhttp.send();
}