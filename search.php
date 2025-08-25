<?php

$iterator = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator(__DIR__ . '/src')
);

foreach ($iterator as $file) {
    if ($file->isFile() && strpos(file_get_contents($file), 'form.html.twig') !== false) {
        echo $file->getPathname() . "\n";
    }
}