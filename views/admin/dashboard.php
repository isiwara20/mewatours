<?php render_partial('admin-header', ['page_title' => 'Admin Dashboard - Mewa Tours Portal']); ?>

<div class="admin-dashboard-overview">
    <div class="dashboard-header" style="margin-bottom: 25px;">
        <h2><i class="fa-solid fa-gauge-high"></i> Dashboard Overview</h2>
        <p class="text-muted">Welcome to the Mewa Tours website management portal.</p>
    </div>

    <!-- Summary Statistics Cards -->
    <div class="stats-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px; margin-bottom: 30px;">
        <div class="stat-card" style="background: #ffffff; border-left: 4px solid #004080; padding: 20px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
            <div class="stat-title" style="color: #64748b; font-size: 0.9rem;">Active Tours</div>
            <div class="stat-value" style="font-size: 1.8rem; font-weight: 700; color: #004080; margin-top: 5px;"><?= $tours_count ?></div>
        </div>

        <div class="stat-card" style="background: #ffffff; border-left: 4px solid #0284c7; padding: 20px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
            <div class="stat-title" style="color: #64748b; font-size: 0.9rem;">Destinations</div>
            <div class="stat-value" style="font-size: 1.8rem; font-weight: 700; color: #0284c7; margin-top: 5px;"><?= $destinations_count ?></div>
        </div>

        <div class="stat-card" style="background: #ffffff; border-left: 4px solid #10b981; padding: 20px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
            <div class="stat-title" style="color: #64748b; font-size: 0.9rem;">Total Inquiries</div>
            <div class="stat-value" style="font-size: 1.8rem; font-weight: 700; color: #10b981; margin-top: 5px;"><?= $inquiries_count ?></div>
        </div>
    </div>

    <!-- Recent Web Inquiries -->
    <div class="recent-inquiries-card" style="background: #ffffff; padding: 25px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
        <h3 style="margin-bottom: 15px; color: #1e293b;"><i class="fa-solid fa-clock-rotate-left"></i> Recent Customer Inquiries</h3>

        <?php if (empty($recent_inquiries)): ?>
            <p class="text-muted">No customer web inquiries recorded yet.</p>
        <?php else: ?>
            <table style="width: 100%; border-collapse: collapse; text-align: left;">
                <thead>
                    <tr style="border-bottom: 2px solid #e2e8f0; color: #64748b;">
                        <th style="padding: 10px;">ID</th>
                        <th style="padding: 10px;">Date</th>
                        <th style="padding: 10px;">Name</th>
                        <th style="padding: 10px;">Email</th>
                        <th style="padding: 10px;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recent_inquiries as $inquiry): ?>
                        <tr style="border-bottom: 1px solid #f1f5f9;">
                            <td style="padding: 10px;">#<?= $inquiry['id'] ?></td>
                            <td style="padding: 10px;"><?= format_date($inquiry['created_at']) ?></td>
                            <td style="padding: 10px;"><?= e($inquiry['name']) ?></td>
                            <td style="padding: 10px;"><?= e($inquiry['email']) ?></td>
                            <td style="padding: 10px;"><span class="badge badge-status"><?= e($inquiry['status']) ?></span></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>

<?php render_partial('admin-footer'); ?>
