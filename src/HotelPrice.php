<?php

namespace Tumichnix\TaskHotelPrices;

use Carbon\CarbonPeriod;
use Tumichnix\TaskHotelPrices\Repositories\HotelPricesRepository;

class HotelPrice
{
	protected HotelPricesRepository $hotelPricesRepository;

	public const FORMAT_DATE = 'Y-m-d';

    public function __construct(HotelPricesRepository $hotelPricesRepository)
    {
        $this->hotelPricesRepository = $hotelPricesRepository;
    }

    public function getCheapestRoom(string $checkin, string $checkout): array
	{
		$json = json_decode($this->hotelPricesRepository->getJSON(), true);
		$days = $json[HotelPricesRepository::KEY_DAYS];

		$period = CarbonPeriod::create($checkin, $checkout);
		$period->excludeEndDate(true);

		$data = [];

		foreach ($period as $day) {
			$date = $day->format(self::FORMAT_DATE);
			if (array_key_exists($date, $days)) {
				$rooms = $days[$date][HotelPricesRepository::KEY_ROOMS];
				foreach ($rooms as $code => $price) {
					if (!array_key_exists($code, $data)) {
						$data[$code] = $price;
					} else {
						$data[$code] += $price;
					}
				}
			}
		}

		asort($data);

		$code = array_key_first($data);

		return [
			'code' => $code,
			'total_price' => number_format($data[$code], 2),
		];
	}
}
