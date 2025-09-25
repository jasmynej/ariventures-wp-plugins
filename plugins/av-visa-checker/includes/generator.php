<?php
if (!defined('ABSPATH')) exit;

class ArivVisa_Generator {
	public static function generate_missing_rules() {
		global $wpdb;
		$countries_table = $wpdb->prefix . 'av_countries';
		$rules_table     = $wpdb->prefix . 'av_visa_rules';

		$countries = $wpdb->get_results("SELECT iso2 FROM $countries_table");
		if (!$countries) {
			return ['message' => 'No countries loaded. Import countries first.'];
		}

		$isos = wp_list_pluck($countries, 'iso2');
		$created = 0;

		foreach ($isos as $nat) {
			foreach ($isos as $dest) {
				if ($nat === $dest) continue; // skip same-country rules

				// Does a rule already exist?
				$exists = $wpdb->get_var($wpdb->prepare(
					"SELECT id FROM $rules_table WHERE nationality_iso2=%s AND destination_iso2=%s AND purpose='tourism' LIMIT 1",
					$nat, $dest
				));

				if ($exists) continue;

				// Insert placeholder rule
				$ok = $wpdb->insert(
					$rules_table,
					[
						'nationality_iso2' => $nat,
						'destination_iso2' => $dest,
						'purpose'          => 'tourism',
						'visa_type'        => 'required', // sensible default
						'notes'            => 'Auto-generated placeholder. Update as needed.'
					],
					['%s','%s','%s','%s','%s']
				);

				if ($ok !== false) $created++;
			}
		}

		return ['message' => "Generated {$created} new placeholder rules."];
	}
}