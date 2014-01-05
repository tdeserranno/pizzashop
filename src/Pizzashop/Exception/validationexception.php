<?php

namespace Pizzashop\Exception;

/**
 * Description of validationexception
 *
 * @author Thomas
 */
class ValidationException extends \Exception
{
    private $form;
    private $errors = array();
    
    function __construct($form, $errors)
    {
        $this->form = $form;
        $this->errors = $errors;
    }
    
    public function getForm()
    {
        return $this->form;
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
