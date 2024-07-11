import axios from 'axios';
import { showMessage } from '../navigation/messageHandlers';
import { loadProfileContent } from './profileHandlers';

export function setupAddressForms() {
    setupCreateAddressForm();
    setupEditAddressForm();
}

function setupCreateAddressForm() {
    const createAddressForm = document.getElementById('create-address-form');
    if (createAddressForm) {
        const cancelButton = createAddressForm.querySelector('.btn-cancel');
        if (cancelButton) {
            cancelButton.addEventListener('click', function(event) {
                event.preventDefault();
                showMessage("Creation cancelled", 'success');
                loadProfileContent('/profile/address');
            });
        }
        createAddressForm.addEventListener('submit', handleCreateAddressSubmit);
    }
}

function handleCreateAddressSubmit(event) {
    event.preventDefault();
    const formData = new FormData(event.target);

    axios.post(event.target.action, formData)
        .then(response => {
            if (response.data.success) {
                showMessage(response.data.success, 'success');
                setTimeout(() => {
                    loadProfileContent('/profile/address');
                }, 1000);
            } else {
                showMessage('Address creation failed. Please try again.', 'danger');
            }
        })
        .catch(error => {
            showMessage(error.response.data.error || 'An unexpected error occurred. Please try again.', 'danger');
        });
}

function setupEditAddressForm() {
    const editAddressForm = document.getElementById('edit-address-form');
    if (editAddressForm) {
        const cancelButton = editAddressForm.querySelector('.btn-cancel');
        if (cancelButton) {
            cancelButton.addEventListener('click', function(event) {
                event.preventDefault();
                showMessage("Update cancelled", 'success');
                loadProfileContent('/profile/address');
            });
        }
        editAddressForm.addEventListener('submit', handleEditAddressSubmit);
    }
}

function handleEditAddressSubmit(event) {
    event.preventDefault();
    const formData = new FormData(event.target);

    axios.post(event.target.action, formData)
        .then(response => {
            if (response.data.success) {
                showMessage(response.data.success, 'success');
                setTimeout(() => {
                    loadProfileContent('/profile/address');
                }, 1000);
            } else {
                showMessage('Address update failed. Please try again.', 'danger');
            }
        })
        .catch(error => {
            showMessage(error.response.data.error || 'An unexpected error occurred. Please try again.', 'danger');
        });
}
