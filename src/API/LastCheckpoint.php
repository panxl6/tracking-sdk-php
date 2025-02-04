<?php
/*
 * This code was auto generated by AfterShip SDK Generator.
 * Do not edit the class manually.
 */
namespace Tracking\API;

use Tracking\API\Base\APIBase;
use Tracking\Exception\AfterShipError;
use Tracking\Exception\ErrorCode;
use Tracking\Transport\Http;
use Tracking\API\LastCheckpoint\GetCheckpointByTrackingIdQuery;
use Tracking\API\LastCheckpoint\GetCheckpointBySlugTrackingNumberQuery;

class LastCheckpoint extends APIBase
{
    private $httpClient;

    public function __construct(Http $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
    * @throws AfterShipError
    */
    public function getCheckpointByTrackingId(
        string $tracking_id,
        GetCheckpointByTrackingIdQuery $query = null,
        array $headers = []
    ): \Tracking\API\LastCheckpoint\GetCheckpointByTrackingIdResponse {
        if ($tracking_id === "") {
            throw ErrorCode::genLocalError(ErrorCode::INVALID_REQUEST, "Param 'tracking_id' cannot be an empty string");
        }

        $options = [
            'headers' => $headers,
            'query' => $query ? $query->toArray() : [],
        ];
        $resp = $this->httpClient->request('GET', sprintf("/tracking/2024-04/last_checkpoint/%s", $tracking_id), $options);
        $result = $this->parseSingleResource($resp, '', \Tracking\API\LastCheckpoint\GetCheckpointByTrackingIdResponse::class);
        return $result;
    }
    /**
    * @throws AfterShipError
    */
    public function getCheckpointBySlugTrackingNumber(
        string $slug,
        string $tracking_number,
        GetCheckpointBySlugTrackingNumberQuery $query = null,
        array $headers = []
    ): \Tracking\API\LastCheckpoint\GetCheckpointBySlugTrackingNumberResponse {
        if ($slug === "") {
            throw ErrorCode::genLocalError(ErrorCode::INVALID_REQUEST, "Param 'slug' cannot be an empty string");
        }
        if ($tracking_number === "") {
            throw ErrorCode::genLocalError(ErrorCode::INVALID_REQUEST, "Param 'tracking_number' cannot be an empty string");
        }

        $options = [
            'headers' => $headers,
            'query' => $query ? $query->toArray() : [],
        ];
        $resp = $this->httpClient->request('GET', sprintf("/tracking/2024-04/last_checkpoint/%s/%s", $slug, $tracking_number), $options);
        $result = $this->parseSingleResource($resp, '', \Tracking\API\LastCheckpoint\GetCheckpointBySlugTrackingNumberResponse::class);
        return $result;
    }
}
