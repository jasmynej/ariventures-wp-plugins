<?php
if (!defined('ABSPATH')) exit;
class ArivVisa_Activator {
	const DB_VERSION = '1.1.0';
	public static function activate() {
		global $wpdb;
		$charset_collate = $wpdb->get_charset_collate();

		$countries = $wpdb->prefix . 'av_countries';
		$rules     = $wpdb->prefix . 'av_visa_rules';

		require_once ABSPATH . 'wp-admin/includes/upgrade.php';

		// IMPORTANT: dbDelta requires each field on its own line and indexes named.
		$sql = "
			CREATE TABLE $countries (
			  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
			  iso2 CHAR(2) NOT NULL,
			  name VARCHAR(100) NOT NULL,
			  capital VARCHAR(100) NOT NULL,
			  region VARCHAR(100) NULL,
			  sub_region VARCHAR(100) NULL,
			  flag VARCHAR(255) NULL,
			  PRIMARY KEY  (id),
			  UNIQUE KEY iso2_unique (iso2),
			  KEY name_idx (name)
			) $charset_collate;

			CREATE TABLE $rules (
			  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
			  nationality_iso2 CHAR(2) NOT NULL,
			  destination_iso2 CHAR(2) NOT NULL,
			  purpose ENUM('tourism','business','transit') NOT NULL DEFAULT 'tourism',
			  stay_days INT NULL,
			  visa_type ENUM('visa_free','evisa','voa','required','eta') NOT NULL,
			  notes TEXT NULL,
			  sources LONGTEXT NULL,
			  updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
			  PRIMARY KEY  (id),
			  KEY combo_idx (nationality_iso2, destination_iso2, purpose),
			  KEY destination_idx (destination_iso2)
			) $charset_collate;
		";
		dbDelta($sql);
		update_option('arivvisa_db_version', self::DB_VERSION);
	}
}