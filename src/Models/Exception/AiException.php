<?php

namespace WebbyTroops\AiContentGenerator\Models\Exception;

use Exception;

class AiException extends Exception
{
    public function render($request)
    {       
        return response()->json(["error" => true, "message" => $this->getMessage()]);       
    }
}
