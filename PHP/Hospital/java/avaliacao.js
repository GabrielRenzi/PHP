document.addEventListener("DOMContentLoaded", () => {
    const escalaContainers = document.querySelectorAll(".escala-avaliacao");

    escalaContainers.forEach(container => {
        const radioButtons = container.querySelectorAll("input[type='radio']");
        
        radioButtons.forEach(radio => {
            radio.addEventListener("change", () => {
                container.querySelectorAll(".escala-item").forEach(item => {
                    item.classList.remove("selected");
                });

                if (radio.checked) {
                    radio.parentElement.classList.add("selected");
                }
            });
        });
    });
});
