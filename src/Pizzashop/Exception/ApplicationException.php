<?php
namespace Pizzashop\Exception;

/**
 * Description of HomeControllerException
 *
 * @author cyber02
 */
class ApplicationException extends \Exception
{
     function __construct($message = '', $code = 0, $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
