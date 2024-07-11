import axios from 'axios';
import { setupEditProfileForm } from './editProfileForm';
import { setupAddressForms } from './addressHandlers';

export function setupProfileLinks() {
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

export function loadProfileContent(url) {
    axios.get(url)
        .then(response => {
            document.getElementById('profile-content').innerHTML = response.data;
            setupProfileLinks();
            setupEditProfileForm();
            setupAddressForms();
            highlightActiveLink(url);
        })
        .catch(error => {
            console.error('Error loading profile content:', error);
        });
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
