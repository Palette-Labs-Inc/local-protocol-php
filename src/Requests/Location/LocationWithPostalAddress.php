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
 * @phpstan-import-type PostalAddressShape from \LocalProtocol\Requests\PostalAddress
 * @phpstan-import-type CoordinatesShape from \LocalProtocol\Requests\Coordinates
 *
 * @phpstan-type LocationWithPostalAddressShape = array{
 *   postalAddress: PostalAddress|PostalAddressShape,
 *   coordinates?: null|Coordinates|CoordinatesShape,
 * }
 */
final class LocationWithPostalAddress implements BaseModel
{
    /** @use SdkModel<LocationWithPostalAddressShape> */
    use SdkModel;

    /**
     * Postal Address.
     */
    #[Required('postal_address')]
    public PostalAddress $postalAddress;

    /**
     * Coordinates.
     */
    #[Optional]
    public ?Coordinates $coordinates;

    /**
     * `new LocationWithPostalAddress()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * LocationWithPostalAddress::with(postalAddress: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new LocationWithPostalAddress)->withPostalAddress(...)
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
     * @param PostalAddress|PostalAddressShape $postalAddress
     * @param Coordinates|CoordinatesShape|null $coordinates
     */
    public static function with(
        PostalAddress|array $postalAddress,
        Coordinates|array|null $coordinates = null
    ): self {
        $self = new self;

        $self['postalAddress'] = $postalAddress;

        null !== $coordinates && $self['coordinates'] = $coordinates;

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
}
