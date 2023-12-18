<?php declare(strict_types = 1);

namespace App\Domain\Routing;

use App\Api\Product\CreateProductController;
use App\Api\Product\DeleteProductController;
use App\Api\Product\GetProductController;
use App\Api\Product\ListProductController;
use App\Api\Product\UpdateProductController;
use Contributte\Api\Controller\OpenapiController;
use Contributte\Api\Controller\PingController;
use Contributte\Api\Router\ApiRouter;
use Nette\Application\Routers\Route;
use Nette\Application\Routers\RouteList;
use Nette\Routing\Router;

class RouterFactory
{

	public static function create(): Router
	{
		$router = new RouteList();

		self::createApi($router);
		self::createGui($router);

		return $router;
	}

	public static function createApi(RouteList $router): void
	{
		// /api
		$api = (new ApiRouter($router))->withPath('api');
		$api->add('GET', '_/apidoc', OpenapiController::class)->tag(['public']);
		$api->add('GET', '_/ping', PingController::class)->tag(['public']);

		// /api/v1
		$v1 = (new ApiRouter($api))->withPath('v1');

		// /api/v1/product
		$v1->add('GET', 'product', ListProductController::class);
		$v1->add('GET', 'product/<uuid>', GetProductController::class);
		$v1->add('POST', 'product', CreateProductController::class);
		$v1->add('PUT', 'product/<uuid>', UpdateProductController::class);
		$v1->add('DELETE', 'product/<uuid>', DeleteProductController::class);

		// /api/*
		$api->add('GET', '<fallback .*>', PingController::class);
	}

	public static function createGui(RouteList $router): void
	{
		$router[] = new Route('<presenter>/<action>[/<id>]', 'Home:default');
	}

}
