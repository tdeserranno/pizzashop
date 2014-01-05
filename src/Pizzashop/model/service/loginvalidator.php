<?php

namespace Pizzashop\Model\Service;
use Pizzashop\Model\Service\AbstractValidator;

/**
 * Description of loginvalidator
 *
 * @author Thomas
 */
class LoginValidator extends AbstractValidator
{
    public function validate($post)
    {
        $errors = array();
        //validate username and password
        if (isset($post['username']) && !empty($post['username'])) {
            if (isset($post['password']) && !empty($post['password'])) {
                return true;
            } else {
                $error = array('password' => 'password required');
                array_push($errors, $error);
            }
        } else {
            $error = array('username' => 'username required');
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
