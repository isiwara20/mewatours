<?php render_partial('admin-header', ['page_title' => 'Manage Gallery - Admin Portal']); ?>

<div class="admin-page-header">
    <h2><i class="fa-solid fa-images"></i> Photo Gallery Management</h2>
    <p class="text-muted">Upload and manage photo gallery assets.</p>
</div>

<div class="admin-table-card" style="background: #ffffff; padding: 20px; border-radius: 8px; margin-top: 20px;">
    <?php if (empty($gallery_items)): ?>
        <p class="text-muted">No gallery items uploaded yet.</p>
    <?php else: ?>
        <table style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr style="border-bottom: 2px solid #e2e8f0;">
                    <th style="padding: 10px;">ID</th>
                    <th style="padding: 10px;">Title</th>
                    <th style="padding: 10px;">Category</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($gallery_items as $item): ?>
                    <tr style="border-bottom: 1px solid #f1f5f9;">
                        <td style="padding: 10px;">#<?= $item['id'] ?></td>
                        <td style="padding: 10px;"><?= e($item['title'] ?? 'Untitled') ?></td>
                        <td style="padding: 10px;"><?= e($item['category'] ?? 'general') ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php render_partial('admin-footer'); ?>
