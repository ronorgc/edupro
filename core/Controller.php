<?php
/** Base controller */
class Controller {
    protected function render(string $view, array $data = []) {
        // Base path is project root
        $base = dirname(__DIR__);
        extract($data);
        $contentView = $base . '/app/views/' . $view . '.php';
        $layoutView = $base . '/app/views/layout/layout.php';
        if (file_exists($layoutView) && file_exists($contentView)) {
            // Make the content view path available to layout
            $contentViewPath = $contentView;
            include $layoutView;
        } else {
            http_response_code(500);
            echo 'View not found';
        }
    }
}
