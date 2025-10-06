addEventListener("DOMContentLoaded", function() {
    this.document.querySelector(".menu-icon").addEventListener("click", abrirMenu);
    this.document.querySelector("#close-menu").addEventListener("click", abrirMenu);
    this.document.querySelector(".sombra").addEventListener("click", abrirMenu);
})

let open = false;
function abrirMenu() {
    if (!open) {
        document.querySelector(".nav-menu").style.transform = "translateX(0)";
        open = true;
        document.querySelector(".sombra").style.display = "flex";
    } else {
        document.querySelector(".nav-menu").style.transform = "translateX(100%)";
        open = false;
        document.querySelector(".sombra").style.display = "none";
    }
}