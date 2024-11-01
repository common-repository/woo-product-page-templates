<?php

/*
  Plugin Name: WooCommerce Product Page Templates
  Plugin URI: https://wppagetemplates.com
  Description: Make product pages full width and add or remove sidebars.
  Version: 1.0.0
  Author: JoseVega
  Author Email: josevega@vegacorp.me
  License:

  Copyright 2011 JoseVega (josevega@vegacorp.me)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 2, as
  published by the Free Software Foundation.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

 */

require 'vendor/vg-plugin-sdk/index.php';

if (!class_exists('WC_Product_Page_Templates')) {

	class WC_Product_Page_Templates {

		static private $instance = false;
		var $args = array();
		var $version = '1.0.0';
		var $plugin_dir = __DIR__;

		private function __construct() {
			
		}

		function init() {

			$this->args = array(
				'main_plugin_file' => __FILE__,
				'show_welcome_page' => true,
				'welcome_page_file' => $this->plugin_dir . '/views/welcome-page-content.php',
				'logo' => plugins_url('/assets/imgs/logo.png', __FILE__),
				'plugin_name' => 'WooCommerce Product Page Templates',
				'plugin_prefix' => 'wcppt_',
				'plugin_version' => $this->version,
				'plugin_options' => get_option('vg_page_layout_in_use', false),
			);

			$this->vg_plugin_sdk = new VG_Freemium_Plugin_SDK($this->args);
			add_filter('vg_page_layout/allowed_post_types', array($this, 'allow_product_post_type'));
		}

		function get_plugin_install_url($plugin_slug) {
			$install_plugin_base_url = ( is_multisite() ) ? network_admin_url() : admin_url();
			$install_plugin_url = add_query_arg(array(
				's' => $plugin_slug,
				'tab' => 'search',
				'type' => 'term'
					), $install_plugin_base_url . '/plugin-install.php');
			return $install_plugin_url;
		}

		function allow_product_post_type($post_types) {
			$post_types[] = 'product';
			return $post_types;
		}

		/**
		 * Creates or returns an instance of this class.
		 *
		 * @return  Foo A single instance of this class.
		 */
		static function get_instance() {
			if (null == WC_Product_Page_Templates::$instance) {
				WC_Product_Page_Templates::$instance = new WC_Product_Page_Templates();
				WC_Product_Page_Templates::$instance->init();
			}
			return WC_Product_Page_Templates::$instance;
		}

		function __set($name, $value) {
			$this->$name = $value;
		}

		function __get($name) {
			return $this->$name;
		}

	}

}

if (!function_exists('WC_Product_Page_Templates_Obj')) {

	function WC_Product_Page_Templates_Obj() {
		return WC_Product_Page_Templates::get_instance();
	}

}

WC_Product_Page_Templates_Obj();
