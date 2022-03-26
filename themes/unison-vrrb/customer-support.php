<?php
/* Template Name: Customer support */
?>
<?php get_header(); ?>
    <div class="jumbotron text-white  bg-light-blue-gradient">
        <div class="container">
            <div class="row page-section-title-center col-xxxl-9 col-xxl-9 col-xl-11 col-xl-11 col-lg-11 col-md-11 col-sm-11 col-xs-11 mx-auto col-xxl-7 col-lg-9 col-sm-12 text-center pl-0 pr-0">
                <h1>Customer Support</h1>
            </div>
        </div>
    </div>
    <main class="flex-grow-1">

        <section class="container padding-74">
            <div class="col-xxxxl-9 col-xxl-9 col-xl-11 col-xl-11 col-lg-11 col-sm-11  col-md-11 col-sm-11 col-xs-11 mx-auto text-center p-0">
                <div class=" text-center mx-auto">
                    <div id="accordion" class="p-0 mt-4">
                        <?php $faqs = get_field('faquestions');
                        foreach ($faqs as $key => $faq) :?>
                        <?php if ($key == 0 ) : ?>
                            <div class="acordion-item pointer mb-4">
                                <div class="row mx-auto rounded-xs acc-close align-items-top"
                                     aria-expanded="false" id="collapse-accordion" data-toggle="collapse"
                                     data-target="#<?php echo $faq['id']; ?>">
                                    <div class="col-xl-11 col-lg-11  col-md-10 col-sm-10 col-xs-10  pl-0">
                                        <p class="text-left font-weight-bold pl-0">
                                            <?php echo($key + 1); ?>. <?php echo $faq['question'] ?>
                                        </p>
                                    </div>
                                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-right ">
                                        <img src="<?php bloginfo('template_url') ?>/assets/images/Vector.png"
                                             id="btn-down">
                                        <img src="<?php bloginfo('template_url') ?>/assets/images/Vector green.png"
                                             id="btn-up">
                                    </div>
                                </div>

                                <div id="<?php echo $faq['id']; ?>" data-parent="#accordion" class="collapse">
                                    <div class="text-left mx-auto acc-open">
                                        <p> <?php echo $faq['answer'] ?></p>
                                    </div>
                                </div>
                            </div>
                            <?php else : ?>
                                <div class="acordion-item pointer mb-4">
                                    <div class="row col-xxxl-12 col-xl-12 col-lg-12 col-sm-12 mx-auto rounded-xs alignb-items-top acc-close"
                                         aria-expanded="false" id="collapse-accordion" data-toggle="collapse"
                                         data-target="#<?php echo $faq['id']; ?>">
                                        <div class="col-xl-11 col-lg-11 col-md-10 col-sm-10 col-xs-10 pl-0">
                                            <p class="text-left font-weight-bold pl-0">
                                                <?php echo($key + 1); ?>. <?php echo $faq['question'] ?>
                                            </p>
                                        </div>
                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 text-right">
                                            <img src="<?php bloginfo('template_url') ?>/assets/images/Vector.png"
                                                 id="btn-down">
                                            <img src="<?php bloginfo('template_url') ?>/assets/images/Vector green.png"
                                                 id="btn-up">
                                        </div>
                                    </div>

                                    <div id="<?php echo $faq['id']; ?>" data-parent="#accordion" class="collapse">
                                        <div class="text-left row mx-auto acc-open">
                                            <p class="text-white"> <?php echo $faq['answer'] ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endif;?>
                        <?php endforeach; ?>
                    </div>

        </section>
    </main>
<?php get_footer(); ?>