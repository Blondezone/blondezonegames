document.getElementById('toggleTheme').addEventListener('click', function() {
    const body = document.body;
    body.classList.toggle('light-mode');
    body.classList.toggle('dark-mode');
});

// Animação ao passar o mouse nos itens
const gameCards = document.querySelectorAll('.game-card');
gameCards.forEach(card => {
    card.addEventListener('mouseenter', () => {
        card.classList.add('shadow-2xl');
    });
    card.addEventListener('mouseleave', () => {
        card.classList.remove('shadow-2xl');
    });
});
