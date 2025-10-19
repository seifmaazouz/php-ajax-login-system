document.getElementById("registerForm").addEventListener("submit", function(e) {
    e.preventDefault();

    const name = this.name.value;
    const email = this.email.value;
    const password = this.password.value;
    const confirmPassword = this.confirmPassword.value;

    message = document.getElementById("message");
    message.classList.remove("color-error", "color-success");
    message.innerText = "";
    if (!name && !email && !password && !confirmPassword) {
        message.innerText = "Please fill in all fields.";
        message.classList.add("color-error");
        return;
    }

    if (!name) {
        message.innerText = "Name cannot be empty.";
        message.classList.add("color-error");
        return;
    }

    if (!email) {
        message.innerText = "Email cannot be empty.";
        message.classList.add("color-error");
        return;
    }

    if (!password) {
        message.innerText = "Password cannot be empty.";
        message.classList.add("color-error");
        return;
    }

    if (!confirmPassword) {
        message.innerText = "Please confirm your password.";
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

    this.submit();
});