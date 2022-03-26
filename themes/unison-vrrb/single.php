<?php
get_header();
?>

<?php if (have_posts()) : ?>
<!-- posts -->
<main class="flex-grow-1 bg-white">

    <?php while (have_posts()) : the_post(); ?>

    <section class="text-dark blog-main p-0">
        <div class="container">
            <div class="row">
                <div class="col-xxxl-9 col-xxl-9 col-xl-11 col-lg-11 col-md-11 col-sm-12 mx-auto">
                    <div class="row">
                        <div class="col">
                            <a href="/blog">
                                <div class="back-arrow">
                                    <div>
                                        <i class="fa fa-long-arrow-left mr-2"></i>
                                    </div>
                                    <p>Back to Blog</p>
                                </div>
                            </a>
                            <p class="blog-article-tagline"> <?php
                                        $categories = get_the_category();
                                        if (!empty($categories)) {
                                            echo esc_html($categories[0]->name);
                                        } ?></p>
                            <h1 class="text-dark"><?php the_title(); ?></h1>
                            <div class="blog-article-date text-dark text-uppercase d-flex align-items-center">
                                <span><?php the_date('F j, Y'); ?></span>
                                <i class="fa fa-circle"></i>
                                <p> by <?php the_author_meta('first_name'); ?></p>
                            </div>
                            <p class="blog-article-text text-grey">
                                <?php //echo wp_trim_words(get_the_content(), 30, '...'); ?></p>
                        </div>
                    </div>
                    <?php if (has_post_thumbnail()) : ?>
                    <div class="row blog-article-image"
                        style="background-image: url(<?php echo get_the_post_thumbnail_url(); ?>);"
                        alt="<?php the_title_attribute(); ?>">
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
    <section class="text-dark p-0 blog-article-section">
        <div class="container">
            <div class="row">
                <div class="col-xxxl-9 col-xxl-9 col-xl-11 col-lg-11 col-md-11 col-sm-12 mx-auto">
                    <div class="row">
                        <div class="blog-article-share-icons">
                            <?php
                      // Get current page URL
                      $sb_url = urlencode(get_permalink());

                      // Get current page title
                      $sb_title = str_replace( ' ', '%20', get_the_title());

                      // Get Post Thumbnail for pinterest
                      $sb_thumb = get_the_post_thumbnail_src(get_the_post_thumbnail());
                      ?>
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $sb_url; ?>"><img
                                    src="<?php bloginfo('template_url')?>/assets/images/fb-share.svg" alt=""
                                    srcset=""></a>
                            <a
                                href="https://twitter.com/intent/tweet?text=<?php echo $sb_title; ?>&amp;url=<?php echo $sb_url; ?>&amp;via=wpvkp">
                                <img src="<?php bloginfo('template_url')?>/assets/images/tw-share.svg" alt=""
                                    srcset=""></a>
                            <p class="copy-btn"><img src="<?php bloginfo('template_url')?>/assets/images/link-share.svg"
                                    alt="" srcset=""></p>
                        </div>
                        <div class="col-xl-9 col-lg-9 mx-auto blog-content">
                            <?php the_content(); ?>

                            <?php comments_template(); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php endwhile; ?>
    <?php wp_reset_postdata(); ?>

    <section class="p-0">
        <div class="container">
            <div class="row">
                <div class="col-xxxl-9 col-xxl-9 col-xl-11 col-lg-11 col-md-11 col-sm-12 mx-auto">
                    <div class="blog-list bg-white">
                        <div class="row">
                            <div class="recommended-posts-border"></div>
                            <?php
                                $categories = get_the_category(); ?>
                            <?php
                                // the query
                                $the_query = new WP_Query(array(
                                    'posts_per_page' => 3,
                                    'post__not_in' => array(get_the_ID())
                                ));
                                ?>

                            <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
                            <div class="col-lg-4">
                                <a href="<?php the_permalink(); ?>">
                                    <div class="bg-transparent blog-item">
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
                                                    <p>by <?php the_author_meta('first_name'); ?></p>
                                                </div>
                                                <p class="blog-list-title text-truncate line-clamp">
                                                    <?php the_title(); ?>
                                                </p>
                                                <p class="text-grey blog-list-text text-truncate line-clamp">
                                                    <?php echo get_the_excerpt(); ?></p>
                                                <div style="display: flex; flex-direction: row; text-align: left;">
                                                    <p class="text-success read-more">Read More</p>
                                                    <div>
                                                        <i class="fa fa-long-arrow-right ml-2 text-success mt-1 "></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?php endwhile; ?>
                            <?php wp_reset_postdata(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php wp_reset_postdata(); ?>

<?php else: ?>

<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>

<?php endif;
?>
<script>
function Copy() {
    var inputc = document.body.appendChild(document.createElement("input"));
    inputc.value = window.location.href;
    inputc.focus();
    inputc.select();
    document.execCommand('copy');
    inputc.parentNode.removeChild(inputc);
    alert("URL Copied.");
}

jQuery(document).ready(function(){
    jQuery('.copy-btn').on("click", function(){
        value = window.location.href; //Upto this I am getting value
 
        var $temp = jQuery("<input>");
          jQuery("body").append($temp);
          $temp.val(value).select();
          document.execCommand("copy");
          $temp.remove();
          alert("URL Copied.");
    })
})

</script>
<?php
get_footer();
?>