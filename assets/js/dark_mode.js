document.addEventListener("DOMContentLoaded", () => {
  const toggleBtn = document.getElementById("theme-toggle");
  const sun = document.getElementById("icon-sun");
  const moon = document.getElementById("icon-moon");

  const setTheme = (theme) => {
    document.documentElement.classList.toggle("dark", theme === "dark");
    localStorage.setItem("theme", theme);
    if (theme === "dark") {
      sun.classList.add("hidden");
      moon.classList.remove("hidden");
    } else {
      moon.classList.add("hidden");
      sun.classList.remove("hidden");
    }
  };

  const currentTheme = document.documentElement.classList.contains("dark") ? "dark" : "light";
  setTheme(currentTheme);

  toggleBtn.addEventListener("click", () => {
    const newTheme = document.documentElement.classList.contains("dark") ? "light" : "dark";
    setTheme(newTheme);
  });
});
