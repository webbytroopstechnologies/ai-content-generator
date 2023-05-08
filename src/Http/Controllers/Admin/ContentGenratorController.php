<?php

namespace WebbyTroops\AiContentGenerator\Http\Controllers\Admin;

use Webkul\Admin\Http\Controllers\Controller;
use WebbyTroops\AiContentGenerator\Http\Requests\GeneratorRequest;
use WebbyTroops\AiContentGenerator\Models\GeneratorConfigs;
use WebbyTroops\AiContentGenerator\Models\Exception\AiException;
use InvalidArgumentException;

class ContentGenratorController extends Controller
{
    
    /**
     * Generate AI Content.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function generate(GeneratorRequest $generatorRequest)
    {
        try {
            $generatorType  = $this->getGeneratorType($generatorRequest->post('generator_type'));
            $keyword = $generatorRequest->post('keyword');
            if($generatorType){
                $contentData = $generatorType->fetchContent($keyword);
            }

        } catch (InvalidArgumentException $e) {
            return response()->json([
                'success' => false,
                'message' => __($e->getMessage()),
            ]);
        } catch (AiException $e) {
            return response()->json([
                'success' => false,
                'message' => __($e->getMessage()),
            ]);
        }
        return response()->json([
            'success' => true,
            'type' => $generatorRequest->post('generator_type'),
            'content' => $contentData
        ]);
        
    }
    
    
    private function getGeneratorType($type)
    {
        switch ($type) {
            case "meta_title":
                $config = new \WebbyTroops\AiContentGenerator\Models\GeneratorConfigs\MetaTitle;
              break;
            case "meta_keywords":
                $config = new \WebbyTroops\AiContentGenerator\Models\GeneratorConfigs\MetaKeywords;
              break;
            case "meta_description":
              $config = new \WebbyTroops\AiContentGenerator\Models\GeneratorConfigs\MetaDescription;
              break;
            case "description":
                $config = new \WebbyTroops\AiContentGenerator\Models\GeneratorConfigs\Description;
              break;
            case "short_description":
              $config = new \WebbyTroops\AiContentGenerator\Models\GeneratorConfigs\ShortDescription;
              break;
        }
        if(!isset($config)){
            throw new InvalidArgumentException('Invalid generator type');
        }
        return $config;
    }
}
