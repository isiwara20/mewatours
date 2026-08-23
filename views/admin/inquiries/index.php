<?php render_partial('admin-header', ['page_title' => 'Customer Inquiries - Admin Portal']); ?>

<div class="admin-page-header" style="margin-bottom: 25px;">
    <h2 style="color: #0f172a; margin: 0;"><i class="fa-solid fa-envelope-open-text" style="color: #10b981;"></i> Customer Inquiries Management</h2>
    <p class="text-muted" style="margin: 5px 0 0 0;">Review, update status, and manage incoming traveler web booking inquiries.</p>
</div>

<div class="admin-table-card" style="background: #ffffff; padding: 25px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">
    <?php if (empty($inquiries)): ?>
        <div style="text-align: center; padding: 40px;">
            <i class="fa-solid fa-inbox" style="font-size: 3rem; color: #cbd5e1; margin-bottom: 15px;"></i>
            <p class="text-muted">No customer inquiries submitted yet.</p>
        </div>
    <?php else: ?>
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; text-align: left;">
                <thead>
                    <tr style="border-bottom: 2px solid #e2e8f0; color: #64748b; font-size: 0.85rem; text-transform: uppercase;">
                        <th style="padding: 12px 10px; width: 60px;">ID</th>
                        <th style="padding: 12px 10px;">Submitted</th>
                        <th style="padding: 12px 10px;">Customer Name</th>
                        <th style="padding: 12px 10px;">Contact Details</th>
                        <th style="padding: 12px 10px;">Tour Interest</th>
                        <th style="padding: 12px 10px;">Status</th>
                        <th style="padding: 12px 10px; text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($inquiries as $inquiry): ?>
                        <tr style="border-bottom: 1px solid #f1f5f9;">
                            <td style="padding: 12px 10px; font-weight: 600; color: #475569;">#<?= $inquiry['id'] ?></td>
                            <td style="padding: 12px 10px; color: #64748b; font-size: 0.85rem;"><?= format_date($inquiry['created_at']) ?></td>
                            <td style="padding: 12px 10px;">
                                <strong style="color: #0f172a; display: block;"><?= e($inquiry['name']) ?></strong>
                                <?php if (!empty($inquiry['country'])): ?>
                                    <span style="font-size: 0.8rem; color: #64748b;"><i class="fa-solid fa-globe"></i> <?= e($inquiry['country']) ?></span>
                                <?php endif; ?>
                            </td>
                            <td style="padding: 12px 10px;">
                                <a href="mailto:<?= e($inquiry['email']) ?>" style="color: #004080; text-decoration: none; font-size: 0.9rem; display: block; font-weight: 500;"><?= e($inquiry['email']) ?></a>
                                <?php if (!empty($inquiry['phone'])): ?>
                                    <span style="font-size: 0.8rem; color: #64748b;"><i class="fa-solid fa-phone"></i> <?= e($inquiry['phone']) ?></span>
                                <?php endif; ?>
                            </td>
                            <td style="padding: 12px 10px; font-size: 0.9rem; color: #334155;">
                                <?= e($inquiry['tour_title'] ?? 'General Contact Form') ?>
                            </td>
                            <td style="padding: 12px 10px;">
                                <form method="POST" action="<?= base_url('admin/inquiries/update_status/' . $inquiry['id']) ?>" style="margin: 0;">
                                    <input type="hidden" name="csrf_token" value="<?= CsrfService::generateToken() ?>">
                                    <select name="status" onchange="this.form.submit()" style="padding: 4px 8px; border-radius: 6px; font-size: 0.8rem; font-weight: 700; border: 1px solid #cbd5e1; cursor: pointer;
                                        <?php if ($inquiry['status'] === 'NEW') echo 'background: #fee2e2; color: #991b1b;'; ?>
                                        <?php if ($inquiry['status'] === 'CONTACTED') echo 'background: #dbeafe; color: #1e40af;'; ?>
                                        <?php if ($inquiry['status'] === 'IN_PROGRESS') echo 'background: #fef3c7; color: #92400e;'; ?>
                                        <?php if ($inquiry['status'] === 'CLOSED') echo 'background: #d1fae5; color: #065f46;'; ?>
                                        <?php if ($inquiry['status'] === 'CANCELLED') echo 'background: #f1f5f9; color: #64748b;'; ?>
                                    ">
                                        <option value="NEW" <?= $inquiry['status'] === 'NEW' ? 'selected' : '' ?>>NEW</option>
                                        <option value="CONTACTED" <?= $inquiry['status'] === 'CONTACTED' ? 'selected' : '' ?>>CONTACTED</option>
                                        <option value="IN_PROGRESS" <?= $inquiry['status'] === 'IN_PROGRESS' ? 'selected' : '' ?>>IN PROGRESS</option>
                                        <option value="CLOSED" <?= $inquiry['status'] === 'CLOSED' ? 'selected' : '' ?>>CLOSED</option>
                                        <option value="CANCELLED" <?= $inquiry['status'] === 'CANCELLED' ? 'selected' : '' ?>>CANCELLED</option>
                                    </select>
                                </form>
                            </td>
                            <td style="padding: 12px 10px; text-align: right;">
                                <div style="display: flex; justify-content: flex-end; gap: 8px;">
                                    <a href="<?= base_url('admin/inquiries/show/' . $inquiry['id']) ?>" style="padding: 6px 12px; background: #004080; color: white; text-decoration: none; border-radius: 4px; font-size: 0.8rem; font-weight: 600;">
                                        <i class="fa-solid fa-eye"></i> View
                                    </a>
                                    <form method="POST" action="<?= base_url('admin/inquiries/delete/' . $inquiry['id']) ?>" onsubmit="return confirm('Are you sure you want to delete this inquiry record?');" style="margin: 0; display: inline;">
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
