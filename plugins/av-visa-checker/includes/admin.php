<?php
if (!defined('ABSPATH')) exit;

class ArivVisa_Admin {
	public function __construct() {
		// Fix: hook to the existing method name
		add_action('admin_menu', [$this, 'menu']);
	}

	public function menu() {
		add_menu_page(
			'Visa Checker',
			'Visa Checker',
			'manage_options',
			'arivvisa',
			[$this, 'render_main'],
			'dashicons-admin-site',
			59
		);

		add_submenu_page(
			'arivvisa',
			'Tools',
			'Tools',
			'manage_options',
			'arivvisa-tools',
			[$this, 'render_tools'] // make sure this exists
		);
	}

	public function render_main() {
		// Fix: echo the returned HTML
		echo av_get_template_html('admin/main.php');
	}

	public function render_tools() {
		$import_result = null;
		$generate_result = null;

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			if (isset($_POST['countries_csv'])) {
				check_admin_referer('arivvisa_import_countries','arivvisa_nonce');
				require_once AV_VISA_CHECKER_PATH . 'includes/importer.php';
				$import_result = ArivVisa_Importer::import_countries_from_upload($_FILES['countries_csv']);
			}

			if (isset($_POST['generate_rules'])) {
				check_admin_referer('arivvisa_generate_rules','arivvisa_nonce');
				require_once AV_VISA_CHECKER_PATH . 'includes/generator.php';
				$generate_result = ArivVisa_Generator::generate_missing_rules();
			}
		}

		echo av_get_template_html('admin/tools.php', [
			'import_result'   => $import_result,
			'generate_result' => $generate_result,
		]);
	}
}

new ArivVisa_Admin();