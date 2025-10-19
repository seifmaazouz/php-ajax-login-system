document.getElementById("registerForm").addEventListener("submit", function(e) {
    e.preventDefault();

    const name = this.name.value;
    const email = this.email.value;
    const password = this.password.value;
    const confirmPassword = this.confirmPassword.value;

    message = document.getElementById("message");
    message.classList.remove("color-error", "color-success");
    message.innerText = "";
    if (!name || !email || !password || !confirmPassword) {
        message.innerText = "Please fill in all fields.";
        message.classList.add("color-error");
        return;
    }

    if (password !== confirmPassword) {
        message.innerText = "Passwords do not match.";
        message.classList.add("color-error");
        return;
    }

    message.innerText = "Registering...";
    message.classList.add("color-success");

    // go to php to process registration todo
});