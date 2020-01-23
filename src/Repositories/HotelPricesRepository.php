<?php

namespace Tumichnix\TaskHotelPrices\Repositories;

class HotelPricesRepository
{
	protected string $xmlFile;

	public const KEY_DAYS = 'days';
	public const KEY_ROOMS = 'rooms';

    public function __construct(string $xmlFile)
    {
        $this->setXmlFile($xmlFile);
    }

    public function setXmlFile(string $xmlFile): void
	{
		if (!file_exists($xmlFile)) {
			throw new \ErrorException(sprintf('XML file not found [%s]', $xmlFile));
		}

		$this->xmlFile = $xmlFile;
	}

    public function getJSON(): string
	{
		$data = [];

		$xml = simplexml_load_file($this->xmlFile);

		foreach ($xml->children() as $obj) {
			$data[(string)$obj->date][self::KEY_ROOMS][(string)$obj->code] = (float)$obj->price;
		}

		return json_encode([self::KEY_DAYS => $data]);
	}
}
