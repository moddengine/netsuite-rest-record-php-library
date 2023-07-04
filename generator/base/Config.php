<?php

namespace NetSuiteRestAPI;

class Config
{
	public readonly string $realm;

	public function __construct(
		public readonly string $accountId,
		public readonly string $consumerKey,
		public readonly string $consumerSecret,
		public readonly string $tokenId,
		public readonly string $tokenSecret,
		public readonly string $apiSource
	)
	{
		$this->realm = str_replace('-', '_', strtoupper($accountId));
	}

}