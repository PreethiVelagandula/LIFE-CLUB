/*data table container starts*/
window.addEventListener('DOMContentLoaded', function () {
    var container = document.getElementById('data-table-container');
    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            container.innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "display_data.php", true);
    xhttp.send();
});
/*data table container ends*/



