<?php render_partial('admin-header', ['page_title' => 'Manage Gallery - Admin Portal']); ?>

<div class="admin-page-header" style="margin-bottom: 25px;">
    <h2 style="color: #0f172a; margin: 0;"><i class="fa-solid fa-images" style="color: #f59e0b;"></i> Photo Gallery Management</h2>
    <p class="text-muted" style="margin: 5px 0 0 0;">Upload and organize high-definition photo assets for the public gallery showcase.</p>
</div>

<!-- Upload New Photo Card -->
<div style="background: #ffffff; padding: 25px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); margin-bottom: 30px;">
    <h3 style="margin: 0 0 15px 0; color: #1e293b; font-size: 1.1rem;"><i class="fa-solid fa-cloud-arrow-up" style="color: #f59e0b;"></i> Upload New Gallery Photo</h3>
    
    <form method="POST" action="<?= base_url('admin/gallery?action=store') ?>" enctype="multipart/form-data">
        <input type="hidden" name="csrf_token" value="<?= CsrfService::generateToken() ?>">

        <div style="display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 20px; margin-bottom: 15px;">
            <div>
                <label style="display: block; font-weight: 600; color: #1e293b; margin-bottom: 6px;">Photo Title / Caption</label>
                <input type="text" name="title" placeholder="e.g. Guided Wild Elephant Safari in Yala" class="form-control" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.95rem;">
            </div>

            <div>
                <label style="display: block; font-weight: 600; color: #1e293b; margin-bottom: 6px;">Category Tag</label>
                <select name="category" class="form-control" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.95rem;">
                    <option value="wildlife">Wildlife & Safaris</option>
                    <option value="culture">Culture & Heritage</option>
                    <option value="highlands">Highlands & Tea</option>
                    <option value="culinary">Culinary & Cooking</option>
                    <option value="experiences">Activities & Experiences</option>
                    <option value="general" selected>General Showcase</option>
                </select>
            </div>

            <div>
                <label style="display: block; font-weight: 600; color: #1e293b; margin-bottom: 6px;">Display Order</label>
                <input type="number" name="display_order" value="0" class="form-control" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.95rem;">
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
            <div>
                <label style="display: block; font-weight: 600; color: #1e293b; margin-bottom: 6px;">Upload Image File</label>
                <input type="file" name="gallery_image" accept="image/*" class="form-control" style="width: 100%; padding: 8px; border: 1px solid #cbd5e1; border-radius: 6px;">
            </div>

            <div>
                <label style="display: block; font-weight: 600; color: #1e293b; margin-bottom: 6px;">OR Existing Image Path</label>
                <input type="text" name="image_url" placeholder="e.g. Gallery/WhatsApp Image 2026-08-18 at 09.19.55.jpeg" class="form-control" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.95rem;">
            </div>
        </div>

        <button type="submit" class="btn btn-primary" style="padding: 10px 22px; background: #f59e0b; color: white; border: none; border-radius: 6px; font-weight: 600; font-size: 0.95rem; cursor: pointer; display: inline-flex; align-items: center; gap: 8px;">
            <i class="fa-solid fa-plus"></i> Add Photo to Gallery
        </button>
    </form>
</div>

<!-- Existing Gallery Items List -->
<div class="admin-table-card" style="background: #ffffff; padding: 25px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">
    <h3 style="margin: 0 0 20px 0; color: #1e293b; font-size: 1.1rem;"><i class="fa-solid fa-photo-film" style="color: #004080;"></i> Uploaded Gallery Items (<?= count($gallery_items) ?>)</h3>

    <?php if (empty($gallery_items)): ?>
        <p class="text-muted" style="text-align: center; padding: 30px;">No photo gallery items uploaded yet.</p>
    <?php else: ?>
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(240px, 1fr)); gap: 20px;">
            <?php foreach ($gallery_items as $item): ?>
                <div style="border: 1px solid #e2e8f0; border-radius: 8px; overflow: hidden; background: #fafafa; display: flex; flex-direction: column;">
                    <div style="height: 160px; overflow: hidden; position: relative; background: #000;">
                        <img src="<?= asset_url($item['image']) ?>" alt="<?= e($item['title'] ?? 'Gallery Image') ?>" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.src='https://placehold.co/400x300?text=Gallery+Photo'">
                        <span style="position: absolute; top: 10px; right: 10px; background: rgba(0,0,0,0.7); color: white; padding: 3px 8px; border-radius: 12px; font-size: 0.7rem; font-weight: 600; text-transform: uppercase;">
                            <?= e($item['category'] ?? 'general') ?>
                        </span>
                    </div>

                    <div style="padding: 15px; flex-grow: 1; display: flex; flex-direction: column; justify-content: space-between;">
                        <div>
                            <strong style="color: #0f172a; display: block; font-size: 0.95rem; margin-bottom: 5px;"><?= e($item['title'] ?? 'Untitled Photo') ?></strong>
                            <small style="color: #64748b; font-size: 0.75rem; word-break: break-all; display: block; margin-bottom: 12px;">
                                Path: <code><?= e($item['image']) ?></code>
                            </small>
                        </div>

                        <div style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #f1f5f9; padding-top: 10px;">
                            <span style="font-size: 0.75rem; color: #94a3b8;">ID: #<?= $item['id'] ?></span>
                            <form method="POST" action="<?= base_url('admin/gallery/delete/' . $item['id']) ?>" onsubmit="return confirm('Are you sure you want to delete this gallery item?');" style="margin: 0;">
                                <input type="hidden" name="csrf_token" value="<?= CsrfService::generateToken() ?>">
                                <button type="submit" style="padding: 4px 10px; background: #ef4444; color: white; border: none; border-radius: 4px; font-size: 0.75rem; font-weight: 600; cursor: pointer;">
                                    <i class="fa-solid fa-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php render_partial('admin-footer'); ?>
