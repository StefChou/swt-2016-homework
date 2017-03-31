<?php

class File {
	private $handler;
	private $filename;

	public function __construct($fn){
		$this->handler = fopen($fn, 'a+');
		$this->filename = $fn;
	}

	public function write($text){
		fwrite($this->handler, $text);
	}

	public function read(){
		rewind($this->handler);
		return fread($this->handler, filesize($this->filename));
	}

	public function __destruct(){
		fclose($this->handler);
	}
}

$f = new File('file.txt');
$f->write('Some text. Blah blah blah...');
$f->write(' TEST TEST TEST ');
echo $f->read();
unset($f);

?>