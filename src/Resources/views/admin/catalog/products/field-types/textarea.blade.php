<textarea v-validate="'{{$validations}}'" class="control {{ $attribute->enable_wysiwyg ? 'enable-wysiwyg' : '' }}" id="{{ $attribute->code }}" name="{{ $attribute->code }}" data-vv-as="&quot;{{ $attribute->admin_name }}&quot;">{{ old($attribute->code) ?: $product[$attribute->code]}}</textarea>

@include('ai-content-generator::content.generate-button', 
    [
       "elementId" => $attribute->code,
       "entity" => "product",
       "generatorType" => $attribute->code
    ]
)