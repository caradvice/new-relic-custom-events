<?php


namespace CarAdvice\NewRelic\CustomEvents\Services\NewRelic;


use CarAdvice\NewRelic\CustomEvents\Contracts\ApiClientContract;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Response;
use Illuminate\Contracts\Config\Repository as Config;

class ApiClient implements ApiClientContract
{
    /**
     * @var ClientInterface
     */
    public $client;
    /**
     * @var Config
     */
    private $config;

    public function __construct(ClientInterface $client, Config $config)
    {
        $this->client = $client;
        $this->config = $config;
    }

    /**
     * @inheritDoc
     */
    public function send(array $data = []): Response
    {
        return $this->client->post($this->config->get('new-relic-custom-events.uri'), ['json' => $data]);
    }
}
