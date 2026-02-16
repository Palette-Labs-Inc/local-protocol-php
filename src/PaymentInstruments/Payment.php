<?php

declare(strict_types=1);

namespace LocalProtocol\PaymentInstruments;

use LocalProtocol\Core\Attributes\Required;
use LocalProtocol\Core\Concerns\SdkModel;
use LocalProtocol\Core\Contracts\BaseModel;

/**
 * Payment configuration containing handlers.
 *
 * @phpstan-import-type PaymentInstrumentShape from \LocalProtocol\PaymentInstruments\PaymentInstrument
 *
 * @phpstan-type PaymentShape = array{
 *   instruments: list<PaymentInstrument|PaymentInstrumentShape>
 * }
 */
final class Payment implements BaseModel
{
    /** @use SdkModel<PaymentShape> */
    use SdkModel;

    /**
     * The payment instruments available for this payment. Each instrument is associated with a specific handler via the handler_id field. Handlers can extend the base payment_instrument schema to add handler-specific fields.
     *
     * @var list<PaymentInstrument> $instruments
     */
    #[Required(list: PaymentInstrument::class)]
    public array $instruments;

    /**
     * `new Payment()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Payment::with(instruments: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Payment)->withInstruments(...)
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
     * @param list<PaymentInstrument|PaymentInstrumentShape> $instruments
     */
    public static function with(array $instruments): self
    {
        $self = new self;

        $self['instruments'] = $instruments;

        return $self;
    }

    /**
     * The payment instruments available for this payment. Each instrument is associated with a specific handler via the handler_id field. Handlers can extend the base payment_instrument schema to add handler-specific fields.
     *
     * @param list<PaymentInstrument|PaymentInstrumentShape> $instruments
     */
    public function withInstruments(array $instruments): self
    {
        $self = clone $this;
        $self['instruments'] = $instruments;

        return $self;
    }
}
