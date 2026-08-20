<?php render_partial('admin-header', ['page_title' => 'Manage Destinations - Admin Portal']); ?>

<div class="admin-page-header">
    <h2><i class="fa-solid fa-location-dot"></i> Destinations Management</h2>
    <p class="text-muted">Manage Sri Lankan destinations.</p>
</div>

<div class="admin-table-card" style="background: #ffffff; padding: 20px; border-radius: 8px; margin-top: 20px;">
    <?php if (empty($destinations)): ?>
        <p class="text-muted">No destinations registered yet.</p>
    <?php else: ?>
        <table style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr style="border-bottom: 2px solid #e2e8f0;">
                    <th style="padding: 10px;">ID</th>
                    <th style="padding: 10px;">Name</th>
                    <th style="padding: 10px;">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($destinations as $dest): ?>
                    <tr style="border-bottom: 1px solid #f1f5f9;">
                        <td style="padding: 10px;">#<?= $dest['id'] ?></td>
                        <td style="padding: 10px;"><?= e($dest['name']) ?></td>
                        <td style="padding: 10px;"><?= e($dest['status']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php render_partial('admin-footer'); ?>
