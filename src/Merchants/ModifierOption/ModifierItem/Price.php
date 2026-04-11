<?php

declare(strict_types=1);

namespace LocalProtocol\Merchants\ModifierOption\ModifierItem;

use LocalProtocol\Core\Attributes\Required;
use LocalProtocol\Core\Concerns\SdkModel;
use LocalProtocol\Core\Contracts\BaseModel;
use LocalProtocol\Merchants\ModifierOption\ModifierItem\Price\Currency\FiatCurrency;
use LocalProtocol\PaymentInstruments\EvmCurrency;

/**
 * Price for this modifier item.
 *
 * @phpstan-import-type CurrencyVariants from \LocalProtocol\Merchants\ModifierOption\ModifierItem\Price\Currency
 * @phpstan-import-type CurrencyShape from \LocalProtocol\Merchants\ModifierOption\ModifierItem\Price\Currency
 *
 * @phpstan-type PriceShape = array{currency: CurrencyShape, value: string}
 */
final class Price implements BaseModel
{
    /** @use SdkModel<PriceShape> */
    use SdkModel;

    /**
     * Currency descriptor (fiat or EVM token).
     *
     * @var CurrencyVariants $currency
     */
    #[Required]
    public FiatCurrency|EvmCurrency $currency;

    /**
     * Value in minor currency units as an integer string (e.g., "1000" = $10.00 USD, or atomic units for EVM tokens). Use "0" for free items.
     */
    #[Required]
    public string $value;

    /**
     * `new Price()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Price::with(currency: ..., value: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Price)->withCurrency(...)->withValue(...)
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
     * @param CurrencyShape $currency
     */
    public static function with(
        FiatCurrency|array|EvmCurrency $currency,
        string $value
    ): self {
        $self = new self;

        $self['currency'] = $currency;
        $self['value'] = $value;

        return $self;
    }

    /**
     * Currency descriptor (fiat or EVM token).
     *
     * @param CurrencyShape $currency
     */
    public function withCurrency(FiatCurrency|array|EvmCurrency $currency): self
    {
        $self = clone $this;
        $self['currency'] = $currency;

        return $self;
    }

    /**
     * Value in minor currency units as an integer string (e.g., "1000" = $10.00 USD, or atomic units for EVM tokens). Use "0" for free items.
     */
    public function withValue(string $value): self
    {
        $self = clone $this;
        $self['value'] = $value;

        return $self;
    }
}
