import axios from 'axios';
import { showMessage } from '../navigation/messageHandlers';

export function setupContactForm() {
    const contactForm = document.querySelector('#contact-form');
    if (contactForm) {
        contactForm.addEventListener('submit', handleContactSubmit);
    }
}

function handleContactSubmit(event) {
    event.preventDefault();
    const formData = new FormData(event.target);

    axios.post('/api/contact/send', formData)
        .then(response => {
            if (response.data.message) {
                showMessage(response.data.message, 'success');
                document.getElementById('contact-form').reset();
            } else {
                showMessage('Something went wrong. Please try again.', 'danger');
            }
        })
        .catch(error => {
            if (error.response && error.response.data && error.response.data.errors) {
                const errors = error.response.data.errors;
                let errorMessages = '<ul>';
                Object.keys(errors).forEach(key => {
                    errorMessages += `<li>${errors[key][0]}</li>`;
                });
                errorMessages += '</ul>';
                showMessage(errorMessages, 'danger');
            } else {
                showMessage('An unexpected error occurred. Please try again.', 'danger');
            }
        });
}

