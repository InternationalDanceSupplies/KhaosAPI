<?php

namespace KhaosAPI\Utility
{
    /**
     * The Obj class provides methods for dealing with common Object
     * tasks.
     *
     * @author      Jon Matthews <joncarlmatthews@gmail.com>
     * @category    KhaosAPI
     * @package     Utility
     */
    class Obj
    {
        /**
         * Private constructor for singleton
         *
         * @access private
         * @author  Jon Matthews <joncarlmatthews@gmail.com>
         * @return ArrayMethods
         */
        private function __construct(){}
        
        /**
         * Private clone for singleton
         *
         * @access private
         * @author  Jon Matthews <joncarlmatthews@gmail.com>
         * @return ArrayMethods
         */
        private function __clone(){}

        /**
         * Converts an object to s string.
         *
         * @static
         * @access public
         * @author Jon Matthews <joncarlmatthews@gmail.com>
         * @param StdObject $object
         * @param string $glue
         * @return string
         */
        static public function toString($object, $glue = ',')
        {
            $array = json_decode(json_encode($object), true);
            
            return implode($glue, $array);
        }
    }
}