<?php
declare(strict_types=1);

/*
Plugin Name: Betheme Color Replace
Description: Replace HEX colors in database strings, serialized data, and base64 serialized builder data.
Version: 1.0.0
Author: David Vielhuber
*/

add_action('admin_menu', function(): void {
	add_submenu_page(
		'tools.php',
		'Betheme Color Replace',
		'Betheme Color Replace',
		'manage_options',
		'bt-color-replace',
		function(): void {
			global $wpdb;

			$from = strtolower(trim((string) ($_POST['from'] ?? '')));
			$to = strtolower(trim((string) ($_POST['to'] ?? '')));
			$result = '';

			if ($_POST !== []) {
				check_admin_referer('bt-color-replace');

				if ($from !== '' && $from[0] !== '#') {
					$from = '#' . $from;
				}

				if ($to !== '' && $to[0] !== '#') {
					$to = '#' . $to;
				}

				if ($from === '' || $to === '') {
					$result = 'missing values';
				} else {
					$replaceNested = function(mixed $value, int &$count) use (&$replaceNested, $from, $to): mixed {
						if (is_string($value)) {
							$stringCount = 0;
							$value = str_ireplace($from, $to, $value, $stringCount);
							$count += $stringCount;

							return $value;
						}

						if (is_array($value)) {
							foreach ($value as $key => $childValue) {
								$value[$key] = $replaceNested($childValue, $count);
							}
						}

						return $value;
					};

					$replaceValue = function(string $value) use ($from, $to, $replaceNested): array {
						$count = 0;
						$replaceRaw = function(string $raw) use ($from, $to, $replaceNested, &$count): string {
							if (is_serialized($raw)) {
								return maybe_serialize($replaceNested(maybe_unserialize($raw), $count));
							}

							return str_ireplace($from, $to, $raw, $count);
						};

						$decoded = base64_decode($value, true);

						if ($decoded !== false && (is_serialized($decoded) || preg_match('/^[aOsibdN]:/', $decoded) === 1)) {
							$replaced = $replaceRaw($decoded);

							return $count > 0 ? [base64_encode($replaced), $count] : [$value, 0];
						}

						return [$replaceRaw($value), $count];
					};

					foreach ($wpdb->get_col('SHOW TABLES') as $table) {
						$columns = $wpdb->get_results("SHOW COLUMNS FROM `{$table}`", ARRAY_A);
						$primaryKey = '';

						foreach ($columns as $column) {
							if (($column['Key'] ?? '') === 'PRI') {
								$primaryKey = (string) $column['Field'];
								break;
							}
						}

						foreach ($columns as $columnData) {
							$column = (string) $columnData['Field'];

							if (preg_match('/^(char|varchar|tinytext|text|mediumtext|longtext)/', strtolower((string) $columnData['Type'])) !== 1) {
								continue;
							}

							$changedRows = 0;
							$replacements = 0;

							foreach ($wpdb->get_results("SELECT * FROM `{$table}` WHERE `{$column}` IS NOT NULL AND `{$column}` != ''", ARRAY_A) as $row) {
								[$newValue, $count] = $replaceValue((string) $row[$column]);

								if ($count === 0 || $newValue === (string) $row[$column]) {
									continue;
								}

								$changedRows++;
								$replacements += $count;

								if ($primaryKey !== '') {
									$wpdb->update($table, [$column => $newValue], [$primaryKey => $row[$primaryKey]]);
								}
							}

							if ($replacements > 0) {
								$result .= $table . '.' . $column . ': rows=' . $changedRows . ', replacements=' . $replacements . "\n";
							}
						}
					}
				}
			}

			?>
			<div class="wrap">
				<h1>Betheme Color Replace</h1>
				<form method="post">
					<?php wp_nonce_field('bt-color-replace'); ?>
					<p>
						<input type="text" name="from" placeholder="#ffce60" value="<?php echo esc_attr($from); ?>">
						<input type="text" name="to" placeholder="#d90912" value="<?php echo esc_attr($to); ?>">
						<button class="button button-primary">Replace</button>
					</p>
				</form>
				<?php if ($result !== ''): ?>
					<pre><?php echo esc_html($result); ?></pre>
				<?php endif; ?>
			</div>
			<?php
		}
	);
});
