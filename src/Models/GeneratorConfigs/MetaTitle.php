<?php
namespace WebbyTroops\AiContentGenerator\Models\GeneratorConfigs;

use WebbyTroops\AiContentGenerator\Models\GeneratorRequestInterface;

class MetaTitle extends AbstractGenerator implements GeneratorRequestInterface
{
    public function createPayload(string $text): array
    {
        parent::validatePayload($text);
        return [
            "model" => "text-davinci-003",
            "prompt" => sprintf("Create HTML meta title (only content) of the following product:\n%s", $text),
            "n" => 1,
            "temperature" => 0.5,
            "max_tokens" => 100,
            "frequency_penalty" => 0,
            "presence_penalty" => 0
        ];
    }
}
