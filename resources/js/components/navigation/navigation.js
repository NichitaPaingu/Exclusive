import axios from 'axios';
import { loadEventListenerAuth } from '../auth/auth.js';
import { setupProfileLinks, loadProfileContent } from '../profile/profileHandlers.js';
import { setupLogoutForm } from '../auth/logout.js';
import { setupContactForm } from '../mail/contact.js';

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

    if (window.location.pathname === '/contact') {
        setupContactForm();
    }
}

function handleNavClick(event) {
    event.preventDefault();
    const url = this.getAttribute('data-url');
    if (url === '/wishlist' || url === '/cart') {
        checkAuthAndLoad(url);
    } else {
        loadPageContent(url);
    }
}

function handlePopState(event) {
    const state = event.state;
    const url = state ? state.url : location.pathname;
    loadPageContent(url);
}

function checkAuthAndLoad(url) {
    axios.get('/auth-check')
        .then(response => {
            if (response.data.authenticated) {
                // Пользователь аутентифицирован
                loadPageContent(url);
            } else {
                // Пользователь не аутентифицирован
                redirectToLogin();
            }
        })
        .catch(() => {
            // Если запрос на /user не удался, перенаправляем на страницу входа
            console.log("Запрос не удался");
            redirectToLogin();
        });
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

function redirectToLogin() {
    loadPageContent('/auth');
}
