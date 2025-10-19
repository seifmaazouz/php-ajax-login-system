document.getElementById("registerForm").addEventListener("submit", async function (e) {
    e.preventDefault();

    message = document.getElementById("message");
    const formData = new FormData(this);

    const name = formData.get("name").trim();
    const email = formData.get("email").trim();
    const password = formData.get("password").trim();
    const confirm_password = formData.get("confirmPassword").trim();

    if (!name && !email && !password && !confirm_password) {
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

    const emailregex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailregex.test(email)) {
        message.innerText = "Please enter a valid email address.";
        message.classList.add("color-error");
        return;
    }

    if (!password) {
        message.innerText = "Password cannot be empty.";
        message.classList.add("color-error");
        return;
    }

    if (!confirm_password) {
        message.innerText = "Please confirm your password.";
        message.classList.add("color-error");
        return;
    }

    if (password !== confirm_password) {
        message.innerText = "Passwords do not match.";
        message.classList.add("color-error");
        return;
    }


    // All validations passed, proceed with AJAX request
    try {
        const response = await fetch('../app/includes/register_user.php', {
            method: 'POST',
            body: formData
        });

        const result = await response.json();
        message.innerText = result.message;
        if (!result.success) {
            message.classList.remove("color-success");
            message.classList.add("color-error");
            return;
        }

        message.classList.remove("color-error");
        message.classList.add("color-success");
        setTimeout(() => (window.location.href = "login.html"), 1000); // delay for user to see success message
    } catch (error) {
        message.innerText = error.message;
        message.classList.add("color-error");
        return;
    }
});