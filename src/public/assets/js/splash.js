let emailTouched = false;
let passwordTouched = false;

function setEmailTouched() {
    emailTouched = true;
}

function setPasswordTouched() {
    passwordTouched = true;
}

function doAction() {
    if (window.location.pathname == '/login') {
        if (emailTouched == false && passwordTouched == false) {
            window.location.href = '/';
        }
    }
}

document.addEventListener('DOMContentLoaded', function() {
    setTimeout(doAction, 1000 * 60 * 1); 

    if (window.location.pathname == '/') {
        document.body.addEventListener('click', function() {
            window.location.href = '/login';
        });
    }
});