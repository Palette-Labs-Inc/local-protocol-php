<?php

declare(strict_types=1);

namespace LocalProtocol\Requests\Location;

use LocalProtocol\Core\Attributes\Optional;
use LocalProtocol\Core\Attributes\Required;
use LocalProtocol\Core\Concerns\SdkModel;
use LocalProtocol\Core\Contracts\BaseModel;
use LocalProtocol\Requests\Coordinates;
use LocalProtocol\Requests\PostalAddress;

/**
 * @phpstan-import-type CoordinatesShape from \LocalProtocol\Requests\Coordinates
 * @phpstan-import-type PostalAddressShape from \LocalProtocol\Requests\PostalAddress
 *
 * @phpstan-type LocationWithCoordinatesShape = array{
 *   coordinates: Coordinates|CoordinatesShape,
 *   postalAddress?: null|PostalAddress|PostalAddressShape,
 * }
 */
final class LocationWithCoordinates implements BaseModel
{
    /** @use SdkModel<LocationWithCoordinatesShape> */
    use SdkModel;

    /**
     * Coordinates.
     */
    #[Required]
    public Coordinates $coordinates;

    /**
     * Postal Address.
     */
    #[Optional('postal_address')]
    public ?PostalAddress $postalAddress;

    /**
     * `new LocationWithCoordinates()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * LocationWithCoordinates::with(coordinates: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new LocationWithCoordinates)->withCoordinates(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Coordinates|CoordinatesShape $coordinates
     * @param PostalAddress|PostalAddressShape|null $postalAddress
     */
    public static function with(
        Coordinates|array $coordinates,
        PostalAddress|array|null $postalAddress = null
    ): self {
        $self = new self;

        $self['coordinates'] = $coordinates;

        null !== $postalAddress && $self['postalAddress'] = $postalAddress;

        return $self;
    }

    /**
     * Coordinates.
     *
     * @param Coordinates|CoordinatesShape $coordinates
     */
    public function withCoordinates(Coordinates|array $coordinates): self
    {
        $self = clone $this;
        $self['coordinates'] = $coordinates;

        return $self;
    }

    /**
     * Postal Address.
     *
     * @param PostalAddress|PostalAddressShape $postalAddress
     */
    public function withPostalAddress(PostalAddress|array $postalAddress): self
    {
        $self = clone $this;
        $self['postalAddress'] = $postalAddress;

        return $self;
    }
}
