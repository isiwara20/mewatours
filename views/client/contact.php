<?php 
render_partial('header', ['page_title' => 'Contact Us & Plan Your Trip - Mewa Tours']); 

$whatsapp = new WhatsAppService();
$generalWaUrl = $whatsapp->generateInquiryLink($whatsapp->buildGeneralInquiryMessage());
?>

<section class="contact-section" style="padding: 40px 0;">
    <h2>Contact Mewa Tours</h2>
    <p>Plan your custom itinerary with our local Sri Lankan travel experts.</p>

    <div class="contact-options" style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px; margin-top: 30px;">
        <!-- Left Col: Direct WhatsApp Action -->
        <div class="whatsapp-card" style="background: #f0fdf4; border: 1px solid #bbf7d0; padding: 30px; border-radius: 12px;">
            <h3 style="color: #166534;"><i class="fa-brands fa-whatsapp"></i> Instant WhatsApp Inquiry</h3>
            <p style="margin: 15px 0; color: #15803d;">
                Connect directly with our team on WhatsApp for quick tour estimates and instant travel assistance.
            </p>
            <a href="<?= e($generalWaUrl) ?>" target="_blank" rel="noopener noreferrer" class="btn" style="display: inline-block; background: #25d366; color: white; padding: 12px 24px; border-radius: 6px; text-decoration: none; font-weight: 600;">
                <i class="fa-brands fa-whatsapp"></i> Chat on WhatsApp Now
            </a>
            <p style="font-size: 0.85rem; color: #166534; margin-top: 15px; font-style: italic;">
                Note: Clicking opens WhatsApp with a pre-filled message. Press Send to transmit your inquiry.
            </p>
        </div>

        <!-- Right Col: Email Inquiry Form -->
        <div class="inquiry-form-card" style="background: #ffffff; border: 1px solid #e2e8f0; padding: 30px; border-radius: 12px;">
            <h3><i class="fa-solid fa-paper-plane"></i> Send Email Inquiry</h3>
            
            <form action="<?= base_url('contact') ?>" method="POST" style="margin-top: 20px;">
                <?= CsrfService::inputField() ?>

                <div style="margin-bottom: 15px;">
                    <label for="name" style="display: block; margin-bottom: 5px; font-weight: 500;">Your Name *</label>
                    <input type="text" id="name" name="name" value="<?= old('name') ?>" required class="form-control" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;">
                </div>

                <div style="margin-bottom: 15px;">
                    <label for="email" style="display: block; margin-bottom: 5px; font-weight: 500;">Email Address *</label>
                    <input type="email" id="email" name="email" value="<?= old('email') ?>" required class="form-control" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;">
                </div>

                <div style="margin-bottom: 15px;">
                    <label for="phone" style="display: block; margin-bottom: 5px; font-weight: 500;">Phone / WhatsApp Number</label>
                    <input type="text" id="phone" name="phone" value="<?= old('phone') ?>" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;">
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 15px;">
                    <div>
                        <label for="travel_date" style="display: block; margin-bottom: 5px; font-weight: 500;">Estimated Travel Date</label>
                        <input type="date" id="travel_date" name="travel_date" value="<?= old('travel_date') ?>" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;">
                    </div>
                    <div>
                        <label for="traveller_count" style="display: block; margin-bottom: 5px; font-weight: 500;">Travellers</label>
                        <input type="number" id="traveller_count" name="traveller_count" value="<?= old('traveller_count', '2') ?>" min="1" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;">
                    </div>
                </div>

                <div style="margin-bottom: 15px;">
                    <label for="message" style="display: block; margin-bottom: 5px; font-weight: 500;">Inquiry Details *</label>
                    <textarea id="message" name="message" rows="4" required class="form-control" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;"><?= old('message') ?></textarea>
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%; padding: 12px; background: #004080; color: white; border: none; border-radius: 6px; font-weight: 600; cursor: pointer;">
                    Submit Inquiry
                </button>
            </form>
        </div>
    </div>
</section>

<?php render_partial('footer'); ?>
