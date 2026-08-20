/**
 * Mewa Tours - WhatsApp Deep Link Helper
 * 
 * Note: WhatsApp links open pre-filled messages directly in the user's WhatsApp client.
 */
document.addEventListener('DOMContentLoaded', () => {
    const waButtons = document.querySelectorAll('.btn-whatsapp, .whatsapp-float-btn');
    waButtons.forEach(btn => {
        btn.addEventListener('click', (e) => {
            console.log('Opening WhatsApp pre-filled inquiry window...');
        });
    });
});
