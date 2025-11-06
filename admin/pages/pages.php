<?php

function getDataDir() {
    return __DIR__ . '/../../data/';
}

function getAllPages() {
    $dir = getDataDir();
    if (!is_dir($dir)) {
        return [];
    }

    $files = scandir($dir);
    $pages = [];

    foreach ($files as $file) {
        if (pathinfo($file, PATHINFO_EXTENSION) === 'txt') {
            $pages[] = pathinfo($file, PATHINFO_FILENAME);
        }
    }

    return $pages;
}

function getPageContent($name) {
    $filePath = getDataDir() . $name . '.txt';
    if (file_exists($filePath)) {
        return file_get_contents($filePath);
    }
    return null;
}

function createPage($name, $content) {
    $filePath = getDataDir() . $name . '.txt';
    if (file_exists($filePath)) {
        return false; 
    }

    file_put_contents($filePath, $content);
    return true;
}

function updatePage($name, $newContent) {
    $filePath = getDataDir() . $name . '.txt';
    if (!file_exists($filePath)) {
        return false; 
    }

    file_put_contents($filePath, $newContent);
    return true;
}

function deletePage($name) {
    $filePath = getDataDir() . $name . '.txt';
    if (file_exists($filePath)) {
        unlink($filePath);
        return true;
    }
    return false;
}
?>
