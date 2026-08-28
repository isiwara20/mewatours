<?php
/**
 * Global Flash Messages & Animated PopUp Modal Component
 */
if (!empty($_SESSION['_flash']) && is_array($_SESSION['_flash'])):
    foreach ($_SESSION['_flash'] as $key => $flashData):
        $flashMessage = is_array($flashData) ? ($flashData['message'] ?? '') : (string)$flashData;
        $flashType = is_array($flashData) ? ($flashData['type'] ?? 'info') : 'info';
        
        // Consume flash key so it displays only once
        unset($_SESSION['_flash'][$key]);
        
        if (empty($flashMessage)) continue;

        $isError = in_array($flashType, ['danger', 'error']);
        $isWarning = in_array($flashType, ['warning']);
        $title = $isError ? 'Action Failed' : ($isWarning ? 'Attention Required' : 'Success!');
        $iconClass = $isError ? 'fa-solid fa-circle-xmark' : ($isWarning ? 'fa-solid fa-triangle-exclamation' : 'fa-solid fa-circle-check');
        $themeClass = $isError ? 'error' : ($isWarning ? 'warning' : 'success');
        $elementId = 'globalFlashPopup_' . preg_replace('/[^a-zA-Z0-9_]/', '_', (string)$key);
?>
    <!-- Global Animated PopUp Modal -->
    <div class="global-popup-overlay" id="<?= e($elementId) ?>" onclick="if(event.target===this) closeGlobalPopup('<?= e($elementId) ?>')">
        <div class="global-popup-card">
            <div class="global-popup-icon <?= $themeClass ?>">
                <i class="<?= $iconClass ?>"></i>
            </div>
            <h3 class="global-popup-title <?= $themeClass ?>"><?= e($title) ?></h3>
            <p class="global-popup-text">
                <?= e($flashMessage) ?>
            </p>
            <div class="global-popup-actions">
                <button type="button" class="btn-global-popup-close <?= $themeClass ?>" onclick="closeGlobalPopup('<?= e($elementId) ?>')">
                    <i class="fa-solid fa-check"></i> Continue
                </button>
            </div>
        </div>
    </div>
<?php 
    endforeach;
?>
    <style>
        .global-popup-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(14, 27, 61, 0.72);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            z-index: 999999;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            box-sizing: border-box;
            animation: popupFadeIn 0.3s ease-out forwards;
        }

        .global-popup-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 40px 35px;
            max-width: 440px;
            width: 100%;
            text-align: center;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.35);
            border: 1px solid rgba(255, 255, 255, 0.9);
            transform: scale(0.85);
            animation: popupScale 0.35s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
        }

        .global-popup-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            font-size: 2.8rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }

        .global-popup-icon.success {
            background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
            color: #166534;
            box-shadow: 0 10px 25px rgba(22, 101, 52, 0.2);
        }

        .global-popup-icon.error {
            background: linear-gradient(135deg, #fee2e2 0%, #fca5a5 100%);
            color: #991b1b;
            box-shadow: 0 10px 25px rgba(153, 27, 27, 0.22);
        }

        .global-popup-icon.warning {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
            color: #92400e;
            box-shadow: 0 10px 25px rgba(146, 64, 14, 0.2);
        }

        .global-popup-title {
            font-size: 1.55rem;
            font-weight: 800;
            margin: 0 0 10px 0;
        }

        .global-popup-title.success { color: #0f172a; }
        .global-popup-title.error { color: #991b1b; }
        .global-popup-title.warning { color: #92400e; }

        .global-popup-text {
            font-size: 0.95rem;
            color: #64748b;
            line-height: 1.6;
            margin: 0 0 25px 0;
        }

        .global-popup-actions {
            display: flex;
            gap: 12px;
            justify-content: center;
        }

        .btn-global-popup-close {
            border: none;
            padding: 14px 28px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 0.98rem;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.25s ease;
            width: 100%;
            justify-content: center;
            text-decoration: none !important;
            color: #ffffff !important;
        }

        .btn-global-popup-close.success {
            background: linear-gradient(135deg, #166534 0%, #15803d 100%);
            box-shadow: 0 6px 20px rgba(22, 101, 52, 0.35);
        }

        .btn-global-popup-close.success:hover {
            background: linear-gradient(135deg, #14532d 0%, #166534 100%);
            transform: translateY(-2px);
        }

        .btn-global-popup-close.error {
            background: linear-gradient(135deg, #dc2626 0%, #991b1b 100%);
            box-shadow: 0 6px 20px rgba(153, 27, 27, 0.35);
        }

        .btn-global-popup-close.error:hover {
            background: linear-gradient(135deg, #b91c1c 0%, #7f1d1d 100%);
            transform: translateY(-2px);
        }

        .btn-global-popup-close.warning {
            background: linear-gradient(135deg, #d97706 0%, #b45309 100%);
            box-shadow: 0 6px 20px rgba(180, 83, 9, 0.35);
        }

        .btn-global-popup-close.warning:hover {
            background: linear-gradient(135deg, #b45309 0%, #78350f 100%);
            transform: translateY(-2px);
        }

        @keyframes popupFadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes popupScale {
            from { transform: scale(0.85); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }
    </style>

    <script>
        function closeGlobalPopup(id) {
            const popup = document.getElementById(id);
            if (popup) {
                popup.style.opacity = '0';
                popup.style.transition = 'opacity 0.25s ease';
                setTimeout(function() {
                    popup.remove();
                }, 250);
            }
        }
    </script>
<?php endif; ?>
