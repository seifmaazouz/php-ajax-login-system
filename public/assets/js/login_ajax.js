document.getElementById("loginForm").addEventListener("submit", async function(e) {
    e.preventDefault();

    message = document.getElementById("message");
    const formData = new FormData(this);

    const email = formData.get("email").trim();
    const password = formData.get("password").trim();

    if (!email && !password) {
        message.innerText = "Please fill in all fields.";
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


    // All validations passed, proceed with AJAX request
    try {
      const response = await fetch("../app/includes/login_user.php", {
        method: "POST",
        body: formData,
      });

      const result = await response.json();
      message.textContent = result.message;
      if (!result.success) {
        message.classList.remove("color-success");
        message.classList.add("color-error");
        return
      }

      message.classList.remove("color-error");
      message.classList.add("color-success");
      setTimeout(() => (window.location.href = "../views/welcome.php"), 1000);

    } catch (err) {
      message.textContent = err.message;
      message.classList.add("color-error");
    }
}); 