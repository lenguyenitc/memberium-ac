<?php

get_header();
global $post, $product;
?>

<div class="jumbotron testimonials text-white bg-testimonial-gradient">
    <div class="container">
        <div class="row">
            <div class="col-xxxl-7 col-xxl-8 col-xl-8 col-lg-8 col-md-9 col-sm-12 mx-auto">
                <div class="row testimonials-heading">
                    <div class="col-lg-4 col-sm-12">
                        <div class="testimonials-heading-image"
                            style="background-image: url(<?php bloginfo('template_url') ?>/assets/images/testimonials-heart.svg););">
                        </div>
                    </div>
                    <div class="col-lg-8 col-sm-12">
                        <h1 class="testimonials-title">Over 222,708 <br> <span class="text-success">Satisfied</span>
                            Customers
                        </h1>
                        <p class="text-white testimonials-heading-text">200,000+ producers from all around the world
                            have taken their music to the next level using various Unison products.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<main class="flex-grow-1 testimonial-wistia-player">
    <?php
    $testimonials = get_posts(array(
        'numberposts' => 6,
        'post_type' => 'testimonials',
        'meta_key' => 'testimonials_section',
        'meta_value' => 'Meet Our Amazing Customers!'
    )); ?>

    <?php if ($testimonials) : ?>
    <section class="p-0 testimonials-background-image">
        <div class="container">
            <div class="row">
                <div class="col-xxxl-7 col-xxl-8 col-xl-10 col-lg-11 col-sm-12 mx-auto">
                    <div class="text-center amazing-customers">
                        <h3>Meet Our Amazing Customers!</h3>
                    </div>
                    <div class="row text-white my-5">
                        <?php foreach ($testimonials as $testimonial) : ?>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="testimonial-card-md">
                                <div class="testimonial-card-image-md"
                                    alt="<?php echo get_the_post_thumbnail_caption(); ?>">
                                    <?php echo get_field('wistia', $testimonial->ID); ?>
                                </div>
                                <p class="amazing-customers-text">"<?php echo $testimonial->post_content; ?>"</p>
                                <p class="amazing-customers-name"><?php echo $testimonial->post_title; ?></p>
                                <p class="amazing-customers-title text-success">
                                    <?php echo get_field('job', $testimonial->ID) ?>
                                    - <?php echo get_field('country', $testimonial->ID) ?></p>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <?php wp_reset_postdata(); ?>
            <?php $first_cta = get_posts(array(
                        'numberposts' => 1,
                        'post_type' => 'testimonials',
                        'meta_key' => 'testimonials_section',
                        'meta_value' => 'First CTA'
                    )); ?>

            <?php foreach ($first_cta as $testimonial) : ?>
            <div class="col-xxxl-8 col-xxl-9 col-xl-11 col-lg-11 col-sm-12 mx-auto p-5 bg-black text-white">
                <div class="row flex-xs-column flex-sm-column flex-lg-row">
                    <?php if (has_post_thumbnail($testimonial->ID)) : ?>
                    <div class="testimonial-cta-image-container"
                        style="background-image: url(<?php echo get_the_post_thumbnail_url($testimonial->ID)?>);"
                        alt="<?php echo get_the_post_thumbnail_caption(); ?>">
                    </div>
                    <?php endif; ?>
                    <p class="testimonials-content-text d-flex align-items-center">
                        "<?php echo $testimonial->post_content; ?>"</p>
                    <div class="d-flex flex-column justify-content-end cta-signature">
                        <p class="testimonials-content-name font-weight-bold"><?php echo $testimonial->post_title; ?>
                        </p>
                        <p class="navigation-text text-success"><?php echo get_field('job', $testimonial->ID) ?>
                            - <?php echo get_field('country', $testimonial->ID) ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            <div class="col-lg-7 text-center testimonials-cta-button mx-auto">
                <a href="/product/unison-midi-chord-pack/" class="badge badge-pill-testimonials badge-success">get
                    started now</a>
            </div>
        </div>
    </section>
    <?php endif; ?>
    <?php wp_reset_postdata(); ?>

    <?php $after_using = get_posts(array(
        'numberposts' => 3,
        'post_type' => 'testimonials',
        'meta_key' => 'testimonials_section',
        'meta_value' => 'After Using Unison Products...'
    )); ?>

    <?php if ($after_using) : ?>
    <section class="pb-3 pt-1 testimonials-gradient-bg">
        <div class="container">
            <div class="row">
                <div class="col-xxxl-8 col-xxl-8 col-xl-11 col-lg-11 col-sm-12 mx-auto">
                    <div class="text-center after-using">
                        <h3 class="letter-spacing-2to1">After Using <span class="text-success">Unison</span>
                            Products...
                        </h3>
                    </div>
                    <div class="row text-white my-5">
                        <?php foreach ($after_using as $testimonial) : ?>
                        <div class="col-md-4 col-sm-12">
                            <div class="testimonial-card-sm">
                                <div class="testimonial-card-image-md"
                                    alt="<?php echo get_the_post_thumbnail_caption(); ?>">
                                    <?php echo get_field('wistia', $testimonial->ID); ?>
                                </div>
                                <p class="amazing-customers-text">"<?php echo $testimonial->post_content; ?>"</p>
                                <p class="amazing-customers-name"><?php echo $testimonial->post_title; ?></p>
                                <p class="amazing-customers-title text-success">
                                    <?php echo get_field('job', $testimonial->ID) ?>
                                    - <?php echo get_field('country', $testimonial->ID) ?></p>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>
    <?php wp_reset_postdata(); ?>

    <?php $join_thousands = get_posts(array(
        'numberposts' => 6,
        'post_type' => 'testimonials',
        'meta_key' => 'testimonials_section',
        'meta_value' => 'Join Thousands Of Producers Around The World...'
    )); ?>

    <?php if ($join_thousands) : ?>
    <section class="p-0 bg-dirty-white">
        <div class="container">
            <div class="row">
                <div class="col-xxxl-7 col-xxl-8 col-xl-10 col-lg-11 col-sm-12 mx-auto">
                    <div class="text-center join-title">
                        <h3 class="text-dark letter-spacing-2to1">Join <span class="text-success">Thousands Of
                                Producers</span> Around The World...
                        </h3>
                    </div>
                    <div class="row text-dark my-5">
                        <?php foreach ($join_thousands as $testimonial) : ?>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="testimonial-card-md">
                                <div class="testimonial-card-image-md"
                                    alt="<?php echo get_the_post_thumbnail_caption(); ?>">
                                    <?php echo get_field('wistia', $testimonial->ID); ?>
                                </div>
                                <p class="amazing-customers-text">"<?php echo $testimonial->post_content; ?>"</p>
                                <p class="amazing-customers-name"><?php echo $testimonial->post_title; ?></p>
                                <p class="amazing-customers-title text-success">
                                    <?php echo get_field('job', $testimonial->ID) ?>
                                    - <?php echo get_field('country', $testimonial->ID) ?></p>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php wp_reset_postdata(); ?>

                <?php $second_cta = get_posts(array(
                            'numberposts' => 1,
                            'post_type' => 'testimonials',
                            'meta_key' => 'testimonials_section',
                            'meta_value' => 'Second CTA'
                        )); ?>
                <?php foreach ($second_cta as $testimonial) : ?>
                <div class="col-xxxl-8 col-xxl-9 col-xl-11 col-lg-11 col-sm-12 mx-auto p-5 bg-white text-dark">
                    <div class="row flex-xs-column flex-sm-column flex-lg-row">
                        <?php if (has_post_thumbnail($testimonial->ID)) : ?>
                        <div class="testimonial-cta-image-container"
                            style="background-image: url(<?php echo get_the_post_thumbnail_url($testimonial->ID)?>);"
                            alt="<?php echo get_the_post_thumbnail_caption(); ?>">
                        </div>
                        <?php endif; ?>
                        <p class="testimonials-content-text d-flex align-items-center">
                            "<?php echo $testimonial->post_content; ?>"</p>
                        <div class="d-flex flex-column justify-content-end cta-signature">
                            <p class="testimonials-content-name font-weight-bold">
                                <?php echo $testimonial->post_title; ?></p>
                            <p class="navigation-text text-success"><?php echo get_field('job', $testimonial->ID) ?>
                                - <?php echo get_field('country', $testimonial->ID) ?></p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
                <div class="col-lg-7 text-center join-cta mx-auto">
                    <a href="/product/unison-midi-chord-pack/" class="badge badge-pill-testimonials badge-success">get
                        started now</a>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>
    <?php wp_reset_postdata(); ?>

    <?php $became_part = get_posts(array(
        'numberposts' => 3,
        'post_type' => 'testimonials',
        'meta_key' => 'testimonials_section',
        'meta_value' => 'Become A Part Of The Unison Family...'
    )); ?>

    <?php if ($became_part) : ?>
    <section class="pb-3 pt-1 testimonials-gradient-bg">
        <div class="container">
            <div class="row">
                <div class="col-xxxl-8 col-xxl-8 col-xl-11 col-lg-11 col-sm-12 mx-auto">
                    <div class="text-center become-a-part">
                        <h3 class="letter-spacing-2to1">Become A Part Of The Unison Family...</h3>
                    </div>
                    <div class="row text-white my-5">
                        <?php foreach ($became_part as $testimonial) : ?>
                        <div class="col-md-4 col-sm-12">
                            <div class="testimonial-card-sm">
                                <div class="testimonial-card-image-md"
                                    alt="<?php echo get_the_post_thumbnail_caption(); ?>">
                                    <?php echo get_field('wistia', $testimonial->ID); ?>
                                </div>
                                <p class="amazing-customers-text">"<?php echo $testimonial->post_content; ?>"</p>
                                <p class="amazing-customers-name"><?php echo $testimonial->post_title; ?></p>
                                <p class="amazing-customers-title text-success">
                                    <?php echo get_field('job', $testimonial->ID) ?>
                                    - <?php echo get_field('country', $testimonial->ID) ?></p>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>
    <?php wp_reset_postdata(); ?>

    <?php $watch_more = get_posts(array(
        'numberposts' => -1,
        'post_type' => 'testimonials',
        'meta_key' => 'testimonials_section',
        'meta_value' => 'Watch More Success Stories...'
    )); ?>

    <?php if ($watch_more) : ?>
    <section class="p-0">
        <div class="container">
            <div class="row">
                <div class="col-xxxl-7 col-xxl-8 col-xl-10 col-lg-11 col-sm-12 mx-auto">
                    <div class="text-center watch-more">
                        <h3 class="letter-spacing-2to1">Watch More <span class="text-success">Success Stories</span>...
                        </h3>
                    </div>
                    <div class="row text-white my-5">
                        <?php foreach ($watch_more as $testimonial) : ?>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="testimonial-card-md">
                                <div class="testimonial-card-image-md"
                                    alt="<?php echo get_the_post_thumbnail_caption(); ?>">
                                    <?php echo get_field('wistia', $testimonial->ID); ?>
                                </div>
                                <p class="amazing-customers-text">"<?php echo $testimonial->post_content; ?>"</p>
                                <p class="amazing-customers-name"><?php echo $testimonial->post_title; ?></p>
                                <p class="amazing-customers-title text-success">
                                    <?php echo get_field('job', $testimonial->ID) ?>
                                    - <?php echo get_field('country', $testimonial->ID) ?></p>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <?php wp_reset_postdata(); ?>

            <?php $third_cta = get_posts(array(
                        'numberposts' => 1,
                        'post_type' => 'testimonials',
                        'meta_key' => 'testimonials_section',
                        'meta_value' => 'Third CTA'
                    )); ?>
            <?php foreach ($third_cta as $testimonial) : ?>
            <div class="col-xxxl-8 col-xxl-9 col-xl-11 col-lg-11 col-sm-12 mx-auto p-5 text-white bg-black">
                <div class="row flex-xs-column flex-sm-column flex-lg-row">
                    <?php if (has_post_thumbnail($testimonial->ID)) : ?>
                    <div class="testimonial-cta-image-container"
                        style="background-image: url(<?php echo get_the_post_thumbnail_url($testimonial->ID)?>);"
                        alt="<?php echo get_the_post_thumbnail_caption(); ?>">
                    </div>
                    <?php endif; ?>
                    <p class="testimonials-content-text d-flex align-items-center">
                        "<?php echo $testimonial->post_content; ?>"</p>
                    <div class="d-flex flex-column justify-content-end cta-signature">
                        <p class="testimonials-content-name font-weight-bold"><?php echo $testimonial->post_title; ?>
                        </p>
                        <p class="navigation-text text-success"><?php echo get_field('job', $testimonial->ID) ?>
                            - <?php echo get_field('country', $testimonial->ID) ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            <div class="col-lg-7 text-center watch-more-cta mx-auto">
                <a href="/product/unison-midi-chord-pack/" class="badge badge-pill-testimonials badge-success">get
                    started now</a>
            </div>
        </div>
    </section>
    <?php endif; ?>
    <?php wp_reset_postdata(); ?>

    <?php $watch_more2 = get_posts(array(
        'numberposts' => -1,
        'post_type' => 'testimonials',
        'meta_key' => 'testimonials_section',
        'meta_value' => 'Watch More Success Stories'
    )); ?>

    <?php if ($watch_more2) : ?>
    <section class="p-0 testimonials-gradient-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-sm-12 mx-auto">
                    <div class="text-center watch-more">
                        <h3 class="letter-spacing-2to1">Watch More <span class="text-success">Success Stories</span>
                        </h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xxxl-8 col-xxl-8 col-xl-11 col-lg-11 col-sm-12 mx-auto">
                    <div class="row text-white pb-5">
                        <?php foreach ($watch_more2 as $testimonial) : ?>
                        <div class="col-md-4 col-sm-12">
                            <div class="testimonial-card-xl">
                                <div class="testimonial-card-image-xl"
                                    alt="<?php echo get_the_post_thumbnail_caption(); ?>">
                                    <?php echo get_field('wistia', $testimonial->ID); ?>
                                </div>
                                <p class="amazing-customers-text">"<?php echo $testimonial->post_content; ?>"</p>
                                <p class="amazing-customers-name"><?php echo $testimonial->post_title; ?></p>
                                <p class="amazing-customers-title text-success">
                                    <?php echo get_field('job', $testimonial->ID) ?>
                                    - <?php echo get_field('country', $testimonial->ID) ?></p>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <section class="testimonials-bottom-section text-white">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <p>Become A Part Of The Unison Family</p>
                    <a href="/product/unison-midi-chord-pack/" class="badge badge-pill-testimonials badge-success">get
                        started now</a>
                </div>
            </div>
        </div>
    </section>
</main>

<script type="text/javascript">
function openModal(id) {
    $(`#modal-testimonials-${id}`).removeClass('closed');
    $('#modal-overlay').removeClass('closed');
}

function closeModal(id) {
    $(`#modal-testemonial-close-${id}`).on('click', function() {
        $(`#modal-testimonials-${id}`).addClass('closed');
        $('#modal-overlay').addClass('closed');
    });
}
</script>

<?php get_footer(); ?>