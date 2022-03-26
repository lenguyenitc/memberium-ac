<?php

	if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && 'comments.php' == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
		die ( esc_html__( 'This page cannot be opened directly!', 'corpus' ) );
	}

	if ( post_password_required() ) {
?>
		<div class="help">
			<p class="no-comments"><?php echo esc_html__( 'This post is password protected. Enter the password to view comments.', 'corpus' ); ?></p>
		</div>
<?php
		return;
	}
?>

<?php if ( have_comments() ) : ?>

	<!-- Comments -->
	<div id="eut-comments" class="eut-section">
		<h5 class="eut-comments-number">
			<?php comments_number( esc_html__( 'no comments', 'corpus' ), esc_html__( '1 comment', 'corpus' ), '% ' . esc_html__( 'comments', 'corpus' ) ); ?>
		</h5>
		<ol class="commentlist">
		<?php wp_list_comments( array(
                    'style'       => 'ol',
                    'short_ping'  => false,
                    'avatar_size' => 74,
                    'type'=> 'comment',
                    'callback'=>'unison_comment'
                ) ); ?>
		</ol>
	</div>
	<!-- End Comments -->

	<nav class="eut-comment-nav">
		<ul>
	  		<li><?php previous_comments_link(); ?></li>
	  		<li><?php next_comments_link(); ?></li>
		</ul>
	</nav>

<?php endif; ?>


<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'corpus' ); ?></p>

<?php endif; ?>



<?php if ( comments_open() ) : ?>

<?php
		$commenter = wp_get_current_commenter();
		$req = get_option( 'require_name_email' );

		$args = array(
			'id_form'           => 'commentform',
			'id_submit'         => 'eut-comment-submit-button',
			'title_reply'       => esc_html__( 'Leave a Reply', 'corpus' ),
			'title_reply_to'    => esc_html__( 'Leave a Reply to', 'corpus' ) . ' %s',
			'cancel_reply_link' => esc_html__( 'Cancel Reply', 'corpus' ),
			'label_submit'      => esc_html__( 'Submit Comment', 'corpus' ),

			'comment_field' =>
				'<div class="eut-form-textarea">'.
				'<textarea style="resize:none;" id="comment" name="comment" placeholder="' . esc_attr__( 'Your Comment Here...', 'corpus' ) . '" cols="45" rows="15" aria-required="true">' .
				'</textarea></div><div class="clear"></div>',

			'must_log_in' =>
				'<p class="must-log-in">' . esc_html__( 'You must be', 'corpus' ) .
				'<a href="' .  wp_login_url( get_permalink() ) . '">' . esc_html__( 'logged in', 'corpus' ) . '</a> ' . esc_html__( 'to post a comment.', 'corpus' ) . '</p>',

			'logged_in_as' =>
				'<p class="logged-in-as">' . '<span>'.  esc_html__('Logged in as','corpus') . '</span>' .
				'<a href="' . admin_url( 'profile.php' ) . '" class="loign_as_con"> ' . $user_identity . '</a>. ' .
				'<a class="loout_as_con" href="' . wp_logout_url( get_permalink() ) . '" title="' . esc_attr__( 'Log out of this account', 'corpus' ) . '"> ' . esc_html__( 'Log out', 'corpus' ) . '</a></p>',

			'comment_notes_before' =>
				'<p class="comment-notes">' .
				esc_html__( 'Your email address will not be published.', 'corpus' ) .
				'</p>',

			'comment_notes_after' => '' ,

			'fields' => apply_filters(
				'comment_form_default_fields',
				array(
					'author' =>
						'<div class="eut-one-third eut-form-input">' .
						'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '"' .
						' placeholder="' . esc_attr__( 'Name', 'corpus' ) . ' ' . ( $req ? esc_attr__( '(required)', 'corpus' ) : '' ) . '" />' .
						'</div>',

					'email' =>
						'<div class="eut-one-third eut-form-input">' .
						'<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '"' .
						' placeholder="' . esc_attr__( 'E-mail', 'corpus' ) . ' ' . ( $req ? esc_attr__( '(required)', 'corpus' ) : '' ) . '" />' .
						'</div>',

					'url' =>
						'<div class="eut-one-third eut-last-column eut-form-input">' .
						'<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '"' .
						' placeholder="' . esc_attr__( 'Website', 'corpus' )  . '" />' .
						'</div>',
					)
				),
		);
?>


			<?php
				//Use comment_form() with no parameters if you want the default form instead.
				comment_form( $args );
			?>


<?php endif;

//Omit closing PHP tag to avoid accidental whitespace output errors.
