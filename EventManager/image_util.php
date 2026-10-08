<?php
// image_util.php

function process_image($file_key, $upload_dir = 'images/') {
    if (!isset($_FILES[$file_key]) || $_FILES[$file_key]['error'] !== UPLOAD_ERR_OK) {
        return null;
    }

    $tmp_name = $_FILES[$file_key]['tmp_name'];
    $original_name = basename($_FILES[$file_key]['name']);
    $image_info = getimagesize($tmp_name);

    if ($image_info === false) {
        return null;
    }

    $mime_type = $image_info['mime'];
    switch ($mime_type) {
        case 'image/jpeg':
            $src_image = imagecreatefromjpeg($tmp_name);
            break;
        case 'image/png':
            $src_image = imagecreatefrompng($tmp_name);
            break;
        case 'image/gif':
            $src_image = imagecreatefromgif($tmp_name);
            break;
        default:
            return null;
    }

    $filename = pathinfo($original_name, PATHINFO_FILENAME);
    $clean_filename = preg_replace('/[^a-zA-Z0-9_-]/', '_', $filename);
    $unique_name = $clean_filename . '_' . time();

    // Create 100x100 thumbnail and 400x400 detailed view images
    resize_and_save($src_image, $image_info[0], $image_info[1], 100, 100, $upload_dir . $unique_name . '_100.jpg');
    resize_and_save($src_image, $image_info[0], $image_info[1], 400, 400, $upload_dir . $unique_name . '_400.jpg');

    imagedestroy($src_image);

    return $unique_name;
}

function resize_and_save($src_image, $orig_w, $orig_h, $target_w, $target_h, $dest_path) {
    $new_image = imagecreatetruecolor($target_w, $target_h);
    
    $white = imagecolorallocate($new_image, 255, 255, 255);
    imagefill($new_image, 0, 0, $white);

    imagecopyresampled($new_image, $src_image, 0, 0, 0, 0, $target_w, $target_h, $orig_w, $orig_h);
    imagejpeg($new_image, $dest_path, 90);
    imagedestroy($new_image);
}
?>