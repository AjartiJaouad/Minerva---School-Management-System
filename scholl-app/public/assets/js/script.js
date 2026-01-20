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


/* ========= AUTH PAGE JS ========= */

function switchTab(tab) {
    const tabButtons = document.querySelectorAll('.tab-btn');
    tabButtons.forEach(btn => btn.classList.remove('active'));
    event.target.classList.add('active');

    const forms = document.querySelectorAll('.form-content');
    forms.forEach(form => form.classList.remove('active'));

    if (tab === 'login') {
        document.getElementById('login-form').classList.add('active');
    } else {
        document.getElementById('register-form').classList.add('active');
    }
}

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