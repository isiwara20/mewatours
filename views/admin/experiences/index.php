<?php render_partial('admin-header', ['page_title' => 'Manage Experiences - Admin Portal']); ?>

<div class="admin-page-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
    <div>
        <h2 style="color: #0f172a; margin: 0;"><i class="fa-solid fa-compass" style="color: #8b5cf6;"></i> Experiences Management</h2>
        <p class="text-muted" style="margin: 5px 0 0 0;">Manage travel activities, safari encounters, and Sri Lankan heritage experiences.</p>
    </div>
    <div>
        <a href="<?= base_url('admin/experiences/create') ?>" class="btn btn-primary" style="padding: 10px 20px; background: #8b5cf6; color: white; text-decoration: none; border-radius: 6px; font-weight: 600; display: inline-flex; align-items: center; gap: 8px;">
            <i class="fa-solid fa-plus"></i> Add New Experience
        </a>
    </div>
</div>

<div class="admin-table-card" style="background: #ffffff; padding: 25px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">
    <?php if (empty($experiences)): ?>
        <div style="text-align: center; padding: 40px;">
            <i class="fa-solid fa-compass" style="font-size: 3rem; color: #cbd5e1; margin-bottom: 15px;"></i>
            <p class="text-muted">No experiences registered yet in the database.</p>
            <a href="<?= base_url('admin/experiences/create') ?>" style="color: #8b5cf6; font-weight: 600;">Add your first experience &rarr;</a>
        </div>
    <?php else: ?>
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; text-align: left;">
                <thead>
                    <tr style="border-bottom: 2px solid #e2e8f0; color: #64748b; font-size: 0.85rem; text-transform: uppercase;">
                        <th style="padding: 12px 10px; width: 60px;">ID</th>
                        <th style="padding: 12px 10px; width: 80px;">Image</th>
                        <th style="padding: 12px 10px;">Experience Title</th>
                        <th style="padding: 12px 10px;">Category</th>
                        <th style="padding: 12px 10px;">Featured</th>
                        <th style="padding: 12px 10px;">Status</th>
                        <th style="padding: 12px 10px; text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($experiences as $exp): ?>
                        <tr style="border-bottom: 1px solid #f1f5f9;">
                            <td style="padding: 12px 10px; font-weight: 600; color: #475569;">#<?= $exp['id'] ?></td>
                            <td style="padding: 12px 10px;">
                                <?php if (!empty($exp['featured_image'])): ?>
                                    <img src="<?= asset_url($exp['featured_image']) ?>" alt="<?= e($exp['name']) ?>" style="width: 50px; height: 35px; object-fit: cover; border-radius: 4px;" onerror="this.src='https://placehold.co/100x70?text=No+Img'">
                                <?php else: ?>
                                    <div style="width: 50px; height: 35px; background: #e2e8f0; border-radius: 4px; display: flex; align-items: center; justify-content: center; font-size: 0.7rem; color: #64748b;">No Image</div>
                                <?php endif; ?>
                            </td>
                            <td style="padding: 12px 10px;">
                                <strong style="color: #0f172a; display: block;"><?= e($exp['name']) ?></strong>
                                <span style="font-size: 0.8rem; color: #64748b;"><?= e(truncate_text($exp['short_description'] ?? '', 60)) ?></span>
                            </td>
                            <td style="padding: 12px 10px;">
                                <span style="padding: 3px 8px; background: #f3e8ff; color: #6b21a8; border-radius: 12px; font-size: 0.75rem; font-weight: 600;">
                                    <?= e($exp['category_name'] ?? 'General') ?>
                                </span>
                            </td>
                            <td style="padding: 12px 10px;">
                                <?php if (!empty($exp['is_featured'])): ?>
                                    <span style="padding: 3px 8px; background: #fef3c7; color: #92400e; border-radius: 12px; font-size: 0.75rem; font-weight: 700;">★ Featured</span>
                                <?php else: ?>
                                    <span style="color: #94a3b8; font-size: 0.8rem;">Standard</span>
                                <?php endif; ?>
                            </td>
                            <td style="padding: 12px 10px;">
                                <?php if ($exp['status'] === 'ACTIVE'): ?>
                                    <span style="padding: 4px 10px; background: #d1fae5; color: #065f46; border-radius: 12px; font-size: 0.75rem; font-weight: 700;">Active</span>
                                <?php else: ?>
                                    <span style="padding: 4px 10px; background: #fee2e2; color: #991b1b; border-radius: 12px; font-size: 0.75rem; font-weight: 700;">Inactive</span>
                                <?php endif; ?>
                            </td>
                            <td style="padding: 12px 10px; text-align: right;">
                                <div style="display: flex; justify-content: flex-end; gap: 8px;">
                                    <a href="<?= base_url('admin/experiences/edit/' . $exp['id']) ?>" style="padding: 6px 12px; background: #8b5cf6; color: white; text-decoration: none; border-radius: 4px; font-size: 0.8rem; font-weight: 600;">
                                        <i class="fa-solid fa-pen-to-square"></i> Edit
                                    </a>
                                    <form method="POST" action="<?= base_url('admin/experiences/delete/' . $exp['id']) ?>" onsubmit="return confirm('Are you sure you want to delete this experience?');" style="margin: 0; display: inline;">
                                        <input type="hidden" name="csrf_token" value="<?= CsrfService::generateToken() ?>">
                                        <button type="submit" style="padding: 6px 12px; background: #ef4444; color: white; border: none; border-radius: 4px; font-size: 0.8rem; font-weight: 600; cursor: pointer;">
                                            <i class="fa-solid fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<?php render_partial('admin-footer'); ?>
