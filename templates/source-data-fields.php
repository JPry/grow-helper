<?php
declare( strict_types=1 );

use Automattic\WooCommerce\Grow\OrderAttributePrototype\Internal\Plugin;

defined( 'ABSPATH' ) || exit;

/**
 * Variables used in this file.
 *
 * @see Plugin
 *
 * @var Plugin         $this
 * @var WC_Order       $order
 * @var WC_Meta_Data[] $meta
 */

$meta = array_filter(
	$order->get_meta_data(),
	function ( WC_Meta_Data $meta ) {
		return str_starts_with( $meta->key, '_grow_' );
	}
);

?>

<div class="source_data form-field form-field-wide">
	<h3><?php _e( 'Source Info', 'grow-oap' ); ?></h3>

	<?php
	foreach ( $meta as $item ) {
		switch ( $item->key ) {
			case '_grow_referrer':
				$label = __( 'Referrer', 'grow-oap' );
				break;

			case '_grow_source_type':
				$label = __( 'Source type', 'grow-oap' );
				break;

			default:
				$label = str_replace( [ '_grow_', '_' ], [ '', ' ' ], $item->key );
				$label = ucwords( $label );
				break;
		}
		?>
		<p class="form-field form-field-wide">
			<label><?php echo esc_html( $label ); ?>:</label>
			<?php echo esc_html( $item->value ); ?>
		</p>
		<?php
	}
	?>
</div>
