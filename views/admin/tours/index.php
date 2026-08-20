<?php render_partial('admin-header', ['page_title' => 'Manage Tours - Admin Portal']); ?>

<div class="admin-page-header">
    <h2><i class="fa-solid fa-route"></i> Tour Packages Management</h2>
    <p class="text-muted">Create, edit, or toggle public Sri Lanka tour packages.</p>
</div>

<div class="admin-table-card" style="background: #ffffff; padding: 20px; border-radius: 8px; margin-top: 20px;">
    <?php if (empty($tours)): ?>
        <p class="text-muted">No tour packages created yet.</p>
    <?php else: ?>
        <table style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr style="border-bottom: 2px solid #e2e8f0;">
                    <th style="padding: 10px;">ID</th>
                    <th style="padding: 10px;">Title</th>
                    <th style="padding: 10px;">Duration</th>
                    <th style="padding: 10px;">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tours as $tour): ?>
                    <tr style="border-bottom: 1px solid #f1f5f9;">
                        <td style="padding: 10px;">#<?= $tour['id'] ?></td>
                        <td style="padding: 10px;"><?= e($tour['title']) ?></td>
                        <td style="padding: 10px;"><?= format_duration((int)$tour['duration_days'], (int)$tour['duration_nights']) ?></td>
                        <td style="padding: 10px;"><?= e($tour['status']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php render_partial('admin-footer'); ?>
