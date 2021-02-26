<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsoneditor/9.2.0/jsoneditor.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jsoneditor/9.2.0/jsoneditor.min.js"></script>
<script>
    let container, jsonString, options, editor, value;
</script>

@php

    $value = old($row->field, $dataTypeContent->{$row->field} ?? '{}');
//var_dump($value);
@endphp

<div id="{{$row->field}}_editor" style="width: 100%; height: 100%;"></div>

<input type="hidden" id="{{$row->field}}_input"
       name="{{ $row->field }}"
       value="{{ old($row->field, $dataTypeContent->{$row->field} ?? '{}') }}" />


<div id="jsoneditor_{{$row->field}}" style="height: 500px;"></div>
<script>

    /**
     * @return {boolean}
     */
    function IsJsonString(str) {
        try {
            JSON.parse(str);
        } catch (e) {
            return false;
        }
        return true;
    }
    // create the editor
    container = document.getElementById('jsoneditor_{{$row->field}}');
    jsonString = @json($value);
    if (IsJsonString(jsonString)){
        validJsonString = JSON.parse(jsonString);
    } else {
        jsonString = jsonString.replace(/[\r\n]+/g, '');
        validJsonString = {jsonString};
        document.getElementById('{{$row->field}}_input').insertAdjacentHTML("beforeBegin",
            "<p>При сохранении была допущена ошибка в JSON. Вставьте указанный код в редактор и исправьте ошибки<br><code>"+jsonString+"</code></p>");
    }

    options = {
        onChange: function() {
            const hiddenField = document.getElementById('{{$row->field}}_input');
            value = window['editor_{{$row->field}}'].getText();
            if(value.trim() == ''){
                value = '{}';
            }
            hiddenField.value = value;
        },
        modes: @json(['tree', 'code', 'form']),
    };
    // set json
    window['editor_{{$row->field}}'] = new JSONEditor(container, options, validJsonString);
    document.getElementById('{{$row->field}}_input').value = window['editor_{{$row->field}}'].getText();
</script>


