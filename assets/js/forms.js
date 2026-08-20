/**
 * Mewa Tours - Form Client-side Validation Helper
 */
document.addEventListener('DOMContentLoaded', () => {
    const contactForm = document.querySelector('form[action*="contact"]');
    if (contactForm) {
        contactForm.addEventListener('submit', (e) => {
            const name = contactForm.querySelector('[name="name"]');
            const email = contactForm.querySelector('[name="email"]');
            const message = contactForm.querySelector('[name="message"]');

            if (name && !name.value.trim()) {
                alert('Please enter your name.');
                e.preventDefault();
                return;
            }

            if (email && !email.value.trim()) {
                alert('Please enter a valid email address.');
                e.preventDefault();
                return;
            }

            if (message && !message.value.trim()) {
                alert('Please enter your inquiry details.');
                e.preventDefault();
                return;
            }
        });
    }
});
