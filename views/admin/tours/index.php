<?php render_partial('admin-header', ['page_title' => $page_title ?? 'Manage Tours - Admin Portal']); ?>

<div class="admin-page-header">
    <div class="header-content">
        <h2><i class="fa-solid fa-route"></i> Tour Packages Management</h2>
        <p class="text-muted">Create, edit, manage dynamic inclusions & highlights, or set public Sri Lanka tour packages.</p>
    </div>
    <div class="header-actions">
        <a href="<?= base_url('admin/tours/create') ?>" class="btn btn-admin-primary">
            <i class="fa-solid fa-plus"></i> Add New Tour Package
        </a>
    </div>
</div>

<div class="admin-table-card">
    <?php if (empty($tours)): ?>
        <div class="admin-empty-state">
            <i class="fa-solid fa-route"></i>
            <h3>No Tour Packages Available</h3>
            <p>Get started by adding your first Sri Lanka tour package.</p>
            <a href="<?= base_url('admin/tours/create') ?>" class="btn btn-admin-primary" style="margin-top: 15px;">
                <i class="fa-solid fa-plus"></i> Add Tour Package
            </a>
        </div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="admin-data-table">
                <thead>
                    <tr>
                        <th style="width: 70px;">Image</th>
                        <th>Tour Title</th>
                        <th>Duration</th>
                        <th>Tour Type</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Featured</th>
                        <th>Updated</th>
                        <th style="width: 140px; text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tours as $tour): ?>
                        <tr>
                            <td>
                                <?php 
                                    $imgSrc = !empty($tour['featured_image']) 
                                        ? ((strpos($tour['featured_image'], 'http') === 0) ? $tour['featured_image'] : asset_url('images/' . e($tour['featured_image'])))
                                        : asset_url('images/tours/hero-tours-ella.jpg');
                                ?>
                                <img src="<?= e($imgSrc) ?>" alt="<?= e($tour['title']) ?>" class="admin-thumb-img" onerror="this.src='https://placehold.co/100x70/eef2ff/4f46e5?text=Tour'">
                            </td>
                            <td>
                                <strong class="admin-tour-title"><?= e($tour['title']) ?></strong>
                                <small class="admin-tour-slug">/tours/<?= e($tour['slug']) ?></small>
                            </td>
                            <td>
                                <span class="badge badge-duration"><?= e($tour['formatted_duration']) ?></span>
                            </td>
                            <td>
                                <?= !empty($tour['tour_type']) ? '<span class="badge badge-type">' . e($tour['tour_type']) . '</span>' : '<span class="text-muted">—</span>' ?>
                            </td>
                            <td>
                                <?= e($tour['category_name'] ?? 'General') ?>
                            </td>
                            <td>
                                <?php if ($tour['status'] === 'ACTIVE'): ?>
                                    <span class="badge badge-status-active"><i class="fa-solid fa-circle"></i> Published</span>
                                <?php else: ?>
                                    <span class="badge badge-status-inactive"><i class="fa-solid fa-circle"></i> Draft</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if (!empty($tour['is_featured'])): ?>
                                    <span class="badge badge-featured"><i class="fa-solid fa-star"></i> Featured</span>
                                <?php else: ?>
                                    <span class="text-muted">—</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <small class="text-muted"><?= format_date($tour['updated_at'] ?? $tour['created_at']) ?></small>
                            </td>
                            <td style="text-align: right;">
                                <div class="admin-actions-group">
                                    <a href="<?= base_url('admin/tours/edit/' . $tour['id']) ?>" class="btn-action btn-edit" title="Edit Tour">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form action="<?= base_url('admin/tours/delete/' . $tour['id']) ?>" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this tour package? This action cannot be undone.');">
                                        <?= CsrfService::inputField() ?>
                                        <button type="submit" class="btn-action btn-delete" title="Delete Tour">
                                            <i class="fa-solid fa-trash-can"></i>
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
