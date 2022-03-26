<?php
/*
 * Template Name: Project Files
 *
 * */

get_header();
global $post; ?>
    <div class="mt-0">
        <div class="jumbotron text-white page-section-title-py bg-light-blue-gradient">
            <div class="container">
                <div class="row">
                    <div class="col-xxxl-9 col-xxl-9 col-xl-11 col-lg-11 col-md-11 col-sm-11 col-xs-11 mx-auto col-sm-11 content">
                        <div class="col-xxxl-4 col-xxl-5 col-lg-5 col-md-12 col-sm-12 col-xs-12 pl-0 content">
                            <h1><?php the_title(); ?></h1>
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <main class="flex-grow-1 mt-0 pt-0">
        <section class="mt-0 mb-0  bg-black p-0">
            <div class="container">
                <div class="row mt-0 ">
                    <div class="col-xxxl-9 col-xxl-9 col-xl-11 col-lg-11 col-sm-11 col-md-11 col-xs-11 mx-auto">
                        <div class="row align-items-center  flex-xxxl-row flex-xxl-row flex-xl-row flex-lg-row  flex-md-column-reverse flex-sm-column-reverse flex-xs-column-reverse">
                            <div class="col-xxxl-6 col-xxl-7 col-xl-6 col-lg-7  col-sm-12 col-md-12 col-xs-12 unison-complete">
                                <div class="p-0">
                                    <h1>Unison Complete<br><span class="blue-title">Project File Bundle</span></h1>
                                    <p class="unison-text font-weight-normal  text-white line-height34 col-xxxl-8 p-0">Save over 50% when purchasing the Entire Project file Collection. Gain instant inspiration with everything our world-calss producers have to offer.</p>
                                    <div class="row text-center text-sm-left p-0 m-0 align-items-center  col-xxxl-10 col-xxl-12  col-sm-12 col-xs-12 col-md-12  flex-xxxl-row flex-xxl-row flex-xl-row flex-lg-row  flex-md-column-reverse flex-sm-column-reverse flex-xs-column-reverse">
                                        <div class="col-xxxl-6 col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-xs-12 col-sm-12 p-0">
                                            <a href="#" class="badge badge-pill badge-success justify-content-center align-items-center button-unison">Learn more
                                                <img class="right-arrow" src="<?php bloginfo('template_url')?>/assets/images/arrow-right.png" style="margin-left: 12px !important;">
                                            </a>
                                        </div>
                                        <div class="col-xxxl-4 col-xxl-5 col-xl-5 col-lg-5 col-md-12 col-xs-12 col-sm-12 row justify-content-lg-end justify-content-md-start p-0 p-lg-3">
                                            <p class="font-weight-bold price-warning m-0"><s class="p-0">$432</s></p>
                                            <p class="price text-white font-weight-bold">$297</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxxl-6 col-xxl-5 col-xl-5 col-lg-5 col-sm-12 d-flex justify-content-center">
                                <img class=" img-big " src="<?php bloginfo('template_url')?>/assets/images/HipHop_Rap_Final.png" alt="Image">
                                <img class="img-small" src="<?php bloginfo('template_url')?>/assets/images/Piano project files.svg" alt="Image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="mt-0 genre">
            <div class="container mt-0 text-white">
                <div class="row mt-0 ">
                    <div class="col-xxxl-9 col-xxl-9 col-xl-11 col-lg-11 col-sm-11 col-xs-11 col-md-11 mx-auto">
                        <h4 class="genre-title">Or Browse by Genre...</h4>
                        <div class="row">
                            <?php $genres = get_terms('pa_genre', array('hide_empty' => false));
                            foreach ($genres as $genre) :
                                $music = get_post_meta($genre->ID, '_music', true); ?>
                                <div class="col-xl-3 col-lg-3 col-md-6 col-xs-6 col-sm-6  card-margin">
                                    <div class="card bg-transparent">
                                        <div class="card-image mb-img">
                                            <img class="card-img img-fluid"
                                                 src="<?php echo bloginfo('template_url') ?>/assets/images/Rectangle%2025-1.jpg"
                                                 alt="Image caption">
                                            <div class="image-overlay d-flex align-items-center justify-content-center">
                                                <a href="#" class="badge badge-pill badge-success front-cta-btn">Learn more</a>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-top  pack-card">
                                            <!-- <div class="col-3"> -->
                                                <div class="single_product_play">
                                                    <div class="play_single_audio">
                                                        <a href="#" class="btn-play js-sound"
                                                           data-file="<?php echo $music; ?>"
                                                           data-id="<?php echo $genre->ID?>">
                                                        </a>
                                                    </div>
                                                </div>
                                            <!-- </div> -->
                                            <div class="col-9 pr-0">
                                                <p class="front-card-title font-weight-bold text-truncate line-clamp player-text"><?php echo $genre->name; ?></p>
                                                <p class="front-card-text player-text-small">Albeton, FL & Logic Projects</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php get_footer();