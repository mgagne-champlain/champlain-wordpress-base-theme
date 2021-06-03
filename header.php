<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
} ?>

<!DOCTYPE html>
<html <?php esc_attr(language_attributes()); ?>>
<head>
    <meta charset="<?php esc_attr(bloginfo( 'charset' )); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?= esc_attr(wp_title()); ?>">
    <link rel="icon" sizes="32x32" href="<?= esc_attr(get_template_directory_uri()) ?>/images/icon32_32.png">
    <link rel="icon" sizes="192x192" href="<?= esc_attr(get_template_directory_uri()) ?>/images/icon192_192.png">
    <link rel="apple-touch-icon" href="<?= esc_attr(get_template_directory_uri()) ?>/images/icon192_192.png">
    <meta name="msapplication-square310x310logo" content="<?= esc_attr(get_template_directory_uri()) ?>/images/icon310_310.png">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<!-- TODO Put actual header/nav content here -->
<h1><?= esc_attr(wp_title()); ?></h1>
<hr/>

<?php do_action( 'wp_body_open' ); ?>

