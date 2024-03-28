var timeoutInMinutes = 10; 
var timeoutId;

function startTimer() {
    timeoutId = setTimeout(function() {        
		window.location.href = "/logout"; 
	}, timeoutInMinutes * 60 * 1000); 
}

function resetTimer() {
    clearTimeout(timeoutId);
    startTimer();
}

document.addEventListener("DOMContentLoaded", function() {
	startTimer();

	// Reset timer on user activity
	document.addEventListener("mousemove", resetTimer);
	document.addEventListener("keypress", resetTimer);
});
