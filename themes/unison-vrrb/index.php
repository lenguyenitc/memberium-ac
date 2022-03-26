<?php
get_header();
global $wp_query;


$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$args = array(
    'post_type' => 'post',
    'order' => 'DESC',
    'posts_per_page' => 7,
    'paged' => $paged
);

$the_query = new WP_Query($args);
?>

<?php if ($the_query->have_posts()) : ?>
<!-- posts -->
<div class="jumbotron blog-jumbotron text-white bg-light-blue-gradient mb-0 py-0">
    <div class="container">
        <div class="row">
            <div class="col-xxxl-9 col-xxl-9 col-xl-11 col-lg-11 col-md-11 col-sm-12 mx-auto">
                <div class="jumbo-blog">
                    <h1>Blog</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<main class="flex-grow-1 bg-white">

    <section class="p-0">
        <div class="container">
            <div class="row">
                <div class="col-xxxl-9 col-xxl-9 col-xl-11 col-lg-11 col-md-11 col-sm-12 mx-auto">
                    <?php if ($the_query->current_post != 0) : ?>
                    <div class="bg-white blog-list">
                        <div class="row blog-list-row">
                            <?php endif; ?>
                            <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
                            <?php if ($the_query->current_post == 0) : ?>

                            <div class="blog-front">
                                <a href="<?php the_permalink(); ?>">
                                    <div class="row">
                                        <div class="col-xxl-7 col-lg-6">
                                            <div class="blog-jumbo-image glow"
                                                style="background-image: url(<?php echo get_the_post_thumbnail_url($post_item['ID'], 'full'); ?>)"
                                                alt="Image caption">
                                                <p class="blog-tagline"><?php
                                                        $categories = get_the_category();
                                                        if (!empty($categories)) {
                                                            echo esc_html($categories[0]->name);
                                                        }
                                                        ?></p>
                                            </div>
                                        </div>
                                        <div class="col-xxl-5 col-lg-6 blog-main-triger-glow">
                                            <div class="blog-front-date d-flex align-items-center">
                                                <p><?php echo get_the_date('F j, Y'); ?></p>
                                                <i class="fa fa-circle"></i>
                                                <p>by UNISON</p>
                                            </div>
                                            <div>
                                                <h3 class="text-dark"><?php the_title(); ?></h3>
                                                <p
                                                    class="blog-front-text text-grey text-truncate line-clamp-blog-front">
                                                    <?php echo get_the_excerpt(); ?></p>
                                            </div>
                                            <div class="col-lg-6 col-12 primary-button text-center text-lg-left p-0">
                                                <div class="badge badge-pill badge-success read-more">read
                                                    more</div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <?php else : ?>
                            <div class="col-lg-4">
                                <div class="bg-transparent blog-item">
                                    <a href="<?php the_permalink(); ?>">
                                        <!-- Image -->
                                        <?php if (has_post_thumbnail()) : ?>
                                        <div class="blog-list-image glow"
                                            style="background-image: url(<?php echo get_the_post_thumbnail_url(); ?>);"
                                            alt="<?php the_title_attribute(); ?>">
                                            <p class="blog-item-tagline"><?php
                                                        $categories = get_the_category();
                                                        if (!empty($categories)) {
                                                            echo esc_html($categories[0]->name);
                                                            }?></p>
                                        </div>

                                        <?php endif; ?>
                                        <div class="row align-items-center text-dark blog-card triger-glow">
                                            <div class="col">
                                                <div
                                                    class="blog-list-date text-dark text-uppercase d-flex align-items-center">
                                                    <p><?php echo get_the_date('F j, Y'); ?></p>
                                                    <i class="fa fa-circle"></i>
                                                    <p>by UNISON</p>
                                                </div>
                                                <p class="blog-list-title text-truncate line-clamp">
                                                    <?php the_title(); ?>
                                                </p>
                                                <p class="text-grey blog-list-text text-truncate line-clamp">
                                                    <?php echo get_the_excerpt(); ?></p>
                                                <div style="display: flex; flex-direction: row; text-align: left">
                                                    <p class="text-success read-more">Read More</p>
                                                    <div>
                                                        <i class="fa fa-long-arrow-right ml-2 text-success mt-1"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>

                            <?php endif; ?>
                            <?php endwhile; ?>
                            <?php if ($the_query->current_post != 0) : ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
    <section class="p-0">
        <div class="blog-pagination">

            <?php
                $pagination = paginate_links(array(
                    'base' => get_pagenum_link(1) . '%_%',
                    'format' => 'page/%#%',
                    'type' => 'array',
                    'total' => $the_query->max_num_pages,
                    'mid_size' => 1,
                    //'current' => max(1, get_query_var('paged'))
                )); ?>

            <?php if (!empty($pagination)) : ?>
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <?php foreach ($pagination as $key => $page_link) : ?>
                    <li class="page-item<?php if (strpos($page_link, 'current') !== false) {
                                    echo ' active';
                                } ?>"><?php echo $page_link ?></li>
                    <?php endforeach ?>
                </ul>
            </nav>
            <?php endif ?>
        </div>
    </section>
</main>

<?php wp_reset_postdata(); ?>

<?php else: ?>

<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>

<?php endif;
get_footer();
?>