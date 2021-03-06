<!DOCTYPE html>

<html <?php language_attributes(); ?>>

<head>

    <meta charset="<?php bloginfo( 'charset' ); ?>">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap" rel="stylesheet">

    <?php wp_head(); ?>

</head>

<body>

    <div id="vue-wordpress-app" class="container">

        <?php
        get_template_part('template-parts/site-branding');
        set_query_var( 'vw_nav_menu', 'main' );
        get_template_part('template-parts/nav-menu'); 
