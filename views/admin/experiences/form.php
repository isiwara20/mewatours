<?php 
$isEdit = ($action === 'edit');
$pageTitle = $isEdit ? 'Edit Experience - ' . e($experience['name']) : 'Add New Experience';
$formUrl = $isEdit ? base_url('admin/experiences/edit/' . $experience['id']) : base_url('admin/experiences/create');

render_partial('admin-header', ['page_title' => $pageTitle]); 
?>

<div class="admin-page-header" style="margin-bottom: 25px;">
    <a href="<?= base_url('admin/experiences') ?>" style="color: #8b5cf6; text-decoration: none; font-weight: 600; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 5px; margin-bottom: 10px;">
        &larr; Back to Experiences Listing
    </a>
    <h2 style="color: #0f172a; margin: 0;"><i class="fa-solid fa-compass" style="color: #8b5cf6;"></i> <?= e($pageTitle) ?></h2>
</div>

<div style="background: #ffffff; padding: 30px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); max-width: 900px;">
    <form method="POST" action="<?= $formUrl ?>" enctype="multipart/form-data">
        <input type="hidden" name="csrf_token" value="<?= CsrfService::generateToken() ?>">
        <?php if ($isEdit): ?>
            <input type="hidden" name="id" value="<?= $experience['id'] ?>">
        <?php endif; ?>

        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 20px; margin-bottom: 20px;">
            <div>
                <label style="display: block; font-weight: 600; color: #1e293b; margin-bottom: 6px;">Experience Name / Title <span style="color: #ef4444;">*</span></label>
                <input type="text" name="name" required value="<?= e($experience['name'] ?? old('name')) ?>" placeholder="e.g. Walk Among Giants, Ride Through Hill Country" class="form-control" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.95rem;">
            </div>

            <div>
                <label style="display: block; font-weight: 600; color: #1e293b; margin-bottom: 6px;">Experience Category</label>
                <select name="category_id" class="form-control" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.95rem;">
                    <option value="">-- Select Category --</option>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?= $cat['id'] ?>" <?= ((int)($experience['category_id'] ?? 0)) === (int)$cat['id'] ? 'selected' : '' ?>>
                            <?= e($cat['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; font-weight: 600; color: #1e293b; margin-bottom: 6px;">URL Slug (Optional)</label>
            <input type="text" name="slug" value="<?= e($experience['slug'] ?? old('slug')) ?>" placeholder="Auto-generated if left empty" class="form-control" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.95rem;">
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; font-weight: 600; color: #1e293b; margin-bottom: 6px;">Short Tagline / Catchphrase</label>
            <input type="text" name="short_description" value="<?= e($experience['short_description'] ?? old('short_description')) ?>" placeholder="Catchy summary (e.g. A Wild Encounter You'll Never Forget)" class="form-control" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.95rem;">
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; font-weight: 600; color: #1e293b; margin-bottom: 6px;">Detailed Description</label>
            <textarea name="description" rows="5" placeholder="Full description of the activity and what travelers will experience..." class="form-control" style="width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.95rem; font-family: inherit;"><?= e($experience['description'] ?? old('description')) ?></textarea>
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; font-weight: 600; color: #1e293b; margin-bottom: 6px;">Featured Image</label>
            <?php if ($isEdit && !empty($experience['featured_image'])): ?>
                <div style="margin-bottom: 10px; display: flex; align-items: center; gap: 15px;">
                    <img src="<?= asset_url($experience['featured_image']) ?>" alt="Current Image" style="width: 100px; height: 60px; object-fit: cover; border-radius: 6px; border: 1px solid #cbd5e1;">
                    <span style="font-size: 0.85rem; color: #64748b;">Current Image Path: <code><?= e($experience['featured_image']) ?></code></span>
                </div>
            <?php endif; ?>
            <input type="file" name="featured_image" accept="image/*" class="form-control" style="width: 100%; padding: 8px; border: 1px solid #cbd5e1; border-radius: 6px;">
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px; margin-bottom: 30px;">
            <div>
                <label style="display: block; font-weight: 600; color: #1e293b; margin-bottom: 6px;">Status</label>
                <select name="status" class="form-control" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.95rem;">
                    <option value="ACTIVE" <?= ($experience['status'] ?? 'ACTIVE') === 'ACTIVE' ? 'selected' : '' ?>>Active (Visible)</option>
                    <option value="INACTIVE" <?= ($experience['status'] ?? '') === 'INACTIVE' ? 'selected' : '' ?>>Inactive (Hidden)</option>
                </select>
            </div>

            <div>
                <label style="display: block; font-weight: 600; color: #1e293b; margin-bottom: 6px;">Display Order</label>
                <input type="number" name="display_order" value="<?= (int)($experience['display_order'] ?? 0) ?>" class="form-control" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.95rem;">
            </div>

            <div style="display: flex; align-items: center; margin-top: 25px;">
                <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-weight: 600; color: #1e293b;">
                    <input type="checkbox" name="is_featured" value="1" <?= !empty($experience['is_featured']) ? 'checked' : '' ?> style="width: 18px; height: 18px; accent-color: #8b5cf6;">
                    Mark as Featured Experience
                </label>
            </div>
        </div>

        <div style="display: flex; gap: 12px; border-top: 1px solid #e2e8f0; padding-top: 20px;">
            <button type="submit" class="btn btn-primary" style="padding: 12px 25px; background: #8b5cf6; color: white; border: none; border-radius: 6px; font-weight: 600; font-size: 0.95rem; cursor: pointer;">
                <?= $isEdit ? 'Save Changes' : 'Create Experience' ?>
            </button>
            <a href="<?= base_url('admin/experiences') ?>" style="padding: 12px 25px; background: #e2e8f0; color: #334155; text-decoration: none; border-radius: 6px; font-weight: 600; font-size: 0.95rem;">
                Cancel
            </a>
        </div>
    </form>
</div>

<?php render_partial('admin-footer'); ?>
