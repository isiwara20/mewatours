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
     * Build beautifully formatted & well-organized tour package inquiry message
     */
    public function buildTourInquiryMessage(
        string $tourTitle,
        string $duration,
        ?string $tourType = null,
        ?string $route = null,
        ?string $name = null,
        ?string $travelDate = null,
        ?int $travellers = null,
        ?string $customNotes = null
    ): string {
        $lines = [
            "🌴 *MEWA TOURS - SRI LANKA TOUR INQUIRY* 🌴",
            "----------------------------------------",
            "👋 *Hello Mewa Tours Team!*",
            "",
            "I am interested in booking / inquiring about this tour package:",
            "",
            "📌 *Package:* " . trim($tourTitle),
            "⏱️ *Duration:* " . trim($duration)
        ];

        if (!empty($tourType)) {
            $lines[] = "🏷️ *Tour Style:* " . trim($tourType);
        }

        if (!empty($route)) {
            $lines[] = "🗺️ *Travel Route:* " . trim($route);
        }

        if (!empty($name) || !empty($travelDate) || !empty($travellers)) {
            $lines[] = "";
            $lines[] = "----------------------------------------";
            $lines[] = "✈️ *GUEST & TRAVEL DETAILS:*";
            if (!empty($name)) $lines[] = "👤 *Name:* " . trim($name);
            if (!empty($travelDate)) $lines[] = "📅 *Travel Date:* " . trim($travelDate);
            if (!empty($travellers)) $lines[] = "👥 *Travelers:* " . (int)$travellers . " Guests";
        }

        if (!empty($customNotes)) {
            $lines[] = "";
            $lines[] = "💬 *Additional Notes:*";
            $lines[] = trim($customNotes);
        }

        $lines[] = "";
        $lines[] = "----------------------------------------";
        $lines[] = "Could you please share availability, price details, and itinerary customization options?";
        $lines[] = "";
        $lines[] = "Thank you so much! 🙏";

        return implode("\n", $lines);
    }

    /**
     * Build beautifully formatted & well-organized general inquiry message
     */
    public function buildGeneralInquiryMessage(?string $name = null, ?string $customMessage = null): string
    {
        $lines = [
            "🌴 *MEWA TOURS - SRI LANKA TRAVEL INQUIRY* 🌴",
            "----------------------------------------",
            "👋 *Hello Mewa Tours Team!*",
            "",
            "I am planning a trip to Sri Lanka and would like to get more information about your private tour packages, chauffeur services, and custom travel itineraries."
        ];

        if (!empty($name) || !empty($customMessage)) {
            $lines[] = "";
            $lines[] = "----------------------------------------";
            if (!empty($name)) $lines[] = "👤 *Name:* " . trim($name);
            if (!empty($customMessage)) {
                $lines[] = "💬 *My Inquiry:*";
                $lines[] = trim($customMessage);
            }
        }

        $lines[] = "";
        $lines[] = "----------------------------------------";
        $lines[] = "Could you please assist me with recommended travel routes and options?";
        $lines[] = "";
        $lines[] = "Thank you! 🙏";

        return implode("\n", $lines);
    }

    /**
     * Build pre-filled custom itinerary request message text
     */
    public function buildCustomTripInquiryMessage(
        ?string $name = null,
        ?string $travelDate = null,
        ?string $duration = null,
        ?int $travellers = null,
        ?string $interests = null
    ): string {
        $lines = [
            "🌴 *MEWA TOURS - TAILOR-MADE JOURNEY REQUEST* 🌴",
            "----------------------------------------",
            "👋 *Hello Mewa Tours Team!*",
            "",
            "I would like to create a custom tailor-made tour itinerary in Sri Lanka.",
            "",
            "----------------------------------------",
            "📋 *TRIP DETAILS:*"
        ];

        if (!empty($name)) $lines[] = "👤 *Name:* " . trim($name);
        if (!empty($travelDate)) $lines[] = "📅 *Travel Date:* " . trim($travelDate);
        if (!empty($duration)) $lines[] = "⏱️ *Duration:* " . trim($duration) . " Days";
        if (!empty($travellers)) $lines[] = "👥 *Travelers:* " . (int)$travellers . " Guests";
        if (!empty($interests)) {
            $lines[] = "";
            $lines[] = "📍 *Interests & Destinations:*";
            $lines[] = trim($interests);
        }

        $lines[] = "";
        $lines[] = "----------------------------------------";
        $lines[] = "Please help me plan an ideal route and provide a quotation.";
        $lines[] = "";
        $lines[] = "Thank you! 🙏";

        return implode("\n", $lines);
    }

    /**
     * Build pre-filled destination inquiry message text
     */
    public function buildDestinationInquiryMessage(string $destinationName): string
    {
        $lines = [
            "🌴 *MEWA TOURS - DESTINATION INQUIRY* 🌴",
            "----------------------------------------",
            "👋 *Hello Mewa Tours Team!*",
            "",
            "I am interested in visiting *" . trim($destinationName) . "* during my Sri Lanka trip.",
            "",
            "----------------------------------------",
            "Could you please share tour package recommendations and custom itineraries that include " . trim($destinationName) . "?",
            "",
            "Thank you so much! 🙏"
        ];

        return implode("\n", $lines);
    }

    /**
     * Build pre-filled experience inquiry message text
     */
    public function buildExperienceInquiryMessage(string $experienceName): string
    {
        $lines = [
            "🌴 *MEWA TOURS - ISLAND EXPERIENCE INQUIRY* 🌴",
            "----------------------------------------",
            "👋 *Hello Mewa Tours Team!*",
            "",
            "I am interested in experiencing *" . trim($experienceName) . "* in Sri Lanka.",
            "",
            "----------------------------------------",
            "Could you please recommend an itinerary or day trip package that includes this experience?",
            "",
            "Thank you so much! 🙏"
        ];

        return implode("\n", $lines);
    }
}
