<?php render_partial('admin-header', ['page_title' => 'Manage Gallery - Admin Portal']); ?>

<div class="admin-page-header" style="margin-bottom: 25px;">
    <h2 style="color: #0f172a; margin: 0;"><i class="fa-solid fa-images" style="color: #f59e0b;"></i> Photo Gallery Management</h2>
    <p class="text-muted" style="margin: 5px 0 0 0;">Upload, edit and organize high-definition photo assets for the public gallery showcase.</p>
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
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 20px;">
            <?php foreach ($gallery_items as $item): ?>
                <?php 
                    $imgSrc = (strpos($item['image'], 'http') === 0) 
                        ? $item['image'] 
                        : asset_url('images/' . e(ltrim($item['image'], '/')));
                ?>
                <div style="border: 1px solid #e2e8f0; border-radius: 8px; overflow: hidden; background: #fafafa; display: flex; flex-direction: column;">
                    <div style="height: 160px; overflow: hidden; position: relative; background: #000;">
                        <img src="<?= $imgSrc ?>" alt="<?= e($item['title'] ?? 'Gallery Image') ?>" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.src='https://placehold.co/400x300?text=Gallery+Photo'">
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

                        <div style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #f1f5f9; padding-top: 10px; gap: 8px;">
                            <span style="font-size: 0.75rem; color: #94a3b8;">ID: #<?= $item['id'] ?></span>
                            
                            <div style="display: flex; gap: 6px;">
                                <button type="button" class="btn-edit-gallery-photo" 
                                    data-id="<?= $item['id'] ?>"
                                    data-title="<?= e($item['title'] ?? '') ?>"
                                    data-category="<?= e($item['category'] ?? 'general') ?>"
                                    data-order="<?= (int)($item['display_order'] ?? 0) ?>"
                                    data-status="<?= e($item['status'] ?? 'ACTIVE') ?>"
                                    data-image="<?= e($item['image'] ?? '') ?>"
                                    data-imgsrc="<?= $imgSrc ?>"
                                    style="padding: 5px 10px; background: #0284c7; color: white; border: none; border-radius: 4px; font-size: 0.75rem; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 4px;">
                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                </button>

                                <form method="POST" action="<?= base_url('admin/gallery?action=delete') ?>" onsubmit="return confirm('Are you sure you want to delete this gallery item?');" style="margin: 0;">
                                    <input type="hidden" name="csrf_token" value="<?= CsrfService::generateToken() ?>">
                                    <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                    <button type="submit" style="padding: 5px 10px; background: #ef4444; color: white; border: none; border-radius: 4px; font-size: 0.75rem; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 4px;">
                                        <i class="fa-solid fa-trash"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<!-- =========================================================================
     EDIT GALLERY PHOTO MODAL
     ========================================================================= -->
<div id="editGalleryModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(4px); z-index: 9999; justify-content: center; align-items: center; padding: 20px;">
    <div style="background: #ffffff; width: 100%; max-width: 600px; border-radius: 12px; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1), 0 10px 10px -5px rgba(0,0,0,0.04); overflow: hidden;">
        
        <div style="background: #0f172a; color: white; padding: 18px 24px; display: flex; justify-content: space-between; align-items: center;">
            <h3 style="margin: 0; font-size: 1.1rem; font-weight: 700; display: flex; align-items: center; gap: 8px;">
                <i class="fa-solid fa-pen-to-square" style="color: #f59e0b;"></i> Update Gallery Photo
            </h3>
            <button type="button" id="closeEditModalBtn" style="background: transparent; border: none; color: #94a3b8; font-size: 1.4rem; cursor: pointer; line-height: 1;">&times;</button>
        </div>

        <form method="POST" action="<?= base_url('admin/gallery?action=update') ?>" enctype="multipart/form-data" style="padding: 24px;">
            <input type="hidden" name="csrf_token" value="<?= CsrfService::generateToken() ?>">
            <input type="hidden" name="id" id="edit_photo_id" value="">

            <div style="margin-bottom: 15px; display: flex; align-items: center; gap: 15px; background: #f8fafc; padding: 12px; border-radius: 8px; border: 1px solid #e2e8f0;">
                <img id="edit_img_preview" src="" alt="Current Image" style="width: 80px; height: 55px; object-fit: cover; border-radius: 6px; border: 1px solid #cbd5e1;">
                <div>
                    <span style="font-size: 0.8rem; color: #64748b; display: block;">Current Image Path:</span>
                    <code id="edit_img_path_code" style="font-size: 0.8rem; color: #0284c7; word-break: break-all;"></code>
                </div>
            </div>

            <div style="margin-bottom: 15px;">
                <label style="display: block; font-weight: 600; color: #1e293b; margin-bottom: 6px;">Photo Title / Caption</label>
                <input type="text" name="title" id="edit_title" required class="form-control" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.95rem;">
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 15px;">
                <div>
                    <label style="display: block; font-weight: 600; color: #1e293b; margin-bottom: 6px;">Category Tag</label>
                    <select name="category" id="edit_category" class="form-control" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.95rem;">
                        <option value="wildlife">Wildlife & Safaris</option>
                        <option value="culture">Culture & Heritage</option>
                        <option value="highlands">Highlands & Tea</option>
                        <option value="culinary">Culinary & Cooking</option>
                        <option value="experiences">Activities & Experiences</option>
                        <option value="general">General Showcase</option>
                    </select>
                </div>

                <div>
                    <label style="display: block; font-weight: 600; color: #1e293b; margin-bottom: 6px;">Display Order</label>
                    <input type="number" name="display_order" id="edit_display_order" value="0" class="form-control" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.95rem;">
                </div>
            </div>

            <div style="margin-bottom: 15px;">
                <label style="display: block; font-weight: 600; color: #1e293b; margin-bottom: 6px;">Upload New Replace File (Optional)</label>
                <input type="file" name="gallery_image" accept="image/*" class="form-control" style="width: 100%; padding: 8px; border: 1px solid #cbd5e1; border-radius: 6px;">
                <small style="color: #64748b; font-size: 0.75rem; margin-top: 4px; display: block;">Leave empty to keep the existing photo file.</small>
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; font-weight: 600; color: #1e293b; margin-bottom: 6px;">OR Edit Image Path / URL</label>
                <input type="text" name="image_url" id="edit_image_url" placeholder="e.g. Gallery/WhatsApp Image 2026-08-18 at 09.19.55.jpeg" class="form-control" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 0.95rem;">
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 12px; border-top: 1px solid #e2e8f0; padding-top: 16px;">
                <button type="button" id="cancelEditModalBtn" style="padding: 10px 20px; background: #e2e8f0; color: #334155; border: none; border-radius: 6px; font-weight: 600; font-size: 0.9rem; cursor: pointer;">
                    Cancel
                </button>
                <button type="submit" style="padding: 10px 24px; background: #0284c7; color: white; border: none; border-radius: 6px; font-weight: 600; font-size: 0.9rem; cursor: pointer; display: inline-flex; align-items: center; gap: 6px;">
                    <i class="fa-solid fa-check"></i> Save Changes
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('editGalleryModal');
    const closeBtn = document.getElementById('closeEditModalBtn');
    const cancelBtn = document.getElementById('cancelEditModalBtn');
    const editBtns = document.querySelectorAll('.btn-edit-gallery-photo');

    const photoIdInput = document.getElementById('edit_photo_id');
    const titleInput = document.getElementById('edit_title');
    const categoryInput = document.getElementById('edit_category');
    const orderInput = document.getElementById('edit_display_order');
    const imageUrlInput = document.getElementById('edit_image_url');
    const imgPreview = document.getElementById('edit_img_preview');
    const imgPathCode = document.getElementById('edit_img_path_code');

    editBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const id = btn.getAttribute('data-id');
            const title = btn.getAttribute('data-title');
            const category = btn.getAttribute('data-category');
            const order = btn.getAttribute('data-order');
            const image = btn.getAttribute('data-image');
            const imgsrc = btn.getAttribute('data-imgsrc');

            photoIdInput.value = id;
            titleInput.value = title;
            categoryInput.value = category;
            orderInput.value = order;
            imageUrlInput.value = image;
            imgPathCode.textContent = image;
            imgPreview.src = imgsrc;

            modal.style.display = 'flex';
        });
    });

    const closeModal = () => {
        modal.style.display = 'none';
    };

    if (closeBtn) closeBtn.addEventListener('click', closeModal);
    if (cancelBtn) cancelBtn.addEventListener('click', closeModal);

    window.addEventListener('click', (e) => {
        if (e.target === modal) {
            closeModal();
        }
    });
});
</script>

<?php render_partial('admin-footer'); ?>
