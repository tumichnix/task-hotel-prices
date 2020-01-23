<?php

namespace Tumichnix\TaskHotelPrices;

use PHPUnit\Framework\TestCase;

class HotelPriceTest extends TestCase
{
	protected string $xmlFile;

	public function setUp(): void
	{
		parent::setUp();

		$this->xmlFile = join(DIRECTORY_SEPARATOR, [
			dirname(__FILE__, 2),
			'storage',
			'hotel_prices.xml'
		]);
	}

	public function testCheapestRoom()
    {
		$repository = new Repositories\HotelPricesRepository($this->xmlFile);
		$hotelPrice = new HotelPrice($repository);

		$this->assertEquals(
			['code' => 'room_1', 'total_price' => 251.31],
			$hotelPrice->getCheapestRoom('2019-08-24', '2019-08-26')
		);

		$this->assertEquals(
			['code' => 'room_2', 'total_price' => 525.95],
			$hotelPrice->getCheapestRoom('2019-08-28', '2019-09-02')
		);

		$this->assertEquals(
			['code' => 'room_2', 'total_price' => 839.79],
			$hotelPrice->getCheapestRoom('2019-08-25', '2019-09-01')
		);

		$this->assertEquals(
			['code' => 'room_2', 'total_price' => 54.71],
			$hotelPrice->getCheapestRoom('2019-09-01', '2019-09-02')
		);
    }
}
