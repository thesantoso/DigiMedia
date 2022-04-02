<?php
/** Instagram grid */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'pixwell_widget_sb_instagram' ) ) :
	class pixwell_widget_sb_instagram extends WP_Widget {

		function __construct() {
			$widget_ops = array(
				'classname'   => 'widget-sb-instagram',
				'description' => esc_attr__( '[Sidebar Widget] Display Instagram grid images in the sidebar.', 'pixwell-core' )
			);
			parent::__construct( 'sb_instagram', esc_attr__( '- [Sidebar] Instagram Grid -', 'pixwell-core' ), $widget_ops );
		}

		function widget( $args, $instance ) {

			echo $args['before_widget'];

			$instance = wp_parse_args( $instance, array(
				'title'           => '',
				'user_name'       => '',
				'instagram_token' => '',
				'total_images'    => 9,
				'total_cols'      => 'rb-c3',
				'footer_intro'    => '',
				'footer_url'      => '#',
			) );

			$instance['title']    = apply_filters( 'widget_title', $instance['title'], 12 );
			$instance['cache_id'] = $args['widget_id'];
			$data_images          = array();

			if ( ! empty( $instance['title'] ) ) {
				echo $args['before_title'] . esc_html( $instance['title'] ) . $args['after_title'];
			}

			if ( ! empty( $instance['user_name'] ) ) {
				$data_images = pixwell_data_instagram_no_token( $instance );
			}

			if ( ( ! array_filter( $data_images ) || ! empty( $data_images['error'] ) ) && ! empty( $instance['instagram_token'] ) ) {
				$data_images = pixwell_data_instagram_token( $instance );
			} ?>
			<div class="instagram-grid layout-default">
				<?php if ( ! empty( $data_images['error'] ) ) :
					if ( current_user_can( 'install_plugins' ) ) : echo '<div class="rb-error">' . esc_html( $data_images['error'] ) . '</div>'; endif;
				else :
					$data_images = array_slice( $data_images, 0, $instance['total_images'] ); ?>
					<div class="grid-holder">
						<?php foreach ( $data_images as $image ) : ?>
                            <div class="grid-el <?php echo esc_attr( $instance['total_cols'] ) ?>">
								<?php if ( ! empty( $image['thumbnail_src'] ) ) :
									$image_size = pixwell_getimagesize( $image['thumbnail_src'] );
                                    ?>
                                    <div class="instagram-box">
                                        <a href="<?php echo esc_html( $image['link'] ); ?>" target="_blank" rel="noopener nofollow">
                                            <img src="<?php echo esc_url( $image['thumbnail_src'] ); ?>" alt="<?php echo esc_attr( $image['caption'] ); ?>" loading="lazy" width="<?php if ( ! empty( $image_size[0] ) ) { echo esc_attr( $image_size[0] ); } ?>" height="<?php if ( ! empty( $image_size[1] ) ) { echo esc_attr( $image_size[1] ); } ?>">
                                        </a>
                                        <div class="box-content">
											<?php if ( ! empty( $image['likes'] ) ) : ?>
                                                <span class="likes"><i class="rbi rbi-heart"></i><?php echo esc_html( $image['likes'] ); ?></span>
											<?php endif;
											if ( ! empty( $image['comments'] ) ) : ?>
                                                <span class="comments"><i class="rbi rbi-chat-bubble"></i><?php echo esc_html( $image['comments'] ); ?></span>
											<?php endif; ?>
                                        </div>
                                    </div>
								<?php endif; ?>
                            </div>
						<?php endforeach; ?>
					</div>
					<?php if ( ! empty( $instance['footer_intro'] ) ) : ?>
						<div class="grid-footer">
							<a href="<?php echo esc_url( $instance['footer_url'] ); ?>" target="_blank" rel="noopener nofollow"><?php echo wp_kses_post( $instance['footer_intro'] ) ?></a>
						</div>
					<?php endif;
				endif; ?>
			</div>
			<?php echo $args['after_widget'];
		}

		function update( $new_instance, $old_instance ) {

			$instance                    = $old_instance;
			$instance['title']           = esc_attr( $new_instance['title'] );
			$instance['user_name']       = esc_attr( $new_instance['user_name'] );
			$instance['instagram_token'] = esc_attr( $new_instance['instagram_token'] );
			$instance['total_images']    = absint( esc_attr( $new_instance['total_images'] ) );
			$instance['total_cols']      = esc_attr( $new_instance['total_cols'] );
			$instance['footer_intro']    = wp_kses_post( $new_instance['footer_intro'] );
			$instance['footer_url']      = esc_url( $new_instance['footer_url'] );

			delete_transient( 'pixwell_instagram_cache' );

			return $instance;
		}


		function form( $instance ) {

			$defaults = array(
				'title'           => esc_html__( 'Instagram', 'pixwell-core' ),
				'user_name'       => '',
				'instagram_token' => '',
				'total_images'    => 9,
				'total_cols'      => 'rb-c3',
				'footer_intro'    => esc_html__( 'Follow Us on @ Instagram', 'pixwell-core' ),
				'footer_url'      => '#',
			);

			$instance = wp_parse_args( (array) $instance, $defaults ); ?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><strong><?php esc_html_e( 'Title:', 'pixwell-core' ) ?></strong></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>"/>
			</p>
			<h3><?php esc_html_e( 'Easy Method', 'pixwell-core' ); ?></h3>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'user_name' ) ); ?>"><?php esc_html_e( '@Username or #Tag:', 'pixwell-core' ) ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'user_name' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'user_name' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['user_name'] ); ?>"/>
				<em><?php esc_html_e( 'Input your Instagram username or tags (ie: #technology). Maximum is 12 images.' ); ?></em>
			</p>
			<p><strong>PLEASE NOTE:</strong>The Instagram server will limit connection, so this method may not work with shared hosting plans. Please try to use the token method below.</p>
			<h3><?php esc_html_e('Token Method', 'pixwell-core'); ?></h3>
			<p><?php echo sprintf(esc_html__('Refer to %s to create an Instagram token','pixwell-core'), '<a target="_blank" href="https://help.themeruby.com/pixwell/how-to-create-a-new-instagram-access-token/">DOCUMENTATION</a>'); ?></p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'instagram_token' ) ); ?>"><?php esc_html_e( 'Instagram Token:', 'pixwell-core' ) ?></label>
				<textarea rows="5" cols="20" id="<?php echo esc_attr( $this->get_field_id( 'instagram_token' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'instagram_token' ) ); ?>" class="widefat"><?php echo $instance['instagram_token']; ?></textarea>
			</p>
			<h3><?php esc_html_e('Grid Layout', 'pixwell-core'); ?></h3>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'total_images' ) ); ?>"><?php esc_html_e( 'Total Images:', 'pixwell-core' ) ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'total_images' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'total_images' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['total_images'] ); ?>"/>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'total_cols' ) ); ?>"><?php esc_html_e( 'Number of Columns:', 'pixwell-core' ); ?></label>
				<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'total_cols' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'total_cols' ) ); ?>">
					<option value="rb-c2" <?php if ( ! empty( $instance['total_cols'] ) && $instance['total_cols'] == 'rb-c2' ) echo "selected=\"selected\""; else echo ""; ?>><?php esc_html_e( '2 columns', 'pixwell-core' ); ?></option>
					<option value="rb-c3" <?php if ( ! empty( $instance['total_cols'] ) && $instance['total_cols'] == 'rb-c3' ) echo "selected=\"selected\""; else echo ""; ?>><?php esc_html_e( '3 columns', 'pixwell-core' ); ?></option>
					<option value="rb-c4" <?php if ( ! empty( $instance['total_cols'] ) && $instance['total_cols'] == 'rb-c4' ) echo "selected=\"selected\""; else echo ""; ?>><?php esc_html_e( '4 columns', 'pixwell-core' ); ?></option>
				</select>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'footer_intro' ) ); ?>"><?php esc_html_e( 'Footer Description (Allow Raw HTMl):', 'pixwell-core' ) ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'footer_intro' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'footer_intro' ) ); ?>" type="text" value="<?php echo wp_kses_post( $instance['footer_intro'] ); ?>"/>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'footer_url' ) ); ?>"><strong><?php esc_html_e( 'Footer Link:', 'pixwell-core' ) ?></strong></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'footer_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'footer_url' ) ); ?>" type="text" value="<?php echo esc_url( $instance['footer_url'] ); ?>"/>
			</p>
		<?php
		}
	}
endif;