<?php
function readPlainText($filename) {
    $path = "../data/" . $filename;
    
    if (!file_exists($path)) {
        return "Error: file not found (" . htmlspecialchars($path) . ")";
    }

    $content = file_get_contents($path);
    return nl2br(htmlspecialchars($content));
}
?>
