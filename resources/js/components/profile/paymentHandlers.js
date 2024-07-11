import axios from 'axios';
import { showMessage } from '../navigation/messageHandlers';
import { formatCard } from './paymentForm.js';
import { loadProfileContent } from './profileHandlers';

export function setupPaymentForms() {
    setupCreatePaymentForm();
    setupEditPaymentForm();
    formatCard();
}

function setupCreatePaymentForm() {
    const createPaymentForm = document.getElementById('create-payment-form');
    if (createPaymentForm) {
        const cancelButton = createPaymentForm.querySelector('.btn-cancel');
        if (cancelButton) {
            cancelButton.addEventListener('click', function(event) {
                event.preventDefault();
                showMessage("Payment creation cancelled", 'success');
                loadProfileContent('/profile/payment');
            });
        }
        createPaymentForm.addEventListener('submit', handleCreatePaymentSubmit);
    }
}

function handleCreatePaymentSubmit(event) {
    event.preventDefault();
    const form = event.target;
    const formData = new FormData(form);

    // Удаляем пробелы и слеши перед отправкой данных
    formData.set('card_number', formData.get('card_number').replace(/\s+/g, ''));
    formData.set('expiry_date', formData.get('expiry_date').replace(/\//g, ''));
    formData.set('cvv', formData.get('cvv').replace(/\s+/g, ''));

    axios.post(form.action, formData)
        .then(response => {
            if (response.data.success) {
                showMessage(response.data.success, 'success');
                setTimeout(() => {
                    loadProfileContent('/profile/payment');
                }, 1000);
            } else {
                showMessage(response.data.error || 'Payment creation failed. Please try again.', 'danger');
            }
        })
        .catch(error => {
            const errorMessage = error.response && error.response.data && error.response.data.error
                ? error.response.data.error
                : 'An unexpected error occurred. Please try again.';
            showMessage(errorMessage, 'danger');
        });
}

function handleEditPaymentSubmit(event) {
    event.preventDefault();
    const form = event.target;
    const formData = new FormData(form);

    // Удаляем пробелы и слеши перед отправкой данных
    formData.set('card_number', formData.get('card_number').replace(/\s+/g, ''));
    formData.set('expiry_date', formData.get('expiry_date').replace(/\//g, ''));
    formData.set('cvv', formData.get('cvv').replace(/\s+/g, ''));

    axios.post(form.action, formData)
        .then(response => {
            if (response.data.success) {
                showMessage(response.data.success, 'success');
                setTimeout(() => {
                    loadProfileContent('/profile/payment');
                }, 1000);
            } else {
                showMessage(response.data.error || 'Payment update failed. Please try again.', 'danger');
            }
        })
        .catch(error => {
            const errorMessage = error.response && error.response.data && error.response.data.error
                ? error.response.data.error
                : 'An unexpected error occurred. Please try again.';
            showMessage(errorMessage, 'danger');
        });
}


function setupEditPaymentForm() {
    const editPaymentForms = document.querySelectorAll('[id^="edit-payment-form-"]');
    editPaymentForms.forEach(form => {
        const cancelButton = form.querySelector('.btn-cancel');
        if (cancelButton) {
            cancelButton.addEventListener('click', function(event) {
                event.preventDefault();
                showMessage("Payment update cancelled", 'success');
                loadProfileContent('/profile/payment');
            });
        }

        const deleteButton = form.querySelector('.btn-delete');
        if (deleteButton) {
            deleteButton.addEventListener('click', function(event) {
                event.preventDefault();
                const paymentId = deleteButton.getAttribute('data-id');
                handleDeletePayment(paymentId);
            });
        }

        form.addEventListener('submit', handleEditPaymentSubmit);
    });
}

function handleDeletePayment(paymentId) {
    if (!confirm('Are you sure you want to delete this payment option?')) {
        return;
    }

    axios.delete(`/profile/payment/${paymentId}`)
        .then(response => {
            if (response.data.success) {
                showMessage(response.data.success, 'success');
                setTimeout(() => {
                    loadProfileContent('/profile/payment');
                }, 1000);
            } else {
                showMessage(response.data.error || 'Payment deletion failed. Please try again.', 'danger');
            }
        })
        .catch(error => {
            const errorMessage = error.response && error.response.data && error.response.data.error
                ? error.response.data.error
                : 'An unexpected error occurred. Please try again.';
            showMessage(errorMessage, 'danger');
        });
}
