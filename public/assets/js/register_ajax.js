document.getElementById("registerForm").addEventListener("submit", async function (e) {
    e.preventDefault();

    message = document.getElementById("message");
    const formData = new FormData(this);

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
        message.innerText = error;
        message.classList.add("color-error");
        return;
    }
});