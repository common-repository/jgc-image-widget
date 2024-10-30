<?php
/**
 * Widget to display an image.
 *
 * @author GalussoThemes
 * @link https://galussothemes.com
 * @package JGC Image Widget
 */

/**
 * Sanitize HTML text.
 *
 * @since 1.0.0
 * @param string $input HTML text.
 */
function jgcwiw_sanitize_textarea( $input ) {

	return wp_kses_post( force_balance_tags( $input ) );

}

add_action( 'admin_enqueue_scripts', 'jgcwiw_enqueue_upload' );
/**
 * Enqueue scripts.
 *
 * @since 1.0.0
 */
function jgcwiw_enqueue_upload() {

	wp_enqueue_script( 'jgcwiw-widget-image-script', plugins_url( '../js/jgc-widget-image-widget.js', __FILE__ ), array( 'jquery' ), false, true );

	wp_enqueue_media();

}

add_action( 'widgets_init', 'jgcwiw_image_widget' );
/**
 * Register widget.
 *
 * @since 1.0.0
 */
function jgcwiw_image_widget() {

	register_widget( 'Jgcwiw_Widget_Image' );

}

class Jgcwiw_Widget_Image extends WP_Widget {

	/**
	 * Sets up a new widget instance.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		$widget_ops = array(
			'classname'   => 'Jgcwiw_Widget_Image',
			'description' => __( 'Image Widget.', 'jgc-image-widget' ),
		);

		parent::__construct( 'Jgcwiw_Widget_Image', __( '(JGC) Image Widget', 'jgc-image-widget' ), $widget_ops );
	}

	/**
	 * Outputs the settings form for the widget.
	 *
	 * @since 1.0.0
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {

		$defaults = array(
			'title'          => '',
			'url_imagen'     => '',
			'css_class'      => '',
			'id_imagen'      => '',
			'img_max_width'  => '100',
			'centered_image' => '',
			'texto_imagen'   => '',
			'texto_centrado' => '',
			'link_imagen'    => '',
			'target_blank'   => '',
			'rel_nofollow'   => '',
			'attr_alt'       => '',
			'attr_title'     => '',
		);

		$instance = wp_parse_args( (array) $instance, $defaults );

		$title          = $instance ['title'];
		$url_imagen     = $instance ['url_imagen'];
		$css_class      = $instance ['css_class'];
		$id_imagen      = $instance ['id_imagen'];
		$img_max_width  = $instance ['img_max_width'];
		$centered_image = $instance ['centered_image'];
		$texto_imagen   = $instance ['texto_imagen'];
		$texto_centrado = $instance ['texto_centrado'];
		$link_imagen    = $instance ['link_imagen'];
		$target_blank   = $instance ['target_blank'];
		$rel_nofollow   = $instance ['rel_nofollow'];
		$attr_alt       = $instance ['attr_alt'];
		$attr_title     = $instance ['attr_title'];
		?>

		<p><?php esc_html_e( 'Widget Title', 'jgc-image-widget' ); ?><br />
			<input class="widefat"
			id="<?php echo $this->get_field_id( 'title' ); ?>"
			name="<?php echo $this->get_field_name( 'title' ); ?>"
			type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>

		<p>
			<input class="widefat"
			id="numero_widget"
			name="numero_widget"
			type="hidden" value="<?php echo $this->number; ?>" />
		</p>

		<p>
			<input class="widefat"
			id="url_imagen_widget_<?php echo $this->number; ?>"
			name="<?php echo $this->get_field_name( 'url_imagen' ); ?>"
			type="hidden" value="<?php echo esc_url( $url_imagen ); ?>" />
		</p>

		<p>
			<input class="widefat"
			id="id_imagen_widget_<?php echo $this->number; ?>"
			name="<?php echo $this->get_field_name( 'id_imagen' ); ?>"
			type="hidden" value="<?php echo $id_imagen; ?>" />
		</p>

		<p>
			<input id="button_imagen_widget"
			name="button_imagen_widget_<?php echo $this->number; ?>"
			type="button" class="button-img-widget-upload button-primary"
			value="<?php esc_html_e( 'Select image... ', 'jgc-image-widget' ); ?>" style="text-align: center; width: 100%;" />
		</p>

		<div>
		<img id="img_imagen_widget_<?php echo $this->number; ?>" class="img-form" style="width:100%; height:auto;" src="<?php echo esc_url( $url_imagen ); ?>" alt="" />
		</div>

		<div>
			<?php
			$meta_img = wp_get_attachment_metadata( $id_imagen );
			?>
			<div id="img_info_<?php echo $this->number; ?>">
			<?php
			if ( ! empty( $meta_img ) ) {
				echo $meta_img['width'] . 'x' . $meta_img['height'];
			}
			?>
			</div>
		</div>

		<p><?php esc_html_e( 'Max width (relative to container)', 'jgc-image-widget' ); ?><br>
			<input type="number" max="100" min="10" step="2" size="3"
			name="<?php echo $this->get_field_name( 'img_max_width' ); ?>"
			value="<?php echo esc_attr( $img_max_width ); ?>" style="width:80%;" /> %
		<br>

		<input name="<?php echo $this->get_field_name( 'centered_image' ); ?>" type="checkbox"
		<?php echo checked( $centered_image, 'on', false ); ?> /> <?php esc_html_e( 'Centered image', 'jgc-image-widget' ); ?>
		</p>

		<p><?php esc_html_e( 'Image link', 'jgc-image-widget' ); ?>: &nbsp;
			<input class="widefat"
			name="<?php echo $this->get_field_name( 'link_imagen' ); ?>"
			type="text" value="<?php echo esc_attr( $link_imagen ); ?>" />

		<input name="<?php echo $this->get_field_name( 'target_blank' ); ?>" type="checkbox"
		<?php echo checked( $target_blank, 'on', false ); ?> /> <?php esc_html_e( 'Open in new tab', 'jgc-image-widget' ); ?><br />

		<input name="<?php echo $this->get_field_name( 'rel_nofollow' ); ?>" type="checkbox"
		<?php echo checked( $rel_nofollow, 'on', false ); ?> /> rel="nofollow"
		</p>

		<p><?php esc_html_e( 'Image Alternative Text', 'jgc-image-widget' ); ?><br />
			<input class="widefat"
			name="<?php echo $this->get_field_name( 'attr_alt' ); ?>"
			type="text" value="<?php echo esc_attr( $attr_alt ); ?>" />
		</p>

		<p><?php esc_html_e( 'Image Title Attribute', 'jgc-image-widget' ); ?><br />
			<input class="widefat"
			name="<?php echo $this->get_field_name( 'attr_title' ); ?>"
			type="text" value="<?php echo esc_attr( $attr_title ); ?>" />
		</p>

		<p><?php esc_html_e( 'Image caption', 'jgc-image-widget' ); ?>: &nbsp;
			<textarea class="widefat"
			name="<?php echo $this->get_field_name( 'texto_imagen' ); ?>"
			rows="5"><?php echo esc_attr( $texto_imagen ); ?></textarea><br />

		<input name="<?php echo $this->get_field_name( 'texto_centrado' ); ?>" type="checkbox"
		<?php echo checked( $texto_centrado, 'on', false ); ?> /> <?php esc_html_e( 'Centered text', 'jgc-image-widget' ); ?>
		</p>

		<p><?php esc_html_e( 'CSS classes (advanced)', 'jgc-image-widget' ); ?><br />
			<input class="widefat"
			name="<?php echo $this->get_field_name( 'css_class' ); ?>"
			type="text" value="<?php echo esc_attr( $css_class ); ?>" placeholder="class1 class2" />
			<br><i>(<?php esc_html_e( 'You can add several CSS classes separated by spaces', 'jgc-image-widget' ); ?>)</i>
		</p>

		<p><a style="font-style: italic; color:#919191; text-decoration: none;" href="https://galussothemes.com/wordpress-themes" target="_blank"><?php esc_html_e( 'Take a look to our Themes', 'jgc-facebook-page-plugin' ); ?> &raquo;</a></p><hr>

		<?php
	}

	/**
	 * Handles updating settings for the current widget instance.
	 *
	 * @since 1.0.0
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Updated settings to save.
	 */
	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['title']          = sanitize_text_field( $new_instance['title'] );
		$instance['url_imagen']     = esc_url( $new_instance['url_imagen'] );
		$instance['id_imagen']      = sanitize_text_field( $new_instance['id_imagen'] );
		$instance['img_max_width']  = sanitize_text_field( $new_instance['img_max_width'] );
		$instance['centered_image'] = ( ! empty( $new_instance['centered_image'] ) ) ? strip_tags( $new_instance['centered_image'] ) : '';
		$instance['texto_imagen']   = jgcwiw_sanitize_textarea( $new_instance['texto_imagen'] );
		$instance['texto_centrado'] = ( ! empty( $new_instance['texto_centrado'] ) ) ? strip_tags( $new_instance['texto_centrado'] ) : '';
		$instance['link_imagen']    = esc_url( $new_instance['link_imagen'] );
		$instance['target_blank']   = ( ! empty( $new_instance['target_blank'] ) ) ? strip_tags( $new_instance['target_blank'] ) : '';
		$instance['rel_nofollow']   = ( ! empty( $new_instance['rel_nofollow'] ) ) ? strip_tags( $new_instance['rel_nofollow'] ) : '';
		$instance['attr_alt']       = sanitize_text_field( $new_instance['attr_alt'] );
		$instance['attr_title']     = sanitize_text_field( $new_instance['attr_title'] );
		$instance['css_class']      = sanitize_text_field( $new_instance['css_class'] );

		return $instance;
	}

	/**
	 * Outputs the content for the current widget instance.
	 *
	 * @since 1.0.0
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current widget instance.
	 */
	public function widget( $args, $instance ) {

		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		echo $args['before_widget'];

		$title          = ! empty( $instance['title'] ) ? apply_filters( 'widget_title', $instance['title'] ) : '';
		$url_imagen     = ! empty( $instance['url_imagen'] ) ? $instance['url_imagen'] : '';
		$id_imagen      = ! empty( $instance['id_imagen'] ) ? $instance['id_imagen'] : '';
		$img_max_width  = ! empty( $instance['img_max_width'] ) ? $instance['img_max_width'] : '';
		$centered_image = ! empty( $instance['centered_image'] ) ? $instance['centered_image'] : '';
		$texto_imagen   = ! empty( $instance['texto_imagen'] ) ? $instance['texto_imagen'] : '';
		$texto_centrado = ! empty( $instance['texto_centrado'] ) ? $instance['texto_centrado'] : '';
		$link_imagen    = ! empty( $instance['link_imagen'] ) ? $instance['link_imagen'] : '';
		$target_blank   = ! empty( $instance['target_blank'] ) ? $instance['target_blank'] : '';
		$rel_nofollow   = ! empty( $instance['rel_nofollow'] ) ? $instance['rel_nofollow'] : '';
		$attr_alt       = ! empty( $instance['attr_alt'] ) ? $instance['attr_alt'] : '';
		$attr_title     = ! empty( $instance['attr_title'] ) ? $instance['attr_title'] : '';
		$css_class      = ! empty( $instance['css_class'] ) ? 'class="' . $instance['css_class'] . '"' : '';

		if ( ! empty( $title ) ) {
			echo $args['before_title'] . esc_html( $title ) . $args['after_title'];
		}

		$alt = ( '' !== $attr_alt ) ? ' alt="' . $attr_alt . '"' : '';
		$tit = ( '' !== $attr_title ) ? ' title="' . $attr_title . '"' : '';

		$attrs_imagen = $alt . $tit;

		$target          = ( 'on' === $target_blank ) ? ' target="_blank"' : '';
		$rel_nofollow    = ( 'on' === $rel_nofollow ) ? ' rel="nofollow"' : '';
		$centrado        = ( 'on' === $texto_centrado ) ? 'text-align:center' : '';
		$imagen_centrada = ( 'on' === $centered_image ) ? 'text-align:center' : '';

		$num = $this->number;
		?>

		<style type="text/css">
			.wrapper-widget-imagen {
				overflow:hidden;
				color:inherit !important;
			}
			.inner-imagen-del-widget-<?php echo $num; ?> {
				<?php echo $imagen_centrada; ?>
			}
			.wrapper-imagen-del-widget-<?php echo $num; ?> {
				width:<?php echo $img_max_width; ?>%;
				display: inline-block; /* para poder centrarlo */
			}
			.wrapper-imagen-del-widget-<?php echo $num; ?> img {
				width: 100% !important;
				height: auto;
			}
			.wrapper-texto-imagen {
				padding:5px;
			}
		</style>

		<div class="wrapper-widget-imagen">
			<div class="inner-imagen-del-widget-<?php echo $num; ?>">
			<div class="wrapper-imagen-del-widget-<?php echo $num; ?>">
				<?php
				if ( ! empty( $link_imagen ) ) {
					?>
					<a href="<?php echo $link_imagen; ?>"<?php echo $target . $rel_nofollow; ?>>
					<?php
				}
				?>

				<img <?php echo $css_class . $attrs_imagen; ?> src="<?php echo $url_imagen; ?>">

				<?php
				if ( ! empty( $link_imagen ) ) {
					echo '</a>';
				}
				?>
			</div><!-- .wrapper-imagen-del-widget -->
			</div><!-- .inner-imagen-del-widget -->

			<?php if ( ! empty( $texto_imagen ) ) { ?>
			<div class="wrapper-texto-imagen" style=" <?php echo $centrado; ?>">
				<?php echo $texto_imagen; ?>
			</div>
			<?php } ?>

		</div><!-- wrapper-widget-imagen -->

		<?php

		echo $args['after_widget'];
	}

}
