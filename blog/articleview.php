<?php

require_once 'db.php';

if (!isset($_SESSION['user'])) {
    echo '<h1>Access forbidden</h1>';
    echo 'Only logged in users are allowed to post.';
    echo '<a href="index.php">Click to continue</.a>';
    exit;
}

/* TODO: add form with subject and body (textarea)
 * Required subject at 
 */