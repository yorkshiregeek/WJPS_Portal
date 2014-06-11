<?php 
	$PageDescription = "Encryption and Decryption Code";
	//$PageFilename = "EncDec.php";
	//$PageTitle = "JamesProctor.net :: Encryption and Decryption Code";
	$PageAuthor = "William James Proctor";
	$PageCopyright = "© William James Proctor 2004";
	$PageCreated = "26/10/04";
	$PageLastUpdated = "26/10/04";
	$PageSecure = "N";
	$PageAdmin = "N";

	function Encrypt ($Item)
	{
		return base64_encode($Item);
	}
	
	function Decrypt($Item)
	{
		return base64_decode($Item);
	}	
    
    function generatepassword()
    {
        srand((double) microtime() * 1000000);

        $Password = "";
        for ($i=0;$i<8;$i++)
        {
            $RandomNumber = rand(0,35);
            switch($RandomNumber)
            {
                case 0: $Password .= "0";break;
                case 1: $Password .= "1";break;
                case 2: $Password .= "2";break;
                case 3: $Password .= "3";break;
                case 4: $Password .= "4";break;
                case 5: $Password .= "5";break;
                case 6: $Password .= "6";break;
                case 7: $Password .= "7";break;
                case 8: $Password .= "8";break;
                case 9: $Password .= "9";break;
                case 10: $Password .= "A";break;
                case 11: $Password .= "B";break;
                case 12: $Password .= "C";break;
                case 13: $Password .= "D";break;
                case 14: $Password .= "E";break;
                case 15: $Password .= "F";break;
                case 16: $Password .= "G";break;
                case 17: $Password .= "H";break;
                case 18: $Password .= "I";break;
                case 19: $Password .= "J";break;
                case 20: $Password .= "K";break;
                case 21: $Password .= "L";break;
                case 22: $Password .= "M";break;
                case 23: $Password .= "N";break;
                case 24: $Password .= "O";break;
                case 25: $Password .= "P";break;
                case 26: $Password .= "Q";break;
                case 27: $Password .= "R";break;
                case 28: $Password .= "S";break;
                case 29: $Password .= "T";break;
                case 30: $Password .= "U";break;
                case 31: $Password .= "V";break;
                case 32: $Password .= "W";break;
                case 33: $Password .= "X";break;
                case 34: $Password .= "Y";break;
                case 35: $Password .= "Z";break;
                default: $Password .= "A";
            }
        }
        return $Password;
    }

?>
