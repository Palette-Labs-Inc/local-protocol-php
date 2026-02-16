<?php

declare(strict_types=1);

namespace LocalProtocol\Requests\Quotes;

use LocalProtocol\Core\Attributes\Optional;
use LocalProtocol\Core\Attributes\Required;
use LocalProtocol\Core\Concerns\SdkModel;
use LocalProtocol\Core\Contracts\BaseModel;
use LocalProtocol\PaymentInstruments\Payment;
use LocalProtocol\Requests\Location\LocationWithCoordinates;
use LocalProtocol\Requests\Location\LocationWithPostalAddress;

/**
 * DeliveryQuote.
 *
 * @phpstan-import-type LocationShape from \LocalProtocol\Requests\Location
 * @phpstan-import-type PaymentShape from \LocalProtocol\PaymentInstruments\Payment
 * @phpstan-import-type LocationVariants from \LocalProtocol\Requests\Location
 *
 * @phpstan-type DeliveryQuoteShape = array{
 *   id: string,
 *   currency: string,
 *   dropoffEstimate: \DateTimeInterface,
 *   dropoffLocation: LocationShape,
 *   nonce: string,
 *   payment: Payment|PaymentShape,
 *   pickupEstimate: \DateTimeInterface,
 *   pickupLocation: LocationShape,
 *   price: int,
 *   expiresAt?: \DateTimeInterface|null,
 * }
 */
final class DeliveryQuote implements BaseModel
{
    /** @use SdkModel<DeliveryQuoteShape> */
    use SdkModel;

    /**
     * Unique quote identifier.
     */
    #[Required]
    public string $id;

    /**
     * ISO 4217 currency code.
     */
    #[Required]
    public string $currency;

    /**
     * Estimated dropoff time (RFC 3339).
     */
    #[Required('dropoff_estimate')]
    public \DateTimeInterface $dropoffEstimate;

    /**
     * Dropoff location for the delivery.
     *
     * @var LocationVariants $dropoffLocation
     */
    #[Required('dropoff_location')]
    public LocationWithPostalAddress|LocationWithCoordinates $dropoffLocation;

    /**
     * Client-generated idempotency key.
     */
    #[Required]
    public string $nonce;

    /**
     * Payment handlers available for accepting this quote.
     */
    #[Required]
    public Payment $payment;

    /**
     * Estimated pickup time (RFC 3339).
     */
    #[Required('pickup_estimate')]
    public \DateTimeInterface $pickupEstimate;

    /**
     * Pickup location for the delivery.
     *
     * @var LocationVariants $pickupLocation
     */
    #[Required('pickup_location')]
    public LocationWithPostalAddress|LocationWithCoordinates $pickupLocation;

    /**
     * Price in minor currency units.
     */
    #[Required]
    public int $price;

    /**
     * Time when the quote expires (RFC 3339).
     */
    #[Optional('expires_at')]
    public ?\DateTimeInterface $expiresAt;

    /**
     * `new DeliveryQuote()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DeliveryQuote::with(
     *   id: ...,
     *   currency: ...,
     *   dropoffEstimate: ...,
     *   dropoffLocation: ...,
     *   nonce: ...,
     *   payment: ...,
     *   pickupEstimate: ...,
     *   pickupLocation: ...,
     *   price: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DeliveryQuote)
     *   ->withID(...)
     *   ->withCurrency(...)
     *   ->withDropoffEstimate(...)
     *   ->withDropoffLocation(...)
     *   ->withNonce(...)
     *   ->withPayment(...)
     *   ->withPickupEstimate(...)
     *   ->withPickupLocation(...)
     *   ->withPrice(...)
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
     * @param LocationShape $dropoffLocation
     * @param Payment|PaymentShape $payment
     * @param LocationShape $pickupLocation
     */
    public static function with(
        string $id,
        string $currency,
        \DateTimeInterface $dropoffEstimate,
        LocationWithPostalAddress|array|LocationWithCoordinates $dropoffLocation,
        string $nonce,
        Payment|array $payment,
        \DateTimeInterface $pickupEstimate,
        LocationWithPostalAddress|array|LocationWithCoordinates $pickupLocation,
        int $price,
        ?\DateTimeInterface $expiresAt = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['currency'] = $currency;
        $self['dropoffEstimate'] = $dropoffEstimate;
        $self['dropoffLocation'] = $dropoffLocation;
        $self['nonce'] = $nonce;
        $self['payment'] = $payment;
        $self['pickupEstimate'] = $pickupEstimate;
        $self['pickupLocation'] = $pickupLocation;
        $self['price'] = $price;

        null !== $expiresAt && $self['expiresAt'] = $expiresAt;

        return $self;
    }

    /**
     * Unique quote identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * ISO 4217 currency code.
     */
    public function withCurrency(string $currency): self
    {
        $self = clone $this;
        $self['currency'] = $currency;

        return $self;
    }

    /**
     * Estimated dropoff time (RFC 3339).
     */
    public function withDropoffEstimate(
        \DateTimeInterface $dropoffEstimate
    ): self {
        $self = clone $this;
        $self['dropoffEstimate'] = $dropoffEstimate;

        return $self;
    }

    /**
     * Dropoff location for the delivery.
     *
     * @param LocationShape $dropoffLocation
     */
    public function withDropoffLocation(
        LocationWithPostalAddress|array|LocationWithCoordinates $dropoffLocation
    ): self {
        $self = clone $this;
        $self['dropoffLocation'] = $dropoffLocation;

        return $self;
    }

    /**
     * Client-generated idempotency key.
     */
    public function withNonce(string $nonce): self
    {
        $self = clone $this;
        $self['nonce'] = $nonce;

        return $self;
    }

    /**
     * Payment handlers available for accepting this quote.
     *
     * @param Payment|PaymentShape $payment
     */
    public function withPayment(Payment|array $payment): self
    {
        $self = clone $this;
        $self['payment'] = $payment;

        return $self;
    }

    /**
     * Estimated pickup time (RFC 3339).
     */
    public function withPickupEstimate(\DateTimeInterface $pickupEstimate): self
    {
        $self = clone $this;
        $self['pickupEstimate'] = $pickupEstimate;

        return $self;
    }

    /**
     * Pickup location for the delivery.
     *
     * @param LocationShape $pickupLocation
     */
    public function withPickupLocation(
        LocationWithPostalAddress|array|LocationWithCoordinates $pickupLocation
    ): self {
        $self = clone $this;
        $self['pickupLocation'] = $pickupLocation;

        return $self;
    }

    /**
     * Price in minor currency units.
     */
    public function withPrice(int $price): self
    {
        $self = clone $this;
        $self['price'] = $price;

        return $self;
    }

    /**
     * Time when the quote expires (RFC 3339).
     */
    public function withExpiresAt(\DateTimeInterface $expiresAt): self
    {
        $self = clone $this;
        $self['expiresAt'] = $expiresAt;

        return $self;
    }
}
