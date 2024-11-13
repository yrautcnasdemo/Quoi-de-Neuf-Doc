// MENU BURGER 
let burgerNav = document.querySelector(".nav-burger");
let burgerButton = document.querySelector(".menu-burger");

burgerButton.addEventListener("click", () => {
    if(burgerNav.style.marginRight === "0px") {
        burgerNav.style.marginRight = "-180px";
    } else {
        burgerNav.style.marginRight = "0px";
    }
});


/* SLIDER IMG RESPONSIVE HOMEPAGE*/
const slides = document.querySelector('.slide-images');
const images = document.querySelectorAll('.slide-images img');
let index = 0;

function showNextSlide() {
    index = (index + 1) % images.length;
    slides.style.transform = `translateX(${-index * 360}px)`;
}
setInterval(showNextSlide, 5000);




// Modal Loging & register - @Nouvelle-Techno - On se serre des Data-target pour selection la "modal" ou la "modal2"
window.onload = () => {
    //On récupère tous les boutons d'ouverture de modale
    const modalButtons = document.querySelectorAll("[data-toggle=modal]");

    for(let button of modalButtons){
        button.addEventListener("click", function(e){
            //on empeche la navigation
            e.preventDefault();
            //On récupere le data-target
            let target = this.dataset.target

            //on récupère la bonne modal 
            let modal = document.querySelector(target);
            //On affiche la modal 
            modal.classList.add("show");

            //On récupere les boutons de fermeture
            const modalClose = modal.querySelectorAll("[data-dismiss=dialog]");

            for(let close of modalClose) {
                close.addEventListener("click", () => {
                    modal.classList.remove("show");
                });
            }

            //On gere la fermeture lors du clique dans la zone grise
            modal.addEventListener("click", function(){
                this.classList.remove("show");
            });
            //On évite la propagation du click d'un enfant a son parent grace a la fonction native JS "stopPropagation"
            modal.children[0].addEventListener("click", function(e){
                e.stopPropagation();
            })
        });
    }
}
