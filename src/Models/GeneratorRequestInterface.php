<?php
namespace WebbyTroops\AiContentGenerator\Models;
use Illuminate\Http\Client\Response;
use InvalidArgumentException;

interface GeneratorRequestInterface
{
    /**
     * @param string $text
     * @return array
     */
    public function createPayload(string $text): array;
    
    /**
     * @return string
     */
    public function parseResponse(Response $response): string;
    
    /**
     * @param string $prompt
     * @return string
     */
    public function fetchContent(string $prompt): string;
    
    /**
     * @param string $params
     * @throw InvalidArgumentException
     */
    public function validatePayload(string $text);
}
