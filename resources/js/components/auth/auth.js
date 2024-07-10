import axios from 'axios';
import { setupRegisterForm } from './register';
import { setupLoginForm } from './login';

function loadRegisterForm(event) {
    event.preventDefault();
    axios.get('/ajax/register')
        .then(response => {
            document.getElementById('auth-content').innerHTML = response.data;
            loadEventListenerAuth();
            setupRegisterForm(); // Инициализация обработчика для формы регистрации
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
            loadEventListenerAuth();
            setupLoginForm(); // Инициализация обработчика для формы логина
        })
        .catch(error => {
            console.error('Error loading login form:', error);
        });
}

export function loadEventListenerAuth() {
    const registerLink = document.querySelector('.register-link');
    const loginLink = document.querySelector('.login-link');

    if (registerLink) {
        registerLink.removeEventListener('click', loadRegisterForm);
        registerLink.addEventListener('click', loadRegisterForm);
    }

    if (loginLink) {
        loginLink.removeEventListener('click', loadLoginForm);
        loginLink.addEventListener('click', loadLoginForm);
    }

    // Убедитесь, что события устанавливаются при загрузке страницы
    setupRegisterForm();
    setupLoginForm();
}
