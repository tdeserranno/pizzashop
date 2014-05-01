<?php

namespace Pizzashop\Model\Service;

use Pizzashop\Exception\FormException;

/**
 * Description of ValidationService
 *
 * @author Thomas
 */
class ValidationService
{
    public static function validateArticle($name, $price, $promoPrice)
    {
        $errors = array();

        //validate name
        if ($name === '') {
            array_push($errors, 'naam mag niet leeg zijn');
        }
        
        //validate price
        if ($price <= 0) {
            array_push($errors, 'prijs moet groter dan 0 zijn');
        }
        
        //validate promo price
        if ($promoPrice <= 0 || $promoPrice >= $price) {
            array_push($errors, 'promoprijs moet groter zijn dan 0 en moet kleiner zijn dan de normale prijs');
        }
        
        //assess errors
        if (empty($errors)) {
            return true;
        } else {
            $errormsg = '';
            foreach ($errors as $error) {
                if ($errormsg !== '') {
                    $errormsg .= PHP_EOL;
                }
                $errormsg .= $error;
            }
            throw new FormException($errormsg);
        }
    }
    
    public static function validateTopping($name, $price)
    {
        $errors = array();

        //validate name
        if ($name === '') {
            array_push($errors, 'naam mag niet leeg zijn');
        }
        
        //validate price
        if ($price <= 0) {
            array_push($errors, 'prijs moet groter dan 0 zijn');
        }
        
        //assess errors
        if (empty($errors)) {
            return true;
        } else {
            $errormsg = '';
            foreach ($errors as $error) {
                if ($errormsg !== '') {
                    $errormsg .= PHP_EOL;
                }
                $errormsg .= $error;
            }
            throw new FormException($errormsg);
        }
    }
}
