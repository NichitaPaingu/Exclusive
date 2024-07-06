import axios from 'axios';

function loadRegisterForm(event) {
    event.preventDefault();
    axios.get('/ajax/register')
        .then(response => {
            document.getElementById('auth-content').innerHTML = response.data;
            loadEventListenerAuth(); // Повторно инициализируем обработчики формы
        })
        .catch(error => {
            console.error('Error loading register form:', error);
        });
}

function loadLoginForm(event) {
    event.preventDefault();
    axios.get('/ajax/login')
        .then(response => {
            document.getElementById('auth-content').innerHTML = response.data;
            loadEventListenerAuth(); // Повторно инициализируем обработчики формы
        })
        .catch(error => {
            console.error('Error loading login form:', error);
        });
}

export function loadEventListenerAuth() {
    const registerLink = document.querySelector('.register-link');
    const loginLink = document.querySelector('.login-link');

    if (registerLink) {
        registerLink.removeEventListener('click', loadRegisterForm); // Удаляем предыдущий обработчик
        registerLink.addEventListener('click', loadRegisterForm); // Добавляем новый обработчик
    }

    if (loginLink) {
        loginLink.removeEventListener('click', loadLoginForm); // Удаляем предыдущий обработчик
        loginLink.addEventListener('click', loadLoginForm); // Добавляем новый обработчик
    }
}
