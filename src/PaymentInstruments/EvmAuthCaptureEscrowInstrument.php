<?php

declare(strict_types=1);

namespace LocalProtocol\PaymentInstruments;

use LocalProtocol\Core\Attributes\Optional;
use LocalProtocol\Core\Attributes\Required;
use LocalProtocol\Core\Concerns\SdkModel;
use LocalProtocol\Core\Contracts\BaseModel;
use LocalProtocol\PaymentInstruments\EvmAuthCaptureEscrowInstrumentDetails\Amount;
use LocalProtocol\PaymentInstruments\EvmAuthCaptureEscrowInstrumentDetails\MaxAmount;
use LocalProtocol\PaymentInstruments\EvmAuthCaptureEscrowInstrumentDetails\Token;
use LocalProtocol\PaymentInstruments\PaymentInstrument\BillingAddress;
use LocalProtocol\PaymentInstruments\PaymentInstrument\Credential;

/**
 * Payment instrument for auth/capture escrow on EVM chains.
 *
 * @phpstan-import-type BillingAddressShape from \LocalProtocol\PaymentInstruments\PaymentInstrument\BillingAddress
 * @phpstan-import-type CredentialShape from \LocalProtocol\PaymentInstruments\PaymentInstrument\Credential
 * @phpstan-import-type TokenShape from \LocalProtocol\PaymentInstruments\EvmAuthCaptureEscrowInstrumentDetails\Token
 * @phpstan-import-type AmountShape from \LocalProtocol\PaymentInstruments\EvmAuthCaptureEscrowInstrumentDetails\Amount
 * @phpstan-import-type MaxAmountShape from \LocalProtocol\PaymentInstruments\EvmAuthCaptureEscrowInstrumentDetails\MaxAmount
 *
 * @phpstan-type EvmAuthCaptureEscrowInstrumentShape = array{
 *   id: string,
 *   handlerID: string,
 *   type: string,
 *   billingAddress?: null|BillingAddress|BillingAddressShape,
 *   credential?: null|Credential|CredentialShape,
 *   display?: array<string,mixed>|null,
 *   token: Token|TokenShape,
 *   amount: \LocalProtocol\PaymentInstruments\EvmAuthCaptureEscrowInstrumentDetails\Amount|AmountShape,
 *   authorizationExpiresAt: \DateTimeInterface,
 *   chainID: int,
 *   contract: string,
 *   maxAmount: MaxAmount|MaxAmountShape,
 *   nonce: string,
 *   operator: string,
 *   payer: string,
 *   paymentInfoHash: string,
 *   preapprovalExpiresAt: \DateTimeInterface,
 *   receiver: string,
 *   refundExpiresAt: \DateTimeInterface,
 * }
 */
final class EvmAuthCaptureEscrowInstrument implements BaseModel
{
    /** @use SdkModel<EvmAuthCaptureEscrowInstrumentShape> */
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

    /**
     * `new EvmAuthCaptureEscrowInstrument()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * EvmAuthCaptureEscrowInstrument::with(
     *   id: ...,
     *   handlerID: ...,
     *   type: ...,
     *   token: ...,
     *   amount: ...,
     *   authorizationExpiresAt: ...,
     *   chainID: ...,
     *   contract: ...,
     *   maxAmount: ...,
     *   nonce: ...,
     *   operator: ...,
     *   payer: ...,
     *   paymentInfoHash: ...,
     *   preapprovalExpiresAt: ...,
     *   receiver: ...,
     *   refundExpiresAt: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new EvmAuthCaptureEscrowInstrument)
     *   ->withID(...)
     *   ->withHandlerID(...)
     *   ->withType(...)
     *   ->withToken(...)
     *   ->withAmount(...)
     *   ->withAuthorizationExpiresAt(...)
     *   ->withChainID(...)
     *   ->withContract(...)
     *   ->withMaxAmount(...)
     *   ->withNonce(...)
     *   ->withOperator(...)
     *   ->withPayer(...)
     *   ->withPaymentInfoHash(...)
     *   ->withPreapprovalExpiresAt(...)
     *   ->withReceiver(...)
     *   ->withRefundExpiresAt(...)
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
     * @param BillingAddress|BillingAddressShape|null $billingAddress
     * @param Credential|CredentialShape|null $credential
     * @param array<string,mixed>|null $display
     */
    public static function with(
        string $id,
        string $handlerID,
        string $type,
        Token|array $token,
        Amount|array $amount,
        \DateTimeInterface $authorizationExpiresAt,
        int $chainID,
        string $contract,
        MaxAmount|array $maxAmount,
        string $nonce,
        string $operator,
        string $payer,
        string $paymentInfoHash,
        \DateTimeInterface $preapprovalExpiresAt,
        string $receiver,
        \DateTimeInterface $refundExpiresAt,
        BillingAddress|array|null $billingAddress = null,
        Credential|array|null $credential = null,
        ?array $display = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['handlerID'] = $handlerID;
        $self['type'] = $type;
        $self['token'] = $token;
        $self['amount'] = $amount;
        $self['authorizationExpiresAt'] = $authorizationExpiresAt;
        $self['chainID'] = $chainID;
        $self['contract'] = $contract;
        $self['maxAmount'] = $maxAmount;
        $self['nonce'] = $nonce;
        $self['operator'] = $operator;
        $self['payer'] = $payer;
        $self['paymentInfoHash'] = $paymentInfoHash;
        $self['preapprovalExpiresAt'] = $preapprovalExpiresAt;
        $self['receiver'] = $receiver;
        $self['refundExpiresAt'] = $refundExpiresAt;

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
}
