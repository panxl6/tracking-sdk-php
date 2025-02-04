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
use Tracking\API\Tracking\GetTrackingsQuery;
use Tracking\API\Tracking\DeleteTrackingBySlugTrackingNumberQuery;
use Tracking\API\Tracking\GetTrackingByIdQuery;
use Tracking\API\Tracking\RetrackTrackingBySlugTrackingNumberQuery;
use Tracking\API\Tracking\UpdateTrackingBySlugTrackingNumberQuery;
use Tracking\API\Tracking\GetTrackingBySlugTrackingNumberQuery;
use Tracking\API\Tracking\MarkTrackingCompletedBySlugTrackingNumberQuery;

class Tracking extends APIBase
{
    private $httpClient;

    public function __construct(Http $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
    * @throws AfterShipError
    */
    public function getTrackings(
        GetTrackingsQuery $query = null,
        array $headers = []
    ): \Tracking\API\Tracking\GetTrackingsResponse {
        $options = [
            'headers' => $headers,
            'query' => $query ? $query->toArray() : [],
        ];
        $resp = $this->httpClient->request('GET', sprintf("/tracking/2024-04/trackings"), $options);
        $data = $this->parseMultipleResources(
            $resp,
            'trackings',
            \Tracking\Model\Tracking::class,
            \Tracking\Model\PaginationPage::class
        );
        $result = new \Tracking\API\Tracking\GetTrackingsResponse($data['resources'], $data['pagination']);
        return $result;
    }
    /**
    * @throws AfterShipError
    */
    public function retrackTrackingById(
        string $id,
        array $headers = []
    ): \Tracking\Model\PartialUpdateTracking {
        if ($id === "") {
            throw ErrorCode::genLocalError(ErrorCode::INVALID_REQUEST, "Param 'id' cannot be an empty string");
        }

        $options = [
            'headers' => $headers,
        ];
        $resp = $this->httpClient->request('POST', sprintf("/tracking/2024-04/trackings/%s/retrack", $id), $options);
        $result = $this->parseSingleResource($resp, 'tracking', \Tracking\Model\PartialUpdateTracking::class);
        return $result;
    }
    /**
    * @throws AfterShipError
    */
    public function deleteTrackingBySlugTrackingNumber(
        string $slug,
        string $tracking_number,
        DeleteTrackingBySlugTrackingNumberQuery $query = null,
        array $headers = []
    ): \Tracking\Model\PartialDeleteTracking {
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
        $resp = $this->httpClient->request('DELETE', sprintf("/tracking/2024-04/trackings/%s/%s", $slug, $tracking_number), $options);
        $result = $this->parseSingleResource($resp, 'tracking', \Tracking\Model\PartialDeleteTracking::class);
        return $result;
    }
    /**
    * @throws AfterShipError
    */
    public function getTrackingById(
        string $id,
        GetTrackingByIdQuery $query = null,
        array $headers = []
    ): \Tracking\Model\Tracking {
        if ($id === "") {
            throw ErrorCode::genLocalError(ErrorCode::INVALID_REQUEST, "Param 'id' cannot be an empty string");
        }

        $options = [
            'headers' => $headers,
            'query' => $query ? $query->toArray() : [],
        ];
        $resp = $this->httpClient->request('GET', sprintf("/tracking/2024-04/trackings/%s", $id), $options);
        $result = $this->parseSingleResource($resp, 'tracking', \Tracking\Model\Tracking::class);
        return $result;
    }
    /**
    * @throws AfterShipError
    */
    public function updateTrackingById(
        string $id,
        \Tracking\API\Tracking\TrackingUpdateTrackingByIdRequest $body,
        array $headers = []
    ): \Tracking\Model\Tracking {
        if ($id === "") {
            throw ErrorCode::genLocalError(ErrorCode::INVALID_REQUEST, "Param 'id' cannot be an empty string");
        }

        $options = [
            'headers' => $headers,

            'json' => ['tracking' => $body->toRequestArray()],
        ];
        $resp = $this->httpClient->request('PUT', sprintf("/tracking/2024-04/trackings/%s", $id), $options);
        $result = $this->parseSingleResource($resp, 'tracking', \Tracking\Model\Tracking::class);
        return $result;
    }
    /**
    * @throws AfterShipError
    */
    public function retrackTrackingBySlugTrackingNumber(
        string $slug,
        string $tracking_number,
        RetrackTrackingBySlugTrackingNumberQuery $query = null,
        array $headers = []
    ): \Tracking\Model\PartialUpdateTracking {
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
        $resp = $this->httpClient->request('POST', sprintf("/tracking/2024-04/trackings/%s/%s/retrack", $slug, $tracking_number), $options);
        $result = $this->parseSingleResource($resp, 'tracking', \Tracking\Model\PartialUpdateTracking::class);
        return $result;
    }
    /**
    * @throws AfterShipError
    */
    public function createTracking(
        \Tracking\API\Tracking\TrackingCreateTrackingRequest $body,
        array $headers = []
    ): \Tracking\Model\Tracking {
        $options = [
            'headers' => $headers,

            'json' => ['tracking' => $body->toRequestArray()],
        ];
        $resp = $this->httpClient->request('POST', sprintf("/tracking/2024-04/trackings"), $options);
        $result = $this->parseSingleResource($resp, 'tracking', \Tracking\Model\Tracking::class);
        return $result;
    }
    /**
    * @throws AfterShipError
    */
    public function deleteTrackingById(
        string $id,
        array $headers = []
    ): \Tracking\Model\PartialDeleteTracking {
        if ($id === "") {
            throw ErrorCode::genLocalError(ErrorCode::INVALID_REQUEST, "Param 'id' cannot be an empty string");
        }

        $options = [
            'headers' => $headers,
        ];
        $resp = $this->httpClient->request('DELETE', sprintf("/tracking/2024-04/trackings/%s", $id), $options);
        $result = $this->parseSingleResource($resp, 'tracking', \Tracking\Model\PartialDeleteTracking::class);
        return $result;
    }
    /**
    * @throws AfterShipError
    */
    public function updateTrackingBySlugTrackingNumber(
        string $slug,
        string $tracking_number,
        \Tracking\API\Tracking\TrackingUpdateTrackingBySlugTrackingNumberRequest $body,
        UpdateTrackingBySlugTrackingNumberQuery $query = null,
        array $headers = []
    ): \Tracking\Model\Tracking {
        if ($slug === "") {
            throw ErrorCode::genLocalError(ErrorCode::INVALID_REQUEST, "Param 'slug' cannot be an empty string");
        }
        if ($tracking_number === "") {
            throw ErrorCode::genLocalError(ErrorCode::INVALID_REQUEST, "Param 'tracking_number' cannot be an empty string");
        }

        $options = [
            'headers' => $headers,
            'query' => $query ? $query->toArray() : [],
            'json' => ['tracking' => $body->toRequestArray()],
        ];
        $resp = $this->httpClient->request('PUT', sprintf("/tracking/2024-04/trackings/%s/%s", $slug, $tracking_number), $options);
        $result = $this->parseSingleResource($resp, 'tracking', \Tracking\Model\Tracking::class);
        return $result;
    }
    /**
    * @throws AfterShipError
    */
    public function markTrackingCompletedById(
        string $id,
        \Tracking\API\Tracking\MarkTrackingCompletedByIdRequest $body,
        array $headers = []
    ): \Tracking\Model\Tracking {
        if ($id === "") {
            throw ErrorCode::genLocalError(ErrorCode::INVALID_REQUEST, "Param 'id' cannot be an empty string");
        }

        $options = [
            'headers' => $headers,

            'json' => $body->toRequestArray(),
        ];
        $resp = $this->httpClient->request('POST', sprintf("/tracking/2024-04/trackings/%s/mark-as-completed", $id), $options);
        $result = $this->parseSingleResource($resp, 'tracking', \Tracking\Model\Tracking::class);
        return $result;
    }
    /**
    * @throws AfterShipError
    */
    public function getTrackingBySlugTrackingNumber(
        string $slug,
        string $tracking_number,
        GetTrackingBySlugTrackingNumberQuery $query = null,
        array $headers = []
    ): \Tracking\Model\Tracking {
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
        $resp = $this->httpClient->request('GET', sprintf("/tracking/2024-04/trackings/%s/%s", $slug, $tracking_number), $options);
        $result = $this->parseSingleResource($resp, 'tracking', \Tracking\Model\Tracking::class);
        return $result;
    }
    /**
    * @throws AfterShipError
    */
    public function markTrackingCompletedBySlugTrackingNumber(
        string $slug,
        string $tracking_number,
        \Tracking\API\Tracking\MarkTrackingCompletedBySlugTrackingNumberRequest $body,
        MarkTrackingCompletedBySlugTrackingNumberQuery $query = null,
        array $headers = []
    ): \Tracking\Model\Tracking {
        if ($slug === "") {
            throw ErrorCode::genLocalError(ErrorCode::INVALID_REQUEST, "Param 'slug' cannot be an empty string");
        }
        if ($tracking_number === "") {
            throw ErrorCode::genLocalError(ErrorCode::INVALID_REQUEST, "Param 'tracking_number' cannot be an empty string");
        }

        $options = [
            'headers' => $headers,
            'query' => $query ? $query->toArray() : [],
            'json' => $body->toRequestArray(),
        ];
        $resp = $this->httpClient->request('POST', sprintf("/tracking/2024-04/trackings/%s/%s/mark-as-completed", $slug, $tracking_number), $options);
        $result = $this->parseSingleResource($resp, 'tracking', \Tracking\Model\Tracking::class);
        return $result;
    }
}
