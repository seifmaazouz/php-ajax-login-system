document.getElementById("loginForm").addEventListener("submit", function(e) {
    e.preventDefault();

    const email = this.email.value;
    const password = this.password.value;

    message = document.getElementById("message");
    message.classList.remove("color-error", "color-success");
    message.innerText = "";
    if (!email || !password) {
        message.innerText = "Please fill in all fields.";
        message.classList.add("color-error");
        return;
    }

    message.innerText = "Logging in...";
    message.classList.add("color-success");
    
    // go to php to process login todo
});