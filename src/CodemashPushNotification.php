<?php

namespace Codemash;

use Codemash\Exceptions\RequestValidationException;
use Codemash\Params\CodemashPushNotificationParams;
use GuzzleHttp\Exception\GuzzleException;

class CodemashPushNotification
{
    private CodemashClient $client;
    private string $uriPrefix = 'v2/notifications/push/';

    public function __construct(CodemashClient $client)
    {
        $this->client = $client;
    }

    /**
     * @throws GuzzleException
     * @throws RequestValidationException
     */
    public function getTemplate(array $params): array
    {
        $params = CodemashPushNotificationParams::prepGetByIdParams($params);

        $response = $this->client->request('GET', $this->uriPrefix . 'templates/' . $params['id'], [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ]);

        return $response['result'];
    }

    /**
     * @throws GuzzleException
     */
    public function getTemplates(): array
    {
        $response = $this->client->request('GET', $this->uriPrefix . 'templates', [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ]);

        return $response['result'];
    }

    /**
     * @throws GuzzleException
     * @throws RequestValidationException
     */
    public function sendNotification(array $params): string
    {
        $params = CodemashPushNotificationParams::prepSendNotificationParams($params);

        $response = $this->client->request('POST', $this->uriPrefix, [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            'body' => toJson($params),
        ]);

        return $response['result'];
    }

    /**
     * @throws GuzzleException
     * @throws RequestValidationException
     */
    public function getNotification(array $params): array
    {
        $params = CodemashPushNotificationParams::prepGetByIdParams($params);

        $response = $this->client->request('GET', $this->uriPrefix . $params['id'], [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ]);

        return $response['result'];
    }

    /**
     * @throws GuzzleException
     */
    public function getNotifications(array $params = []): array
    {
        $params = CodemashPushNotificationParams::prepGetNotificationsParams($params);

        $response = $this->client->request('GET', $this->uriPrefix, [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            'body' => toJson($params),
        ]);

        return $response['result'];
    }

    /**
     * @throws GuzzleException
     */
    public function getNotificationCount(array $params): array
    {
        $params = CodemashPushNotificationParams::prepGetNotificationsParams($params);

        $response = $this->client->request('GET', $this->uriPrefix . 'count', [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            'body' => toJson($params),
        ]);

        return $response['result'];
    }

    /**
     * @throws GuzzleException
     * @throws RequestValidationException
     */
    public function readNotification(array $params): int
    {
        $params = CodemashPushNotificationParams::prepGetByIdParams($params);

        return $this->client->request('PATCH', $this->uriPrefix . $params['id'] . '/read', [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ]);
    }

    /**
     * @throws GuzzleException
     * @throws RequestValidationException
     */
    public function deleteNotification(array $params): int
    {
        $params = CodemashPushNotificationParams::prepGetByIdParams($params);

        return $this->client->request('DELETE', $this->uriPrefix . $params['id'], [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ]);
    }

    /**
     * @throws GuzzleException
     * @throws RequestValidationException
     */
    public function registerDevice(array $params = []): array
    {
        $params = CodemashPushNotificationParams::prepRegisterDeviceParams($params);

        $response = $this->client->request('POST', $this->uriPrefix . 'devices', [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            'body' => toJson($params),
        ]);

        return $response['result'];
    }

    /**
     * @throws GuzzleException
     * @throws RequestValidationException
     */
    public function registerExpoToken(array $params): string
    {
        $params = CodemashPushNotificationParams::prepRegisterExpoTokenParams($params);

        $response = $this->client->request('POST', $this->uriPrefix . 'token/expo', [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            'body' => toJson($params),
        ]);

        return $response['result'];
    }

    /**
     * @throws GuzzleException
     * @throws RequestValidationException
     */
    public function getDevice(array $params): array
    {
        $params = CodemashPushNotificationParams::prepGetByIdParams($params);

        $response = $this->client->request('GET', $this->uriPrefix . 'devices/' . $params['id'], [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ]);

        return $response['result'];
    }

    /**
     * @throws GuzzleException
     */
    public function getDevices(): array
    {
        $response = $this->client->request('GET', $this->uriPrefix . 'devices', [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ]);

        return $response['result'];
    }

    /**
     * @throws GuzzleException
     * @throws RequestValidationException
     */
    public function deleteDevice(array $params): int
    {
        $params = CodemashPushNotificationParams::prepGetByIdParams($params);

        return $this->client->request('DELETE', $this->uriPrefix . 'devices/' . $params['id'], [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ]);
    }

    /**
     * @throws GuzzleException
     * @throws RequestValidationException
     */
    public function deleteDeviceToken(array $params): int
    {
        $params = CodemashPushNotificationParams::prepGetByIdParams($params);

        return $this->client->request('DELETE', $this->uriPrefix . 'devices/' . $params['id'] . '/token', [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ]);
    }

    /**
     * @throws GuzzleException
     * @throws RequestValidationException
     */
    public function updateDeviceMeta(array $params): bool
    {
        $params = CodemashPushNotificationParams::prepUpdateDeviceMetaParams($params);

        $response = $this->client->request('PATCH', $this->uriPrefix . 'devices/' . $params['id'] . '/metadata', [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            'body' => toJson($params),
        ]);

        return $response['result'];
    }

    /**
     * @throws GuzzleException
     * @throws RequestValidationException
     */
    public function updateDeviceTimezone(array $params): bool
    {
        $params = CodemashPushNotificationParams::prepUpdateDeviceTimezoneParams($params);

        $response = $this->client->request('PATCH', $this->uriPrefix . 'devices/' . $params['id'] . '/timezone', [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            'body' => toJson($params),
        ]);

        return $response['result'];
    }

    /**
     * @throws GuzzleException
     * @throws RequestValidationException
     */
    public function updateDeviceUser(array $params): bool
    {
        $params = CodemashPushNotificationParams::prepUpdateDeviceUserParams($params);

        $response = $this->client->request('PATCH', $this->uriPrefix . 'devices/' . $params['id'] . '/user', [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            'body' => toJson($params),
        ]);

        return $response['result'];
    }
}