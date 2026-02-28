function showForm(formId) {
  document.querySelectorAll(".form-box").forEach((formBox) => {
    formBox.classList.remove("active");
  });
  document.getElementById(formId).classList.add("active");
}

const loginButton = document.getElementById("login-btn");
const registerForm = document.getElementById("register-btn");
loginButton.addEventListener("click", (event) => {
  event.preventDefault();
  showForm("login-form");
}); 
registerForm.addEventListener("click", (event) => {
  event.preventDefault();
  showForm("register-form");
});
