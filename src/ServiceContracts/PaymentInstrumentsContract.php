<?php

declare(strict_types=1);

namespace LocalProtocol\ServiceContracts;

use LocalProtocol\Core\Exceptions\APIException;
use LocalProtocol\PaymentInstruments\EvmAuthCaptureEscrowInstrument;
use LocalProtocol\PaymentInstruments\PaymentInstrumentRegisterParams\Amount;
use LocalProtocol\PaymentInstruments\PaymentInstrumentRegisterParams\BillingAddress;
use LocalProtocol\PaymentInstruments\PaymentInstrumentRegisterParams\Credential;
use LocalProtocol\PaymentInstruments\PaymentInstrumentRegisterParams\MaxAmount;
use LocalProtocol\PaymentInstruments\PaymentInstrumentRegisterParams\Token;
use LocalProtocol\PaymentInstruments\PaymentInstrumentRegisterParams\Type;
use LocalProtocol\RequestOptions;

/**
 * @phpstan-import-type TokenShape from \LocalProtocol\PaymentInstruments\PaymentInstrumentRegisterParams\Token
 * @phpstan-import-type AmountShape from \LocalProtocol\PaymentInstruments\PaymentInstrumentRegisterParams\Amount
 * @phpstan-import-type MaxAmountShape from \LocalProtocol\PaymentInstruments\PaymentInstrumentRegisterParams\MaxAmount
 * @phpstan-import-type BillingAddressShape from \LocalProtocol\PaymentInstruments\PaymentInstrumentRegisterParams\BillingAddress
 * @phpstan-import-type CredentialShape from \LocalProtocol\PaymentInstruments\PaymentInstrumentRegisterParams\Credential
 * @phpstan-import-type RequestOpts from \LocalProtocol\RequestOptions
 */
interface PaymentInstrumentsContract
{
    /**
     * @api
     *
     * @param string $id a unique identifier for this instrument instance, assigned by the platform
     * @param Token|TokenShape $token EVM token
     * @param Amount|AmountShape $amount Amount in atomic units. Currency chain_id MUST match the instrument chain_id; currency address and decimals MUST match token address and decimals.
     * @param \DateTimeInterface $authorizationExpiresAt authorization expiration timestamp (RFC 3339)
     * @param int $chainID EVM chain id for the escrow contract
     * @param string $contract escrow contract address on the target chain
     * @param string $handlerID The unique identifier for the handler instance that produced this instrument. This corresponds to the 'id' field in the Payment Handler definition.
     * @param MaxAmount|MaxAmountShape $maxAmount Maximum amount that can be authorized (atomic units). Currency chain_id MUST match the instrument chain_id; currency address and decimals MUST match token address and decimals.
     * @param string $nonce unique nonce used to compute the payment info hash
     * @param string $operator operator address used to compute the payment info hash
     * @param string $payer payer address used to compute the payment info hash
     * @param string $paymentInfoHash hash that identifies the on-chain payment authorization
     * @param \DateTimeInterface $preapprovalExpiresAt pre-approval expiration timestamp (RFC 3339)
     * @param string $receiver receiver address used for captures
     * @param \DateTimeInterface $refundExpiresAt refund expiration timestamp (RFC 3339)
     * @param Type|value-of<Type> $type
     * @param BillingAddress|BillingAddressShape $billingAddress the billing address associated with this payment method
     * @param Credential|CredentialShape $credential The base definition for any payment credential. Handlers define specific credential types.
     * @param array<string,mixed> $display Display information for this payment instrument. Each payment instrument schema defines its specific display properties, as outlined by the payment handler.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function register(
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
        RequestOptions|array|null $requestOptions = null,
    ): EvmAuthCaptureEscrowInstrument;
}
