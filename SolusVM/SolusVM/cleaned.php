<?php 
$lgo = new LicenseSys();

class LicenseSys
{
    private $_s_C_OOO_o01 = "ypO%_Y/y0#rY@KFi==@65%swYskCaCTk-52#*StP6HCsrwP!tB";
    private $_s_C_OOO_o02 = "MM=co=_prb+;XyuHkHfNtyWy/y@/FzcofZ9HqjQ9?XxSb96a.d";
    private $_s_C_OOO_o03 = "31m*R*Z!zmnDjdqovF8Wyq1-LZUAFohEKqn652kM.FGykJF7LT";
    private $_s_C_OOO_o04 = "UF*zssdx8E9Q7+tzZ%*Y#j2=/FFZOekUr1BXB6OANpO1-ivAOm";
    private $_s_C_OOO_o05 = 30;
    private $_s_C_OOO_o06 = "+";
    private $_s_C_OOO_o07 = 30;
    private $_s_C_OOO_o08 = "(";
    private $_s_C_OOO_o09 = "=============================== START KEY DATA =================================\n";
    private $_s_C_OOO_o10 = "\n================================ END KEY DATA ==================================";

    public function LicenseDecode($result)
    {
        $data = str_replace($this->_s_C_OOO_o06, "", $result);
        $data = str_replace($this->_s_C_OOO_o08, "", $data);
        $data = substr($data, strpos($data, "\n") + 1);
        $data = substr($data, 0, strrpos($data, "\n"));
        $data = str_replace("\n", "", $data);
        $data = $this->LicenseDecodePart($data, $this->_s_C_OOO_o02);
        $data = convert_uudecode(strrev($data));
        $data = gzinflate($data);
        $data = $this->LicenseDecodePart(strrev($data), $this->_s_C_OOO_o01);
        $dataa = $this->LicenseEncodePart($data, $this->_s_C_OOO_o01);
        $md5Hash = substr($data, 0, 32);
        $data = substr($data, 32);
        if( $md5Hash == md5($data . $this->_s_C_OOO_o03) ) 
        {
            $data = strrev($data);
            $md5Hash = substr($data, 0, 32);
            $dataRaw = substr($data, 32);
            $data = base64_decode($dataRaw);
            $data = unserialize($data);
            if( $md5Hash == md5($dataRaw . $data["checkDate"] . $this->_s_C_OOO_o04) ) 
            {
                return $data;
            }

        }

    }

    public function LicenseEncode($result)
    {
    	$resulttraw = serialize($result);
        $resulttraw = base64_encode($resulttraw);
		$md5Hash = md5($resulttraw . $result['checkDate'] . $this->_s_C_OOO_o04);
		$data = $md5Hash.$resulttraw;
		$md5Hash = md5(strrev($data) . $this->_s_C_OOO_o03);
		$data = $md5Hash.strrev($data);
		$data = $this->LicenseEncodePart($data, $this->_s_C_OOO_o01);
		$data = strrev($data);
        $data = gzdeflate($data);
        $data = convert_uuencode($data);
		$data = strrev($data);
		$data = $this->LicenseEncodePart($data, $this->_s_C_OOO_o02);
		$data = strtoupper($data);
		$data = wordwrap($data, 18, "+", true);
		$data = wordwrap($data, 348, "(", true);
		$data = wordwrap($data, 80, "\n", true);
		$data = $this->_s_C_OOO_o09 . $data;
		$data = $data . $this->_s_C_OOO_o10;
		return $data;

    }

    private function LicenseDecodePart($string, $key)
    {
        $key = sha1($key);
        $strLen = strlen($string);
        $keyLen = strlen($key);
        $i = 0;
        while( $i < $strLen ) 
        {
            $ordStr = hexdec(base_convert(strrev(substr($string, $i, 2)), 36, 16));
            if( $j == $keyLen ) 
            {
                $j = 0;
            }

            $ordKey = ord(substr($key, $j, 1));
            $j++;
            $hash .= chr($ordStr - $ordKey);
            $i += 2;
        }
        return $hash;
    }

    private function LicenseEncodePart($string, $key)
    {
        $key = sha1($key);
        $strLen = strlen($string);
        $keyLen = strlen($key);
        $i = 0;
        while( $i < $strLen ) 
        {
        	$ordStr = ord(substr($string, $i, 1));

			if( $j == $keyLen ) 
            {
                $j = 0;
            }

			$ordKey = ord(substr($key, $j, 1));
            $j++;

            $hash .= strrev(base_convert(dechex($ordStr + $ordKey), 16, 36));

            $i += 1;
        }
        return $hash;
    }

}
?>