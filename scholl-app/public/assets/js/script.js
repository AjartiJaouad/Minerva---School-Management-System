// Parallax effect on scroll
window.addEventListener('scroll', () => {
    const scrolled = window.pageYOffset;
    const leaves = document.querySelectorAll('.leaf');
    leaves.forEach((leaf, index) => {
        const speed = 0.5 + (index * 0.2);
        leaf.style.transform += ` translateY(${scrolled * speed}px)`;
    });
});

// Card hover effect
const cards = document.querySelectorAll('.feature-card, .module-card');
cards.forEach(card => {
    card.addEventListener('mouseenter', function() {
        this.style.transition = 'all 0.3s ease';
    });
});




// Tab switching functionality
function switchTab(tab) {
    // Get all tab buttons and form contents
    const tabButtons = document.querySelectorAll('.tab-btn');
    const formContents = document.querySelectorAll('.form-content');

    // Remove active class from all tabs and forms
    tabButtons.forEach(btn => btn.classList.remove('active'));
    formContents.forEach(form => form.classList.remove('active'));

    // Add active class to selected tab and form
    if (tab === 'login') {
        tabButtons[0].classList.add('active');
        document.getElementById('login-form').classList.add('active');
    } else if (tab === 'register') {
        tabButtons[1].classList.add('active');
        document.getElementById('register-form').classList.add('active');
    }
}

// Password validation for registration
document.addEventListener('DOMContentLoaded', function() {
    const registerForm = document.querySelector('#register-form form');

    if (registerForm) {
        registerForm.addEventListener('submit', function(e) {
            const password = document.getElementById('register-password').value;
            const confirmPassword = document.getElementById('register-confirm').value;

            if (password !== confirmPassword) {
                e.preventDefault();
                alert('Les mots de passe ne correspondent pas!');
                return false;
            }

            if (password.length < 6) {
                e.preventDefault();
                alert('Le mot de passe doit contenir au moins 6 caractères!');
                return false;
            }
        });
    }
});

// Animate leaf decorations
document.addEventListener('DOMContentLoaded', function() {
    const leaves = document.querySelectorAll('.leaf-decoration');
    leaves.forEach((leaf, index) => {
        leaf.style.animationDelay = `${index * 0.5}s`;
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const leaves = document.querySelectorAll('.leaf-decoration');
    leaves.forEach((leaf, index) => {
        leaf.style.setProperty('--rotation', `${15 + index * 20}deg`);
    });
});

document.querySelectorAll('form').forEach(form => {
    form.addEventListener('submit', function(e) {
        // validation placeholder
    });
});