<?php

namespace app\src;

use Exception;

class GenerateHMAC
{

    /**
     * @throws Exception
     */
    public function setHMAC(string $message):string
    {
        return $this->generateHMAC($message);
    }

    /**
     * @throws Exception
     */
    protected function generateHMAC(string $message):string
    {
        $random_key = $this->generateKey();
        $hmac = hash_hmac('sha256', $message, $random_key);
        return strtoupper($hmac);
    }

    /**
     * @throws Exception
     */
    protected function generateKey():string
    {

        $str = random_bytes(8);

        return bin2hex($str);
    }

}