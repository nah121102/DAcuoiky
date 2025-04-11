<?php
spl_autoload_register(function ($class_name) {
    $paths = ["../models/", "../controllers/"];
    foreach ($paths as $path) {
        $file = __DIR__ . "/" . $path . $class_name . ".php";
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
    die("❌ Không tìm thấy clagagagagagagss: " . $class_name);
});
?>
