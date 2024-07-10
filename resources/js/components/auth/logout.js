import axios from 'axios';
import { showMessage } from '../navigation/messageHandlers';

export function setupLogoutForm() {
    const logoutForm = document.querySelector('.logout-form');
    if (logoutForm) {
        logoutForm.addEventListener('submit', handleLogoutSubmit);
    }
}

function handleLogoutSubmit(event) {
    event.preventDefault(); // Предотвращаем стандартную отправку формы

    axios.post('/api/logout')
        .then(response => {
            if (response.data.success) {
                showMessage(response.data.success, 'success');
                setTimeout(() => {
                    window.location.href = '/auth';
                }, 1000); // Задержка на 1 секунду для отображения сообщения
            } else {
                showMessage('Logout failed. Please try again.', 'danger');
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
