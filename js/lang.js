document.addEventListener("DOMContentLoaded", function () {

    const buttons = document.querySelectorAll(".lang-btn");

    const origin = window.location.origin;
    let path = window.location.pathname;

    // Remove trailing slash (kecuali root)
    if (path.length > 1 && path.endsWith("/")) {
        path = path.slice(0, -1);
    }

    // Detect if English
    const isEnglish = path === "/en" || path.startsWith("/en/");

    // Remove /en from path for clean switching
    let cleanPath = path.replace(/^\/en/, "");

    // ===== ACTIVE CLASS =====
    buttons.forEach(btn => {
        btn.classList.remove("active");

        if (btn.dataset.lang === "en" && isEnglish) {
            btn.classList.add("active");
        }

        if (btn.dataset.lang === "id" && !isEnglish) {
            btn.classList.add("active");
        }
    });

    // ===== CLICK HANDLER =====
    buttons.forEach(btn => {
        btn.addEventListener("click", function (e) {
            e.preventDefault();

            if (this.dataset.lang === "en") {
                window.location.href = origin + "/en" + cleanPath;
            } else {
                window.location.href = origin + (cleanPath || "/");
            }
        });
    });

});