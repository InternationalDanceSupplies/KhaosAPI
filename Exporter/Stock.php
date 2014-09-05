<?php

namespace KhaosAPI\Exporter
{
    use \KhaosApi\Caller\CallerAbstract;
    use \KhaosAPI\Utility\Obj;
    
    class Stock extends CallerAbstract
    {
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