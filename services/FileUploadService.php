<?php
declare(strict_types=1);

/**
 * Mewa Tours - Secure File Upload Service
 */
class FileUploadService
{
    private array $config;
    private LoggerService $logger;

    public function __construct()
    {
        $appConfig = require ROOT_PATH . '/config/app.php';
        $this->config = $appConfig['upload'];
        $this->logger = new LoggerService();
    }

    /**
     * Validate and upload an image file
     * 
     * @param array $file $_FILES element
     * @param string $subfolder Subfolder inside upload target (e.g. 'tours', 'destinations')
     * @return array ['success' => bool, 'filename' => string|null, 'error' => string|null]
     */
    public function uploadImage(array $file, string $subfolder = 'uploads'): array
    {
        if (!isset($file['error']) || is_array($file['error'])) {
            return ['success' => false, 'error' => 'Invalid upload request parameters.'];
        }

        switch ($file['error']) {
            case UPLOAD_ERR_OK:
                break;
            case UPLOAD_ERR_NO_FILE:
                return ['success' => false, 'error' => 'No file was uploaded.'];
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                return ['success' => false, 'error' => 'Uploaded file exceeds size limit.'];
            default:
                return ['success' => false, 'error' => 'Unknown upload error occurred.'];
        }

        if ($file['size'] > $this->config['max_size']) {
            return ['success' => false, 'error' => 'File size exceeds maximum allowed 5MB limit.'];
        }

        // Validate MIME type strictly using finfo
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mimeType = $finfo->file($file['tmp_name']);

        if (!in_array($mimeType, $this->config['allowed_mimes'], true)) {
            $this->logger->warning('Rejected file upload due to invalid MIME type', ['mime' => $mimeType]);
            return ['success' => false, 'error' => 'Invalid file format. Only JPEG, PNG, and WebP images are allowed.'];
        }

        // Validate file extension
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, $this->config['allowed_extensions'], true)) {
            return ['success' => false, 'error' => 'Invalid file extension.'];
        }

        // Target path generation
        $targetDir = rtrim($this->config['path'], '/\\') . '/' . trim($subfolder, '/\\');
        if (!is_dir($targetDir)) {
            if (!@mkdir($targetDir, 0755, true)) {
                $this->logger->error('Failed to create upload destination directory', ['dir' => $targetDir]);
                return ['success' => false, 'error' => 'Failed to create upload storage directory.'];
            }
        }

        // Generate secure randomized filename
        $newFilename = sprintf('%s_%s.%s', date('Ymd_His'), bin2hex(random_bytes(8)), $ext);
        $destination = $targetDir . '/' . $newFilename;

        if (!move_uploaded_file($file['tmp_name'], $destination)) {
            $this->logger->error('Failed to move uploaded file', ['destination' => $destination]);
            return ['success' => false, 'error' => 'Failed to store uploaded file.'];
        }

        $this->logger->info('File uploaded successfully', ['filename' => $newFilename, 'subfolder' => $subfolder]);

        $assetPath = 'images/uploads/' . trim($subfolder, '/\\') . '/' . $newFilename;

        return [
            'success' => true,
            'filename' => $newFilename,
            'relative_path' => $assetPath,
            'filepath' => $assetPath,
            'error' => null
        ];
    }
}
