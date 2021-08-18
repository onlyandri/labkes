$(document).ready(function () {
    $("#jam").load("waktu.php");
    setInterval(function () {
        $("#jam").load("waktu.php");
    }, 1000);
});