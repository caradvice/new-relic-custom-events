<?php


namespace CarAdvice\NewRelic\CustomEvents;


use CarAdvice\NewRelic\CustomEvents\Contracts\ApiClientContract;
use CarAdvice\NewRelic\CustomEvents\Events\CustomEventEvent;
use CarAdvice\NewRelic\CustomEvents\Listeners\SendCustomEvent;
use CarAdvice\NewRelic\CustomEvents\Services\NewRelic\ApiClient;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Illuminate\Contracts\Config\Repository as Config;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\ServiceProvider;

class LaravelServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/config.php', 'new-relic-custom-events'
        );

        $this->app->bind(ApiClientContract::class, ApiClient::class);
        $this->app
            ->when(ApiClient::class)
            ->needs(ClientInterface::class)
            ->give(function () {
                return new Client([
                    'headers' => [
                        'ContentType' => 'application/json',
                        'X-Insert-Key' => config('new-relic-custom-events.api-key'),
                    ]
                ]);
            });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     * @throws BindingResolutionException
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/config.php' => config_path('new-relic-custom-events.php'),
        ]);

        $this->setConfigUris();

        /** @var Dispatcher $eventDispatcher */
        $eventDispatcher = $this->app->make(Dispatcher::class);
        $eventDispatcher->listen([
            SendCustomEvent::class
        ], CustomEventEvent::class);
    }

    /**
     * @throws BindingResolutionException
     */
    private function setConfigUris(): void
    {
        /** @var Config $config */
        $config = $this->app->make('config');

        $config->set('new-relic-custom-events.uri', $this->transformNewRelicUri($config));
    }

    private function transformNewRelicUri(Config $config): string
    {
        $accountId = $config->get('new-relic-custom-events.account-id');
        $uri = $config->get('new-relic-custom-events.uri');

        return str_replace('{accountId}', $accountId, $uri);
    }
}