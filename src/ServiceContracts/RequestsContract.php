<?php

declare(strict_types=1);

namespace LocalProtocol\ServiceContracts;

use LocalProtocol\Core\Exceptions\APIException;
use LocalProtocol\RequestOptions;
use LocalProtocol\Requests\DeliveryRequest;
use LocalProtocol\Requests\Location\LocationWithCoordinates;
use LocalProtocol\Requests\Location\LocationWithPostalAddress;

/**
 * @phpstan-import-type LocationShape from \LocalProtocol\Requests\Location
 * @phpstan-import-type RequestOpts from \LocalProtocol\RequestOptions
 */
interface RequestsContract
{
    /**
     * @api
     *
     * @param string $id unique request identifier
     * @param LocationShape $dropoffLocation dropoff location for the delivery
     * @param \DateTimeInterface $dropoffTime requested dropoff time (RFC 3339)
     * @param string $nonce client-generated idempotency key
     * @param LocationShape $pickupLocation pickup location for the delivery
     * @param \DateTimeInterface $pickupTime requested pickup time (RFC 3339)
     * @param string $dropoffInstructions dropoff directions, access codes, or delivery notes
     * @param string $pickupInstructions pickup directions, access codes, or handling notes
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $id,
        LocationWithPostalAddress|array|LocationWithCoordinates $dropoffLocation,
        \DateTimeInterface $dropoffTime,
        string $nonce,
        LocationWithPostalAddress|array|LocationWithCoordinates $pickupLocation,
        \DateTimeInterface $pickupTime,
        ?string $dropoffInstructions = null,
        ?string $pickupInstructions = null,
        RequestOptions|array|null $requestOptions = null,
    ): DeliveryRequest;

    /**
     * @api
     *
     * @param string $requestID delivery request identifier
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $requestID,
        RequestOptions|array|null $requestOptions = null
    ): DeliveryRequest;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return list<DeliveryRequest>
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): array;
}
