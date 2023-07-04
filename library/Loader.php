<?php
declare(strict_types=1);

namespace NetSuiteRestAPI;

class Loader
{
	/**
	 * Loads config from config.json
	 *
	 * @param \stdClass|null $configData Load config from an external source
	 * @return Config
	 */
	public function getConfig($configData = null):Config
	{
		static $config = null;
		if ($config === null) {
			$config = $configData !== null
				? $configData
				: json_decode(
					file_get_contents(
						sprintf(
							'%s/config.json',
							dirname(__FILE__)
						)
					)
				);
		}
		$accountId = str_replace('_', '-', strtolower($config->ACCOUNT_ID));

		return new Config(
			$accountId,
			$config->CONSUMER_KEY,
			$config->CONSUMER_SECRET,
			$config->TOKEN_ID,
			$config->TOKEN_SECRET,
			$config->API_SOURCE
		);

	}
}
