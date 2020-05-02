<?php
$target = '/home/watchitf/watchitfilms/storage/app/public';
$shortcut = '/home/watchitf/public_html/storage';
symlink($target, $shortcut);
echo 'symlink'
?>