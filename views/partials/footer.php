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
    <a href="<?= e($generalWaUrl) ?>" target="_blank" rel="noopener noreferrer" class="whatsapp-float-btn" id="floatingWhatsappBtn" title="Chat on WhatsApp">
        <i class="fa-brands fa-whatsapp"></i>
    </a>

    <footer class="site-footer">
        <div class="container footer-container">
            <div class="footer-col brand-col">
                <img src="<?= asset_url('images/branding/mewa-tours-logo.jpeg') ?>" alt="Mewa Tours" class="footer-logo" onerror="this.src='https://placehold.co/160x50/ffffff/004080?text=MEWA+TOURS'">
                <p class="footer-about-text">
                    Experience authentic Sri Lankan luxury travel, tailor-made itineraries, cultural heritage, and pristine island discovery with Mewa Tours.
                </p>
            </div>

            <div class="footer-col links-col">
                <h4 class="footer-heading">Quick Links</h4>
                <ul class="footer-links">
                    <li><a href="<?= base_url('tours') ?>">Tour Packages</a></li>
                    <li><a href="<?= base_url('destinations') ?>">Sri Lankan Destinations</a></li>
                    <li><a href="<?= base_url('experiences') ?>">Island Experiences</a></li>
                    <li><a href="<?= base_url('gallery') ?>">Photo Gallery</a></li>
                    <li><a href="<?= base_url('about') ?>">About Company</a></li>
                </ul>
            </div>

            <div class="footer-col contact-col">
                <h4 class="footer-heading">Contact Us</h4>
                <p><i class="fa-solid fa-envelope"></i> <?= e($config['company']['email']) ?></p>
                <p><i class="fa-solid fa-phone"></i> <?= e($config['company']['phone']) ?></p>
                <p><i class="fa-solid fa-location-dot"></i> <?= e($config['company']['address']) ?></p>
                <p><i class="fa-brands fa-whatsapp"></i> WhatsApp: <?= e($config['company']['phone']) ?></p>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="container footer-bottom-content">
                <p>&copy; <?= date('Y') ?> <?= e($config['company']['name']) ?>. All Rights Reserved.</p>
                <p class="inquiry-notice">Inquiry-Based Tour Reservations • No Online Booking Required</p>
            </div>
        </div>
    </footer>

    <!-- Main JavaScript Assets -->
    <script src="<?= asset_url('js/main.js') ?>"></script>
    <script src="<?= asset_url('js/navigation.js') ?>"></script>
    <script src="<?= asset_url('js/forms.js') ?>"></script>
    <script src="<?= asset_url('js/whatsapp.js') ?>"></script>
</body>
</html>
