function initializeDarkMode() {
    const toggleBtn = document.getElementById("theme-toggle");
    
    if (!toggleBtn) {
        return; 
    }
    
    const newToggleBtn = toggleBtn.cloneNode(true);
    toggleBtn.parentNode.replaceChild(newToggleBtn, toggleBtn);

    const sun = newToggleBtn.querySelector("#icon-sun");
    const moon = newToggleBtn.querySelector("#icon-moon");

    if (!sun || !moon) {
        return;
    }
    
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
    
    newToggleBtn.addEventListener("click", () => {
        const newTheme = document.documentElement.classList.contains("dark") ? "light" : "dark";
        setTheme(newTheme);
    });
}
document.addEventListener("DOMContentLoaded", initializeDarkMode);
document.addEventListener("turbo:load", initializeDarkMode);