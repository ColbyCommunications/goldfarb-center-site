<?php
/**
 * Images list item template
 */
$settings = $this->get_settings_for_display();
$perPage = $settings['per_page'];
$cover_icon = ! empty( $settings['cover_icon'] ) ? sprintf( '<i class="%s"></i>', $settings['cover_icon'] ) : '';
$is_more_button = $settings['view_more_button'];
$is_lightbox = 'lightbox' == $this->__loop_item( array( 'item_image_link' ) ) ? true : false;

$item_instance = 'item-instance-' . $this->item_counter;

$more_item = ( $this->item_counter >= $perPage && filter_var( $is_more_button, FILTER_VALIDATE_BOOLEAN ) ) ? true : false;

$this->add_render_attribute( $item_instance, 'class', array(
	'jet-portfolio__item',
	! $more_item ? 'visible-status' : 'hidden-status',
) );

if ( 'justify' == $settings['layout_type'] ) {
	$this->add_render_attribute( $item_instance, 'class', $this->get_justify_item_layout() );
}

$this->add_render_attribute( $item_instance, 'data-slug', $this->get_item_slug_list() );

$link_instance = 'link-instance-' . $this->item_counter;

$this->add_render_attribute( $link_instance, 'class', array(
	'jet-portfolio__link',
	// Ocean Theme lightbox compatibility
	class_exists( 'OCEANWP_Theme_Class' ) ? 'no-lightbox' : '',
) );

$link_href = $is_lightbox
	? $this->__loop_item( array( 'item_image', 'url' ) )
	: $this->__loop_item( array( 'item_button_url', 'url' ) );

$this->add_render_attribute( $link_instance, 'href', $link_href );

if ( $is_lightbox ) {
	$this->add_render_attribute( $link_instance, 'data-elementor-open-lightbox', 'yes' );
}

?>
<article <?php echo $this->get_render_attribute_string( $item_instance ); ?>>
	<div class="jet-portfolio__inner">
		<a <?php echo $this->get_render_attribute_string( $link_instance ); ?>>
			<div class="jet-portfolio__image">
				<?php echo $this->__loop_image_item(); ?>
				<div class="jet-portfolio__image-loader"><span></span></div>
				<div class="jet-portfolio__cover"><?php echo $cover_icon; ?></div>
			</div>
		</a>
	</div>
</article><?php

$this->item_counter++;
?>
