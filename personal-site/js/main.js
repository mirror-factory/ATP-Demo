// Michael Torres - Personal Site Animations
// Powered by GSAP & ATP Brand Ecosystem

gsap.registerPlugin(ScrollTrigger);

document.addEventListener('DOMContentLoaded', () => {
    
    // --- Interaction Logic ---
    
    // Engagement Input Interaction
    const submitBtn = document.querySelector('.btn-submit');
    const inputField = document.querySelector('.input-field');
    
    if (submitBtn && inputField) {
        submitBtn.addEventListener('click', () => {
            if (inputField.value.trim() !== '') {
                const originalText = submitBtn.innerText;
                const originalBg = submitBtn.style.backgroundColor;
                
                // Animate button state
                gsap.to(submitBtn, {
                    backgroundColor: '#2E7D32', // Success Green
                    duration: 0.3,
                    onComplete: () => {
                        submitBtn.innerText = 'Thanks for sharing';
                    }
                });

                gsap.to(inputField, { opacity: 0.5, duration: 0.3 });
                
                inputField.value = '';
                
                // Reset after delay
                setTimeout(() => {
                    gsap.to(submitBtn, {
                        backgroundColor: getComputedStyle(document.documentElement).getPropertyValue('--atp-red').trim(),
                        duration: 0.3,
                        onComplete: () => {
                            submitBtn.innerText = originalText;
                            submitBtn.style.backgroundColor = ''; // Clear inline style to revert to CSS
                        }
                    });
                    gsap.to(inputField, { opacity: 1, duration: 0.3 });
                }, 3000);
            } else {
                // Shake animation for error
                gsap.to(inputField, { x: 10, duration: 0.1, yoyo: true, repeat: 5 });
                inputField.focus();
            }
        });
    }

    // --- Entrance Animations ---

    const heroTl = gsap.timeline({ delay: 0.2 });

    // Hero Content
    heroTl.from('.hero-kicker', { y: 20, opacity: 0, duration: 0.6, ease: 'power2.out' })
          .from('.hero h1', { y: 30, opacity: 0, duration: 0.8, ease: 'power2.out' }, '-=0.4')
          .from('.hero p', { y: 20, opacity: 0, duration: 0.8, ease: 'power2.out' }, '-=0.6')
          .from('.hero-image-container', { y: 40, opacity: 0, duration: 1, ease: 'power3.out' }, '-=0.6')
          .from('.authority-logo', { 
              y: 20, 
              opacity: 0, 
              duration: 0.6, 
              stagger: 0.1, 
              ease: 'back.out(1.7)' 
          }, '-=0.4');

    // --- Scroll Trigger Animations ---

    // Media Section
    gsap.from('.media-grid > .analytics-panel', {
        scrollTrigger: {
            trigger: '.media-grid',
            start: 'top 85%'
        },
        y: 40,
        opacity: 0,
        duration: 0.8,
        ease: 'power2.out'
    });

    gsap.from('.media-list .analytics-panel', {
        scrollTrigger: {
            trigger: '.media-list',
            start: 'top 85%'
        },
        x: 30,
        opacity: 0,
        duration: 0.6,
        stagger: 0.1,
        ease: 'power2.out'
    });

    // Thought Leadership Cards
    gsap.utils.toArray('.card-grid .analytics-panel').forEach((card, i) => {
        gsap.from(card, {
            scrollTrigger: {
                trigger: '.card-grid',
                start: 'top 80%',
                toggleActions: 'play none none reverse'
            },
            y: 50,
            opacity: 0,
            duration: 0.8,
            delay: i * 0.15,
            ease: 'power2.out'
        });
    });

    // Engagement Section
    gsap.from('.engagement-container', {
        scrollTrigger: {
            trigger: '.engagement',
            start: 'top 75%'
        },
        scale: 0.95,
        opacity: 0,
        duration: 0.8,
        ease: 'power2.out'
    });

    // Timeline Items
    gsap.utils.toArray('.timeline-item').forEach((item) => {
        const tl = gsap.timeline({
            scrollTrigger: {
                trigger: item,
                start: 'top 85%',
                toggleActions: 'play none none reverse'
            }
        });

        tl.from(item.querySelector('.timeline-date'), {
            x: -20,
            opacity: 0,
            duration: 0.6,
            ease: 'power2.out'
        })
        .from(item.querySelector('.timeline-content'), {
            x: 20,
            opacity: 0,
            duration: 0.6,
            ease: 'power2.out'
        }, '-=0.4');
    });

});
