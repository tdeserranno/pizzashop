<?php

namespace Pizzashop\Model\Service;

/**
 * Description of validator
 *
 * @author Thomas
 */
abstract class AbstractValidator
{
    protected static $rules = array();
    
    function __construct()
    {
        $defaultRules = array('names' => "/^[a-zA-Z\s'-]*$/");
        array_push($this->rules, $defaultRules);
    }

    public function addRule($ruleName, $ruleRegex)
    {
        $rule = array($ruleName => $ruleRegex);
        array_push($this->rules, $rule);
    }
}
