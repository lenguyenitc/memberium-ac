<?php
/*
 * Template Name: Plug-Ins
 *
 * */

get_header();
global $post; ?>

    <div class="jumbotron text-white bg-turquoise-gradient pt-4 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-xxxl-9 col-xxl-9 col-xl-9 col-lg-9 col-sm-12 mx-auto">
                    <div class="col-xxxl-5 col-xxl-5 col-xl-5 col-lg-5 p-0">
                        <h1 class="mb-4 mt-5"><?php the_title(); ?></h1>
                        <p class="p2 text-white-90 mb-5">We are now offering Rent-to-Own on every Unison Plug-in, get your copy of the Midi Wizard $29 a month of Drum Monkey for $19 a month.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <main>
        <section class="p-0" style="margin-top: 80px;">
            <div class="container">
                <div class="row">
                    <div class="col-xxxl-9 col-xxl-9 col-sm-12 mx-auto">
                        <div class="row">
                            <?php $midi_wizard = wc_get_product(118910); ?>

                            <div class="col-xxxl-6 col-md-6 col-sm-12 mt-3 mb-4">
                                <div class="card card-box-plugin bg-transparent">
                                    <div class="card-image">
                                        <img class="card-img img-fluid" src="<?php bloginfo('template_url')?>/assets/images/Rectangle 50.jpg" alt="Image caption">
                                        <div class="image-overlay d-flex align-items-center justify-content-center">
                                            <img class="img-fluid" src="<?php bloginfo('template_url')?>/assets/images/playButton.png" alt="Play button">
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <h3>Midi Wizard</h3>
                                        <p class="text-white-50 p3 mt-3 mb-5">The magic way to produce hit songs in 22 genres of music. Get the world’s first (and only) chord progression & melody generator that’s genrer-specific and actually sounds good 93% of the time.</p>
                                        <div class="row align-items-end justify-content-between align-items-center">
                                            <div class="col-xl-4 col-lg-12 col-12 order-2 order-xl-1 text-center text-xl-left">
                                                <a href="<?php echo $midi_wizard->get_permalink(); ?>" class="badge badge-pill badge-success">Learn more</a>
                                            </div>
                                            <div class="col-xl-auto col-lg-12 text-uppercase order-1 order-xl-2 mb-4 mb-xl-0 prices">
                                                <div class="row justify-content-center align-items-center flex-column flex-sm-row">
                                                    <div class="col col-auto one-time-purchase text-center">
                                                        <span class="price">$<?php echo $midi_wizard->get_regular_price(); ?></span>
                                                        <span class="d-block text-light mt-1 font-weight-bold price-description">One time purchase</span>
                                                    </div>
                                                    <div class="col col-auto my-3">
                                                        <span class="text-white font-weight-bold">or</span>
                                                    </div>
                                                    <div class="col col-auto text-center">
                                                        <span class="price text-center">$29</span>
                                                        <sub class="text-white text-capitalize p1">/ Month</sub>
                                                        <span class="d-block text-light font-weight-bold mt-1 price-description w-100">Rent to own</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxxl-6 col-md-6 col-sm-12 mt-3 mb-4">
                                <div class="card card-box-plugin bg-transparent">
                                    <div class="card-image">
                                        <img class="card-img img-fluid" src="<?php echo bloginfo('template_url') ?>/assets/images/Rectangle 51.jpg" alt="Image caption">
                                        <div class="image-overlay d-flex align-items-center justify-content-center">
                                            <img class="img-fluid" src="<?php echo bloginfo('template_url') ?>/assets/images/playButton.png" alt="Play button">
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <h3>Drum Monkey</h3>
                                        <p class="text-white-50 p3 mt-3 mb-5">The magic way to produce hit songs in 22 genres of music. Get the world’s first (and only) chord progression & melody generator that’s genrer-specific and actually sounds good 93% of the time.</p>
                                        <div class="row align-items-end justify-content-between align-items-center">
                                            <div class="col-xl-4 col-lg-12 col-12 order-2 order-xl-1 text-center text-xl-left">
                                                <a href="#" class="badge badge-pill badge-warning">Learn more</a>
                                            </div>
                                            <div class="col-xl-auto col-lg-12 text-uppercase order-1 order-xl-2 mb-4 mb-xl-0 prices">
                                                <div class="row justify-content-center align-items-center flex-column flex-sm-row">
                                                    <div class="col col-auto one-time-purchase text-center">
                                                        <span class="price">$297</span>
                                                        <span class="d-block text-light mt-1 font-weight-bold price-description">One time purchase</span>
                                                    </div>
                                                    <div class="col col-auto my-3">
                                                        <span class="text-white font-weight-bold">or</span>
                                                    </div>
                                                    <div class="col col-auto text-center">
                                                        <span class="price text-center">$29</span>
                                                        <sub class="text-white text-capitalize p1">/ Month</sub>
                                                        <span class="d-block text-light font-weight-bold mt-1 price-description w-100">Rent to own</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

<?php get_footer();
