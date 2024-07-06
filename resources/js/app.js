import './bootstrap';
import { loadEventListenerAuth } from './components/auth/auth.js';
import { setupNavigation } from './components/navigation/navigation.js';
import './components/mail/contact.js';
import './components/profile/profile.js';
import './components/dropdown-menu/dropdown-menu-profile.js';

// Убедитесь, что обработчики событий загружаются после полной загрузки страницы
document.addEventListener('DOMContentLoaded', () => {
    setupNavigation();
    loadEventListenerAuth();
    
});
