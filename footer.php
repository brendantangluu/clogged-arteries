<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Clogged_Arteries
 */

?>

	<footer id="colophon" class="site-footer">
		<nav class="footer-navigation">
			<?php
				wp_nav_menu(
					array(
						'theme_location' => 'footer',
						)
					);
			?>
			<div class="site-info">
				<div class="cla-rights">
					<?php esc_html_e( '© Clogged Arteries ' . date("Y") . ' All Rights Reserved.', 'clogged-arteries' ); ?>
				</div>
				<nav class="cla-port-nav">
					<p><?php esc_html_e( 'Created by: ', 'clogged-arteries' ); ?></p>
					<a href="<?php echo esc_url( __( 'https://btech.codes', 'clogged-arteries' ) ); ?>">
						<?php esc_html_e( 'Brendan Tang-Luu', 'clogged-arteries' ); ?>
					</a>
					<a href="<?php echo esc_url( __( 'https://davidzhan.ca', 'clogged-arteries' ) ); ?>">
						<?php esc_html_e( 'David Zhan', 'clogged-arteries' ); ?>
					</a>
					<a href="<?php echo esc_url( __( 'https://uellemespinueva.com', 'clogged-arteries' ) ); ?>">
						<?php esc_html_e( 'Uellem Espinueva', 'clogged-arteries' ); ?>
					</a>
					<a href="<?php echo esc_url( __( 'https://klausdragon.com/', 'clogged-arteries' ) ); ?>">
						<?php esc_html_e( 'Ali Abbasi', 'clogged-arteries' ); ?>
					</a>
				</nav>
			</div><!-- .site-info -->
		</nav>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
