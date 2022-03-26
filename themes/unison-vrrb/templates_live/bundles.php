<?php
/*
 * Template Name: Bundles
 *
 * */

get_header();
global $post; ?>
<div class="jumbotron bundles text-white bg-black bg-light-blue-gradient">
    <div class="container">
        <div class="row">
            <div class="col-xxxl-9 col-xxl-9 col-xl-11 col-lg-11 col-md-11 col-sm-12 mx-auto">
                <h1><?php the_title(); ?></h1>
                <p class="text-white">Become a top 1% producer in 2021 with everything you need to skyrocket your
                    inspiration, create jaw dropping chord progression, make hit melodies and get your music
                    sounding professional - at epic discounts.</p>
            </div>
        </div>
    </div>
</div>

<main class="flex-grow-1 pt-0">
    <section class="p-0 bg-black">
        <div class="container">
            <div class="row">
                <div class="col-xxxl-9 col-xxl-9 col-xl-11 col-lg-11 col-md-11 col-sm-12 mx-auto">
                    <div
                        class="row flex-xs-column-reverse flex-sm-column-reverse flex-lg-row d-flex justify-content-between mega-bundle align-items-bottom">
                        <div class="col-lg-7 col-xl-6 col-xs-12">
                            <div class="h-100 d-flex flex-column bg-transparent">
                                <h2><?php echo get_field('title', $post->ID); ?></h2>
                                <p class="bundle-text text-white"><?php echo get_field('text', $post->ID); ?>
                                </p>
                                <div
                                    class="row flex-xs-column-reverse flex-sm-column-reverse flex-lg-row align-items-center">
                                    <div
                                        class="col-xxxl-5 col-xxl-6 col-lg-5 col-12 primary-button  text-center text-lg-left">
                                        <a href="<?php echo get_field('button_link', $post->ID); ?>"
                                            class="badge badge-pill badge-success view-deal-big"><?php echo get_field('button_text', $post->ID); ?></a>
                                    </div>
                                    <div
                                        class="col-xxxl-4 col-xxl-6 col-xl-7 col-lg-7 col-12 prices mb-4 mb-sm-0 d-flex flex-sm-row pr-lg-5 pr-xxxl-0 justify-content-xxxl-center justify-content-xxl-end">
                                        <p class="price-warning"><s><?php echo get_field('sale_price', $post->ID); ?></s></p>
                                        <p class="price text-white font-weight-bold"><?php echo get_field('sale_sale_price', $post->ID); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 col-xl-6 col-xs-12  text-center text-lg-right">
                            <img class="img-fluid"
                                src="<?php echo get_field('image', $post->ID)['url']?>"
                                alt="Image">
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- <section class="p-0">
            <div class="container">
                <div class="col-xxxl-9 col-xxl-9 col-xl-11 col-lg-11 col-md-11 col-sm-12 mx-auto bundles-cards">
                    <?php wp_reset_query();
                    $args = array(
                        'post_type' => 'product',
                        'posts_per_page' => 4,
                        // 1. define a custom query var here to pass your term through:
                        'search_prod_title' => 'Bundle',
                        'order' => 'desc',
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'product_cat',
                                'field' => 'slug',
                                'terms' => 'bundle-products'
                            )
                        )
                    );

                    add_filter('posts_where', 'title_filter', 10, 2);
                    $bundles = new WP_Query($args);
                    remove_filter('posts_where', 'title_filter', 10);

                    $i = 1;
                    while ($bundles->have_posts()) : $bundles->the_post();
                    $product = wc_get_product($post->ID); ?>
                    <div class="row  bundle-card text-white green-glow" style="border-radius: 5px; overflow: hidden !important; background: #212121">
                        <div class="col-xs-12 col-sm-12 col-lg-5 col-xxl-6 p-0 bg-black div-img text-center">
                            <div class="mx-auto bundle-img" style="position: relative">
                        <img class="img-fluid save-img" src="<?php bloginfo('template_url') ?>/assets/images/save 56.png"
                                 alt="Image" style="position: absolute;">
                            <img class="img-fluid" src="<?php bloginfo('template_url') ?>/assets/images/bundles-product.png"
                                 alt="Image" style="margin: auto;">
                </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-lg-7 col-xl-6 text-left d-flex flex-column justify-content-between p-bundle-card">
                            <p class="bundle-card-title font-weight-bold"><?php the_title(); ?></p>
                            <p class="bundle-card-text">Get your music played on repeat with these proven, plug & play
                                MIDI chord progressions. Instantly start cranking out hits with jaw-dropping chord
                                progressions from the biggest hits that have generated over 98 billion plays.</p>
                            <div class="row flex-xs-column-reverse flex-sm-column-reverse flex-lg-row align-items-center">
                                <div class="col-lg-6 col-12 primary-button text-center text-lg-left">
                                    <a href="https://specials.unison.audio/unison-midi-wizard"
                                       class="badge badge-pill badge-success view-deal">view this deal</a>
                                </div>
                                <?php if ($product->is_on_sale() && $product->product_type == 'variable') : ?>
                                    <?php
                                    $available_variations = $product->get_available_variations();
                                    $maximumper = 0;
                                    for ($i = 0; $i < count($available_variations); ++$i) {
                                        $variation_id = $available_variations[$i]['variation_id'];
                                        $variable_product1 = new WC_Product_Variation($variation_id);
                                        $regular_price = $variable_product1->regular_price;
                                        $sales_price = $variable_product1->sale_price;
                                        $percentage = round(((($regular_price - $sales_price) / $regular_price) * 100), 1);
                                        if ($percentage > $maximumper) {
                                            $maximumper = $percentage;
                                        }
                                    }
                                    // echo $price . sprintf(__('%s OFF', 'woocommerce'), $maximumper . '%');
                                    ?>
                                    <div class="col-lg-6 col-12 prices mb-4 mb-sm-0 d-flex flex-sm-row">
                                        <p class="price-warning font-weight-bold mr-0">
                                            <s>$<?php echo $sales_price; ?></s></p>
                                        <p class="price text-white font-weight-bold">
                                            $<?php echo $product->regular_price; ?></p>
                                    </div>
                                <?php elseif ($product->is_on_sale() && $product->product_type == 'simple') : ?>
                                    <div class="col-lg-6 col-12 prices mb-4 mb-sm-0 d-flex flex-sm-row">
                                        <p class="old-price price-warning font-weight-bold mr-0">
                                            <s>$<?php echo $product->sale_price; ?></s></p>
                                        <p class="price text-white font-weight-bold">
                                            $<?php echo $product->regular_price; ?></p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                </div>
                <?php
                $i++;
                endwhile; ?>
            </div>
        </section> -->
    <section class="p-0">
        <div class="container">
            <div class="col-xxxl-9 col-xxl-9 col-xl-11 col-lg-11 col-md-11 col-sm-12 mx-auto bundles-cards">
                <a href="https://specials.unison.audio/fp-unison-famous-midi-chord-bundle">
                    <div class="row bg-secondary bundle-card text-white green-glow">
                        <div class="col-xs-12 col-sm-12 col-lg-6 p-0">
                            <div class="bundle-card-img"
                                style="background-image: url(<?php bloginfo('template_url') ?>/assets/images/bundle-1.png);">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-lg-6 text-left d-flex flex-column bundle-card-text-col">
                            <p class="bundle-card-title font-weight-bold">Unison Famous MIDI <br> Chord Bundle</p>
                            <p class="bundle-card-text">Get your music played on repeat with these proven, plug & play
                                MIDI
                                chord progressions. Instantly start cranking out hits with jaw-dropping chord
                                progressions
                                from the biggest hits that have generated over 98 billion plays.</p>
                            <div class="d-flex flex-column-reverse flex-lg-row">
                                <div class="col-lg-6 p-0 text-center text-lg-left">
                                    <div class="badge badge-pill badge-success view-deal">view this deal</div>
                                </div>
                                <div class="align-items-center col-lg-6 d-flex p-0 prices">
                                    <p class="price-warning"><s>$291</s></p>
                                    <p class="price text-white font-weight-bold">$127</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="https://specials.unison.audio/fp-unison-midi-blueprint">
                    <div class="row bg-secondary bundle-card text-white green-glow ">
                        <div class="col-xs-12 col-sm-12 col-lg-6 p-0">
                            <div class="bundle-card-img"
                                style="background-image: url(<?php bloginfo('template_url') ?>/assets/images/bundle-2.png);">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-lg-6 text-left d-flex flex-column bundle-card-text-col">
                            <p class="bundle-card-title font-weight-bold">Unison MIDI Blueprint</p>
                            <p class="bundle-card-text">The ultimate blueprint to creating perfect chords in any genre,
                                finishing music consistently and making your music radio-worthy. With over 37,000
                                mind-blowing chords & progressions you'll have an infinite source of instant
                                inspiration and gain a huge unfair competitive edge.</p>
                            <div class="d-flex flex-column-reverse flex-lg-row">
                                <div class="col-lg-6 p-0 text-center text-lg-left">
                                    <div class="badge badge-pill badge-success view-deal">view this deal</div>
                                </div>
                                <div class="align-items-center col-lg-6 d-flex p-0 prices">
                                    <p class="price-warning"><s>$740</s></p>
                                    <p class="price text-white font-weight-bold">$297</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="https://specials.unison.audio/fp-unison-midi-melody-blueprint">
                    <div class="row bg-secondary bundle-card text-white green-glow ">
                        <div class="col-xs-12 col-sm-12 col-lg-6 p-0">
                            <div class="bundle-card-img"
                                style="background-image: url(<?php bloginfo('template_url') ?>/assets/images/bundle-3.png);">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-lg-6 text-left d-flex flex-column bundle-card-text-col">
                            <p class="bundle-card-title font-weight-bold">Unison MIDI Melody Blueprint</p>
                            <p class="bundle-card-text">The ultimate blueprint to creating hit melodies in any genre,
                                destroying 'beat block' and making your music hit-worthy. With over 2,400 unique,
                                mind-blowing, drag & drop melodies you'll instantly shortcut your way to making
                                hits with consistency.</p>
                            <div class="d-flex flex-column-reverse flex-lg-row">
                                <div class="col-lg-6 p-0 text-center text-lg-left">
                                    <div class="badge badge-pill badge-success view-deal">view this deal</div>
                                </div>
                                <div class="align-items-center col-lg-6 d-flex p-0 prices">
                                    <p class="price-warning"><s>$540</s></p>
                                    <p class="price text-white font-weight-bold">$197</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="https://specials.unison.audio/fp-unison-midi-drum-blueprint">
                    <div class="row bg-secondary bundle-card text-white green-glow ">
                        <div class="col-xs-12 col-sm-12 col-lg-6 p-0">
                            <div class="bundle-card-img"
                                style="background-image: url(<?php bloginfo('template_url') ?>/assets/images/bundle-4.png);">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-lg-6 text-left d-flex flex-column bundle-card-text-col">
                            <p class="bundle-card-title font-weight-bold">Unison MIDI Drum Blueprint</p>
                            <p class="bundle-card-text">The ultimate blueprint to creating perfect drum patterns in any
                                genre, mastering your workflow and making your music addictive. With over 5,300 unique,
                                pro-sounding, drag & drop drum patterns you'll create addictive tracks
                                that make people want to play your music on repeat.</p>
                            <div class="d-flex flex-column-reverse flex-lg-row">
                                <div class="col-lg-6 p-0 text-center text-lg-left">
                                    <div class="badge badge-pill badge-success view-deal">view this deal</div>
                                </div>
                                <div class="align-items-center col-lg-6 d-flex p-0 prices">
                                    <p class="price-warning"><s>$340</s></p>
                                    <p class="price text-white font-weight-bold">$147</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="https://specials.unison.audio/fp-unison-artist-series-bundle">
                    <div class="row bg-secondary bundle-card text-white green-glow ">
                        <div class="col-xs-12 col-sm-12 col-lg-6 p-0">
                            <div class="bundle-card-img"
                                style="background-image: url(<?php bloginfo('template_url') ?>/assets/images/bundle-5.png);">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-lg-6 text-left d-flex flex-column bundle-card-text-col">
                            <p class="bundle-card-title font-weight-bold">Unison Artist Series Bundle</p>
                            <p class="bundle-card-text">The ultimate shortcut to creating professional-sounding music. Get insider access to the 3,000+ signature sounds of 16 top producers responsible for over 120 million plays.</p>
                            <div class="d-flex flex-column-reverse flex-lg-row">
                                <div class="col-lg-6 p-0 text-center text-lg-left">
                                    <div class="badge badge-pill badge-success view-deal">view this deal</div>
                                </div>
                                <div class="align-items-center col-lg-6 d-flex p-0 prices">
                                    <p class="price-warning"><s>$459</s></p>
                                    <p class="price text-white font-weight-bold">$197</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="https://specials.unison.audio/fp-unison-serum-bundle">
                    <div class="row bg-secondary bundle-card text-white green-glow ">
                        <div class="col-xs-12 col-sm-12 col-lg-6 p-0">
                            <div class="bundle-card-img"
                                style="background-image: url(<?php bloginfo('template_url') ?>/assets/images/bundle-6.png);">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-lg-6 text-left d-flex flex-column bundle-card-text-col">
                            <p class="bundle-card-title font-weight-bold">Unison Serum Bundle</p>
                            <p class="bundle-card-text">The ultimate collection of 1,100+ professionally-designed,
                                powerful
                                Unison Serum presets. Instantly take your music to the next level by getting access to
                                all
                                the presets you need – modelled off the top tracks in each genre.</p>
                            <div class="d-flex flex-column-reverse flex-lg-row">
                                <div class="col-lg-6 p-0 text-center text-lg-left">
                                    <div class="badge badge-pill badge-success view-deal">view this deal</div>
                                </div>
                                <div class="align-items-center col-lg-6 d-flex p-0 prices">
                                    <p class="price-warning"><s>$484</s></p>
                                    <p class="price text-white font-weight-bold">$197</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <a href="https://specials.unison.audio/fp-unison-ultimate-one-shot-bundle">
                    <div class="row bg-secondary bundle-card text-white green-glow ">
                        <div class="col-xs-12 col-sm-12 col-lg-6 p-0">
                            <div class="bundle-card-img"
                                style="background-image: url(<?php bloginfo('template_url') ?>/assets/images/bundle-7.png);">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-lg-6 text-left d-flex flex-column bundle-card-text-col">
                            <p class="bundle-card-title font-weight-bold">Unison Ultimate One-Shot Bundle</p>
                            <p class="bundle-card-text">The new way to craft your signature sound, make your music stand out and get the recognition you deserve. With over 1,600 unique, professionally-designed one-shots – you'll get everything you need to become a top producer.</p>
                            <div class="d-flex flex-column-reverse flex-lg-row">
                                <div class="col-lg-6 p-0 text-center text-lg-left">
                                    <div class="badge badge-pill badge-success view-deal">view this deal</div>
                                </div>
                                <div class="align-items-center col-lg-6 d-flex p-0 prices">
                                    <p class="price-warning"><s>$431</s></p>
                                    <p class="price text-white font-weight-bold">$147</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>
</main>
<?php get_footer(); ?>