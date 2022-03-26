<?php
/*Template Name: Page*/
?>
<?php get_header(); ?>

<?php while (have_posts()) : the_post(); ?>
    <div class="jumbotron text-white bg-turquoise-gradient">
        <div class="container">
            <div class="row">
                <div class="col-xxxl-8 col-xxl-9 col-xl-9 col-lg-9 col-sm-12 mx-auto p-0">
                    <div class="terms-title">
                        <h1><?php the_title(); ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <main class="flex-grow-1">
        <?php the_content(); ?>
    </main>
<?php endwhile; ?>

<?php get_footer(); ?>