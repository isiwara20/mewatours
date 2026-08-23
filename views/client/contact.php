<?php 
render_partial('header', [
    'page_title' => 'Contact Us & Plan Your Trip - Mewa Tours Sri Lanka'
]); 

$whatsapp = new WhatsAppService();
$generalWaUrl = $whatsapp->generateInquiryLink($whatsapp->buildGeneralInquiryMessage());
?>

<div class="contact-page-wrapper">
    <div class="container">
        
        <!-- Page Header -->
        <div class="contact-header-block" data-reveal>
            <span class="contact-eyebrow">PLAN YOUR SRI LANKAN ADVENTURE</span>
            <h1 class="contact-title">Contact Mewa Tours</h1>
            <p class="contact-subtitle">
                Reach out directly to Founder <strong>Mewan Manju Sri Kandearachchi</strong> and our travel expert team to create your 100% customized private Sri Lanka itinerary.
            </p>
        </div>

        <?php render_partial('flash-messages'); ?>

        <div class="contact-grid">
            
            <!-- Left Column: Company Contact Details & WhatsApp Action -->
            <div class="contact-info-column" data-reveal>
                
                <!-- Direct WhatsApp Card -->
                <div class="whatsapp-action-card">
                    <h3 class="wa-card-title">
                        <i class="fa-brands fa-whatsapp"></i> Instant WhatsApp Chat
                    </h3>
                    <p class="wa-card-text">
                        Want quick tour estimates or immediate assistance? Chat directly with our team on WhatsApp for instant private tour guidance.
                    </p>
                    <a href="<?= e($generalWaUrl) ?>" target="_blank" rel="noopener noreferrer" class="btn-whatsapp-large">
                        <i class="fa-brands fa-whatsapp"></i> Chat on WhatsApp Now
                    </a>
                </div>

                <!-- Company Details Card -->
                <div class="contact-info-card">
                    <h3 class="contact-info-title">
                        <i class="fa-solid fa-headset" style="color: #0284c7;"></i> Direct Contact Info
                    </h3>

                    <div class="contact-info-list">
                        
                        <div class="contact-info-item">
                            <div class="contact-info-icon">
                                <i class="fa-solid fa-envelope"></i>
                            </div>
                            <div>
                                <span class="contact-info-label">Official Email</span>
                                <a href="mailto:mewatours83@gmail.com" class="contact-info-val">mewatours83@gmail.com</a>
                            </div>
                        </div>

                        <div class="contact-info-item">
                            <div class="contact-info-icon" style="background: #dcfce7; color: #166534;">
                                <i class="fa-brands fa-whatsapp"></i>
                            </div>
                            <div>
                                <span class="contact-info-label">WhatsApp Hotline</span>
                                <a href="https://wa.me/94769695024" target="_blank" rel="noopener noreferrer" class="contact-info-val">+94 76 969 5024 / +94 70 103 8400</a>
                            </div>
                        </div>

                        <div class="contact-info-item">
                            <div class="contact-info-icon">
                                <i class="fa-solid fa-location-dot"></i>
                            </div>
                            <div>
                                <span class="contact-info-label">Headquarters</span>
                                <span class="contact-info-val">Kandy, Sri Lanka</span>
                            </div>
                        </div>

                        <div class="contact-info-item">
                            <div class="contact-info-icon">
                                <i class="fa-solid fa-clock"></i>
                            </div>
                            <div>
                                <span class="contact-info-label">Operating Hours</span>
                                <span class="contact-info-val">8:00 AM – 8:00 PM (IST) Daily</span>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            <!-- Right Column: Email Inquiry Form -->
            <div class="inquiry-form-card" data-reveal>
                <h3 class="form-card-title">
                    <i class="fa-solid fa-paper-plane" style="color: #0284c7;"></i> Send Web Booking Inquiry
                </h3>
                
                <?php if (!empty($selected_tour)): ?>
                    <div style="background: #eef2ff; border: 1px solid #c7d2fe; padding: 14px 18px; border-radius: 10px; margin-bottom: 24px; font-size: 0.95rem; color: #3730a3; display: flex; align-items: center; gap: 10px;">
                        <i class="fa-solid fa-route" style="font-size: 1.2rem;"></i>
                        <div>
                            <strong>Selected Tour Package:</strong><br>
                            <?= e($selected_tour['title']) ?> (<?= e($selected_tour['formatted_duration']) ?>)
                        </div>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('contact') ?>" method="POST">
                    <?= CsrfService::inputField() ?>
                    <?php if (!empty($selected_tour)): ?>
                        <input type="hidden" name="tour_id" value="<?= (int)$selected_tour['id'] ?>">
                    <?php endif; ?>

                    <div class="form-field">
                        <label for="name">Your Full Name <span style="color: #ef4444;">*</span></label>
                        <input type="text" id="name" name="name" value="<?= old('name') ?>" required placeholder="e.g. John Miller">
                    </div>

                    <div class="form-field">
                        <label for="email">Email Address <span style="color: #ef4444;">*</span></label>
                        <input type="email" id="email" name="email" value="<?= old('email') ?>" required placeholder="john.miller@example.com">
                    </div>

                    <div class="form-field">
                        <label for="phone">Phone / WhatsApp Number</label>
                        <input type="text" id="phone" name="phone" value="<?= old('phone') ?>" placeholder="+1 (555) 000-0000">
                    </div>

                    <div class="form-grid-2col">
                        <div class="form-field">
                            <label for="travel_date">Estimated Travel Date</label>
                            <input type="date" id="travel_date" name="travel_date" value="<?= old('travel_date') ?>">
                        </div>
                        <div class="form-field">
                            <label for="traveller_count">Number of Travelers</label>
                            <input type="number" id="traveller_count" name="traveller_count" value="<?= old('traveller_count', '2') ?>" min="1" max="50">
                        </div>
                    </div>

                    <div class="form-field">
                        <label for="message">Inquiry Details & Preferences <span style="color: #ef4444;">*</span></label>
                        <?php 
                            $defaultMsg = !empty($selected_tour) ? ("Hello Mewa Tours,\n\nI would like to inquire about availability and pricing for the " . $selected_tour['title'] . " (" . $selected_tour['formatted_duration'] . "). Please let me know the details.") : '';
                        ?>
                        <textarea id="message" name="message" rows="5" required placeholder="Tell us about your trip plans, preferred travel dates, places you want to visit, or special requirements..."><?= old('message', $defaultMsg) ?></textarea>
                    </div>

                    <button type="submit" class="btn-submit-inquiry">
                        <i class="fa-solid fa-paper-plane"></i> Submit Inquiry
                    </button>
                </form>
            </div>

        </div>

    </div>
</div>

<?php render_partial('footer'); ?>
