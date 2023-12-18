<?php declare(strict_types = 1);

namespace App\Api\Product;

use Contributte\Api\Http\EntityResponse;

class DeleteProductResponse extends EntityResponse
{

	/**
	 * @param array<string, scalar> $detail
	 */
	public static function of(array $detail): self
	{
		$self = self::create();
		$self->payload = $detail;

		return $self;
	}

}
