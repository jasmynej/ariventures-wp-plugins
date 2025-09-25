<?php if (!defined('ABSPATH')) exit; ?>
<div class="av-wrap">
	<h1>Visa Checker Tools</h1>

	<?php if ($import_result): ?>
		<div class="notice notice-info"><p><?php echo esc_html($import_result['message']); ?></p></div>
		<?php if (!empty($import_result['errors'])): ?>
			<div class="notice notice-error">
				<p><strong>Errors:</strong></p>
				<ul>
					<?php foreach ($import_result['errors'] as $e): ?>
						<li><?php echo esc_html($e); ?></li>
					<?php endforeach; ?>
				</ul>
			</div>
		<?php endif; ?>
	<?php endif; ?>

	<h2>Import Countries (CSV)</h2>
	<form method="post" enctype="multipart/form-data">
		<?php wp_nonce_field('arivvisa_import_countries','arivvisa_nonce'); ?>
		<input type="file" name="countries_csv" accept=".csv" required />
		<p><button class="button button-primary">Upload & Import</button></p>
	</form>

	<div class="av-card" style="margin-top: 16px;">
		<div class="av-card__header">
			<span class="dashicons dashicons-randomize"></span>
			<h2 class="av-card__title">Generate Visa Rule Combos</h2>
		</div>
		<div class="av-card__body">
			<p class="av-note">This will create placeholder visa rules for any nationality/destination pair that doesn’t already exist.</p>
			<form method="post">
				<?php wp_nonce_field('arivvisa_generate_rules','arivvisa_nonce'); ?>
				<button class="button button-primary av-btn av-btn--primary" type="submit" name="generate_rules" value="1">
					<span class="dashicons dashicons-update-alt" style="vertical-align: middle;"></span>
					Generate Missing Rules
				</button>
			</form>
		</div>
	</div>
</div>