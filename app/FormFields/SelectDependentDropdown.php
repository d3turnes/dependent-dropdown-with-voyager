<?php

namespace App\FormFields;

use TCG\Voyager\FormFields\AbstractHandler;

class SelectDependentDropdown extends AbstractHandler
{
    protected $codename = 'select_dependent_dropdown';

    public function createContent($row, $dataType, $dataTypeContent, $options)
    {
        /** resource/views/vendor/voyager/formfields/select_dependent_dropdown/select_dependent_dropdown.blade.php */
	return view('voyager::formfields.select_dependent_dropdown.select_dependent_dropdown', [
            'row' => $row,
            'options' => $options,
            'dataType' => $dataType,
            'dataTypeContent' => $dataTypeContent
        ]);
    }
}
