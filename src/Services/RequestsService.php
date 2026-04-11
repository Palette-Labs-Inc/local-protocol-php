<?php

declare(strict_types=1);

namespace LocalProtocol\Services;

use LocalProtocol\Client;
use LocalProtocol\Core\Exceptions\APIException;
use LocalProtocol\Core\Util;
use LocalProtocol\RequestOptions;
use LocalProtocol\Requests\DeliveryRequest;
use LocalProtocol\Requests\Location\LocationWithCoordinates;
use LocalProtocol\Requests\Location\LocationWithPostalAddress;
use LocalProtocol\ServiceContracts\RequestsContract;
use LocalProtocol\Services\Requests\QuotesService;

/**
 * Create and manage delivery requests.
 *
 * @phpstan-import-type LocationShape from \LocalProtocol\Requests\Location
 * @phpstan-import-type RequestOpts from \LocalProtocol\RequestOptions
 */
final class RequestsService implements RequestsContract
{
    /**
     * @api
     */
    public RequestsRawService $raw;

    /**
     * @api
     */
    public QuotesService $quotes;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new RequestsRawService($client);
        $this->quotes = new QuotesService($client);
    }

    /**
     * @api
     *
     * Submit a new delivery request. The `nonce` field provides idempotency.
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
    ): DeliveryRequest {
        $params = Util::removeNulls(
            [
                'id' => $id,
                'dropoffLocation' => $dropoffLocation,
                'dropoffTime' => $dropoffTime,
                'nonce' => $nonce,
                'pickupLocation' => $pickupLocation,
                'pickupTime' => $pickupTime,
                'dropoffInstructions' => $dropoffInstructions,
                'pickupInstructions' => $pickupInstructions,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Returns a single delivery request by ID.
     *
     * @param string $requestID delivery request identifier
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $requestID,
        RequestOptions|array|null $requestOptions = null
    ): DeliveryRequest {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($requestID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Returns all delivery requests.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return list<DeliveryRequest>
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): array {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(requestOptions: $requestOptions);

        return $response->parse();
    }
}
