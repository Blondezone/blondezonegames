const toggle = () => {
    const theme = document.querySelector('button');
    const iconMode = document.querySelector('.icon-mode');
    const moonIcon = document.querySelector('.moon');
    const loginBox = document.querySelector('.login-box');
    const body = document.body;
    const texts = document.querySelectorAll('.login-box h2, h1, p');
    const input = document.querySelectorAll('input');

    // Toggle light/dark modes
    body.classList.toggle('light-mode');
    body.classList.toggle('dark-mode');

    // Toggle visibility of elements and hover effect
    iconMode.classList.toggle('hidden');
    moonIcon.classList.toggle('hidden');
    loginBox.classList.toggle('bg-white');
    theme.classList.toggle('hover:bg-zinc-200');

    input.forEach((inputs) => {
        inputs.classList.toggle('bg-zinc-200')
    }
    )

    texts.forEach((text) => {
    text.classList.toggle('text-black');
    });

};
