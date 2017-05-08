$(document).ready(function() {
$("#submit").click(function() {
var name = $("#name").val();
var email = $("#email").val();
var message = $("#message").val();
var contact = $("#contact").val();
$("#returnmessage").empty();
if (name == '' || email == '' || contact == '') {
alert("Proszę wypełnić wszystkie pola");
} else {
$.post("contact_form.php", {
name1: name,
email1: email,
message1: message,
contact1: contact,
date: datepicker
}, function(data) {
$("#returnmessage").append(data);
if (data == "Twoja wiadomość jest dla nas bardzo ważna. Wkrótce odpowiemy na nią") {
$("#form")[0].reset();
}
});
}
});
});