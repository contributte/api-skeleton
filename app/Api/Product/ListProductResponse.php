<?php declare(strict_types = 1);

namespace App\Api\Product;

use Contributte\Api\Http\EntityResponse;

class ListProductResponse extends EntityResponse
{

	/**
	 * @param array<array<mixed>> $products
	 */
	public static function of(array $products): self
	{
		$self = self::create();
		$self->payload = $products;

		return $self;
	}

}
