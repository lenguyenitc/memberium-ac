<?php
get_header();
            ?>

    <?php if(have_posts() ) : ?> 

   
    <!-- posts -->
    <div class="cemeteries">

        <?php while(have_posts() ) : the_post(); ?>

            <!-- cemetery -->
            <div class="blog_main_wrap">

                <div class="blog_sidebar">
                  
                </div>

                <div class="blog_sec">
                    <!-- <h2><a href="<?php the_permalink()?>"><?php the_title(); ?></a></h2>
                    <?php the_content(); ?> -->
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
                             <span>
                            <?php 
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
                             <span><?php comments_number( 'no responses', 'one response', '% responses' ); ?></span>
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
                     
                       </div>
                       <!-- / .bp-content -->
                    </div>
                   
                   
                </div>

            </div>
            
            <?php comments_template(); ?>

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