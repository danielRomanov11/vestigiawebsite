// script.js

// Smooth scroll to a section
function scrollToSection(sectionId) {
    const section = document.getElementById(sectionId);
    if (section) {
        section.scrollIntoView({ behavior: 'smooth' });
    }
}

// Simulate newsletter subscription
function subscribeNewsletter() {
    const emailInput = document.getElementById('email');
    const email = emailInput.value;

    if (email) {
        alert(`Thank you for subscribing, ${email}!`);
        emailInput.value = ''; // Clear the input field
    } else {
        alert('Please enter a valid email address.');
    }
}
