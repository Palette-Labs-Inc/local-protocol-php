<?php

declare(strict_types=1);

namespace LocalProtocol\PaymentInstruments\PaymentInstrumentRegisterParams;

use LocalProtocol\Core\Attributes\Optional;
use LocalProtocol\Core\Concerns\SdkModel;
use LocalProtocol\Core\Contracts\BaseModel;

/**
 * The billing address associated with this payment method.
 *
 * @phpstan-type BillingAddressShape = array{
 *   addressCountry?: string|null,
 *   addressLocality?: string|null,
 *   addressRegion?: string|null,
 *   extendedAddress?: string|null,
 *   firstName?: string|null,
 *   lastName?: string|null,
 *   phoneNumber?: string|null,
 *   postalCode?: string|null,
 *   streetAddress?: string|null,
 * }
 */
final class BillingAddress implements BaseModel
{
    /** @use SdkModel<BillingAddressShape> */
    use SdkModel;

    /**
     * The country. Recommended to be in 2-letter ISO 3166-1 alpha-2 format, for example "US". For backward compatibility, a 3-letter ISO 3166-1 alpha-3 country code such as "SGP" or a full country name such as "Singapore" can also be used.
     */
    #[Optional('address_country')]
    public ?string $addressCountry;

    /**
     * The locality in which the street address is, and which is in the region. For example, Mountain View.
     */
    #[Optional('address_locality')]
    public ?string $addressLocality;

    /**
     * The region in which the locality is, and which is in the country. Required for applicable countries (i.e. state in US, province in CA). For example, California or another appropriate first-level Administrative division.
     */
    #[Optional('address_region')]
    public ?string $addressRegion;

    /**
     * An address extension such as an apartment number, C/O or alternative name.
     */
    #[Optional('extended_address')]
    public ?string $extendedAddress;

    /**
     * Optional. First name of the contact associated with the address.
     */
    #[Optional('first_name')]
    public ?string $firstName;

    /**
     * Optional. Last name of the contact associated with the address.
     */
    #[Optional('last_name')]
    public ?string $lastName;

    /**
     * Optional. Phone number of the contact associated with the address.
     */
    #[Optional('phone_number')]
    public ?string $phoneNumber;

    /**
     * The postal code. For example, 94043.
     */
    #[Optional('postal_code')]
    public ?string $postalCode;

    /**
     * The street address.
     */
    #[Optional('street_address')]
    public ?string $streetAddress;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        ?string $addressCountry = null,
        ?string $addressLocality = null,
        ?string $addressRegion = null,
        ?string $extendedAddress = null,
        ?string $firstName = null,
        ?string $lastName = null,
        ?string $phoneNumber = null,
        ?string $postalCode = null,
        ?string $streetAddress = null,
    ): self {
        $self = new self;

        null !== $addressCountry && $self['addressCountry'] = $addressCountry;
        null !== $addressLocality && $self['addressLocality'] = $addressLocality;
        null !== $addressRegion && $self['addressRegion'] = $addressRegion;
        null !== $extendedAddress && $self['extendedAddress'] = $extendedAddress;
        null !== $firstName && $self['firstName'] = $firstName;
        null !== $lastName && $self['lastName'] = $lastName;
        null !== $phoneNumber && $self['phoneNumber'] = $phoneNumber;
        null !== $postalCode && $self['postalCode'] = $postalCode;
        null !== $streetAddress && $self['streetAddress'] = $streetAddress;

        return $self;
    }

    /**
     * The country. Recommended to be in 2-letter ISO 3166-1 alpha-2 format, for example "US". For backward compatibility, a 3-letter ISO 3166-1 alpha-3 country code such as "SGP" or a full country name such as "Singapore" can also be used.
     */
    public function withAddressCountry(string $addressCountry): self
    {
        $self = clone $this;
        $self['addressCountry'] = $addressCountry;

        return $self;
    }

    /**
     * The locality in which the street address is, and which is in the region. For example, Mountain View.
     */
    public function withAddressLocality(string $addressLocality): self
    {
        $self = clone $this;
        $self['addressLocality'] = $addressLocality;

        return $self;
    }

    /**
     * The region in which the locality is, and which is in the country. Required for applicable countries (i.e. state in US, province in CA). For example, California or another appropriate first-level Administrative division.
     */
    public function withAddressRegion(string $addressRegion): self
    {
        $self = clone $this;
        $self['addressRegion'] = $addressRegion;

        return $self;
    }

    /**
     * An address extension such as an apartment number, C/O or alternative name.
     */
    public function withExtendedAddress(string $extendedAddress): self
    {
        $self = clone $this;
        $self['extendedAddress'] = $extendedAddress;

        return $self;
    }

    /**
     * Optional. First name of the contact associated with the address.
     */
    public function withFirstName(string $firstName): self
    {
        $self = clone $this;
        $self['firstName'] = $firstName;

        return $self;
    }

    /**
     * Optional. Last name of the contact associated with the address.
     */
    public function withLastName(string $lastName): self
    {
        $self = clone $this;
        $self['lastName'] = $lastName;

        return $self;
    }

    /**
     * Optional. Phone number of the contact associated with the address.
     */
    public function withPhoneNumber(string $phoneNumber): self
    {
        $self = clone $this;
        $self['phoneNumber'] = $phoneNumber;

        return $self;
    }

    /**
     * The postal code. For example, 94043.
     */
    public function withPostalCode(string $postalCode): self
    {
        $self = clone $this;
        $self['postalCode'] = $postalCode;

        return $self;
    }

    /**
     * The street address.
     */
    public function withStreetAddress(string $streetAddress): self
    {
        $self = clone $this;
        $self['streetAddress'] = $streetAddress;

        return $self;
    }
}
