<?php render_partial('header', ['page_title' => 'Mewa Tours - Project Foundation Ready']); ?>

<section class="foundation-hero text-center" style="padding: 60px 20px; background: #f8fafc; border-radius: 12px; margin: 40px 0;">
    <h1 style="color: #004080; font-size: 2.2rem; margin-bottom: 15px; font-weight: 700;">Mewa Tours</h1>
    <p style="font-size: 1.2rem; color: #475569; margin-bottom: 25px;">Project Foundation & N-Tier Architecture Ready</p>

    <div style="max-width: 650px; margin: 0 auto; text-align: left; background: #ffffff; padding: 25px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">
        <h3 style="color: #004080; border-bottom: 2px solid #e2e8f0; padding-bottom: 10px; margin-bottom: 15px;">Architectural Status Summary</h3>
        <ul style="list-style: none; padding: 0; line-height: 2;">
            <li><i class="fa-solid fa-circle-check" style="color: #10b981;"></i> <strong>Architecture:</strong> Strict N-Tier MVC (Presentation &rarr; Controller &rarr; BLL &rarr; DAL &rarr; Database)</li>
            <li><i class="fa-solid fa-circle-check" style="color: #10b981;"></i> <strong>Database:</strong> PDO Prepared Statements (Zero mysqli / concatenation)</li>
            <li><i class="fa-solid fa-circle-check" style="color: #10b981;"></i> <strong>Clean Routing:</strong> Apache mod_rewrite enabled (`.htaccess`)</li>
            <li><i class="fa-solid fa-circle-check" style="color: #10b981;"></i> <strong>Security:</strong> CSRF protection, output escaping helper `e()`, secure sessions</li>
            <li><i class="fa-solid fa-circle-check" style="color: #10b981;"></i> <strong>Inquiry System:</strong> WhatsApp deep links &amp; email inquiry foundation</li>
            <li><i class="fa-solid fa-circle-check" style="color: #10b981;"></i> <strong>Admin Auth:</strong> Private route direct login (`/login`)</li>
        </ul>
    </div>
</section>

<?php render_partial('footer'); ?>
