<?php declare(strict_types = 1);

namespace App\Api\Product;

use Contributte\Api\Controller\JsonController;
use Contributte\Api\Description\Describer;
use Contributte\Api\Exception\ParsingException;
use Contributte\Api\Http\ApiRequest;
use Contributte\Api\Http\ErrorResponse;
use Contributte\Api\Http\ResponseInterface;
use Nette\Schema\Expect;
use Nette\Schema\Schema;
use Throwable;

final class CreateProductController extends JsonController
{

	public static function schema(): Schema
	{
		return Expect::structure([
			'id' => Expect::int()->required(),
		])->castTo(UpdateProductRequest::class);
	}

	public static function describe(): Describer
	{
		$d = new Describer();
		$d->withPath('/api/v1/product');
		$d->withMethods([Describer::METHOD_POST]);
		$d->withDescription('Create product');

		return $d;
	}

	public function __invoke(ApiRequest $request): ResponseInterface
	{
		try {
			$entity = $this->parseBody($request, UpdateProductRequest::class);
		} catch (ParsingException $e) {
			return $e->getResponse();
		}

		try {
			$product = [
				'id' => $entity->id,
				'name' => 'Test',
			];

			return UpdateProductResponse::of($product);
		} catch (Throwable $e) {
			return ErrorResponse::create()
				->withStatusCode(400)
				->withMessage('Cannot update detail');
		}
	}

}
