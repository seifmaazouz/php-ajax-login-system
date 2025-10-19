document.getElementById("loginForm").addEventListener("submit", async function(e) {
    e.preventDefault();

    message = document.getElementById("message");
    const formData = new FormData(this);

    try {
      const response = await fetch("../app/includes/login_user.php", {
        method: "POST",
        body: formData,
      });

      const result = await response.json();
      message.textContent = result.message;
      message.classList.add(result.success ? "color-success" : "color-error");

      if (result.success) {
        setTimeout(() => (window.location.href = "../views/welcome.php"), 1000);
      }
    } catch (err) {
      message.textContent = "error";
      message.classList.add("color-error");
    }
}); 