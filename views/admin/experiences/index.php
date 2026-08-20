<?php render_partial('admin-header', ['page_title' => 'Manage Experiences - Admin Portal']); ?>

<div class="admin-page-header">
    <h2><i class="fa-solid fa-compass"></i> Experiences Management</h2>
    <p class="text-muted">Manage travel activities and special Sri Lankan experiences.</p>
</div>

<div class="admin-table-card" style="background: #ffffff; padding: 20px; border-radius: 8px; margin-top: 20px;">
    <?php if (empty($experiences)): ?>
        <p class="text-muted">No experiences registered yet.</p>
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
                <?php foreach ($experiences as $exp): ?>
                    <tr style="border-bottom: 1px solid #f1f5f9;">
                        <td style="padding: 10px;">#<?= $exp['id'] ?></td>
                        <td style="padding: 10px;"><?= e($exp['name']) ?></td>
                        <td style="padding: 10px;"><?= e($exp['status']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php render_partial('admin-footer'); ?>
