<?php 
render_partial('admin-header', [
    'page_title' => 'Edit About Us Page - Admin Portal'
]); 

function resolve_about_thumb(string $path): string {
    if (empty($path)) {
        return asset_url('images/tours/hero-tours-ella.jpg');
    }
    if (strpos($path, 'http://') === 0 || strpos($path, 'https://') === 0) {
        return $path;
    }
    if (strpos($path, 'images/') === 0) {
        return asset_url($path);
    }
    return asset_url('images/' . $path);
}
?>

<div class="admin-page-header" style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 15px; margin-bottom: 25px;">
    <div>
        <h2 style="color: #0f172a; margin: 0; font-size: 1.6rem; font-weight: 800;">
            <i class="fa-solid fa-circle-info" style="color: #0284c7; margin-right: 8px;"></i> Edit About Us Page
        </h2>
        <p class="text-muted" style="margin: 6px 0 0 0; font-size: 0.95rem;">
            Manage the public story, founder details, company promises, statistics, and call-to-actions.
        </p>
    </div>
    <div style="display: flex; gap: 10px; align-items: center;">
        <a href="<?= base_url('about') ?>" target="_blank" rel="noopener noreferrer" class="btn" style="background: #ffffff; color: #0284c7; border: 1.5px solid #0284c7; padding: 10px 18px; border-radius: 8px; font-weight: 700; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 8px; text-decoration: none;">
            <i class="fa-solid fa-arrow-up-right-from-square"></i> View Live Page
        </a>
    </div>
</div>

<?php render_partial('flash-messages'); ?>

<form method="POST" action="<?= base_url('admin/about') ?>" enctype="multipart/form-data" id="aboutEditForm">
    <input type="hidden" name="csrf_token" value="<?= CsrfService::generateToken() ?>">

    <!-- Navigation Tabs Bar -->
    <div class="about-nav-tabs" style="display: flex; gap: 8px; flex-wrap: wrap; background: #f8fafc; padding: 10px; border-radius: 12px; border: 1px solid #e2e8f0; margin-bottom: 25px;">
        <button type="button" class="tab-btn active" data-tab="tab-hero">
            <i class="fa-solid fa-image"></i> 1. Hero Section
        </button>
        <button type="button" class="tab-btn" data-tab="tab-founder">
            <i class="fa-solid fa-user-tie"></i> 2. Founder Spotlight
        </button>
        <button type="button" class="tab-btn" data-tab="tab-values">
            <i class="fa-solid fa-shield-heart"></i> 3. Why Travel With Us
        </button>
        <button type="button" class="tab-btn" data-tab="tab-stats">
            <i class="fa-solid fa-chart-simple"></i> 4. Statistics Counter
        </button>
        <button type="button" class="tab-btn" data-tab="tab-cta">
            <i class="fa-solid fa-bullhorn"></i> 5. Bottom CTA Banner
        </button>
        <button type="button" class="tab-btn" data-tab="tab-seo">
            <i class="fa-solid fa-magnifying-glass"></i> 6. SEO & Meta
        </button>
    </div>

    <!-- =====================================================================
         TAB 1: HERO BANNER SECTION
         ===================================================================== -->
    <div class="tab-pane active" id="tab-hero">
        <div class="form-card">
            <div class="form-card-header">
                <h3><i class="fa-solid fa-image" style="color: #0284c7;"></i> Hero Banner Section</h3>
                <p>The top opening banner greeting visitors on the About Us page.</p>
            </div>

            <div class="form-group">
                <label class="form-label">Eyebrow Tag / Sub-header</label>
                <input type="text" name="about_hero_eyebrow" class="form-control" value="<?= e($about['about_hero_eyebrow'] ?? 'DISCOVER OUR STORY') ?>" placeholder="DISCOVER OUR STORY" required>
                <small class="form-hint">Appears in small uppercase letters above the main title.</small>
            </div>

            <div class="form-group">
                <label class="form-label">Hero Main Title</label>
                <input type="text" name="about_hero_title" class="form-control" value="<?= e($about['about_hero_title'] ?? '') ?>" placeholder="Authentic Sri Lankan Hospitality & Custom Private Journeys" required>
            </div>

            <div class="form-group">
                <label class="form-label">Hero Subtitle / Introductory Paragraph</label>
                <textarea name="about_hero_subtitle" rows="3" class="form-control" required placeholder="Describe Mewa Tours core philosophy..."><?= e($about['about_hero_subtitle'] ?? '') ?></textarea>
            </div>

            <div class="form-group">
                <label class="form-label">Hero Background Image</label>
                <div class="image-uploader-box">
                    <div class="image-preview-wrap">
                        <img src="<?= e(resolve_about_thumb($about['about_hero_image'] ?? '')) ?>" id="heroImagePreview" alt="Hero Preview" class="admin-thumb-img">
                    </div>
                    <div class="image-uploader-controls">
                        <input type="hidden" name="about_hero_image" value="<?= e($about['about_hero_image'] ?? '') ?>">
                        <input type="file" name="hero_image_file" id="heroFileInput" accept="image/jpeg,image/png,image/webp" class="file-input-control">
                        <p class="form-hint" style="margin-top: 8px;">Upload a high-quality landscape photo (recommended: 1920x800px, max 10MB). Leave empty to keep existing image.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- =====================================================================
         TAB 2: FOUNDER & LEADERSHIP SPOTLIGHT
         ===================================================================== -->
    <div class="tab-pane" id="tab-founder">
        <div class="form-card">
            <div class="form-card-header">
                <h3><i class="fa-solid fa-user-tie" style="color: #0284c7;"></i> Founder & Leadership Spotlight</h3>
                <p>Personal brand and story of Mewan Manju Sri Kandearachchi.</p>
            </div>

            <div class="form-grid-2">
                <div class="form-group">
                    <label class="form-label">Founder Full Name</label>
                    <input type="text" name="about_founder_name" class="form-control" value="<?= e($about['about_founder_name'] ?? '') ?>" required placeholder="Mewan Manju Sri Kandearachchi">
                </div>
                <div class="form-group">
                    <label class="form-label">Official Title / Role</label>
                    <input type="text" name="about_founder_role" class="form-control" value="<?= e($about['about_founder_role'] ?? '') ?>" required placeholder="Founder & Managing Director, Mewa Tours Sri Lanka">
                </div>
            </div>



            <div class="form-group">
                <label class="form-label">Founder Personal Portrait Photo</label>
                <div class="image-uploader-box">
                    <div class="image-preview-wrap">
                        <img src="<?= e(resolve_about_thumb($about['about_founder_image'] ?? '')) ?>" id="founderImagePreview" alt="Founder Preview" class="admin-thumb-img" style="aspect-ratio: 4/5; object-fit: cover;">
                    </div>
                    <div class="image-uploader-controls">
                        <input type="hidden" name="about_founder_image" value="<?= e($about['about_founder_image'] ?? '') ?>">
                        <input type="file" name="founder_image_file" id="founderFileInput" accept="image/jpeg,image/png,image/webp" class="file-input-control">
                        <p class="form-hint" style="margin-top: 8px;">Recommended: High-resolution portrait orientation image. Leave empty to keep existing photo.</p>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Featured Quote</label>
                <textarea name="about_founder_quote" rows="2" class="form-control" required placeholder="Inspirational quote from the founder..."><?= e($about['about_founder_quote'] ?? '') ?></textarea>
                <small class="form-hint">Displayed in large italic quotation box next to the portrait.</small>
            </div>

            <div class="form-group">
                <label class="form-label">Story Paragraph 1 (Welcome & Passion)</label>
                <textarea name="about_founder_bio_1" rows="3" class="form-control" required><?= e($about['about_founder_bio_1'] ?? '') ?></textarea>
            </div>

            <div class="form-group">
                <label class="form-label">Story Paragraph 2 (100% Private Itineraries)</label>
                <textarea name="about_founder_bio_2" rows="3" class="form-control" required><?= e($about['about_founder_bio_2'] ?? '') ?></textarea>
            </div>

            <div class="form-group">
                <label class="form-label">Story Paragraph 3 (Personal Commitment)</label>
                <textarea name="about_founder_bio_3" rows="3" class="form-control" required><?= e($about['about_founder_bio_3'] ?? '') ?></textarea>
            </div>
        </div>
    </div>


    <!-- =====================================================================
         TAB 3: CORE VALUES / WHY CHOOSE US
         ===================================================================== -->
    <div class="tab-pane" id="tab-values">
        <div class="form-card">
            <div class="form-card-header">
                <h3><i class="fa-solid fa-shield-heart" style="color: #0284c7;"></i> Core Values ("The Mewa Tours Promise")</h3>
                <p>The 4 primary value propositions shown on the About Us page.</p>
            </div>

            <div class="form-grid-2">
                <div class="form-group">
                    <label class="form-label">Section Eyebrow</label>
                    <input type="text" name="about_values_eyebrow" class="form-control" value="<?= e($about['about_values_eyebrow'] ?? 'WHY TRAVEL WITH US') ?>" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Section Title</label>
                    <input type="text" name="about_values_title" class="form-control" value="<?= e($about['about_values_title'] ?? 'The Mewa Tours Promise') ?>" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Section Subtitle / Description</label>
                <input type="text" name="about_values_subtitle" class="form-control" value="<?= e($about['about_values_subtitle'] ?? '') ?>" required>
            </div>

            <hr style="border: 0; border-top: 1px solid #e2e8f0; margin: 25px 0;">

            <div class="values-cards-admin-grid">
                <!-- Value 1 -->
                <div class="value-admin-item">
                    <span class="value-item-badge">Value 1</span>
                    <div class="form-group" style="margin-top: 10px;">
                        <label class="form-label">FontAwesome Icon Class</label>
                        <input type="text" name="about_val1_icon" class="form-control icon-input" value="<?= e($about['about_val1_icon'] ?? 'fa-user-shield') ?>" placeholder="fa-user-shield" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Title</label>
                        <input type="text" name="about_val1_title" class="form-control" value="<?= e($about['about_val1_title'] ?? '100% Private Tours') ?>" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Description</label>
                        <textarea name="about_val1_desc" rows="3" class="form-control" required><?= e($about['about_val1_desc'] ?? '') ?></textarea>
                    </div>
                </div>

                <!-- Value 2 -->
                <div class="value-admin-item">
                    <span class="value-item-badge">Value 2</span>
                    <div class="form-group" style="margin-top: 10px;">
                        <label class="form-label">FontAwesome Icon Class</label>
                        <input type="text" name="about_val2_icon" class="form-control icon-input" value="<?= e($about['about_val2_icon'] ?? 'fa-car-side') ?>" placeholder="fa-car-side" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Title</label>
                        <input type="text" name="about_val2_title" class="form-control" value="<?= e($about['about_val2_title'] ?? 'Luxury Private Fleet') ?>" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Description</label>
                        <textarea name="about_val2_desc" rows="3" class="form-control" required><?= e($about['about_val2_desc'] ?? '') ?></textarea>
                    </div>
                </div>

                <!-- Value 3 -->
                <div class="value-admin-item">
                    <span class="value-item-badge">Value 3</span>
                    <div class="form-group" style="margin-top: 10px;">
                        <label class="form-label">FontAwesome Icon Class</label>
                        <input type="text" name="about_val3_icon" class="form-control icon-input" value="<?= e($about['about_val3_icon'] ?? 'fa-hand-holding-heart') ?>" placeholder="fa-hand-holding-heart" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Title</label>
                        <input type="text" name="about_val3_title" class="form-control" value="<?= e($about['about_val3_title'] ?? 'Authentic Local Insights') ?>" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Description</label>
                        <textarea name="about_val3_desc" rows="3" class="form-control" required><?= e($about['about_val3_desc'] ?? '') ?></textarea>
                    </div>
                </div>

                <!-- Value 4 -->
                <div class="value-admin-item">
                    <span class="value-item-badge">Value 4</span>
                    <div class="form-group" style="margin-top: 10px;">
                        <label class="form-label">FontAwesome Icon Class</label>
                        <input type="text" name="about_val4_icon" class="form-control icon-input" value="<?= e($about['about_val4_icon'] ?? 'fa-headset') ?>" placeholder="fa-headset" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Title</label>
                        <input type="text" name="about_val4_title" class="form-control" value="<?= e($about['about_val4_title'] ?? '24/7 Personal Support') ?>" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Description</label>
                        <textarea name="about_val4_desc" rows="3" class="form-control" required><?= e($about['about_val4_desc'] ?? '') ?></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- =====================================================================
         TAB 4: STATISTICS COUNTER
         ===================================================================== -->
    <div class="tab-pane" id="tab-stats">
        <div class="form-card">
            <div class="form-card-header">
                <h3><i class="fa-solid fa-chart-simple" style="color: #0284c7;"></i> Statistics Counter Section</h3>
                <p>Key milestone metrics and numbers to build trust with travelers.</p>
            </div>

            <div class="stats-admin-grid">
                <!-- Stat 1 -->
                <div class="stat-admin-box">
                    <span class="stat-index-badge">Metric 1</span>
                    <div class="form-group" style="margin-top: 10px;">
                        <label class="form-label">Number / Statistic</label>
                        <input type="text" name="about_stat1_num" class="form-control stat-num-input" value="<?= e($about['about_stat1_num'] ?? '10+') ?>" placeholder="10+" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Label Description</label>
                        <input type="text" name="about_stat1_label" class="form-control" value="<?= e($about['about_stat1_label'] ?? 'Years Tourism Experience') ?>" placeholder="Years Tourism Experience" required>
                    </div>
                </div>

                <!-- Stat 2 -->
                <div class="stat-admin-box">
                    <span class="stat-index-badge">Metric 2</span>
                    <div class="form-group" style="margin-top: 10px;">
                        <label class="form-label">Number / Statistic</label>
                        <input type="text" name="about_stat2_num" class="form-control stat-num-input" value="<?= e($about['about_stat2_num'] ?? '1,500+') ?>" placeholder="1,500+" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Label Description</label>
                        <input type="text" name="about_stat2_label" class="form-control" value="<?= e($about['about_stat2_label'] ?? 'Happy Private Travelers') ?>" placeholder="Happy Private Travelers" required>
                    </div>
                </div>

                <!-- Stat 3 -->
                <div class="stat-admin-box">
                    <span class="stat-index-badge">Metric 3</span>
                    <div class="form-group" style="margin-top: 10px;">
                        <label class="form-label">Number / Statistic</label>
                        <input type="text" name="about_stat3_num" class="form-control stat-num-input" value="<?= e($about['about_stat3_num'] ?? '100%') ?>" placeholder="100%" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Label Description</label>
                        <input type="text" name="about_stat3_label" class="form-control" value="<?= e($about['about_stat3_label'] ?? 'Custom Tailored Itineraries') ?>" placeholder="Custom Tailored Itineraries" required>
                    </div>
                </div>

                <!-- Stat 4 -->
                <div class="stat-admin-box">
                    <span class="stat-index-badge">Metric 4</span>
                    <div class="form-group" style="margin-top: 10px;">
                        <label class="form-label">Number / Statistic</label>
                        <input type="text" name="about_stat4_num" class="form-control stat-num-input" value="<?= e($about['about_stat4_num'] ?? '4.9 / 5') ?>" placeholder="4.9 / 5" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Label Description</label>
                        <input type="text" name="about_stat4_label" class="form-control" value="<?= e($about['about_stat4_label'] ?? 'Guest Rating Score') ?>" placeholder="Guest Rating Score" required>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- =====================================================================
         TAB 5: STORY BANNER & CTA
         ===================================================================== -->
    <div class="tab-pane" id="tab-cta">
        <div class="form-card">
            <div class="form-card-header">
                <h3><i class="fa-solid fa-bullhorn" style="color: #0284c7;"></i> Story Banner & Bottom CTA</h3>
                <p>The closing high-impact banner inviting customers to plan a journey.</p>
            </div>

            <div class="form-group">
                <label class="form-label">Eyebrow Tag</label>
                <input type="text" name="about_cta_eyebrow" class="form-control" value="<?= e($about['about_cta_eyebrow'] ?? 'YOUR JOURNEY AWAITS') ?>" required placeholder="YOUR JOURNEY AWAITS">
            </div>

            <div class="form-group">
                <label class="form-label">Call-to-Action Headline</label>
                <input type="text" name="about_cta_title" class="form-control" value="<?= e($about['about_cta_title'] ?? 'Let Us Craft Your Dream Sri Lankan Experience') ?>" required placeholder="Let Us Craft Your Dream Sri Lankan Experience">
            </div>

            <div class="form-group">
                <label class="form-label">Paragraph Text</label>
                <textarea name="about_cta_text" rows="3" class="form-control" required placeholder="From the moment you touch down..."><?= e($about['about_cta_text'] ?? '') ?></textarea>
            </div>

            <div class="form-group">
                <label class="form-label">CTA Banner Background Image</label>
                <div class="image-uploader-box">
                    <div class="image-preview-wrap">
                        <img src="<?= e(resolve_about_thumb($about['about_cta_image'] ?? '')) ?>" id="ctaImagePreview" alt="CTA Preview" class="admin-thumb-img">
                    </div>
                    <div class="image-uploader-controls">
                        <input type="hidden" name="about_cta_image" value="<?= e($about['about_cta_image'] ?? '') ?>">
                        <input type="file" name="cta_image_file" id="ctaFileInput" accept="image/jpeg,image/png,image/webp" class="file-input-control">
                        <p class="form-hint" style="margin-top: 8px;">Upload a scenic background photo (recommended: 1920x800px). Leave empty to keep existing image.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- =====================================================================
         TAB 6: SEO SETTINGS
         ===================================================================== -->
    <div class="tab-pane" id="tab-seo">
        <div class="form-card">
            <div class="form-card-header">
                <h3><i class="fa-solid fa-magnifying-glass" style="color: #0284c7;"></i> Search Engine Optimization (SEO)</h3>
                <p>Customize how the About Us page appears on Google search results and social media shares.</p>
            </div>

            <div class="form-group">
                <label class="form-label">Page Title (&lt;title&gt; Tag)</label>
                <input type="text" name="about_meta_title" class="form-control" value="<?= e($about['about_meta_title'] ?? '') ?>" required placeholder="About Us - Mewan Manju Sri Kandearachchi | Mewa Tours Sri Lanka">
                <small class="form-hint">Shown in browser tabs and search engine headlines.</small>
            </div>

            <div class="form-group">
                <label class="form-label">Meta Description</label>
                <textarea name="about_meta_description" rows="3" class="form-control" required placeholder="Compelling 150-160 character summary of the page..."><?= e($about['about_meta_description'] ?? '') ?></textarea>
                <small class="form-hint">Brief summary shown below the title link in Google search results.</small>
            </div>
        </div>
    </div>

    <!-- Sticky Save Bar -->
    <div class="sticky-save-bar">
        <div style="display: flex; align-items: center; gap: 10px;">
            <i class="fa-solid fa-cloud-arrow-up" style="color: #0284c7; font-size: 1.2rem;"></i>
            <span style="font-size: 0.95rem; font-weight: 600; color: #1e293b;">Ready to publish your About Us updates?</span>
        </div>
        <button type="submit" class="btn btn-save-primary" id="saveAboutBtn">
            <i class="fa-solid fa-check"></i> Save About Us Page
        </button>
    </div>
</form>

<style>
/* ---- Tab Buttons ---- */
.tab-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 18px;
    border: none;
    background: transparent;
    color: #64748b;
    font-weight: 700;
    font-size: 0.88rem;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.2s ease;
}
.tab-btn:hover {
    background: #e2e8f0;
    color: #0f172a;
}
.tab-btn.active {
    background: #0284c7;
    color: #ffffff;
    box-shadow: 0 4px 12px rgba(2, 132, 199, 0.25);
}

/* ---- Tab Panes ---- */
.tab-pane {
    display: none;
}
.tab-pane.active {
    display: block;
    animation: fadeInTab 0.25s ease-in-out;
}
@keyframes fadeInTab {
    from { opacity: 0; transform: translateY(6px); }
    to { opacity: 1; transform: translateY(0); }
}

/* ---- Form Card Containers ---- */
.form-card {
    background: #ffffff;
    border-radius: 14px;
    border: 1px solid #e2e8f0;
    box-shadow: 0 4px 18px rgba(15, 23, 42, 0.04);
    padding: 30px;
    margin-bottom: 25px;
}
.form-card-header {
    margin-bottom: 24px;
    padding-bottom: 16px;
    border-bottom: 1px solid #f1f5f9;
}
.form-card-header h3 {
    margin: 0 0 6px 0;
    font-size: 1.25rem;
    color: #0f172a;
    font-weight: 700;
}
.form-card-header p {
    margin: 0;
    color: #64748b;
    font-size: 0.9rem;
}

/* ---- Form Controls ---- */
.form-group {
    margin-bottom: 20px;
}
.form-label {
    display: block;
    font-weight: 700;
    color: #1e293b;
    font-size: 0.9rem;
    margin-bottom: 7px;
}
.form-control {
    width: 100%;
    padding: 11px 14px;
    border: 1.5px solid #cbd5e1;
    border-radius: 8px;
    font-size: 0.95rem;
    font-family: inherit;
    color: #0f172a;
    transition: border-color 0.2s, box-shadow 0.2s;
    background: #ffffff;
    box-sizing: border-box;
}
.form-control:focus {
    outline: none;
    border-color: #0284c7;
    box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.15);
}
.form-hint {
    color: #64748b;
    font-size: 0.8rem;
    margin-top: 5px;
    margin-bottom: 0;
}

/* ---- Grid Layouts ---- */
.form-grid-2 {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

/* ---- Values Grid ---- */
.values-cards-admin-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}
.value-admin-item {
    background: #f8fafc;
    border: 1.5px solid #e2e8f0;
    border-radius: 10px;
    padding: 20px;
    position: relative;
}
.value-item-badge {
    position: absolute;
    top: 12px;
    right: 12px;
    background: #e0f2fe;
    color: #0284c7;
    font-weight: 800;
    font-size: 0.75rem;
    padding: 3px 10px;
    border-radius: 50px;
}

/* ---- Stats Grid ---- */
.stats-admin-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 16px;
}
.stat-admin-box {
    background: #f8fafc;
    border: 1.5px solid #e2e8f0;
    border-radius: 10px;
    padding: 18px;
    position: relative;
}
.stat-index-badge {
    position: absolute;
    top: 10px;
    right: 10px;
    background: #e2e8f0;
    color: #475569;
    font-size: 0.72rem;
    font-weight: 800;
    padding: 2px 8px;
    border-radius: 50px;
}
.stat-num-input {
    font-size: 1.25rem;
    font-weight: 800;
    color: #0284c7;
}

/* ---- Image Uploader Box ---- */
.image-uploader-box {
    display: flex;
    gap: 20px;
    align-items: center;
    background: #f8fafc;
    border: 1.5px dashed #cbd5e1;
    border-radius: 10px;
    padding: 18px;
}
.image-preview-wrap {
    flex-shrink: 0;
}
.admin-thumb-img {
    width: 160px;
    height: 105px;
    object-fit: cover;
    border-radius: 8px;
    border: 1px solid #cbd5e1;
    background: #ffffff;
}
.image-uploader-controls {
    flex-grow: 1;
}
.file-input-control {
    font-size: 0.9rem;
    color: #475569;
}

/* ---- Sticky Save Bar ---- */
.sticky-save-bar {
    position: sticky;
    bottom: 20px;
    background: #ffffff;
    border: 1px solid #cbd5e1;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(15, 23, 42, 0.15);
    padding: 14px 24px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    z-index: 100;
    margin-top: 25px;
}
.btn-save-primary {
    background: #0284c7;
    color: #ffffff;
    border: none;
    padding: 12px 28px;
    border-radius: 8px;
    font-size: 1rem;
    font-weight: 700;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    box-shadow: 0 4px 14px rgba(2, 132, 199, 0.35);
    transition: all 0.2s;
}
.btn-save-primary:hover {
    background: #0369a1;
    transform: translateY(-1px);
}

@media (max-width: 900px) {
    .form-grid-2, .values-cards-admin-grid, .stats-admin-grid {
        grid-template-columns: 1fr;
    }
    .image-uploader-box {
        flex-direction: column;
        align-items: flex-start;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // 1. Tab switching
    const tabBtns = document.querySelectorAll('.tab-btn');
    const tabPanes = document.querySelectorAll('.tab-pane');

    tabBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const targetId = this.getAttribute('data-tab');

            tabBtns.forEach(b => b.classList.remove('active'));
            tabPanes.forEach(p => p.classList.remove('active'));

            this.classList.add('active');
            const targetPane = document.getElementById(targetId);
            if (targetPane) {
                targetPane.classList.add('active');
            }
        });
    });

    // 2. Instant image previews
    function setupImagePreview(fileInputId, previewImgId) {
        const input = document.getElementById(fileInputId);
        const preview = document.getElementById(previewImgId);
        if (!input || !preview) return;

        input.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(evt) {
                    preview.src = evt.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    }

    setupImagePreview('heroFileInput', 'heroImagePreview');
    setupImagePreview('founderFileInput', 'founderImagePreview');
    setupImagePreview('ctaFileInput', 'ctaImagePreview');
});
</script>
