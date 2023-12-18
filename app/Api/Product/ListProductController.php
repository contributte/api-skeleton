<?php declare(strict_types = 1);

namespace App\Api\Product;

use Contributte\Api\Controller\JsonController;
use Contributte\Api\Description\Describer;
use Contributte\Api\Http\ApiRequest;
use Contributte\Api\Http\ErrorResponse;
use Contributte\Api\Http\ResponseInterface;
use Throwable;

final class ListProductController extends JsonController
{

	public static function describe(): Describer
	{
		$d = new Describer();
		$d->withPath('/api/v1/product');
		$d->withMethods([Describer::METHOD_GET]);
		$d->withDescription('List product');

		return $d;
	}

	public function __invoke(ApiRequest $request): ResponseInterface
	{
		try {
			$products = [
				[
					'id' => 1,
					'name' => 'Test1',
				],
				[
					'id' => 2,
					'name' => 'Test2',
				],
			];

			return ListProductResponse::of($products);
		} catch (Throwable $e) {
			return ErrorResponse::create()
				->withStatusCode(400)
				->withMessage('Cannot load list of products');
		}
	}

}
