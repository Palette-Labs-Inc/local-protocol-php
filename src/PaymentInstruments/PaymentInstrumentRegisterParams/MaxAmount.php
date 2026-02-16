<?php

declare(strict_types=1);

namespace LocalProtocol\PaymentInstruments\PaymentInstrumentRegisterParams;

use LocalProtocol\Core\Attributes\Required;
use LocalProtocol\Core\Concerns\SdkModel;
use LocalProtocol\Core\Contracts\BaseModel;
use LocalProtocol\PaymentInstruments\PaymentInstrumentRegisterParams\MaxAmount\Currency;

/**
 * Maximum amount that can be authorized (atomic units). Currency chain_id MUST match the instrument chain_id; currency address and decimals MUST match token address and decimals.
 *
 * @phpstan-import-type CurrencyShape from \LocalProtocol\PaymentInstruments\PaymentInstrumentRegisterParams\MaxAmount\Currency
 *
 * @phpstan-type MaxAmountShape = array{
 *   currency: Currency|CurrencyShape, value: string
 * }
 */
final class MaxAmount implements BaseModel
{
    /** @use SdkModel<MaxAmountShape> */
    use SdkModel;

    /**
     * EVM token currency.
     */
    #[Required]
    public Currency $currency;

    /**
     * Value in atomic token units as an integer string.
     */
    #[Required]
    public string $value;

    /**
     * `new MaxAmount()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MaxAmount::with(currency: ..., value: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MaxAmount)->withCurrency(...)->withValue(...)
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
     * @param Currency|CurrencyShape $currency
     */
    public static function with(Currency|array $currency, string $value): self
    {
        $self = new self;

        $self['currency'] = $currency;
        $self['value'] = $value;

        return $self;
    }

    /**
     * EVM token currency.
     *
     * @param Currency|CurrencyShape $currency
     */
    public function withCurrency(Currency|array $currency): self
    {
        $self = clone $this;
        $self['currency'] = $currency;

        return $self;
    }

    /**
     * Value in atomic token units as an integer string.
     */
    public function withValue(string $value): self
    {
        $self = clone $this;
        $self['value'] = $value;

        return $self;
    }
}
