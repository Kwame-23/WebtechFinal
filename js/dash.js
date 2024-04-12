// JavaScript code for feedback button functionality
var feedbackBtn = document.getElementById("feedbackBtn");
var feedbackModal = document.getElementById("feedbackModal");
var closeBtn = document.getElementsByClassName("close")[0];
var feedbackForm = document.getElementById("feedbackForm");
var feedbackText = document.getElementById("feedbackText");

feedbackBtn.onclick = function() {
    feedbackModal.style.display = "block";
}

closeBtn.onclick = function() {
    feedbackModal.style.display = "none";
}

window.onclick = function(event) {
    if (event.target == feedbackModal) {
        feedbackModal.style.display = "none";
    }
}

feedbackForm.onsubmit = function(event) {
    event.preventDefault(); // Prevent form submission
    var userFeedback = feedbackText.value;
    // Here you can send the feedback data to your backend or do something with it
    console.log("User feedback:", userFeedback);
    feedbackModal.style.display = "none"; // Close the modal after submission
}
