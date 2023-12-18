<?php declare(strict_types = 1);

namespace App\Api\Product;

use Contributte\Api\Controller\JsonController;
use Contributte\Api\Description\Describer;
use Contributte\Api\Http\ApiRequest;
use Contributte\Api\Http\ErrorResponse;
use Contributte\Api\Http\ResponseInterface;
use Throwable;

final class DeleteProductController extends JsonController
{

	public static function describe(): Describer
	{
		$d = new Describer();
		$d->withPath('/api/v1/product/<uuid>');
		$d->withMethods([Describer::METHOD_DELETE]);
		$d->withDescription('Delete product');

		return $d;
	}

	public function __invoke(ApiRequest $request): ResponseInterface
	{
		$id = $request->getParameter('id');

		// Validate parameters
		if ($id === null) {
			return ErrorResponse::create()
				->withStatusCode(400)
				->withMessage('Invalid ID');
		}

		try {
			$product = [
				'id' => 1,
				'name' => 'Test',
			];

			return GetProductResponse::of($product);
		} catch (Throwable $e) {
			return ErrorResponse::create()
				->withStatusCode(400)
				->withMessage('Cannot load detail');
		}
	}

}
