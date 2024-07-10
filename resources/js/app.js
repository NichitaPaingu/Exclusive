import './bootstrap';
import { setupNavigation } from './components/navigation/navigation.js';
import { loadEventListenerAuth } from './components/auth/auth.js';
import { setupContactForm } from './components/mail/contact.js'; // Импортируем setupContactForm
import './components/dropdown-menu/dropdown-menu-profile.js';

document.addEventListener('DOMContentLoaded', () => {
    setupNavigation();
    loadEventListenerAuth();
});
