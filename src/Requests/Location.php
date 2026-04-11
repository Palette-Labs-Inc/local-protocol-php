<?php

declare(strict_types=1);

namespace LocalProtocol\Requests;

use LocalProtocol\Core\Concerns\SdkUnion;
use LocalProtocol\Core\Conversion\Contracts\Converter;
use LocalProtocol\Core\Conversion\Contracts\ConverterSource;
use LocalProtocol\Requests\Location\LocationWithCoordinates;
use LocalProtocol\Requests\Location\LocationWithPostalAddress;

/**
 * Location.
 *
 * @phpstan-import-type LocationWithPostalAddressShape from \LocalProtocol\Requests\Location\LocationWithPostalAddress
 * @phpstan-import-type LocationWithCoordinatesShape from \LocalProtocol\Requests\Location\LocationWithCoordinates
 *
 * @phpstan-type LocationVariants = LocationWithPostalAddress|LocationWithCoordinates
 * @phpstan-type LocationShape = LocationVariants|LocationWithPostalAddressShape|LocationWithCoordinatesShape
 */
final class Location implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [LocationWithPostalAddress::class, LocationWithCoordinates::class];
    }
}
