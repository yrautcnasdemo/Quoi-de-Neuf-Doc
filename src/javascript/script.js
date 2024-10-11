let burgerNav = document.querySelector(".nav-burger");
let burgerButton = document.querySelector(".menu-burger");

burgerButton.addEventListener("click", () => {
    if(burgerNav.style.marginTop === "70px") {
        burgerNav.style.marginTop = "-170px";
    } else {
        burgerNav.style.marginTop = "70px";
    }
});