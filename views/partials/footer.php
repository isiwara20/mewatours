<?php
/**
 * Mewa Tours - Public Footer Partial Component
 */
$config = require ROOT_PATH . '/config/app.php';
$whatsapp = new WhatsAppService();
$generalWaUrl = $whatsapp->generateInquiryLink($whatsapp->buildGeneralInquiryMessage());
?>
    </main>

    <!-- Floating WhatsApp Action Button -->
    <a href="<?= e($generalWaUrl) ?>" target="_blank" rel="noopener noreferrer" class="whatsapp-float-btn" id="floatingWhatsappBtn" aria-label="Chat with Mewa Tours on WhatsApp">
        <i class="fa-brands fa-whatsapp"></i>
    </a>

    <!-- Footer -->
    <footer class="site-footer">
        <div class="container footer-container">
            <div class="footer-col brand-col">
                <div class="footer-logo-card">
                    <img src="<?= asset_url('images/branding/logo.png') ?>" alt="Mewa Tours" class="footer-logo">
                </div>
                <p class="footer-about-text">
                    Thoughtfully created Sri Lankan journeys with local knowledge, personal service and unforgettable experiences.
                </p>
                <div class="social-links">
                    <a href="https://www.facebook.com/share/1CeW5nqxg8/" target="_blank" rel="noopener noreferrer" class="social-fb" aria-label="Facebook Page"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                    <a href="<?= e($generalWaUrl) ?>" target="_blank" rel="noopener noreferrer" class="social-wa" aria-label="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
                </div>
            </div>

            <div class="footer-col links-col">
                <h4 class="footer-heading">Explore</h4>
                <ul class="footer-links">
                    <li><a href="<?= base_url() ?>">Home</a></li>
                    <li><a href="<?= base_url('tours') ?>">Tour Packages</a></li>
                    <li><a href="<?= base_url('destinations') ?>">Sri Lankan Destinations</a></li>
                    <li><a href="<?= base_url('experiences') ?>">Island Experiences</a></li>
                </ul>
            </div>

            <div class="footer-col links-col">
                <h4 class="footer-heading">Company</h4>
                <ul class="footer-links">
                    <li><a href="<?= base_url('about') ?>">About Us</a></li>
                    <li><a href="<?= base_url('gallery') ?>">Photo Gallery</a></li>
                    <li><a href="<?= base_url('reviews') ?>">Customer Reviews</a></li>
                    <li><a href="<?= base_url('contact') ?>">Contact Us</a></li>
                </ul>
            </div>

            <div class="footer-col contact-col">
                <h4 class="footer-heading">Contact Us</h4>
                <p><i class="fa-solid fa-envelope"></i> <a href="mailto:<?= e($config['company']['email']) ?>"><?= e($config['company']['email']) ?></a></p>
                <p><i class="fa-solid fa-phone"></i> <a href="tel:<?= e($config['company']['phone']) ?>"><?= e($config['company']['phone']) ?></a></p>
                <p><i class="fa-brands fa-whatsapp"></i> <a href="<?= e($generalWaUrl) ?>" target="_blank" rel="noopener noreferrer">WhatsApp: <?= e($config['company']['phone']) ?></a></p>
                <p><i class="fa-brands fa-facebook"></i> <a href="https://www.facebook.com/share/1CeW5nqxg8/" target="_blank" rel="noopener noreferrer">Facebook: Mewa Tours</a></p>
                <p><i class="fa-solid fa-location-dot"></i> <span><?= e($config['company']['address']) ?></span></p>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="container footer-bottom-content">
                <p>&copy; 2026 Mewa Tours. Developed by <span style="color: #FFD700; font-weight: 700;">CHANDILA</span></p>
                <p class="inquiry-notice">Inquiry-Based Tour Reservations • No Online Booking Required</p>
                <a href="#siteHeader" class="back-to-top-btn" id="backToTopBtn">Back to Top <i class="fa-solid fa-arrow-up"></i></a>
            </div>
        </div>

    </footer>

    <!-- JavaScript Assets -->
    <script src="<?= asset_url('js/main.js') ?>"></script>
    <script src="<?= asset_url('js/navigation.js') ?>"></script>
    <script src="<?= asset_url('js/forms.js') ?>"></script>
    <script src="<?= asset_url('js/whatsapp.js') ?>"></script>
</body>
</html>
