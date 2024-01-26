<?php

namespace QF\Validations;
use Illuminate\Contracts\Validation\Rule;

use QF\Constants;

class MainImageTypeIsAnImage implements Rule
{
    private $files = [];
    public function __construct($files){
        $this -> files = $files;
    }
    public function passes($attribute, $value)
    {

        $mainImageName = $value;
        foreach ($this -> files as $file) {
            $fileName = $file -> getClientOriginalName();
            $fileExtension = $file -> getClientOriginalExtension();
            if ($fileName == $mainImageName && in_array($fileExtension, Constants::SUPPORTED_IMAGES_EXTENSIONS))
            {
                return true;
            }
        }
        return false;
    }

    public function message()
    {
        return 'Error Message';
    }
}