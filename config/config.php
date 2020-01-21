<?php

return [
    'uri' => "https://insights-collector.newrelic.com/v1/accounts/{accountId}/events",
    'api-key' => env('NEW_RELIC_API_KEY'),
    'account-id' => env('NEW_RELIC_ACCOUNT_ID'),
];