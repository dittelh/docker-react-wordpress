<?php
/*
Plugin Name: Dittes Simple Image Compressor Plugin
Description: Resizes and compresses images uploaded to the WordPress site.
Version: 1.0
Author: Ditte
*/

// Add action hook to compress images after they are uploaded
add_filter('wp_handle_upload', 'compress_uploaded_images');

function compress_uploaded_images($file) {
    // Check if uploaded file is an image
    $mime_type = $file['type'];
    if (strpos($mime_type, 'image') === false) {
        return $file; // Not an image, do nothing
    }

    // Get the path to the uploaded file
    $file_path = $file['file'];

    // Get image dimensions
    list($orig_width, $orig_height, $type) = getimagesize($file_path);

    // Define maximum dimensions
    $max_width = 600;
    $max_height = 400;

    // Calculate new dimensions while preserving aspect ratio
    $aspect_ratio = $orig_width / $orig_height;
    if ($orig_width > $max_width || $orig_height > $max_height) {
        if ($orig_width / $max_width > $orig_height / $max_height) {
            $new_width = $max_width;
            $new_height = $max_width / $aspect_ratio;
        } else {
            $new_height = $max_height;
            $new_width = $max_height * $aspect_ratio;
        }
    } else {
        $new_width = $orig_width;
        $new_height = $orig_height;
    }

    // Create a new image from the uploaded file
    $image = imagecreatefromstring(file_get_contents($file_path));

    // Create a new temporary image with the new dimensions
    $new_image = imagecreatetruecolor($new_width, $new_height);

    // Resize the original image to the new dimensions
    imagecopyresampled($new_image, $image, 0, 0, 0, 0, $new_width, $new_height, $orig_width, $orig_height);

    // Save the resized image back to the original file path
    switch ($type) {
        case IMAGETYPE_JPEG:
            imagejpeg($new_image, $file_path, 80); // Adjust quality as needed (0 - 100)
            break;
        case IMAGETYPE_PNG:
            imagepng($new_image, $file_path, 8); // Adjust compression level as needed (0 - 9)
            break;
        case IMAGETYPE_GIF:
            imagegif($new_image, $file_path);
            break;
        default:
            break;
    }

    // Free up memory
    imagedestroy($image);
    imagedestroy($new_image);

    return $file; // Return the modified file array
}
