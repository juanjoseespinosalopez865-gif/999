window.addEventListener("scroll", function() {
    const btn = document.getElementById("carrito-flotante");
    if (window.scrollY > 300) {
        btn.classList.remove("oculto");
    } else {
        btn.classList.add("oculto");
    }
});

document.getElementById("carrito-flotante").addEventListener("click", () => {
    window.location.href = "#paquetes";
});
