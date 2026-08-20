<?php render_partial('admin-header', ['page_title' => 'Customer Inquiries - Admin Portal']); ?>

<div class="admin-page-header">
    <h2><i class="fa-solid fa-envelope-open-text"></i> Customer Inquiries</h2>
    <p class="text-muted">Manage web form inquiries received from visitors.</p>
</div>

<div class="admin-table-card" style="background: #ffffff; padding: 20px; border-radius: 8px; margin-top: 20px;">
    <?php if (empty($inquiries)): ?>
        <p class="text-muted">No customer inquiries submitted yet.</p>
    <?php else: ?>
        <table style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr style="border-bottom: 2px solid #e2e8f0;">
                    <th style="padding: 10px;">ID</th>
                    <th style="padding: 10px;">Date</th>
                    <th style="padding: 10px;">Name</th>
                    <th style="padding: 10px;">Email</th>
                    <th style="padding: 10px;">Phone</th>
                    <th style="padding: 10px;">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($inquiries as $inquiry): ?>
                    <tr style="border-bottom: 1px solid #f1f5f9;">
                        <td style="padding: 10px;">#<?= $inquiry['id'] ?></td>
                        <td style="padding: 10px;"><?= format_date($inquiry['created_at']) ?></td>
                        <td style="padding: 10px;"><?= e($inquiry['name']) ?></td>
                        <td style="padding: 10px;"><?= e($inquiry['email']) ?></td>
                        <td style="padding: 10px;"><?= e($inquiry['phone'] ?? '-') ?></td>
                        <td style="padding: 10px;"><?= e($inquiry['status']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php render_partial('admin-footer'); ?>
