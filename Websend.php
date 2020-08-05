<?php
class Websend
{
	public $timeout = 3600;
	
	var $host;
	var $password;
	var $port;
	var $stream;

	public function __construct($host, $password, $port) 
	{
		$this->host = $host;
		$this->password = $password;
		$this->port = $port;
	}

	public function __destruct(){
    	if($this->stream)
        	$this->disconnect();
	}

	/**
	* Connects to a Websend server.
	* Returns true if successful.
	*/
	public function connect()
	{
		@$this->stream = fsockopen($this->host, $this->port, $errno, $errstr, $this->timeout);
		if($this->stream){
			@$this->writeRawByte(21);
			@$this->writeString(hash("SHA512", $this->readRawInt().$this->password));
			return $this->readRawInt() == 1 ? true: false;
		}else{
			return false;
		}
	}

	/**
	* Sends a disconnect signal to the currently connected Websend server.
	*/
	public function disconnect()
	{
		$this->writeRawByte(20);
	}

	//NETWORK IO
	private function writeRawInt( $i )
	{
		@fwrite( $this->stream, pack("N", $i), 4);
	}

	private function writeRawDouble( $d )
	{
		fwrite( $this->stream, strrev(pack("d", $d)));
	}

	private function writeRawByte( $b )
	{
		@fwrite( $this->stream, strrev(pack("C", $b)));
	}

	private function writeChar( $char )
	{
		$v = ord($char);
		$this->writeRawByte((0xff & ($v >> 8)));
		$this->writeRawByte((0xff & $v));
	}

	private function writeChars( $string )
	{
		$array = str_split($string);
		foreach($array as &$cur)
		{
			$v = ord($cur);
			$this->writeRawByte((0xff & ($v >> 8)));
			$this->writeRawByte((0xff & $v));
		}
	}

	private function writeString( $string )
	{
		$array = str_split($string);
		$this->writeRawInt(count($array));
		foreach($array as &$cur)
		{
			$v = ord($cur);
			$this->writeRawByte((0xff & ($v >> 8)));
			$this->writeRawByte((0xff & $v));
		}
	}

	private function readRawInt()
	{
		$a = $this->readRawByte();
		$b = $this->readRawByte();
		$c = $this->readRawByte();
		$d = $this->readRawByte();
		$i = ((($a & 0xff) << 24) | (($b & 0xff) << 16) | (($c & 0xff) << 8) | ($d & 0xff));
		if($i > 2147483648){
 			$i -= 4294967296;
			}
		return $i;
	}
	private function readRawDouble()
	{
		$up = unpack( "di", strrev( fread( $this->stream, 8 ) ) );
		$d = $up["i"];
		return $d;
	}
	private function readRawByte()
	{
		$up = unpack( "Ci", fread( $this->stream, 1 ) );
		$b = $up["i"];
		if($b > 127){
			$b -= 256;
		}
		return $b;
	}
	private function readRawUnsignedByte()
	{
		$up = unpack( "Ci", fread( $this->stream, 1 ) );
		$b = $up["i"];
		return $b;
	}
	private function readChar()
	{
		$byte1 = $this->readRawByte();
		$byte2 = $this->readRawByte();
		$charValue = chr(utf8_decode((($byte1 << 8) | ($byte2 & 0xff))));
		return $charValue;
	}
	private function readChars($len)
	{
		$buf = "";
		for($i = 0;$i<$len;$i++)
		{
			$byte1 = $this->readRawByte();
			$byte2 = $this->readRawByte();
			$buf = $buf.chr(utf8_decode((($byte1 << 8) | ($byte2 & 0xff))));
		}
		return $buf;
	}

	//WEBSEND SPECIFIC

	/**
	* @param string $cmmd Command and arguments to run.
	* @return true if the command was found, else false
	*/
	public function doCommandAsConsole($cmmd)
	{
		$this->writeRawByte(2);
		$this->writeString($cmmd);
		return $this->readRawInt() == 1 ? true: false;
	}
	
	/**
	* Print output to the console window. Invisible to players.
	*/
	public function writeOutputToConsole($message)
	{
		$this->writeRawByte(10);
		$this->writeString($message);
	}
}
?>
