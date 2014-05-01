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
    
    public static function validateCustomer($firstname, $lastname, $address, $postcode, $city, $telephone)
    {
        $errors = array();

        //validate firstname
        if ($firstname === '') {
            array_push($errors, 'voornaam mag niet leeg zijn');
        }
        
        //validate lastname
        if ($lastname === '') {
            array_push($errors, 'familienaam mag niet leeg zijn');
        }
        
        //validate address
        if ($address === '') {
            array_push($errors, 'adres mag niet leeg zijn');
        }
        
        //validate postcode
        if ($postcode === '') {
            array_push($errors, 'postcode mag niet leeg zijn');
        }
        
        //validate city
        if ($city === '') {
            array_push($errors, 'gemeente mag niet leeg zijn');
        }
        
        //validate telephone
        if ($telephone === '') {
            array_push($errors, 'telefoon mag niet leeg zijn');
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
