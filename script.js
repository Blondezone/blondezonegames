const toggle = () => {
    const theme = document.querySelector('button')
    const body = document.body;
    body.classList.toggle('light-mode');
    body.classList.toggle('dark-mode');
    // header.classList.toggle('light-mode');
    // header.classList.toggle('dark-mode');
    document.querySelector('.explore').classList.toggle('text-black')
    document.querySelector('.icon-mode').classList.toggle('hidden')
    theme.classList.toggle('hover:bg-zinc-200')

    if(document.querySelector('.icon-mode').classList.contains('hidden')){
        document.querySelector('.moon').classList.remove('hidden')
        // document.querySelector('login-box').classList.add('bg-white');
    } else (
        document.querySelector('.moon').classList.add('hidden')
    )
};

// const gameCards = document.querySelectorAll('.game-card');
// gameCards.forEach(card => {
//     card.addEventListener('mouseenter', () => {
//         card.classList.add('shadow-2xl');
//     });
//     card.addEventListener('mouseleave', () => {
//         card.classList.remove('shadow-2xl');
//     });
// });
