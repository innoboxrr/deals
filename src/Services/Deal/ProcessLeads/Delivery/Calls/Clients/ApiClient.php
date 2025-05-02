<?php

namespace Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Calls\Clients;

use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\Abstracts\AbstractCallClient;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;
use Innoboxrr\Deals\Services\Deal\ProcessLeads\Delivery\DTOs\ClientResponse;
use Exception;

class ApiClient extends AbstractCallClient
{
    protected string $endpoint;
    protected string $method;
    protected string $dataMethod;
    protected array $headers = [];
    protected string $authType;
    protected array $authConfig = [];

    protected ?Response $httpResponse = null;

    public function buildClient(): self
    {
        $data = $this->getCall()->all();
        $this->endpoint = $data['endpoint'] ?? '';
        $this->method = strtoupper($data['method'] ?? 'POST');
        $this->dataMethod = strtolower($data['data_method'] ?? 'json');
        $this->authType = strtolower($data['auth']['type'] ?? 'none');
        $this->authConfig = $data['auth'] ?? [];
        $this->setHeaders($data['headers'] ?? []);
        return $this;
    }

    public function setHeaders(array $headers): void
    {
        foreach ($headers as $header) {
            if (!empty($header['key']) && isset($header['value'])) {
                $this->headers[$header['key']] = $header['value'];
            }
        }
    }

    public function authenticate(): void
    {
        match ($this->authType) {
            'apikey' => $this->applyApiKey(),
            'basic' => $this->applyBasicAuth(),
            'bearer' => $this->applyBearer(),
            'oauth' => $this->applyOAuth(),
            default => null,
        };
    }

    protected function applyApiKey(): void
    {
        if (!empty($this->authConfig['api_key'])) {
            $this->headers['Authorization'] = 'ApiKey ' . $this->authConfig['api_key'];
        }
    }

    protected function applyBasicAuth(): void
    {
        if (!empty($this->authConfig['username']) && !empty($this->authConfig['password'])) {
            Http::withBasicAuth(
                $this->authConfig['username'],
                $this->authConfig['password']
            );
        }
    }

    protected function applyBearer(): void
    {
        if (!empty($this->authConfig['api_key'])) {
            $this->headers['Authorization'] = 'Bearer ' . $this->authConfig['api_key'];
        }
    }

    protected function applyOAuth(): void
    {
        $oauth = $this->authConfig['oauth'] ?? [];

        if (!empty($oauth['access_token'])) {
            $this->headers['Authorization'] = 'Bearer ' . $oauth['access_token'];
        } else {
            // Posible hook para refresh_token automático
            throw new Exception("Falta el access_token para autenticación OAuth.");
        }
    }

    public function execute(): void
    {
        $this->authenticate();

        $payload = $this->getCall()->getInput()->toArray();
        $wrapped = $this->wrapData($payload);
        $client = Http::withHeaders($this->headers);

        try {
            $this->httpResponse = match ($this->method) {
                'POST' => $client->post($this->endpoint, $wrapped),
                'PUT' => $client->put($this->endpoint, $wrapped),
                'PATCH' => $client->patch($this->endpoint, $wrapped),
                'DELETE' => $client->delete($this->endpoint, $wrapped),
                'GET' => $client->get($this->endpoint, $wrapped),
                default => throw new Exception("Método HTTP no soportado: {$this->method}")
            };
        } catch (Exception $e) {
            throw new Exception("Error al ejecutar la petición: " . $e->getMessage());
        }

        $response = ClientResponse::fromArray([
            'status' => $this->httpResponse->status(),
            'input' => $payload,
            'output' => $this->httpResponse->json() ?? $this->httpResponse->body(),
        ]);

        $this->setResponse($response);
    }

    protected function wrapData(array $data): array|string
    {
        return match ($this->dataMethod) {
            'json' => $data,
            'form_params' => $data,
            'query' => ['query' => $data],
            'body' => ['body' => json_encode($data)],
            'raw' => json_encode($data),
            'multipart' => $this->transformToMultipart($data),
            default => throw new Exception("data_method '{$this->dataMethod}' no soportado."),
        };
    }

    protected function transformToMultipart(array $data): array
    {
        $multipart = [];
        foreach ($data as $name => $value) {
            $multipart[] = [
                'name' => $name,
                'contents' => is_array($value) ? json_encode($value) : $value,
            ];
        }
        return $multipart;
    }
}
