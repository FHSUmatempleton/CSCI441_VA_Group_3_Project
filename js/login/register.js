var strength = {
    0: "Worst",
    1: "Bad",
    2: "Weak",
    3: "Good",
    4: "Strong"
}

// Password strength checking and validation
// Get all objects to work with
var password = document.getElementById('password');
var passwordConfirm = document.getElementById('confirmPass');
var meter = document.getElementById('password-strength-meter');
var text = document.getElementById('password-strength-text');
var submitButton = document.getElementById('submitButton');
var pConfirmText = document.getElementById('password-confirm-text');

// Do the same thing in both the password and password confirmation fields
// Checks strength of password using zxcvbn library, displays tips on
// making password more secure, handles submit disable/enable, handles
// password matching on the front end.
password.addEventListener('input', function() {
    var val = password.value;
    var result = zxcvbn(val);
    meter.value = result.score;
    if (val !== "") {
        text.innerHTML = "Strength: " + "<strong>" + strength[result.score] + "</strong>" + "</br><span class='feedback'>" + result.feedback.warning + " " + result.feedback.suggestions + "</span"; 
    } else {
        text.innerHTML = "";
    }
    if ((result.score > 1) && (password.value == passwordConfirm.value)) {
        submitButton.disabled = false;
        pConfirmText.innerHTML = "";
    } else if (passwordConfirm.value == "") {
        pConfirmText.innerHTML = "";
    } else if (password.value != passwordConfirm.value) {
        submitButton.disabled = true;
        pConfirmText.innerHTML = "Passwords do not match";
    }
});

passwordConfirm.addEventListener('input', function() {
    var val = password.value;
    var result = zxcvbn(val);
    if ((result.score > 1) && (password.value == passwordConfirm.value)) {
        submitButton.disabled = false;
        pConfirmText.innerHTML = "";
    } else if (passwordConfirm.value == "") {
        pConfirmText.innerHTML = "";
    } else if (password.value != passwordConfirm.value) {
        submitButton.disabled = true;
        pConfirmText.innerHTML = "Passwords do not match";
    }
});

// Limit state field to letters only.
var stateInput = document.getElementById("state");
state.addEventListener("keypress", function(e) {
    if ((e.which < 65) || (e.which > 90 && e.which < 97) || (e.which > 122)) {
        e.preventDefault();
    }
})