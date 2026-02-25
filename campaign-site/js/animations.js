// ATP Campaign - Minimal Animations
// No entrance animations - content displays immediately

gsap.registerPlugin(ScrollTrigger);

document.addEventListener('DOMContentLoaded', () => {

    // Scroll Progress Bar
    gsap.to('.scroll-progress', {
        width: '100%',
        ease: 'none',
        scrollTrigger: {
            trigger: 'body',
            start: 'top top',
            end: 'bottom bottom',
            scrub: 0
        }
    });

    // Hero Carousel Animation (rotating text only)
    const texts = document.querySelectorAll('.hero-carousel-text');
    const dots = document.querySelectorAll('.dot');
    let currentIndex = 0;

    function animateCarousel() {
        // Hide current
        gsap.to(texts[currentIndex], { y: -20, opacity: 0, duration: 0.5 });
        dots[currentIndex].classList.remove('active');

        // Increment
        currentIndex = (currentIndex + 1) % texts.length;

        // Show next
        gsap.fromTo(texts[currentIndex],
            { y: 20, opacity: 0 },
            { y: 0, opacity: 1, duration: 0.5 }
        );
        dots[currentIndex].classList.add('active');
    }

    // Initialize first text
    gsap.set(texts, { opacity: 0 });
    gsap.set(texts[0], { opacity: 1, y: 0 });

    // Start loop
    setInterval(animateCarousel, 3000);

    // Response card interactions (if exists)
    document.querySelectorAll('.response-card').forEach(card => {
        card.addEventListener('click', function() {
            // Reset others
            document.querySelectorAll('.response-card').forEach(c => {
                c.classList.remove('voted');
            });

            // Activate clicked
            this.classList.add('voted');

            // Animation for selection
            gsap.to(this, {
                scale: 1.02,
                duration: 0.2,
                yoyo: true,
                repeat: 1
            });

            // Pulse the icon
            const icon = this.querySelector('.response-icon');
            if (icon) {
                gsap.fromTo(icon,
                    { scale: 1 },
                    { scale: 1.15, duration: 0.3, yoyo: true, repeat: 1, ease: 'power2.inOut' }
                );
            }
        });
    });
});
