<?php
declare(strict_types=1);

/**
 * Mewa Tours - View Helper Functions
 */

if (!function_exists('render_view')) {
    /**
     * Render a view file with data variables
     * 
     * @param string $viewPath Relative path to view file under /views/ (e.g. 'client/home' or 'admin/dashboard')
     * @param array $data Data array to extract into view scope
     */
    function render_view(string $viewPath, array $data = []): void
    {
        $filePath = ROOT_PATH . '/views/' . ltrim($viewPath, '/') . '.php';

        if (!file_exists($filePath)) {
            throw new Exception("View file [{$viewPath}] not found at {$filePath}.");
        }

        extract($data);
        require $filePath;
    }
}

if (!function_exists('render_partial')) {
    /**
     * Render a view partial component (header, footer, sidebar, etc.)
     */
    function render_partial(string $partialName, array $data = []): void
    {
        render_view('partials/' . $partialName, $data);
    }
}
