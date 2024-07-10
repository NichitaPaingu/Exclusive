import axios from 'axios';
import { showMessage } from '../navigation/messageHandlers';

export function setupLoginForm() {
    const loginForm = document.querySelector('#login-form');
    if (loginForm) {
        loginForm.addEventListener('submit', handleLoginSubmit);
    }
}

function handleLoginSubmit(event) {
    event.preventDefault();
    const formData = new FormData(event.target);

    axios.post('/api/login', formData)
        .then(response => { 
            if (response.data.success) {
                showMessage(response.data.success, 'success');
                setTimeout(() => {
                    window.location.href = '/dashboard';
                }, 1000);
            } else {
                showMessage('Login failed. Please try again.', 'danger');
            }
        })
        .catch(error => {
            if (error.response && error.response.data && error.response.data.error) {
                showMessage(error.response.data.error, 'danger');
            } else {
                showMessage('An unexpected error occurred. Please try again.', 'danger');
            }
        });
}
