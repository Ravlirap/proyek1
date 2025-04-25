function validateForm() {
    const username = document.getElementById("username").value.trim();
    const password = document.getElementById("password").value.trim();
    const errorMsg = document.getElementById("error-msg");
  
    if (!username || !password) {
      errorMsg.textContent = "Username dan password wajib diisi!";
      const box = document.querySelector(".login-box");
      box.classList.add("shake");
  
      setTimeout(() => box.classList.remove("shake"), 500);
      return false;
    }
  
    return true;
  }
  