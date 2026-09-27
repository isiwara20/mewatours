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

        <div style="margin-bottom: 25px;">
            <label style="display: block; font-weight: 600; color: #1e293b; margin-bottom: 6px;">Featured Cover Image</label>
            
            <!-- Current / Live Image Preview Card -->
            <div id="destPreviewContainer" style="margin-bottom: 12px; <?= empty($destination['featured_image']) ? 'display: none;' : '' ?>">
                <span style="font-size: 0.85rem; color: #64748b; font-weight: 600; display: block; margin-bottom: 6px;" id="destPreviewLabel">Current Cover Image:</span>
                <?php 
                    $cleanDestImg = preg_replace('#^(uploads/)?images/uploads/#i', 'uploads/', $destination['featured_image'] ?? '');
                    $destImgSrc = !empty($cleanDestImg) 
                        ? ((strpos($cleanDestImg, 'http') === 0) ? $cleanDestImg : asset_url('images/' . e(ltrim($cleanDestImg, '/')))) 
                        : '';
                ?>
                <div style="display: flex; align-items: center; gap: 16px;">
                    <img id="destImgPreview" src="<?= e($destImgSrc) ?>" alt="Destination Image" style="width: 140px; height: 90px; object-fit: cover; border-radius: 8px; border: 1px solid #cbd5e1; box-shadow: 0 2px 8px rgba(0,0,0,0.06); display: block;">
                    <div>
                        <span style="font-size: 0.82rem; color: #64748b; display: block;">Active Path / Source:</span>
                        <code style="font-size: 0.82rem; background: #f1f5f9; padding: 3px 8px; border-radius: 4px; display: inline-block; margin-top: 3px;"><?= e($cleanDestImg) ?></code>
                    </div>
                </div>
            </div>

            <!-- Upload File Input -->
            <input type="file" name="featured_image" accept="image/jpeg,image/png,image/webp" class="form-control" onchange="previewDestImage(this)" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.95rem;">
            <small style="color: #64748b; margin-top: 4px; display: block;">Upload a new image file (JPG, PNG, WebP up to 10MB).</small>

            <!-- Optional Image URL or Asset Path -->
            <div style="margin-top: 12px;">
                <label style="font-size: 0.85rem; color: #64748b; font-weight: 600; display: block; margin-bottom: 4px;">Or Enter Image URL / Existing Asset Path:</label>
                <input type="text" name="featured_image_url" value="<?= e(strpos($destination['featured_image'] ?? '', 'http') === 0 ? $destination['featured_image'] : '') ?>" placeholder="e.g. https://... or home/hero-dalada-maligawa.jpg" class="form-control" style="width: 100%; padding: 8px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.9rem;">
                <small style="color: #64748b; display: block; margin-top: 3px;">Leave empty if uploading an image file above.</small>
            </div>
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

<script>
function previewDestImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('destImgPreview');
            const container = document.getElementById('destPreviewContainer');
            const label = document.getElementById('destPreviewLabel');
            if (preview) {
                preview.src = e.target.result;
            }
            if (container) {
                container.style.display = 'block';
            }
            if (label) {
                label.textContent = 'Selected Image Preview (will be uploaded on save):';
                label.style.color = '#0284c7';
            }
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>

<?php render_partial('admin-footer'); ?>
