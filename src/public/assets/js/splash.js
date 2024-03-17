document.addEventListener('DOMContentLoaded', function() {
    setTimeout(redirectToMainScreen, 5000); 

    document.body.addEventListener('click', redirectToMainScreen);
});

function redirectToMainScreen() {
    window.location.href = "/login";
}