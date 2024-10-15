// MENU BURGER 
let burgerNav = document.querySelector(".nav-burger");
let burgerButton = document.querySelector(".menu-burger");

burgerButton.addEventListener("click", () => {
    if(burgerNav.style.marginTop === "70px") {
        burgerNav.style.marginTop = "-170px";
    } else {
        burgerNav.style.marginTop = "70px";
    }
});




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
