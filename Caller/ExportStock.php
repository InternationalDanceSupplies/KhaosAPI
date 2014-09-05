<?php

/**
 * KhaosAPI
 *
 * @link        https://github.com/InternationalDanceSupplies/KhaosAPI for the canonical source repository
 * @link        Coded to the Zend Framework Coding Standard for PHP 
 *              http://framework.zend.com/manual/1.12/en/coding-standard.html
 * 
 * File format: UNIX
 * File encoding: UTF8
 * File indentation: Spaces (4). No tabs
 *
 */

namespace KhaosAPI\Caller
{
    use \KhaosAPI\Utility\Obj;
    
    /**
     * The ExportStock class provides method for calling the ExportStock SOAP
     * method.
     *
     * @author Jon Matthews <joncarlmatthews@gmail.com>
     * @category KhaosAPI
     * @package Caller
     */
    class ExportStock extends CallerAbstract
    {
        /**
         * Calls the endpoint.
         *
         * This is called before init().
         * 
         * @access public
         * @author Jon Matthews <joncarlmatthews@gmail.com>
         * @return string
         */
        public function run()
        {   
            if (!isset($this->getArgs()->stockCode)){
                throw new Exception('stockCode argument not set.');
            }

            $stockCode = Obj::toString($this->getArgs()->stockCode);

            if (isset($this->getArgs()->mappingType)){
                $mappingType = $this->getArgs()->mappingType;
            }else{
                $mappingType = 1;
            }

            if (isset($this->getArgs()->lastUpdated)){
                $lastUpdated = $this->getArgs()->lastUpdated;
            }else{
                $lastUpdated = '2000-01-01';
            }

            return $this->getClient()->ExportStock($stockCode,
                                                    $mappingType,
                                                    $lastUpdated);
        }
    }
}