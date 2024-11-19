document.addEventListener("DOMContentLoaded", () => {
    const escalaContainers = document.querySelectorAll(".escala-avaliacao");

    escalaContainers.forEach(container => {
        const radioButtons = container.querySelectorAll("input[type='radio']");
        
        radioButtons.forEach(radio => {
            radio.addEventListener("change", () => {
                // Remover a classe 'selected' de todos os itens no container atual
                container.querySelectorAll(".escala-item").forEach(item => {
                    item.classList.remove("selected");
                });

                // Adicionar a classe 'selected' ao label pai do input selecionado
                if (radio.checked) {
                    radio.parentElement.classList.add("selected");
                }
            });
        });
    });
});
