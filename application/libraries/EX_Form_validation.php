<?php
/**
 * Get all form_validation errors as an array
 * @author Lin
 * http://www.xgeek.net/
 */
class EX_Form_validation extends CI_Form_validation
{
     function __construct($config = array())
     {
          parent::__construct($config);
     }
 
    /**
     * Error Array
     *
     * Returns the error messages as an array
     *
     * @return  array
     */
    function error_array()
    {
        if (count($this->_error_array) === 0)
        {
                return FALSE;
        }
        else
            return $this->_error_array;
 
    }
}


/* End of file SP_Form_validation.php */
/* Location: ./application/libraries/SP_Form_validation.php */