<?php

namespace Pizzashop\Model\Service;
use Pizzashop\Model\Service\AbstractValidator;

/**
 * Description of registrationvalidator
 *
 * @author Thomas
 */
class SignupValidator extends AbstractValidator
{
    public function validate($post)
    {
        $errors = array();
        //confirm password
        if ($post['password'] !== $post['passconfirm']) {
            $error = array('passconfirm' => 'did not match password');
            array_push($errors, $error);
        }
        //validate first and last name
        if (!preg_match($this->rules['names'], $post['firstname'])) {
            $error = array('firstname' => 'did not match pattern');
            array_push($errors, $error);
        }
        if (!preg_match($this->rules['names'], $post['lastname'])) {
            $error = array('lastname' => 'did not match pattern');
            array_push($errors, $error);
        }
        //if errors were found return errors, otherwise return true
        if (empty($errors)) {
            return true;
        } else {
            return $errors;
        }
    }
}
