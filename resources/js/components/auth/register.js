import axios from 'axios';
import { showMessage } from '../navigation/messageHandlers';

export function setupRegisterForm() {
    const registerForm = document.querySelector('#register-form');
    if (registerForm) {
        registerForm.addEventListener('submit', handleRegisterSubmit);
    }
}

function handleRegisterSubmit(event) {
    event.preventDefault();
    const formData = new FormData(event.target);

    axios.post('/api/register', formData)
        .then(response => {
            if (response.data.success) {
                showMessage(response.data.success, 'success');
                setTimeout(() => {
                    window.location.href = '/dashboard';
                }, 1000);
            } else {
                showMessage('Registration failed. Please try again.', 'danger');
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
