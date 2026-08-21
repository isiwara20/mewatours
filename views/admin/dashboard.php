<?php render_partial('admin-header', ['page_title' => 'Admin Dashboard - Mewa Tours Portal']); ?>

<div class="admin-dashboard-overview">
    <div class="dashboard-header" style="margin-bottom: 25px;">
        <h2 style="color: #0f172a; font-weight: 700;"><i class="fa-solid fa-gauge-high" style="color: #004080;"></i> Admin Control Center</h2>
        <p class="text-muted">Welcome back, <strong><?= e($_SESSION['admin_name'] ?? 'Administrator') ?></strong>! Overview of website operations and content.</p>
    </div>

    <!-- Summary Statistics Cards -->
    <div class="stats-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 30px;">
        <div class="stat-card" style="background: #ffffff; border-left: 5px solid #004080; padding: 20px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <div class="stat-title" style="color: #64748b; font-size: 0.85rem; font-weight: 600; text-transform: uppercase;">Tour Packages</div>
                    <div class="stat-value" style="font-size: 2rem; font-weight: 800; color: #004080; margin-top: 5px;"><?= $tours_count ?></div>
                </div>
                <div style="width: 48px; height: 48px; border-radius: 50%; background: #e0f2fe; color: #004080; display: flex; align-items: center; justify-content: center; font-size: 1.3rem;">
                    <i class="fa-solid fa-route"></i>
                </div>
            </div>
            <a href="<?= base_url('admin/tours') ?>" style="display: inline-block; margin-top: 10px; font-size: 0.825rem; color: #004080; font-weight: 600; text-decoration: none;">Manage Tours &rarr;</a>
        </div>

        <div class="stat-card" style="background: #ffffff; border-left: 5px solid #0284c7; padding: 20px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <div class="stat-title" style="color: #64748b; font-size: 0.85rem; font-weight: 600; text-transform: uppercase;">Destinations</div>
                    <div class="stat-value" style="font-size: 2rem; font-weight: 800; color: #0284c7; margin-top: 5px;"><?= $destinations_count ?></div>
                </div>
                <div style="width: 48px; height: 48px; border-radius: 50%; background: #e0f2fe; color: #0284c7; display: flex; align-items: center; justify-content: center; font-size: 1.3rem;">
                    <i class="fa-solid fa-location-dot"></i>
                </div>
            </div>
            <a href="<?= base_url('admin/destinations') ?>" style="display: inline-block; margin-top: 10px; font-size: 0.825rem; color: #0284c7; font-weight: 600; text-decoration: none;">Manage Destinations &rarr;</a>
        </div>

        <div class="stat-card" style="background: #ffffff; border-left: 5px solid #8b5cf6; padding: 20px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <div class="stat-title" style="color: #64748b; font-size: 0.85rem; font-weight: 600; text-transform: uppercase;">Experiences</div>
                    <div class="stat-value" style="font-size: 2rem; font-weight: 800; color: #8b5cf6; margin-top: 5px;"><?= $experiences_count ?></div>
                </div>
                <div style="width: 48px; height: 48px; border-radius: 50%; background: #f3e8ff; color: #8b5cf6; display: flex; align-items: center; justify-content: center; font-size: 1.3rem;">
                    <i class="fa-solid fa-compass"></i>
                </div>
            </div>
            <a href="<?= base_url('admin/experiences') ?>" style="display: inline-block; margin-top: 10px; font-size: 0.825rem; color: #8b5cf6; font-weight: 600; text-decoration: none;">Manage Experiences &rarr;</a>
        </div>

        <div class="stat-card" style="background: #ffffff; border-left: 5px solid #f59e0b; padding: 20px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <div class="stat-title" style="color: #64748b; font-size: 0.85rem; font-weight: 600; text-transform: uppercase;">Gallery Photos</div>
                    <div class="stat-value" style="font-size: 2rem; font-weight: 800; color: #f59e0b; margin-top: 5px;"><?= $gallery_count ?></div>
                </div>
                <div style="width: 48px; height: 48px; border-radius: 50%; background: #fef3c7; color: #f59e0b; display: flex; align-items: center; justify-content: center; font-size: 1.3rem;">
                    <i class="fa-solid fa-images"></i>
                </div>
            </div>
            <a href="<?= base_url('admin/gallery') ?>" style="display: inline-block; margin-top: 10px; font-size: 0.825rem; color: #f59e0b; font-weight: 600; text-decoration: none;">Manage Gallery &rarr;</a>
        </div>

        <div class="stat-card" style="background: #ffffff; border-left: 5px solid #10b981; padding: 20px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <div class="stat-title" style="color: #64748b; font-size: 0.85rem; font-weight: 600; text-transform: uppercase;">Inquiries</div>
                    <div class="stat-value" style="font-size: 2rem; font-weight: 800; color: #10b981; margin-top: 5px;"><?= $inquiries_count ?></div>
                </div>
                <div style="width: 48px; height: 48px; border-radius: 50%; background: #d1fae5; color: #10b981; display: flex; align-items: center; justify-content: center; font-size: 1.3rem;">
                    <i class="fa-solid fa-envelope-open-text"></i>
                </div>
            </div>
            <a href="<?= base_url('admin/inquiries') ?>" style="display: inline-block; margin-top: 10px; font-size: 0.825rem; color: #10b981; font-weight: 600; text-decoration: none;">View All Inquiries &rarr;</a>
        </div>

        <div class="stat-card" style="background: #ffffff; border-left: 5px solid #ef4444; padding: 20px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <div class="stat-title" style="color: #64748b; font-size: 0.85rem; font-weight: 600; text-transform: uppercase;">Pending New</div>
                    <div class="stat-value" style="font-size: 2rem; font-weight: 800; color: #ef4444; margin-top: 5px;"><?= $pending_inquiries_count ?></div>
                </div>
                <div style="width: 48px; height: 48px; border-radius: 50%; background: #fee2e2; color: #ef4444; display: flex; align-items: center; justify-content: center; font-size: 1.3rem;">
                    <i class="fa-solid fa-bell"></i>
                </div>
            </div>
            <a href="<?= base_url('admin/inquiries') ?>" style="display: inline-block; margin-top: 10px; font-size: 0.825rem; color: #ef4444; font-weight: 600; text-decoration: none;">Respond Now &rarr;</a>
        </div>
    </div>

    <!-- Quick Actions Header & Buttons -->
    <div style="margin-bottom: 30px;">
        <h3 style="margin-bottom: 15px; color: #1e293b; font-size: 1.1rem;"><i class="fa-solid fa-bolt" style="color: #f59e0b;"></i> Quick Operational Actions</h3>
        <div style="display: flex; flex-wrap: wrap; gap: 12px;">
            <a href="<?= base_url('admin/tours/create') ?>" style="padding: 10px 18px; background: #004080; color: white; border-radius: 6px; text-decoration: none; font-weight: 600; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 8px;">
                <i class="fa-solid fa-plus"></i> Add Tour Package
            </a>
            <a href="<?= base_url('admin/destinations/create') ?>" style="padding: 10px 18px; background: #0284c7; color: white; border-radius: 6px; text-decoration: none; font-weight: 600; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 8px;">
                <i class="fa-solid fa-plus"></i> Add Destination
            </a>
            <a href="<?= base_url('admin/experiences/create') ?>" style="padding: 10px 18px; background: #8b5cf6; color: white; border-radius: 6px; text-decoration: none; font-weight: 600; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 8px;">
                <i class="fa-solid fa-plus"></i> Add Experience
            </a>
            <a href="<?= base_url('admin/gallery') ?>" style="padding: 10px 18px; background: #f59e0b; color: white; border-radius: 6px; text-decoration: none; font-weight: 600; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 8px;">
                <i class="fa-solid fa-upload"></i> Upload Gallery Image
            </a>
            <a href="<?= base_url('admin/settings') ?>" style="padding: 10px 18px; background: #475569; color: white; border-radius: 6px; text-decoration: none; font-weight: 600; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 8px;">
                <i class="fa-solid fa-gear"></i> System Settings
            </a>
        </div>
    </div>

    <!-- Recent Web Inquiries -->
    <div class="recent-inquiries-card" style="background: #ffffff; padding: 25px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
            <h3 style="margin: 0; color: #1e293b; font-size: 1.1rem;"><i class="fa-solid fa-clock-rotate-left" style="color: #004080;"></i> Recent Customer Inquiries</h3>
            <a href="<?= base_url('admin/inquiries') ?>" style="color: #004080; font-weight: 600; text-decoration: none; font-size: 0.9rem;">View All (<?= $inquiries_count ?>) &rarr;</a>
        </div>

        <?php if (empty($recent_inquiries)): ?>
            <p class="text-muted">No customer web inquiries recorded yet.</p>
        <?php else: ?>
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; text-align: left;">
                    <thead>
                        <tr style="border-bottom: 2px solid #e2e8f0; color: #64748b; font-size: 0.85rem; text-transform: uppercase;">
                            <th style="padding: 12px 10px;">ID</th>
                            <th style="padding: 12px 10px;">Date</th>
                            <th style="padding: 12px 10px;">Name</th>
                            <th style="padding: 12px 10px;">Email</th>
                            <th style="padding: 12px 10px;">Tour Requested</th>
                            <th style="padding: 12px 10px;">Status</th>
                            <th style="padding: 12px 10px; text-align: right;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($recent_inquiries as $inquiry): ?>
                            <tr style="border-bottom: 1px solid #f1f5f9;">
                                <td style="padding: 12px 10px; font-weight: 600; color: #475569;">#<?= $inquiry['id'] ?></td>
                                <td style="padding: 12px 10px; color: #64748b; font-size: 0.9rem;"><?= format_date($inquiry['created_at']) ?></td>
                                <td style="padding: 12px 10px; font-weight: 600; color: #0f172a;"><?= e($inquiry['name']) ?></td>
                                <td style="padding: 12px 10px; color: #334155;"><?= e($inquiry['email']) ?></td>
                                <td style="padding: 12px 10px; color: #64748b; font-size: 0.9rem;"><?= e($inquiry['tour_title'] ?? 'General Inquiry') ?></td>
                                <td style="padding: 12px 10px;">
                                    <?php 
                                        $badgeBg = '#e2e8f0'; $badgeColor = '#334155';
                                        if ($inquiry['status'] === 'NEW') { $badgeBg = '#fee2e2'; $badgeColor = '#991b1b'; }
                                        elseif ($inquiry['status'] === 'CONTACTED') { $badgeBg = '#dbeafe'; $badgeColor = '#1e40af'; }
                                        elseif ($inquiry['status'] === 'IN_PROGRESS') { $badgeBg = '#fef3c7'; $badgeColor = '#92400e'; }
                                        elseif ($inquiry['status'] === 'CLOSED') { $badgeBg = '#d1fae5'; $badgeColor = '#065f46'; }
                                    ?>
                                    <span style="padding: 4px 10px; border-radius: 12px; font-size: 0.75rem; font-weight: 700; background: <?= $badgeBg ?>; color: <?= $badgeColor ?>;">
                                        <?= e($inquiry['status']) ?>
                                    </span>
                                </td>
                                <td style="padding: 12px 10px; text-align: right;">
                                    <a href="<?= base_url('admin/inquiries/show/' . $inquiry['id']) ?>" class="btn btn-sm" style="padding: 5px 12px; background: #004080; color: white; text-decoration: none; border-radius: 4px; font-size: 0.8rem; font-weight: 600;">
                                        View Details
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php render_partial('admin-footer'); ?>
