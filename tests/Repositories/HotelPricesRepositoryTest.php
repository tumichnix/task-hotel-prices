<?php

namespace Tumichnix\TaskHotelPrices\Repositories;

use PHPUnit\Framework\TestCase;

class HotelPricesRepositoryTest extends TestCase
{
	protected string $xmlFile;

	public function testXmlFileNotFound()
    {
    	$this->expectException(\ErrorException::class);

    	$repository = new HotelPricesRepository('foobar.xml');
    }

    public function testGetJSON()
	{
		$xml = join(DIRECTORY_SEPARATOR, [
			dirname(__FILE__, 3),
			'storage',
			'hotel_prices.xml'
		]);

		$repository = new HotelPricesRepository($xml);

		$this->assertJson($repository->getJSON());
	}
}
