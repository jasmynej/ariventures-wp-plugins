<?php

// includes/class-importer.php
if (!defined('ABSPATH')) exit;

class ArivVisa_Importer {
	public static function import_countries_from_upload(array $file) : array {
		$errors = [];
		if ($file['error'] !== UPLOAD_ERR_OK) {
			return ['message' => 'Upload failed.', 'errors' => ['Upload error code '.$file['error']]];
		}

		require_once ABSPATH . 'wp-admin/includes/file.php';
		$overrides = ['test_form' => false, 'mimes' => ['csv' => 'text/csv']];
		$movefile = wp_handle_upload($file, $overrides);

		if (!isset($movefile['file'])) {
			return ['message' => 'Upload handling failed.', 'errors' => [$movefile['error'] ?? 'Unknown']];
		}

		$path = $movefile['file'];
		$count = 0;

		if (($h = fopen($path, 'r')) === false) {
			return ['message' => 'Could not open uploaded CSV.', 'errors' => []];
		}

		// Read header
		$header = fgetcsv($h);
		if (!$header) {
			fclose($h);
			return ['message' => 'CSV has no header row.', 'errors' => []];
		}

		// Normalize header → index map
		$map = self::header_map($header, ['name','capital','region','sub_region','flag','iso2']);
		if ($map === false) {
			fclose($h);
			return ['message' => 'CSV headers must be: name,capital,region,sub_region,flag,iso2', 'errors' => []];
		}

		global $wpdb;
		$table = $wpdb->prefix . 'av_countries';

		// Upsert each row
		while (($row = fgetcsv($h)) !== false) {
			$name       = sanitize_text_field($row[$map['name']] ?? '');
			$capital    = sanitize_text_field($row[$map['capital']] ?? '');
			$region     = sanitize_text_field($row[$map['region']] ?? '');
			$sub_region = sanitize_text_field($row[$map['sub_region']] ?? '');
			$flag   = esc_url_raw($row[$map['flag']] ?? '');
			$iso2       = strtoupper(sanitize_text_field($row[$map['iso2']] ?? ''));

			if (strlen($iso2) !== 2 || $name === '') {
				$errors[] = "Skipped row with invalid iso2/name: iso2='{$iso2}', name='{$name}'";
				continue;
			}

			// Use INSERT ... ON DUPLICATE KEY UPDATE (requires UNIQUE KEY on iso2)
			$sql = $wpdb->prepare(
				"INSERT INTO $table (iso2, name, capital, region, sub_region, flag)
         VALUES (%s, %s, %s, %s, %s, %s)
         ON DUPLICATE KEY UPDATE
           name = VALUES(name),
           capital = VALUES(capital),
           region = VALUES(region),
           sub_region = VALUES(sub_region),
           flag = VALUES(flag)",
				$iso2, $name, $capital, $region, $sub_region, $flag
			);

			$ok = $wpdb->query($sql);
			if ($ok === false) {
				$errors[] = "DB error for iso2={$iso2}: ".$wpdb->last_error;
			} else {
				$count++;
			}
		}
		fclose($h);

		return [
			'message' => "Imported/updated {$count} countries.",
			'errors'  => $errors,
		];
	}

	private static function header_map(array $header, array $expected) {
		$lower = array_map(fn($h)=> strtolower(trim($h)), $header);
		$map = [];
		foreach ($expected as $col) {
			$idx = array_search($col, $lower, true);
			if ($idx === false) return false;
			$map[$col] = $idx;
		}
		return $map;
	}
}

new ArivVisa_Importer();