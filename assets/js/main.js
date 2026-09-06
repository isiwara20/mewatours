/**
 * Mewa Tours - Scroll Reveal & Main Interactive Scripts
 */
document.addEventListener('DOMContentLoaded', () => {

    // =========================================================================
    // 1. CINEMATIC HERO VIDEO REVEAL
    //    - Video plays cleanly without text overlay
    //    - Overlay gradually darkens near end of video
    //    - Hero content reveals with staggered CSS animation after video ends
    //    - Fallback timer covers autoplay-blocked / load-failed scenarios
    // =========================================================================
    const heroSection     = document.getElementById('heroSection');
    const heroVideo       = document.getElementById('heroLandingVideo');
    const heroOverlay     = document.getElementById('heroOverlay');

    if (heroSection && heroVideo && heroOverlay) {
        let contentRevealed  = false;
        let overlayDarkened  = false;
        let fallbackTimer    = null;

        // Check for reduced-motion preference
        const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

        // Reveal hero content (called once, guarded by flag)
        function revealHeroContent() {
            if (contentRevealed) return;
            contentRevealed = true;

            if (fallbackTimer) clearTimeout(fallbackTimer);

            // Ensure overlay is darkened before content appears
            if (!overlayDarkened) {
                heroOverlay.classList.add('hero-overlay-darkened');
                overlayDarkened = true;
            }

            // Small delay so overlay darkening starts before text appears (skipped for reduced-motion)
            const revealDelay = prefersReducedMotion ? 0 : 300;
            setTimeout(() => {
                heroSection.classList.add('hero-content-visible');
            }, revealDelay);
        }

        // Darken overlay gradually near end of video
        function darkenOverlayNearEnd() {
            if (overlayDarkened) return;
            overlayDarkened = true;
            heroOverlay.classList.add('hero-overlay-darkened');
        }

        // For reduced-motion: reveal immediately (don't force user to wait for video)
        if (prefersReducedMotion) {
            revealHeroContent();
        } else {
            // Listen for video timeupdate to darken overlay ~1.8s before it ends
            heroVideo.addEventListener('timeupdate', () => {
                if (!heroVideo.duration || isNaN(heroVideo.duration)) return;
                const remaining = heroVideo.duration - heroVideo.currentTime;
                if (remaining <= 1.8) {
                    darkenOverlayNearEnd();
                }
            });

            // Primary trigger: video ended event
            heroVideo.addEventListener('ended', () => {
                revealHeroContent();
            });

            // Handle video error or blocked autoplay
            heroVideo.addEventListener('error', () => {
                revealHeroContent();
            });

            // Fallback: if video doesn't start playing within 3s, reveal content
            heroVideo.addEventListener('play', () => {
                // Video is playing — set a max-wait fallback of 60s
                // (in case video is very long or ended event doesn't fire)
                if (fallbackTimer) clearTimeout(fallbackTimer);
                fallbackTimer = setTimeout(revealHeroContent, 60000);
            });

            // Hard fallback: reveal after 10s regardless (covers autoplay blocked, slow load)
            fallbackTimer = setTimeout(revealHeroContent, 10000);
        }
    }


    // =========================================================================
    // 2. LIGHTWEIGHT SCROLL REVEAL (IntersectionObserver)
    //    Handles [data-reveal] elements on all other sections
    // =========================================================================
    const revealElements = document.querySelectorAll('[data-reveal]');

    if ('IntersectionObserver' in window && revealElements.length > 0) {
        const observerOptions = {
            root: null,
            rootMargin: '0px 0px -50px 0px',
            threshold: 0.15
        };

        const revealObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('revealed');
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        revealElements.forEach(el => revealObserver.observe(el));
    } else {
        // Fallback for older browsers
        revealElements.forEach(el => el.classList.add('revealed'));
    }


    // =========================================================================
    // 3. SMOOTH SCROLL FOR ANCHOR LINKS
    // =========================================================================
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const targetId = this.getAttribute('href');
            if (targetId && targetId !== '#') {
                const targetEl = document.querySelector(targetId);
                if (targetEl) {
                    e.preventDefault();
                    targetEl.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            }
        });
    });
});

