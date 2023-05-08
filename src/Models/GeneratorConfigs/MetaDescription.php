<?php
namespace WebbyTroops\AiContentGenerator\Models\GeneratorConfigs;

use WebbyTroops\AiContentGenerator\Models\GeneratorRequestInterface;

class MetaDescription extends AbstractGenerator implements GeneratorRequestInterface
{
    public function createPayload(string $text): array
    {
        parent::validatePayload($text);
        return [
            "model" => "text-davinci-003",
            "prompt" => sprintf("Create a HTML meta description (short as possible) from the following product:\n%s", $text),
            "n" => 1,
            "temperature" => 0.5,
            "max_tokens" => 255,
            "frequency_penalty" => 0,
            "presence_penalty" => 0
        ];
    }
}
