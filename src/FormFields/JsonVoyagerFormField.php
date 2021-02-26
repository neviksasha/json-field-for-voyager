<?php

namespace JsonFieldForVoyager\FormFields;

use TCG\Voyager\FormFields\AbstractHandler;

class JsonVoyagerFormField extends AbstractHandler
{
    protected $codename = 'json';

    public function createContent($row, $dataType, $dataTypeContent, $options)
    {
        return view('formfields.json', [
            'row' => $row,
            'options' => $options,
            'dataType' => $dataType,
            'dataTypeContent' => $dataTypeContent
        ]);
    }
}
