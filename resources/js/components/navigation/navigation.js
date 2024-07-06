import axios from 'axios';
import { loadEventListenerAuth } from '../auth/auth.js'; // Импорт функции

export function setupNavigation() {
    const navLinks = document.querySelectorAll('.nav-link, .breadcrumb-link');

    navLinks.forEach(link => {
        link.removeEventListener('click', handleNavClick); // Удаляем предыдущий обработчик
        link.addEventListener('click', handleNavClick); // Добавляем новый обработчик
    });

    // Handle back/forward buttons
    window.removeEventListener('popstate', handlePopState); // Удаляем предыдущий обработчик
    window.addEventListener('popstate', handlePopState); // Добавляем новый обработчик

    // Инициализация профилей при загрузке, если находимся на странице dashboard
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
}

function handleNavClick(event) {
    event.preventDefault();
    const url = this.getAttribute('data-url');
    if (url.startsWith('/profile')) {
        history.pushState(null, '', '/dashboard');
        loadPageContent('/dashboard', url); // Передаем url для загрузки профиля
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

function setupProfileLinks() {
    const profileLinks = document.querySelectorAll('.profile-link');

    profileLinks.forEach(link => {
        link.removeEventListener('click', handleProfileLinkClick);
        link.addEventListener('click', handleProfileLinkClick);
    });

    const editProfileBtn = document.querySelector('.btn-edit');
    if (editProfileBtn) {
        editProfileBtn.removeEventListener('click', handleEditProfileClick);
        editProfileBtn.addEventListener('click', handleEditProfileClick);
    }
}

function handleProfileLinkClick(event) {
    event.preventDefault();
    const url = this.getAttribute('data-url');
    loadProfileContent(url);
}

function handleEditProfileClick(event) {
    event.preventDefault();
    const url = this.getAttribute('data-url');
    loadProfileContent(url);
}

function loadProfileContent(url) {
    axios.get(url)
        .then(response => {
            document.getElementById('profile-content').innerHTML = response.data;
            setupProfileLinks();
            setupEditProfileForm();
            highlightActiveLink(url);
        })
        .catch(error => {
            console.error('Error loading profile content:', error);
        });
}

function setupEditProfileForm() {
    const form = document.getElementById('edit-profile-form');
    if (form) {
        const cancelButton = form.querySelector('.btn-cancel');
        if (cancelButton) {
            cancelButton.addEventListener('click', function(event) {
                showMessage("Update cancelled", 'success');
                loadProfileContent('/profile/info');
            });
        }
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(form);
            axios.post(form.action, formData)
                .then(response => {
                    showMessage(response.data.success, 'success'); // Используем функцию для показа сообщения
                    loadProfileContent('/profile/info');
                })
                .catch(error => {
                    console.error('Error updating profile:', error);
                });
        });
    }
}

function showMessage(message, type) {
    const messageContainer = document.getElementById('message-container');
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${type}`;
    alertDiv.textContent = message;

    messageContainer.appendChild(alertDiv);

    setTimeout(() => {
        alertDiv.remove();
    }, 5000); // Убираем сообщение через 5 секунд
}


function highlightActiveLink(activeUrl) {
    const profileLinks = document.querySelectorAll('.profile-link');
    profileLinks.forEach(link => {
        if (link.getAttribute('data-url') === activeUrl) {
            link.classList.add('active');
        } else {
            link.classList.remove('active');
        }
    });
}
