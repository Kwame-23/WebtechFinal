
function validateForm() {
    var email = document.getElementById("remail").value;
    var password = document.getElementById("registerPassword").value;
    var confirmPassword = document.getElementById("confirmPassword").value;
    var contact = document.getElementById("contact").value;

    // var emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    // if (!emailPattern.test(email)) {
    //     alert("Please enter a valid email address.");
    //     return false;
    // }

    if (password.length < 8) {
        alert("Password must be at least 8 characters long.");
        return false;
    }

    if (password !== confirmPassword) {
        alert("Passwords do not match.");
        return false;
    }

    if (contact.length !== 10 || isNaN(contact)) {
        alert("Please enter a valid 10-digit contact number.");
        return false;
    }

    return true; 
}


function validateLoginForm() {
    var email = document.getElementById("lemail").value;
    var password = document.getElementById("password").value;

    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
        alert("Please enter a valid email address.");
        return false;
    }

    if (password.length < 8) {
        alert("Password must be at least 8 characters long.");
        return false;
    }

    return true; 
}