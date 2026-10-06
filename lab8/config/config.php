<?php
define('BASE_URL', '/lagagon/lab/asm/'); 

function get_image_path($img_name) {
    if (empty($img_name)) {
        return 'img/default.webp';
    }
    if (strpos($img_name, '/') !== false) {
        return $img_name;
    }
    if (file_exists('uploads/' . $img_name)) {
        return 'uploads/' . $img_name;
    }
    if (file_exists('img/' . $img_name)) {
        return 'img/' . $img_name;
    }
    return 'img/' . $img_name;
}
