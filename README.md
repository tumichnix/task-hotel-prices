# Aufgabe: Hotelpreise Laden und Berechnen #

## Usage

``` php
$hotelPrice = new Tumichnix\HotelPrice(new Tumichnix\Repositories\HotelPricesRepository('prices.xml'));
var_dump($hotelPrice->getCheapestRoom('2019-08-28', '2019-09-02'));
```

## Testing

``` bash
$ composer install
$ composer test
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
