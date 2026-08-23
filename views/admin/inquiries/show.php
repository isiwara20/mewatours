<?php render_partial('admin-header', ['page_title' => 'Inquiry #' . $inquiry['id'] . ' - Admin Portal']); ?>

<div class="admin-page-header" style="margin-bottom: 25px;">
    <a href="<?= base_url('admin/inquiries') ?>" style="color: #004080; text-decoration: none; font-weight: 600; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 5px; margin-bottom: 10px;">
        &larr; Back to Inquiries Listing
    </a>
    <h2 style="color: #0f172a; margin: 0;"><i class="fa-solid fa-envelope-open-text" style="color: #10b981;"></i> Customer Inquiry #<?= $inquiry['id'] ?></h2>
    <p class="text-muted" style="margin: 5px 0 0 0;">Received on <?= format_date($inquiry['created_at']) ?></p>
</div>

<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 25px;">
    <!-- Main Inquiry Message & Details -->
    <div style="background: #ffffff; padding: 30px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">
        <h3 style="margin: 0 0 20px 0; color: #1e293b; font-size: 1.1rem; border-bottom: 1px solid #f1f5f9; padding-bottom: 10px;">
            <i class="fa-solid fa-message" style="color: #004080;"></i> Inquiry Message
        </h3>
        
        <div style="background: #f8fafc; padding: 20px; border-radius: 8px; border-left: 4px solid #004080; font-size: 1rem; color: #334155; line-height: 1.6; white-space: pre-wrap; margin-bottom: 25px;">
            <?= e($inquiry['message']) ?>
        </div>

        <h4 style="margin: 0 0 15px 0; color: #1e293b; font-size: 1rem;"><i class="fa-solid fa-plane-departure" style="color: #0284c7;"></i> Travel Requirements</h4>
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; background: #fafafa; padding: 20px; border-radius: 8px;">
            <div>
                <span style="display: block; font-size: 0.8rem; color: #64748b; text-transform: uppercase;">Tour Package Requested</span>
                <strong style="color: #0f172a; font-size: 0.95rem;"><?= e($inquiry['tour_title'] ?? 'General Web Form Inquiry') ?></strong>
            </div>

            <div>
                <span style="display: block; font-size: 0.8rem; color: #64748b; text-transform: uppercase;">Target Travel Date</span>
                <strong style="color: #0f172a; font-size: 0.95rem;"><?= !empty($inquiry['travel_date']) ? format_date($inquiry['travel_date']) : 'Flexible / Undecided' ?></strong>
            </div>

            <div>
                <span style="display: block; font-size: 0.8rem; color: #64748b; text-transform: uppercase;">Number of Travellers</span>
                <strong style="color: #0f172a; font-size: 0.95rem;"><?= (int)($inquiry['traveller_count'] ?? 1) ?> Person(s)</strong>
            </div>

            <div>
                <span style="display: block; font-size: 0.8rem; color: #64748b; text-transform: uppercase;">Submission Source</span>
                <strong style="color: #0f172a; font-size: 0.95rem;"><?= e($inquiry['source']) ?></strong>
            </div>
        </div>
    </div>

    <!-- Customer Contact Card & Status Control -->
    <div style="display: flex; flex-direction: column; gap: 20px;">
        <!-- Status Card -->
        <div style="background: #ffffff; padding: 25px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">
            <h4 style="margin: 0 0 15px 0; color: #1e293b; font-size: 1rem;"><i class="fa-solid fa-sliders" style="color: #8b5cf6;"></i> Inquiry Status</h4>

            <form method="POST" action="<?= base_url('admin/inquiries/update_status/' . $inquiry['id']) ?>">
                <input type="hidden" name="csrf_token" value="<?= CsrfService::generateToken() ?>">
                <input type="hidden" name="redirect_to_show" value="1">
                
                <div style="margin-bottom: 15px;">
                    <select name="status" class="form-control" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-weight: 700; font-size: 0.95rem;">
                        <option value="NEW" <?= $inquiry['status'] === 'NEW' ? 'selected' : '' ?>>🔴 NEW</option>
                        <option value="CONTACTED" <?= $inquiry['status'] === 'CONTACTED' ? 'selected' : '' ?>>🔵 CONTACTED</option>
                        <option value="IN_PROGRESS" <?= $inquiry['status'] === 'IN_PROGRESS' ? 'selected' : '' ?>>🟡 IN PROGRESS</option>
                        <option value="CLOSED" <?= $inquiry['status'] === 'CLOSED' ? 'selected' : '' ?>>🟢 CLOSED</option>
                        <option value="CANCELLED" <?= $inquiry['status'] === 'CANCELLED' ? 'selected' : '' ?>>⚪ CANCELLED</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%; padding: 10px; background: #004080; color: white; border: none; border-radius: 6px; font-weight: 600;">Update Processing Status</button>
            </form>
        </div>

        <!-- Customer Contact Details Card -->
        <div style="background: #ffffff; padding: 25px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">
            <h4 style="margin: 0 0 15px 0; color: #1e293b; font-size: 1rem;"><i class="fa-solid fa-user-gear" style="color: #004080;"></i> Customer Information</h4>

            <div style="margin-bottom: 12px;">
                <span style="font-size: 0.8rem; color: #64748b; text-transform: uppercase; display: block;">Full Name</span>
                <strong style="color: #0f172a; font-size: 1rem;"><?= e($inquiry['name']) ?></strong>
            </div>

            <div style="margin-bottom: 12px;">
                <span style="font-size: 0.8rem; color: #64748b; text-transform: uppercase; display: block;">Email Address</span>
                <a href="mailto:<?= e($inquiry['email']) ?>" style="color: #004080; font-weight: 600; text-decoration: none; word-break: break-all;"><?= e($inquiry['email']) ?></a>
            </div>

            <?php if (!empty($inquiry['phone'])): ?>
                <div style="margin-bottom: 12px;">
                    <span style="font-size: 0.8rem; color: #64748b; text-transform: uppercase; display: block;">Phone / WhatsApp</span>
                    <strong style="color: #0f172a;"><?= e($inquiry['phone']) ?></strong>
                </div>
            <?php endif; ?>

            <?php if (!empty($inquiry['country'])): ?>
                <div style="margin-bottom: 20px;">
                    <span style="font-size: 0.8rem; color: #64748b; text-transform: uppercase; display: block;">Country / Origin</span>
                    <strong style="color: #0f172a;"><?= e($inquiry['country']) ?></strong>
                </div>
            <?php endif; ?>

            <div style="display: flex; flex-direction: column; gap: 10px; border-top: 1px solid #f1f5f9; padding-top: 15px;">
                <a href="mailto:<?= e($inquiry['email']) ?>?subject=Re:%20Mewa%20Tours%20Inquiry%20#<?= $inquiry['id'] ?>" style="width: 100%; padding: 10px; background: #0284c7; color: white; border-radius: 6px; text-decoration: none; font-weight: 600; font-size: 0.9rem; text-align: center; display: block;">
                    <i class="fa-solid fa-envelope"></i> Send Email Reply
                </a>

                <?php if (!empty($inquiry['phone'])): ?>
                    <?php 
                        $cleanPhone = preg_replace('/[^0-9]/', '', $inquiry['phone']);
                        $waText = rawurlencode("Hello " . $inquiry['name'] . ",\nThank you for reaching out to Mewa Tours regarding your inquiry (#" . $inquiry['id'] . ")!");
                    ?>
                    <a href="https://wa.me/<?= $cleanPhone ?>?text=<?= $waText ?>" target="_blank" style="width: 100%; padding: 10px; background: #25d366; color: white; border-radius: 6px; text-decoration: none; font-weight: 600; font-size: 0.9rem; text-align: center; display: block;">
                        <i class="fa-brands fa-whatsapp"></i> Reply on WhatsApp
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php render_partial('admin-footer'); ?>
