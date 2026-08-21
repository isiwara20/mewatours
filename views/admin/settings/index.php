<?php render_partial('admin-header', ['page_title' => 'Site Settings - Admin Portal']); ?>

<div class="admin-page-header">
    <h2><i class="fa-solid fa-sliders"></i> Application & Site Settings</h2>
    <p class="text-muted">Configure WhatsApp number, business email, and global settings.</p>
</div>

<div class="admin-card" style="background: #ffffff; padding: 25px; border-radius: 8px; margin-top: 20px; max-width: 600px;">
    <h3>Contact & Social Settings</h3>
    <form style="margin-top: 20px;">
        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px; font-weight: 500;">WhatsApp Business Number</label>
            <input type="text" value="94769695024" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px; font-weight: 500;">Official Email</label>
            <input type="email" value="info@mewatours.com" class="form-control" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px;">
        </div>

        <button type="button" class="btn btn-primary" style="padding: 10px 20px; background: #004080; color: white; border: none; border-radius: 6px; font-weight: 600;">Save Settings Foundation</button>
    </form>
</div>

<?php render_partial('admin-footer'); ?>
