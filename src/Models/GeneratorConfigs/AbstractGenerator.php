<?php
namespace WebbyTroops\AiContentGenerator\Models\GeneratorConfigs;

use InvalidArgumentException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use WebbyTroops\AiContentGenerator\Models\Exception\AiException;

abstract class AbstractGenerator
{
    public const API_URL = "https://api.openai.com";

    abstract public function createPayload(string $text): array;

    public function validatePayload(string $text)
    {
        if (empty($text) || (strlen($text) < 5 || strlen($text) > 50)) {
            throw new InvalidArgumentException('Invalid query (must be between 5 and 50 charcters)');
        }
    }

    /**
     * @throws OpenAiException
     */
    public function fetchContent(string $text): string
    {
        $payload = $this->createPayload(
            $text
        );
        $token = core()->getConfigData('general.aiContentGenerator.general.ai-content-generator-api-key');
        if (empty($token)) {
            throw new AiException(__('Please enter the API keys in configuration'));
        }
        $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token
            ])->post(self::API_URL.'/v1/completions', $payload);

        $this->validateResponse($response);
        return $this->parseResponse($response);
    }

    /**
     * @throws AiException
     */
    protected function validateResponse(Response $result): void
    {
        if ($result->getStatusCode() === 401) {
            throw new AiException(__('You are not Authorize or API key is invalid'));
        }

        if ($result->getStatusCode() >= 500) {
            throw new AiException(__('Server error: %1', $result->clientError()));
        }
        $data = json_decode($result->getBody(), true);
        if (isset($data['error'])) {
            throw new AiException(__(
                $data['error']['type'] ?? 'unknown'.
                $data['error']['message'] ?? 'unknown'
            ));
        }

        if (!isset($data['choices'])) {
            throw new AiException(__('No results found'));
        }
    }

    public function parseResponse(Response $response): string
    {
        $data = json_decode($response->getBody(), true);
        $choices = $data['choices'] ?? [];
        $textData = reset($choices);

        $text = $textData['text'] ?? '';
        $text = trim($text);
        $text = trim($text, '"');

        return str_replace(["\n\r", "\n", "\r"], '', strip_tags($text));
    }

    public function getType(): string
    {
        return static::TYPE;
    }
}
