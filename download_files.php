<?php
// Purify plugin
require_once 'HTMLPurifier/HTMLPurifier.auto.php';
$config = HTMLPurifier_Config::createDefault();
$purifier = new HTMLPurifier($config);

if (isset($_REQUEST["file"])) {
    // Get parameters
    $file = $purifier->purify(urldecode($_REQUEST["file"])); // Decode URL-encoded string
    // echo $file;

    /* Test whether the file name contains illegal characters
    such as "../" using the regular expression */
    if (preg_match('/^[-a-z0-9_.\/\]+[a-z0-9]/i', $file)) {
        $filepath = $file;

        // Process download
        if (file_exists($filepath)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($filepath) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filepath));
            flush(); // Flush system output buffer
            readfile($filepath);
            die();
            exit();
        } else {
            http_response_code(404);
            die();
        }
    } else {
        die("Invalid file name!");
    }
}
