<?php
get_header();
        $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

        $args = array(
            'post_type' => 'post',
            'orderby' => 'title',
            'order' => 'ASC',
            'posts_per_page' => 10,
            'paged' => $paged
        );

        $the_query = new WP_Query($args);

    ?>

    <?php if( $the_query->have_posts() ) : ?> 

   
    <!-- posts -->
    <div class="cemeteries">

        <?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>

            <!-- cemetery -->
            <div class="blog_main_wrap">

                <div class="blog_sidebar">
                  
                </div>

                <div class="blog_sec">
                   
                    <div class="blog-post">
                       <!-- Image -->
                       <?php if ( has_post_thumbnail() ) : ?>
                        <a class="post-img" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                            <?php the_post_thumbnail(); ?>
                        </a>
                    <?php endif; ?>
                       <div class="bp-content">
                          <!-- Meta data -->
                          <div class="post-meta">
                             <div class="post-date">
                             <i class="fa fa-calendar-o"></i>
                             <span><?php the_date(); ?></span>
                             </div>
                             <div class="post-cat">
                             <i class="fa fa-list-alt"></i>
                             <span><?php 
                            $categories = get_the_category();
                            if ( ! empty( $categories ) ) {
                              echo esc_html( $categories[0]->name );   
                          } ?></span>
                             </div>
                             <div class="post-auth">
                             <i class="fa fa-user"></i>
                             <span><?php the_author_meta('first_name'); ?></span>
                             </div>
                             <a href="#" class="post-comments">
                             <i class="fa fa-comments-o"></i>
                             <span>12</span>
                             </a>
                          </div>
                          <!-- / .meta -->
                          <!-- Post Title -->
                          <a href="blog-post.html" class="post-title">
                             <h3><?php the_title();?></h3>
                          </a>
                          <!-- Blurb -->
                          <p class="blog_description"><?php the_content();?></p>
                          <!-- Link -->
                          <a href="<?php the_permalink();?>" class="btn btn-small blog_readmore">Read More</a>
                       </div>
                       <!-- / .bp-content -->
                    </div>
                   
                   
                </div>

            </div>
            <!-- /.cemetery -->

        <?php endwhile; ?>

    </div>
    <!-- /.cemetries -->

    <!-- options -->
    <div class="col-md-12 options border-bottom">

        <!-- pagination -->
        <ul class="pagination pull-right">
            <li><?php echo get_next_posts_link( 'Next Page', $the_query->max_num_pages ); ?></li>
            <li><?php echo get_previous_posts_link( 'Previous Page' ); ?></li>
        </ul>

    </div>
    <!-- /.options -->  

    <?php wp_reset_postdata(); ?>

    <?php else:  ?>

    <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>

    <?php endif; 
get_footer();
?>