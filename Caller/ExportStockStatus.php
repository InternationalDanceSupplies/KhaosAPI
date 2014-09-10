<?php

/**
 * KhaosAPI
 *
 * @link        https://github.com/InternationalDanceSupplies/KhaosAPI for the canonical source repository
 * @copyright   Copyright (C) 2014 IDS. See license.txt packaged with this source code.
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
     * The ExportStockStatus class provides methods for calling the 
     * ExportStockStatus SOAP method.
     *
     * @author Jon Matthews <joncarlmatthews@gmail.com>
     * @category KhaosAPI
     * @package Caller
     */
    class ExportStockStatus extends CallerAbstract
    {
        /**
         * API Mapping Type values.
         *
         * @static
         * @access public
         * @var integer
         */
        const MAPPING_TYPE_STOCK_CODE   = 1;
        const MAPPING_TYPE_OTHER_REF    = 2;
        const MAPPING_TYPE_SHORT_DESC   = 4;

        /**
         * Calls the endpoint.
         *
         * 
         * @access public
         * @author Jon Matthews <joncarlmatthews@gmail.com>
         * @return string
         */
        public function run()
        {   
            // StockCode.
            if (isset($this->getArgs()->stockCode)){
                $stockCode = Obj::toString($this->getArgs()->stockCode);
            }else{
                $stockCode = null;
            }

            // MappingType.
            if (isset($this->getArgs()->mappingType)){

                switch($this->getArgs()->mappingType){

                    case self::MAPPING_TYPE_STOCK_CODE:
                    case self::MAPPING_TYPE_OTHER_REF:
                    case self::MAPPING_TYPE_SHORT_DESC:

                        $mappingType = $this->getArgs()->mappingType;

                        break;

                    default:

                        throw new Exception('Invalid mappingType value.');

                        break;
                }

            }else{
                $mappingType = self::MAPPING_TYPE_STOCK_CODE;
            }

            // LastUpdated.
            if (isset($this->getArgs()->lastUpdated)){
                $lastUpdated = $this->getArgs()->lastUpdated;
            }else{
                $lastUpdated = null;
            }

            // SiteID.
            if (isset($this->getArgs()->siteID)){
                $siteID = $this->getArgs()->siteID;
            }else{
                $siteID = null;
            }

            // PotentialLeadTime.
            if (isset($this->getArgs()->potentialLeadTime)){
                $potentialLeadTime = $this->getArgs()->potentialLeadTime;
            }else{
                $potentialLeadTime = null;
            }

            // Call server.
            return $this->getClient()->ExportStockStatus($stockCode,
                                                            $mappingType,
                                                            $lastUpdated,
                                                            $siteID,
                                                            $potentialLeadTime);
        }
    }
}