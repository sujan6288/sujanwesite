document.addEventListener("DOMContentLoaded", () => {
  const msg = document.querySelector(".msg");
  if (msg && msg.textContent.trim().length) {
    msg.style.transition = "opacity 1s";
    setTimeout(() => msg.style.opacity = "0.9", 150);
  }
});
