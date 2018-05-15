<?php
declare(strict_types=1);
/**
 * @author Anton Kartsev <anton@alarm.ru>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace Bigperson\AmoCrmApi;

use Illuminate\Support\ServiceProvider;
use linkprofit\AmoCRM\RequestHandler;
use linkprofit\AmoCRM\services\AccountService;
use linkprofit\AmoCRM\services\CatalogElementService;
use linkprofit\AmoCRM\services\CatalogService;
use linkprofit\AmoCRM\services\CompanyService;
use linkprofit\AmoCRM\services\ContactService;
use linkprofit\AmoCRM\services\CustomerService;
use linkprofit\AmoCRM\services\FieldService;
use linkprofit\AmoCRM\services\LeadService;
use linkprofit\AmoCRM\services\NoteService;
use linkprofit\AmoCRM\services\PipelineService;
use linkprofit\AmoCRM\services\TaskService;
use linkprofit\AmoCRM\services\TaskTypeService;


/**
 * Class AmoCrmApiServiceProvider
 *
 * @package Bigperson\AmoCrmApi
 */
class AmoCrmApiServiceProvider  extends ServiceProvider
{
    /**
     * Local config file path
     */
    private const CONFIG_PATH = __DIR__ . '/../config/amocrm-api.php';

    /**
     * @var array List of services
     */
    protected $services = [
        AccountService::class,
        CatalogElementService::class,
        CatalogService::class,
        CompanyService::class,
        ContactService::class,
        CustomerService::class,
        FieldService::class,
        LeadService::class,
        NoteService::class,
        PipelineService::class,
        TaskService::class,
        TaskTypeService::class,
    ];


    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->bootRequestHandler();
        $this->bootServices();
    }
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->shareResources();
        $this->mergeConfigFrom(self::CONFIG_PATH, 'amocrm-api');
    }

    /**
     * @return void
     */
    private function shareResources(): void
    {
        $publishes = [
            self::CONFIG_PATH => \config_path('amocrm-api.php'),
        ];
        $this->publishes($publishes, 'amocrm-api');
    }

    /**
     * @return void Boot Request Handler
     */
    private function bootRequestHandler()
    {
        $this->app->singleton(RequestHandler::class, function ($app) {
            $request = new \linkprofit\AmoCRM\RequestHandler();
            $request->setSubdomain(config('amocrm.domain'));
            $connection = new \linkprofit\AmoCRM\entities\Authorization(
                config('amocrm-api.login'),
                config('amocrm-api.hash')
            );
            $authorization = new \linkprofit\AmoCRM\services\AuthorizationService($request);
            $authorization->add($connection);
            $authorization->authorize();

            return $request;
        });
    }

    /**
     * @return void Boot all services
     */
    private function bootServices()
    {
        foreach ($this->services as $service) {
            $this->app->singleton($service, function ($app) use ($service) {
                $request = $app->make(\linkprofit\AmoCRM\RequestHandler::class);
                $service = new $service($request);

                return $service;
            });
        }
    }
}