<?php render_partial('admin-header', ['page_title' => 'Site Settings & Admin Profile - Admin Portal']); ?>

<div class="admin-page-header" style="margin-bottom: 25px;">
    <h2 style="color: #0f172a; margin: 0;"><i class="fa-solid fa-sliders" style="color: #004080;"></i> Site Settings & Security Profile</h2>
    <p class="text-muted" style="margin: 5px 0 0 0;">Manage global site configuration, WhatsApp number, email contacts, and administrator security.</p>
</div>

<div class="settings-grid-layout">
    <!-- Left Column: Site Configuration Form -->
    <div class="settings-card">
        <h3 class="settings-card-header">
            <i class="fa-solid fa-gear" style="color: #004080;"></i> Global Site & Contact Configuration
        </h3>

        <form method="POST" action="<?= base_url('admin/settings?action=update_settings') ?>">
            <input type="hidden" name="csrf_token" value="<?= CsrfService::generateToken() ?>">

            <div class="form-grid-2col">
                <div>
                    <label style="display: block; font-weight: 600; color: #1e293b; margin-bottom: 6px;">WhatsApp Business Number</label>
                    <div style="position: relative;">
                        <span style="position: absolute; left: 12px; top: 10px; color: #64748b; font-weight: 600;">+</span>
                        <input type="text" name="whatsapp_number" value="<?= e($settings['whatsapp_number'] ?? '94769695024') ?>" placeholder="94769695024" class="form-control" style="width: 100%; padding: 10px 12px 10px 25px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.95rem;">
                    </div>
                    <small style="color: #64748b; font-size: 0.75rem;">International format without + or spaces (e.g. 94769695024)</small>
                </div>

                <div>
                    <label style="display: block; font-weight: 600; color: #1e293b; margin-bottom: 6px;">Official Company Email</label>
                    <input type="email" name="company_email" value="<?= e($settings['company_email'] ?? 'info@mewatours.com') ?>" placeholder="info@mewatours.com" class="form-control" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.95rem;">
                </div>
            </div>

            <div class="form-grid-2col">
                <div>
                    <label style="display: block; font-weight: 600; color: #1e293b; margin-bottom: 6px;">Contact Phone Number</label>
                    <input type="text" name="company_phone" value="<?= e($settings['company_phone'] ?? '+94 76 969 5024') ?>" placeholder="+94 76 969 5024" class="form-control" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.95rem;">
                </div>

                <div>
                    <label style="display: block; font-weight: 600; color: #1e293b; margin-bottom: 6px;">Office / Location Address</label>
                    <input type="text" name="company_address" value="<?= e($settings['company_address'] ?? 'Kandy, Sri Lanka') ?>" placeholder="Kandy, Sri Lanka" class="form-control" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.95rem;">
                </div>
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; font-weight: 600; color: #1e293b; margin-bottom: 6px;">Website Title</label>
                <input type="text" name="site_title" value="<?= e($settings['site_title'] ?? 'Mewa Tours - Authentic Sri Lanka Tour Operator') ?>" class="form-control" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.95rem;">
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; font-weight: 600; color: #1e293b; margin-bottom: 6px;">Global Meta Description (SEO)</label>
                <textarea name="meta_description" rows="3" class="form-control" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.95rem; font-family: inherit;"><?= e($settings['meta_description'] ?? 'Discover authentic Sri Lanka with private luxury tour packages, highland train journeys, safari expeditions, and beach holidays with Mewa Tours.') ?></textarea>
            </div>

            <h4 style="margin: 25px 0 15px 0; color: #1e293b; font-size: 1rem;"><i class="fa-solid fa-share-nodes" style="color: #0284c7;"></i> Social Media Links</h4>

            <div class="form-grid-3col">
                <div>
                    <label style="display: block; font-size: 0.85rem; font-weight: 600; color: #475569; margin-bottom: 4px;">Facebook URL</label>
                    <input type="url" name="social_facebook" value="<?= e($settings['social_facebook'] ?? '') ?>" placeholder="https://facebook.com/mewatours" class="form-control" style="width: 100%; padding: 8px 10px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.85rem;">
                </div>
                <div>
                    <label style="display: block; font-size: 0.85rem; font-weight: 600; color: #475569; margin-bottom: 4px;">Instagram URL</label>
                    <input type="url" name="social_instagram" value="<?= e($settings['social_instagram'] ?? '') ?>" placeholder="https://instagram.com/mewatours" class="form-control" style="width: 100%; padding: 8px 10px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.85rem;">
                </div>
                <div>
                    <label style="display: block; font-size: 0.85rem; font-weight: 600; color: #475569; margin-bottom: 4px;">TripAdvisor URL</label>
                    <input type="url" name="social_tripadvisor" value="<?= e($settings['social_tripadvisor'] ?? '') ?>" placeholder="https://tripadvisor.com/..." class="form-control" style="width: 100%; padding: 8px 10px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.85rem;">
                </div>
            </div>

            <button type="submit" class="btn btn-primary" style="padding: 12px 25px; background: #004080; color: white; border: none; border-radius: 6px; font-weight: 600; font-size: 0.95rem; cursor: pointer; width: 100%; max-width: 220px;">
                Save Site Settings
            </button>
        </form>
    </div>

    <!-- Right Column: Admin Profile & Password Update -->
    <div class="settings-column-stack">
        <!-- Admin Profile Info -->
        <div class="settings-card">
            <h3 class="settings-card-header">
                <i class="fa-solid fa-user-shield" style="color: #004080;"></i> Admin Account Profile
            </h3>

            <form method="POST" action="<?= base_url('admin/settings?action=update_profile') ?>">
                <input type="hidden" name="csrf_token" value="<?= CsrfService::generateToken() ?>">

                <div style="margin-bottom: 15px;">
                    <label style="display: block; font-weight: 600; color: #1e293b; margin-bottom: 6px;">Administrator Name</label>
                    <input type="text" name="name" required value="<?= e($adminUser['name'] ?? $_SESSION['admin_name'] ?? '') ?>" class="form-control" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.95rem;">
                </div>

                <div style="margin-bottom: 15px;">
                    <label style="display: block; font-weight: 600; color: #1e293b; margin-bottom: 6px;">Admin Email Address</label>
                    <input type="email" name="email" required value="<?= e($adminUser['email'] ?? $_SESSION['admin_email'] ?? '') ?>" class="form-control" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.95rem;">
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%; padding: 10px; background: #0284c7; color: white; border: none; border-radius: 6px; font-weight: 600; cursor: pointer;">Update Profile</button>
            </form>
        </div>

        <!-- Change Password Card -->
        <div class="settings-card">
            <h3 class="settings-card-header">
                <i class="fa-solid fa-key" style="color: #ef4444;"></i> Change Admin Password
            </h3>

            <form method="POST" action="<?= base_url('admin/settings?action=update_password') ?>">
                <input type="hidden" name="csrf_token" value="<?= CsrfService::generateToken() ?>">

                <div style="margin-bottom: 15px;">
                    <label style="display: block; font-weight: 600; color: #1e293b; margin-bottom: 6px;">Current Password</label>
                    <input type="password" name="current_password" required placeholder="Enter current password" class="form-control" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.95rem;">
                </div>

                <div style="margin-bottom: 15px;">
                    <label style="display: block; font-weight: 600; color: #1e293b; margin-bottom: 6px;">New Password</label>
                    <input type="password" name="new_password" required placeholder="At least 6 characters" class="form-control" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.95rem;">
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-weight: 600; color: #1e293b; margin-bottom: 6px;">Confirm New Password</label>
                    <input type="password" name="confirm_password" required placeholder="Re-enter new password" class="form-control" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.95rem;">
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%; padding: 10px; background: #ef4444; color: white; border: none; border-radius: 6px; font-weight: 600; cursor: pointer;">Update Password</button>
            </form>
        </div>
    </div>
</div>

<?php render_partial('admin-footer'); ?>
