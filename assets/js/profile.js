const d = document;
const profile = d.getElementById("profile");
const user_profile = d.getElementById("user-profile");
const user_info = d.getElementById("user-info");
profile.addEventListener("click", (e) => {
  e.preventDefault();
  user_profile.classList.toggle("show");
  user_info.classList.toggle("close");
});
