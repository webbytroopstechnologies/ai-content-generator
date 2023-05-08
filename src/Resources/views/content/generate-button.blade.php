@php
$isEnabled = core()->getConfigData('general.aiContentGenerator.general.ai-content-generator-enable');
if($isEnabled) {
$allowedFields = core()->getConfigData('general.aiContentGenerator.general.ai-content-generator-allowed-fields');
$currentRouteName = Route::currentRouteName();
$locale = core()->getRequestedLocaleCode();
$allowContentGeneration = false;
$contentElement = "";
if(isset($customField) && $customField) {
    $allowContentGeneration = true;
} elseif($allowedFields) {
    foreach(explode(',', $allowedFields) as $allowedField){
        list($entityType, $field) = explode('-', $allowedField);
        if(in_array($currentRouteName, [$entityType.'.create',$entityType.'.edit']) && $elementId == $field){
            $allowContentGeneration = true;
            break;
        }
    }
    
    if($entity == "product"){
       $contentElement = "name";
    } elseif($entity == "page") {
       $contentElement = $locale."[page_title]"; 
    }
}

@endphp

@if($allowContentGeneration)

    @push('scripts')
        <script>

             function generateContent(elementId, contentElement, generatorType, url) {
                if($('#'+elementId).is('input[type="text"]') || $('#'+elementId).is('textarea')){
                    var keyword = "";
                    if(contentElement === ''){
                        keyword = $('#'+elementId).val();
                    } else {
                        keyword = $("input[name='"+contentElement+"']").val()
                    }
                    const postData = { keyword: keyword, generator_type: generatorType};
                    $('#content-'+elementId).html("Genrating AI Content");
                    $('#error-block-'+elementId).remove();
                    axios
                        .post(url, postData)
                        .then(function (response) {
                            let data = response.data;
                            if(data.success){
                                $('#'+elementId).val(data.content);
                            } else {
                                var html = '<div class="control-group has-error" id="error-block-'+elementId+'"><span class="control-error" id="aiContentError">'+data.message+'</span></div>'
                                $('#content-'+elementId).after(html);
                            }
                            $('#content-'+elementId).html("{{ __('ai-content-generator::app.admin.system.generate-content') }}");
                        })
                        .catch(function ({ response }) {
                            let { data } = response;
                            var html = '<div class="control-group has-error" id="error-block-'+elementId+'"><span class="control-error" id="aiContentError">Something went wrong!!</span></div>'
                            $('#content-'+elementId).after(html);
                        });
               }
            }
        </script>
    @endpush
    
        
    <button class="btn btn-lg btn-primary" id='content-{{$elementId}}' onclick="generateContent(
            '{{ $elementId }}',
            '{{ $contentElement }}',
            '{{ $generatorType }}',            
            '{{route('admin.ai.content-generator')}}'
        )" type="button">
          {{ __('ai-content-generator::app.admin.system.generate-content') }}
    </button>
    
@endif

@php 
}
@endphp