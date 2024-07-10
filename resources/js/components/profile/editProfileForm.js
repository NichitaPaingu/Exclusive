import axios from 'axios';
import { showMessage } from '../navigation/messageHandlers';
import { loadProfileContent } from './profileHandlers';

export function setupEditProfileForm() {
    const form = document.getElementById('edit-profile-form');
    if (form) {
        const cancelButton = form.querySelector('.btn-cancel');
        if (cancelButton) {
            cancelButton.addEventListener('click', function(event) {
                event.preventDefault();
                showMessage("Update cancelled", 'success');
                loadProfileContent('/profile/info');
            });
        }
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(form);
            axios.post(form.action, formData)
                .then(response => {
                    if (response.data.success) {
                        showMessage(response.data.success, 'success');
                        loadProfileContent('/profile/info');
                    } else if (response.data.error) {
                        showMessage(response.data.error, 'danger');
                    }
                })
                .catch(error => {
                    if (error.response && error.response.data && error.response.data.error) {
                        showMessage(error.response.data.error, 'danger');
                    } else {
                        showMessage('An unexpected error occurred. Please try again.', 'danger');
                    }
                    console.error('Error updating profile:', error);
                });
        });
    }
}
