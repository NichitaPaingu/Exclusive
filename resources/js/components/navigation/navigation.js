import axios from 'axios';
import { loadEventListenerAuth } from '../auth/auth.js';
import { setupProfileLinks, loadProfileContent } from '../profile/profileHandlers.js';
import { setupLoginForm } from '../auth/login.js'; // Импортируем setupLoginForm
import { setupLogoutForm } from '../auth/logout.js'; // Импортируем setupLogoutForm
import { setupRegisterForm } from '../auth/register.js'; // Импортируем setupRegisterForm


export function setupNavigation() {
    const navLinks = document.querySelectorAll('.nav-link, .breadcrumb-link');

    navLinks.forEach(link => {
        link.removeEventListener('click', handleNavClick);
        link.addEventListener('click', handleNavClick);
    });

    window.removeEventListener('popstate', handlePopState);
    window.addEventListener('popstate', handlePopState);

    if (location.pathname.startsWith('/dashboard')) {
        setupProfileLinks();
        const profileLinks = document.querySelectorAll('.profile-link');
        if (profileLinks.length > 0) {
            const currentUrl = location.pathname;
            const defaultUrl = profileLinks[0].getAttribute('data-url');
            const profileUrl = currentUrl.startsWith('/profile') ? currentUrl : defaultUrl;
            loadProfileContent(profileUrl);
        }
    }

    setupLogoutForm();
}

function handleNavClick(event) {
    event.preventDefault();
    const url = this.getAttribute('data-url');
    if (url.startsWith('/profile')) {
        history.pushState(null, '', '/dashboard');
        loadPageContent('/dashboard', url);
    } else {
        history.pushState(null, '', url);
        loadPageContent(url);
    }
}

function handlePopState(event) {
    const state = event.state;
    const url = state ? state.url : location.pathname;
    loadPageContent(url);
}

function loadPageContent(url, profileUrl = null) {
    axios.get(url)
        .then(response => {
            const parser = new DOMParser();
            const doc = parser.parseFromString(response.data, 'text/html');
            const newContent = doc.querySelector('#dynamic-content');
            if (newContent) {
                document.getElementById('dynamic-content').innerHTML = newContent.innerHTML;
                if (url !== location.pathname) {
                    history.pushState({ url: url }, '', url);
                }
                setupNavigation();
                loadEventListenerAuth();

                if (url.startsWith('/dashboard')) {
                    setupProfileLinks();
                    if (profileUrl) {
                        loadProfileContent(profileUrl);
                    }
                }
            } else {
                redirectTo404();
            }
        })
        .catch(error => {
            if (axios.isCancel(error)) {
                console.log('Request canceled:', error.message);
            } else if (error.response && error.response.status === 404) {
                redirectTo404();
            } else {
                console.error('Error loading page content:', error);
            }
        });
}

function redirectTo404() {
    if (location.pathname !== '/404') {
        history.replaceState(null, '', '/404');
        loadPageContent('/404');
    }
}
