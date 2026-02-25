// Campaign Site - Mini Survey Interactivity
// Quick poll functionality for hero section

document.addEventListener('DOMContentLoaded', () => {
    const surveyButtons = document.querySelectorAll('.survey-btn');
    const submitButton = document.querySelector('.btn-submit-survey');
    let selectedOption = null;

    // Handle survey button clicks
    surveyButtons.forEach((btn) => {
        btn.addEventListener('click', function() {
            // Remove active class from all buttons
            surveyButtons.forEach(b => b.classList.remove('active'));

            // Add active class to clicked button
            this.classList.add('active');
            selectedOption = this.textContent;

            // Enable submit button
            submitButton.disabled = false;
            submitButton.style.opacity = '1';

            // Visual feedback
            gsap.to(this, {
                scale: 1.05,
                duration: 0.2,
                yoyo: true,
                repeat: 1,
                ease: 'power2.inOut'
            });
        });
    });

    // Handle submit
    if (submitButton) {
        submitButton.disabled = true;
        submitButton.style.opacity = '0.5';

        submitButton.addEventListener('click', function(e) {
            e.preventDefault();

            if (!selectedOption) {
                // Shake animation if no selection
                gsap.to('.mini-survey-options', {
                    x: 10,
                    duration: 0.1,
                    yoyo: true,
                    repeat: 5
                });
                return;
            }

            // Success animation
            const originalText = this.textContent;
            const originalBg = this.style.backgroundColor;

            gsap.to(this, {
                backgroundColor: '#2E7D32',
                duration: 0.3,
                onComplete: () => {
                    this.textContent = `✓ ${selectedOption} Recorded`;

                    // Disable buttons
                    surveyButtons.forEach(btn => {
                        btn.disabled = true;
                        btn.style.opacity = '0.6';
                    });

                    // Reset after delay
                    setTimeout(() => {
                        gsap.to(this, {
                            backgroundColor: '',
                            duration: 0.3,
                            onComplete: () => {
                                this.textContent = originalText;
                                this.disabled = true;
                                this.style.opacity = '0.5';

                                surveyButtons.forEach(btn => {
                                    btn.disabled = false;
                                    btn.style.opacity = '1';
                                    btn.classList.remove('active');
                                });

                                selectedOption = null;
                            }
                        });
                    }, 3000);
                }
            });
        });
    }
});
