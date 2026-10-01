(() => {
    const form = document.querySelector('[data-questionario]');
    if (!form) return;
    const progress = document.getElementById('progresso-questionario');
    const text = document.getElementById('texto-progresso');
    const total = form.querySelectorAll('fieldset').length;
    const update = () => {
        const answered = new Set(Array.from(form.querySelectorAll('input[type="radio"]:checked'), input => input.name)).size;
        progress.max = total;
        progress.value = answered;
        text.textContent = `${answered} de ${total} perguntas respondidas`;
    };
    form.addEventListener('change', update);
    update();
})();
