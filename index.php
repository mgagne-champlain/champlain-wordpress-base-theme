<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
get_header(); ?>
<div class="wrapper" id="index-wrapper">
    <main class="site-main" id="main">
        <div id="content" tabindex="-1">
            <?php while ( have_posts() ) { 
                the_post();
                if(is_single()){
                    get_template_part( 'loop-templates/full');
                } else {
                    get_template_part( 'loop-templates/excerpt');
                }
            } ?>
        </div>
    </main>
</div>
<?php get_footer(); ?>
