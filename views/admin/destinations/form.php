<?php 
$isEdit = ($action === 'edit');
$pageTitle = $isEdit ? 'Edit Destination - ' . e($destination['name']) : 'Add New Destination';
$formUrl = $isEdit ? base_url('admin/destinations/edit/' . $destination['id']) : base_url('admin/destinations/create');

render_partial('admin-header', ['page_title' => $pageTitle]); 
?>

<div class="admin-page-header" style="margin-bottom: 25px;">
    <a href="<?= base_url('admin/destinations') ?>" style="color: #0284c7; text-decoration: none; font-weight: 600; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 5px; margin-bottom: 10px;">
        &larr; Back to Destinations Listing
    </a>
    <h2 style="color: #0f172a; margin: 0;"><i class="fa-solid fa-location-dot" style="color: #0284c7;"></i> <?= e($pageTitle) ?></h2>
</div>

<div style="background: #ffffff; padding: 30px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); max-width: 900px;">
    <form method="POST" action="<?= $formUrl ?>" enctype="multipart/form-data">
        <input type="hidden" name="csrf_token" value="<?= CsrfService::generateToken() ?>">
        <?php if ($isEdit): ?>
            <input type="hidden" name="id" value="<?= $destination['id'] ?>">
        <?php endif; ?>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
            <div>
                <label style="display: block; font-weight: 600; color: #1e293b; margin-bottom: 6px;">Destination Name <span style="color: #ef4444;">*</span></label>
                <input type="text" name="name" required value="<?= e($destination['name'] ?? old('name')) ?>" placeholder="e.g. Kandy, Sigiriya, Ella" class="form-control" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.95rem;">
            </div>

            <div>
                <label style="display: block; font-weight: 600; color: #1e293b; margin-bottom: 6px;">URL Slug (Optional)</label>
                <input type="text" name="slug" value="<?= e($destination['slug'] ?? old('slug')) ?>" placeholder="Auto-generated if left empty" class="form-control" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.95rem;">
            </div>
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; font-weight: 600; color: #1e293b; margin-bottom: 6px;">Short Tagline / Summary</label>
            <input type="text" name="short_description" value="<?= e($destination['short_description'] ?? old('short_description')) ?>" placeholder="Brief summary (e.g. Misty tea-covered mountains and waterfalls)" class="form-control" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.95rem;">
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; font-weight: 600; color: #1e293b; margin-bottom: 6px;">Detailed Description</label>
            <textarea name="description" rows="5" placeholder="Full descriptive details of this destination..." class="form-control" style="width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.95rem; font-family: inherit;"><?= e($destination['description'] ?? old('description')) ?></textarea>
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; font-weight: 600; color: #1e293b; margin-bottom: 6px;">Featured Cover Image</label>
            <?php if ($isEdit && !empty($destination['featured_image'])): ?>
                <div style="margin-bottom: 10px; display: flex; align-items: center; gap: 15px;">
                    <img src="<?= asset_url($destination['featured_image']) ?>" alt="Current Image" style="width: 100px; height: 60px; object-fit: cover; border-radius: 6px; border: 1px solid #cbd5e1;">
                    <span style="font-size: 0.85rem; color: #64748b;">Current Image Path: <code><?= e($destination['featured_image']) ?></code></span>
                </div>
            <?php endif; ?>
            <input type="file" name="featured_image" accept="image/*" class="form-control" style="width: 100%; padding: 8px; border: 1px solid #cbd5e1; border-radius: 6px;">
            <small style="color: #64748b; margin-top: 4px; display: block;">Supports JPG, PNG, WEBP formats.</small>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px; margin-bottom: 30px;">
            <div>
                <label style="display: block; font-weight: 600; color: #1e293b; margin-bottom: 6px;">Status</label>
                <select name="status" class="form-control" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.95rem;">
                    <option value="ACTIVE" <?= ($destination['status'] ?? 'ACTIVE') === 'ACTIVE' ? 'selected' : '' ?>>Active (Visible)</option>
                    <option value="INACTIVE" <?= ($destination['status'] ?? '') === 'INACTIVE' ? 'selected' : '' ?>>Inactive (Hidden)</option>
                </select>
            </div>

            <div>
                <label style="display: block; font-weight: 600; color: #1e293b; margin-bottom: 6px;">Display Order</label>
                <input type="number" name="display_order" value="<?= (int)($destination['display_order'] ?? 0) ?>" class="form-control" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.95rem;">
            </div>

            <div style="display: flex; align-items: center; margin-top: 25px;">
                <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-weight: 600; color: #1e293b;">
                    <input type="checkbox" name="is_featured" value="1" <?= !empty($destination['is_featured']) ? 'checked' : '' ?> style="width: 18px; height: 18px; accent-color: #0284c7;">
                    Mark as Featured Destination
                </label>
            </div>
        </div>

        <div style="display: flex; gap: 12px; border-top: 1px solid #e2e8f0; padding-top: 20px;">
            <button type="submit" class="btn btn-primary" style="padding: 12px 25px; background: #0284c7; color: white; border: none; border-radius: 6px; font-weight: 600; font-size: 0.95rem; cursor: pointer;">
                <?= $isEdit ? 'Save Changes' : 'Create Destination' ?>
            </button>
            <a href="<?= base_url('admin/destinations') ?>" style="padding: 12px 25px; background: #e2e8f0; color: #334155; text-decoration: none; border-radius: 6px; font-weight: 600; font-size: 0.95rem;">
                Cancel
            </a>
        </div>
    </form>
</div>

<?php render_partial('admin-footer'); ?>
