import './bootstrap';
import { setupNavigation } from './components/navigation/navigation.js';
import { loadEventListenerAuth } from './components/auth/auth.js';
import './components/mail/contact.js';
import './components/dropdown-menu/dropdown-menu-profile.js';

document.addEventListener('DOMContentLoaded', () => {
    setupNavigation();
    loadEventListenerAuth();
});
