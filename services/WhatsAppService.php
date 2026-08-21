<?php
declare(strict_types=1);

/**
 * Mewa Tours - WhatsApp Deep Link Service
 * 
 * IMPORTANT: This service only generates safe, pre-filled WhatsApp deep links.
 * It DOES NOT automatically send messages. The user manually clicks send in their WhatsApp app.
 */
class WhatsAppService
{
    private string $phoneNumber;

    public function __construct(?string $customNumber = null)
    {
        if ($customNumber !== null) {
            $this->phoneNumber = $this->normalizePhoneNumber($customNumber);
        } else {
            $config = require ROOT_PATH . '/config/app.php';
            $this->phoneNumber = $this->normalizePhoneNumber($config['whatsapp']['number'] ?? '94769695024');
        }
    }

    /**
     * Strip spaces, hyphens, plus signs, and leading zeros to conform with wa.me standards
     */
    public function normalizePhoneNumber(string $number): string
    {
        $digits = preg_replace('/[^0-9]/', '', $number);
        // If leading 0 for Sri Lanka local number (e.g. 0771234567), replace 0 with 94
        if (strpos($digits, '0') === 0 && strlen($digits) === 10) {
            $digits = '94' . substr($digits, 1);
        }
        return $digits;
    }

    /**
     * Generate full WhatsApp link with pre-filled encoded text message
     */
    public function generateInquiryLink(string $message): string
    {
        return sprintf(
            'https://wa.me/%s?text=%s',
            $this->phoneNumber,
            rawurlencode(trim($message))
        );
    }

    /**
     * Build pre-filled tour inquiry message text
     */
    public function buildTourInquiryMessage(
        string $tourTitle,
        string $duration,
        ?string $tourType = null,
        ?string $route = null,
        ?string $name = null,
        ?string $travelDate = null,
        ?int $travellers = null
    ): string {
        $lines = [
            "Hello Mewa Tours,",
            "",
            "I'm interested in the " . $tourTitle . ".",
            "",
            "Duration: " . $duration
        ];

        if (!empty($tourType)) {
            $lines[] = "Tour Type: " . $tourType;
        }

        if (!empty($route)) {
            $lines[] = "";
            $lines[] = "Route:";
            $lines[] = $route;
        }

        if (!empty($name) || !empty($travelDate) || !empty($travellers)) {
            $lines[] = "";
            if (!empty($name)) $lines[] = "Name: " . $name;
            if (!empty($travelDate)) $lines[] = "Travel Date: " . $travelDate;
            if (!empty($travellers)) $lines[] = "Number of Travellers: " . $travellers;
        }

        $lines[] = "";
        $lines[] = "Could you please send me more information about this tour?";
        $lines[] = "";
        $lines[] = "Thank you.";

        return implode("\n", $lines);
    }

    /**
     * Build pre-filled general inquiry message text
     */
    public function buildGeneralInquiryMessage(?string $name = null, ?string $customMessage = null): string
    {
        $lines = [
            "Hello Mewa Tours,",
            "",
            "I have an inquiry regarding travel in Sri Lanka.",
            "Name: " . ($name ?? ''),
            "Message: " . ($customMessage ?? ''),
            "",
            "Please get back to me. Thank you!"
        ];

        return implode("\n", $lines);
    }
}
