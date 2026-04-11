<?php

declare(strict_types=1);

namespace LocalProtocol\PaymentInstruments;

use LocalProtocol\Core\Attributes\Optional;
use LocalProtocol\Core\Attributes\Required;
use LocalProtocol\Core\Concerns\SdkModel;
use LocalProtocol\Core\Concerns\SdkParams;
use LocalProtocol\Core\Contracts\BaseModel;
use LocalProtocol\PaymentInstruments\PaymentInstrumentRegisterParams\Amount;
use LocalProtocol\PaymentInstruments\PaymentInstrumentRegisterParams\BillingAddress;
use LocalProtocol\PaymentInstruments\PaymentInstrumentRegisterParams\Credential;
use LocalProtocol\PaymentInstruments\PaymentInstrumentRegisterParams\MaxAmount;
use LocalProtocol\PaymentInstruments\PaymentInstrumentRegisterParams\Token;
use LocalProtocol\PaymentInstruments\PaymentInstrumentRegisterParams\Type;

/**
 * Register a payment instrument for use in order creation.
 *
 * @see LocalProtocol\Services\PaymentInstrumentsService::register()
 *
 * @phpstan-import-type TokenShape from \LocalProtocol\PaymentInstruments\PaymentInstrumentRegisterParams\Token
 * @phpstan-import-type AmountShape from \LocalProtocol\PaymentInstruments\PaymentInstrumentRegisterParams\Amount
 * @phpstan-import-type MaxAmountShape from \LocalProtocol\PaymentInstruments\PaymentInstrumentRegisterParams\MaxAmount
 * @phpstan-import-type BillingAddressShape from \LocalProtocol\PaymentInstruments\PaymentInstrumentRegisterParams\BillingAddress
 * @phpstan-import-type CredentialShape from \LocalProtocol\PaymentInstruments\PaymentInstrumentRegisterParams\Credential
 *
 * @phpstan-type PaymentInstrumentRegisterParamsShape = array{
 *   id: string,
 *   token: Token|TokenShape,
 *   amount: \LocalProtocol\PaymentInstruments\PaymentInstrumentRegisterParams\Amount|AmountShape,
 *   authorizationExpiresAt: \DateTimeInterface,
 *   chainID: int,
 *   contract: string,
 *   handlerID: string,
 *   maxAmount: MaxAmount|MaxAmountShape,
 *   nonce: string,
 *   operator: string,
 *   payer: string,
 *   paymentInfoHash: string,
 *   preapprovalExpiresAt: \DateTimeInterface,
 *   receiver: string,
 *   refundExpiresAt: \DateTimeInterface,
 *   type: Type|value-of<Type>,
 *   billingAddress?: null|BillingAddress|BillingAddressShape,
 *   credential?: null|Credential|CredentialShape,
 *   display?: array<string,mixed>|null,
 * }
 */
final class PaymentInstrumentRegisterParams implements BaseModel
{
    /** @use SdkModel<PaymentInstrumentRegisterParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * A unique identifier for this instrument instance, assigned by the platform.
     */
    #[Required]
    public string $id;

    /**
     * EVM token.
     */
    #[Required]
    public Token $token;

    /**
     * Amount in atomic units. Currency chain_id MUST match the instrument chain_id; currency address and decimals MUST match token address and decimals.
     */
    #[Required]
    public Amount $amount;

    /**
     * Authorization expiration timestamp (RFC 3339).
     */
    #[Required('authorization_expires_at')]
    public \DateTimeInterface $authorizationExpiresAt;

    /**
     * EVM chain id for the escrow contract.
     */
    #[Required('chain_id')]
    public int $chainID;

    /**
     * Escrow contract address on the target chain.
     */
    #[Required]
    public string $contract;

    /**
     * The unique identifier for the handler instance that produced this instrument. This corresponds to the 'id' field in the Payment Handler definition.
     */
    #[Required('handler_id')]
    public string $handlerID;

    /**
     * Maximum amount that can be authorized (atomic units). Currency chain_id MUST match the instrument chain_id; currency address and decimals MUST match token address and decimals.
     */
    #[Required('max_amount')]
    public MaxAmount $maxAmount;

    /**
     * Unique nonce used to compute the payment info hash.
     */
    #[Required]
    public string $nonce;

    /**
     * Operator address used to compute the payment info hash.
     */
    #[Required]
    public string $operator;

    /**
     * Payer address used to compute the payment info hash.
     */
    #[Required]
    public string $payer;

    /**
     * Hash that identifies the on-chain payment authorization.
     */
    #[Required('payment_info_hash')]
    public string $paymentInfoHash;

    /**
     * Pre-approval expiration timestamp (RFC 3339).
     */
    #[Required('preapproval_expires_at')]
    public \DateTimeInterface $preapprovalExpiresAt;

    /**
     * Receiver address used for captures.
     */
    #[Required]
    public string $receiver;

    /**
     * Refund expiration timestamp (RFC 3339).
     */
    #[Required('refund_expires_at')]
    public \DateTimeInterface $refundExpiresAt;

    /** @var value-of<Type> $type */
    #[Required(enum: Type::class)]
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
     * `new PaymentInstrumentRegisterParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PaymentInstrumentRegisterParams::with(
     *   id: ...,
     *   token: ...,
     *   amount: ...,
     *   authorizationExpiresAt: ...,
     *   chainID: ...,
     *   contract: ...,
     *   handlerID: ...,
     *   maxAmount: ...,
     *   nonce: ...,
     *   operator: ...,
     *   payer: ...,
     *   paymentInfoHash: ...,
     *   preapprovalExpiresAt: ...,
     *   receiver: ...,
     *   refundExpiresAt: ...,
     *   type: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PaymentInstrumentRegisterParams)
     *   ->withID(...)
     *   ->withToken(...)
     *   ->withAmount(...)
     *   ->withAuthorizationExpiresAt(...)
     *   ->withChainID(...)
     *   ->withContract(...)
     *   ->withHandlerID(...)
     *   ->withMaxAmount(...)
     *   ->withNonce(...)
     *   ->withOperator(...)
     *   ->withPayer(...)
     *   ->withPaymentInfoHash(...)
     *   ->withPreapprovalExpiresAt(...)
     *   ->withReceiver(...)
     *   ->withRefundExpiresAt(...)
     *   ->withType(...)
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
     * @param Token|TokenShape $token
     * @param Amount|AmountShape $amount
     * @param MaxAmount|MaxAmountShape $maxAmount
     * @param Type|value-of<Type> $type
     * @param BillingAddress|BillingAddressShape|null $billingAddress
     * @param Credential|CredentialShape|null $credential
     * @param array<string,mixed>|null $display
     */
    public static function with(
        string $id,
        Token|array $token,
        Amount|array $amount,
        \DateTimeInterface $authorizationExpiresAt,
        int $chainID,
        string $contract,
        string $handlerID,
        MaxAmount|array $maxAmount,
        string $nonce,
        string $operator,
        string $payer,
        string $paymentInfoHash,
        \DateTimeInterface $preapprovalExpiresAt,
        string $receiver,
        \DateTimeInterface $refundExpiresAt,
        Type|string $type,
        BillingAddress|array|null $billingAddress = null,
        Credential|array|null $credential = null,
        ?array $display = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['token'] = $token;
        $self['amount'] = $amount;
        $self['authorizationExpiresAt'] = $authorizationExpiresAt;
        $self['chainID'] = $chainID;
        $self['contract'] = $contract;
        $self['handlerID'] = $handlerID;
        $self['maxAmount'] = $maxAmount;
        $self['nonce'] = $nonce;
        $self['operator'] = $operator;
        $self['payer'] = $payer;
        $self['paymentInfoHash'] = $paymentInfoHash;
        $self['preapprovalExpiresAt'] = $preapprovalExpiresAt;
        $self['receiver'] = $receiver;
        $self['refundExpiresAt'] = $refundExpiresAt;
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
     * EVM token.
     *
     * @param Token|TokenShape $token
     */
    public function withToken(Token|array $token): self
    {
        $self = clone $this;
        $self['token'] = $token;

        return $self;
    }

    /**
     * Amount in atomic units. Currency chain_id MUST match the instrument chain_id; currency address and decimals MUST match token address and decimals.
     *
     * @param Amount|AmountShape $amount
     */
    public function withAmount(
        Amount|array $amount,
    ): self {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * Authorization expiration timestamp (RFC 3339).
     */
    public function withAuthorizationExpiresAt(
        \DateTimeInterface $authorizationExpiresAt
    ): self {
        $self = clone $this;
        $self['authorizationExpiresAt'] = $authorizationExpiresAt;

        return $self;
    }

    /**
     * EVM chain id for the escrow contract.
     */
    public function withChainID(int $chainID): self
    {
        $self = clone $this;
        $self['chainID'] = $chainID;

        return $self;
    }

    /**
     * Escrow contract address on the target chain.
     */
    public function withContract(string $contract): self
    {
        $self = clone $this;
        $self['contract'] = $contract;

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
     * Maximum amount that can be authorized (atomic units). Currency chain_id MUST match the instrument chain_id; currency address and decimals MUST match token address and decimals.
     *
     * @param MaxAmount|MaxAmountShape $maxAmount
     */
    public function withMaxAmount(MaxAmount|array $maxAmount): self
    {
        $self = clone $this;
        $self['maxAmount'] = $maxAmount;

        return $self;
    }

    /**
     * Unique nonce used to compute the payment info hash.
     */
    public function withNonce(string $nonce): self
    {
        $self = clone $this;
        $self['nonce'] = $nonce;

        return $self;
    }

    /**
     * Operator address used to compute the payment info hash.
     */
    public function withOperator(string $operator): self
    {
        $self = clone $this;
        $self['operator'] = $operator;

        return $self;
    }

    /**
     * Payer address used to compute the payment info hash.
     */
    public function withPayer(string $payer): self
    {
        $self = clone $this;
        $self['payer'] = $payer;

        return $self;
    }

    /**
     * Hash that identifies the on-chain payment authorization.
     */
    public function withPaymentInfoHash(string $paymentInfoHash): self
    {
        $self = clone $this;
        $self['paymentInfoHash'] = $paymentInfoHash;

        return $self;
    }

    /**
     * Pre-approval expiration timestamp (RFC 3339).
     */
    public function withPreapprovalExpiresAt(
        \DateTimeInterface $preapprovalExpiresAt
    ): self {
        $self = clone $this;
        $self['preapprovalExpiresAt'] = $preapprovalExpiresAt;

        return $self;
    }

    /**
     * Receiver address used for captures.
     */
    public function withReceiver(string $receiver): self
    {
        $self = clone $this;
        $self['receiver'] = $receiver;

        return $self;
    }

    /**
     * Refund expiration timestamp (RFC 3339).
     */
    public function withRefundExpiresAt(
        \DateTimeInterface $refundExpiresAt
    ): self {
        $self = clone $this;
        $self['refundExpiresAt'] = $refundExpiresAt;

        return $self;
    }

    /**
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
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
