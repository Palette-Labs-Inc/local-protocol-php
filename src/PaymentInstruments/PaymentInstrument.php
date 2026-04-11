<?php

declare(strict_types=1);

namespace LocalProtocol\PaymentInstruments;

use LocalProtocol\Core\Attributes\Optional;
use LocalProtocol\Core\Attributes\Required;
use LocalProtocol\Core\Concerns\SdkModel;
use LocalProtocol\Core\Contracts\BaseModel;
use LocalProtocol\PaymentInstruments\PaymentInstrument\BillingAddress;
use LocalProtocol\PaymentInstruments\PaymentInstrument\Credential;

/**
 * The base definition for any payment instrument. It links the instrument to a specific payment handler.
 *
 * @phpstan-import-type BillingAddressShape from \LocalProtocol\PaymentInstruments\PaymentInstrument\BillingAddress
 * @phpstan-import-type CredentialShape from \LocalProtocol\PaymentInstruments\PaymentInstrument\Credential
 *
 * @phpstan-type PaymentInstrumentShape = array{
 *   id: string,
 *   handlerID: string,
 *   type: string,
 *   billingAddress?: null|BillingAddress|BillingAddressShape,
 *   credential?: null|Credential|CredentialShape,
 *   display?: array<string,mixed>|null,
 * }
 */
final class PaymentInstrument implements BaseModel
{
    /** @use SdkModel<PaymentInstrumentShape> */
    use SdkModel;

    /**
     * A unique identifier for this instrument instance, assigned by the platform.
     */
    #[Required]
    public string $id;

    /**
     * The unique identifier for the handler instance that produced this instrument. This corresponds to the 'id' field in the Payment Handler definition.
     */
    #[Required('handler_id')]
    public string $handlerID;

    /**
     * The broad category of the instrument (e.g., 'card', 'tokenized_card'). Specific schemas will constrain this to a constant value.
     */
    #[Required]
    public string $type;

    /**
     * The billing address associated with this payment method.
     */
    #[Optional('billing_address')]
    public ?BillingAddress $billingAddress;

    /**
     * The base definition for any payment credential. Handlers define specific credential types.
     */
    #[Optional]
    public ?Credential $credential;

    /**
     * Display information for this payment instrument. Each payment instrument schema defines its specific display properties, as outlined by the payment handler.
     *
     * @var array<string,mixed>|null $display
     */
    #[Optional(map: 'mixed')]
    public ?array $display;

    /**
     * `new PaymentInstrument()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PaymentInstrument::with(id: ..., handlerID: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PaymentInstrument)->withID(...)->withHandlerID(...)->withType(...)
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
     * @param BillingAddress|BillingAddressShape|null $billingAddress
     * @param Credential|CredentialShape|null $credential
     * @param array<string,mixed>|null $display
     */
    public static function with(
        string $id,
        string $handlerID,
        string $type,
        BillingAddress|array|null $billingAddress = null,
        Credential|array|null $credential = null,
        ?array $display = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['handlerID'] = $handlerID;
        $self['type'] = $type;

        null !== $billingAddress && $self['billingAddress'] = $billingAddress;
        null !== $credential && $self['credential'] = $credential;
        null !== $display && $self['display'] = $display;

        return $self;
    }

    /**
     * A unique identifier for this instrument instance, assigned by the platform.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * The unique identifier for the handler instance that produced this instrument. This corresponds to the 'id' field in the Payment Handler definition.
     */
    public function withHandlerID(string $handlerID): self
    {
        $self = clone $this;
        $self['handlerID'] = $handlerID;

        return $self;
    }

    /**
     * The broad category of the instrument (e.g., 'card', 'tokenized_card'). Specific schemas will constrain this to a constant value.
     */
    public function withType(string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    /**
     * The billing address associated with this payment method.
     *
     * @param BillingAddress|BillingAddressShape $billingAddress
     */
    public function withBillingAddress(
        BillingAddress|array $billingAddress
    ): self {
        $self = clone $this;
        $self['billingAddress'] = $billingAddress;

        return $self;
    }

    /**
     * The base definition for any payment credential. Handlers define specific credential types.
     *
     * @param Credential|CredentialShape $credential
     */
    public function withCredential(Credential|array $credential): self
    {
        $self = clone $this;
        $self['credential'] = $credential;

        return $self;
    }

    /**
     * Display information for this payment instrument. Each payment instrument schema defines its specific display properties, as outlined by the payment handler.
     *
     * @param array<string,mixed> $display
     */
    public function withDisplay(array $display): self
    {
        $self = clone $this;
        $self['display'] = $display;

        return $self;
    }
}
