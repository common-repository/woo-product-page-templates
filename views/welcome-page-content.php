<p><?php _e('Thank you for installing our plugin.', $this->textname); ?></p>

<?php
// Disable core plugin welcome page.
add_option('vgse_welcome_redirect', 'no');

$steps = array();


if (!class_exists('VG_Page_Layouts')) {
	?>

	<p><?php _e('This plugin is the WooCommerce extension for "WP Page Templates" , which lets you add / remove sidebars to pages , create full width pages , and create layouts for landing pages.', $this->textname); ?></p>
	<?php
	$install_plugin_url = WC_Product_Page_Templates_Obj()->get_plugin_install_url('custom-page-templates-by-vegacorp');

	$steps['required_plugin'] = '<p>' . sprintf(__('Please install the <b>free plugin "WP Page Templates"</b>. <a href="%s" target="_blank" class="button install-plugin-trigger">Click here</a>', $this->textname), esc_url($install_plugin_url)) . '</p>';
}
if (!class_exists('WooCommerce')) {
	$install_plugin_url = WC_Product_Page_Templates_Obj()->get_plugin_install_url('woocommerce');

	$steps['required_plugin'] = '<p>' . sprintf(__('Please install <b>"WooCommerce"</b>. <a href="%s" target="_blank" class="button install-plugin-trigger">Click here</a>', $this->textname), esc_url($install_plugin_url)) . '</p>';
}
$steps['create_page'] = '<p>' . sprintf(__('Create a new WooCommerce product or Edit an Existing Product. <a href="%s" target="_blank" class="button">Click here</a>', $this->textname), esc_url(admin_url('post-new.php?post_type=product'))) . '</p>';
$steps['metabox_screenshot'] = '<p>' . __('In the product editor you will find the "page layout" box. There you can select if you want to make it full width, add sidebars, etc.', $this->textname) . '</p>';

$steps = apply_filters('vg_page_layout/frontend_editor/welcome_steps', $steps);

if (!empty($steps)) {
	echo '<ol class="steps">';
	foreach ($steps as $key => $step_content) {
		?>
		<li><?php echo $step_content; ?></li>		
		<?php
	}

	echo '</ol>';
}
?>
<script>

	jQuery('.install-plugin-trigger').click(function (e) {
		return !window.open(this.href, 'Install plugin', 'width=500,height=500');
	});
</script>