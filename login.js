function validateForm() {
  const emailInput = document.getElementById("email");
  const passwordInput = document.getElementById("password");
  const emailError = document.getElementById("emailError");
  const passwordError = document.getElementById("passwordError");

  const email = emailInput?.value.replace(/^\s+|\s+$/g, "");
  const password = passwordInput?.value.replace(/^\s+|\s+$/g, "");

  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  emailError.textContent = "";
  passwordError.textContent = "";

  let isValid = true;

  if (!emailRegex.test(email)) {
    emailError.textContent = "Please enter a valid email address.";
    isValid = false;
  }

  if (password.length < 6) {
    passwordError.textContent = "Password must be at least 6 characters long.";
    isValid = false;
  }

  return isValid;
}
