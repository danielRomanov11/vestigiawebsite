const hamburgerBtn = document.querySelector('.hamburger-btn');
const mobileMenu = document.querySelector('.mobile-menu');
const closeBtn = document.querySelector('.close-btn');

if (hamburgerBtn && mobileMenu && closeBtn) {
  // Hamburger Menu Toggle
  hamburgerBtn.addEventListener('click', () => {
    mobileMenu.classList.toggle('open');
    document.body.classList.toggle('overlay-open'); // Prevent background scrolling
  });

  // Close Button Functionality
  closeBtn.addEventListener('click', () => {
    mobileMenu.classList.remove('open');
    document.body.classList.remove('overlay-open'); // Allow background scrolling
  });
}

// Profile Dropdown Toggle (if applicable)
const profileBtn = document.querySelector('.profile-btn'); 
const profileDropdown = document.querySelector('.dropdown-menu');

if (profileBtn && profileDropdown) { // Check if elements exist
  profileBtn.addEventListener('click', (event) => {
    event.stopPropagation(); 
    profileDropdown.style.display = 
      profileDropdown.style.display === 'block' ? 'none' : 'block';
  });
}

document.addEventListener('DOMContentLoaded', () => {
  const currentPath = window.location.pathname;
  const navLinks = document.querySelectorAll('.nav-link');

  navLinks.forEach(link => {
    if (link.getAttribute('href') === currentPath) {
      link.classList.add('active');
    }
  });
});