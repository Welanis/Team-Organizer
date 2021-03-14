<?php
if(!isset($SEC))
	die('404 Not Found');

class Table {	
	
	//Table CSS class 
	private static $class = false;
	private static $rowClass;
	private static $dataClass;
	private static $outputBuffer;
	private static $outputEnd;
	
	/**
	* Sets up the table with header. 
	* 
	* @param array $header How many headers are needed in the 
	* 
	* @return null
	*/
	public function __construct($header, $class = null) {
		if ($class) {
			self::$class = true;
			$buffer = "<table class=\"$class\">\n<tbody>";
			foreach ($header as $k=>$v) {
				$buffer .= '<th class="'.$class.'-header">'.$v."</th>\n";
			}
		}
		else {
			$buffer = "<table> \n <tbody>\n";
			
			foreach ($header as $k=>$v) {
				$buffer .= '<th>'.$v."</th>\n";
			}
			
		}
		
		
		
		self::$outputBuffer = $buffer;
		
		self::$outputEnd = "</tbody>\n</table>";
		
		if ($class) {
			self::$rowClass = "$class-row";
			self::$dataClass = "$class-data";
		}		
		
	}
	/**
	* Inputs row(s) to the table. Separated with arrays in two dimensions. [row][data]
	* 
	* @var array Set of data that schould be prased to a row.
	* 
	*/
	public function input($data)
	{
		$buffer = "";
		if (self::$class) {
			for ($i=0; $i<count($data); $i++) {
				$buffer .= '<tr class ="'.self::$rowClass.'">'."\n";

				foreach ($data[$i] as $v) {
					$buffer .= '<td class="'.self::$dataClass.'">' . $v . "</td>\n";
				}
			}

			$buffer .= "</tr>\n";
		}
		
		else {
			for ($i=0; $i<count($data); $i++) {
				$buffer .= "<tr>\n";

				foreach ($data[$i] as $v) {
					$buffer .= "<td >" . $v . "</td>\n";
				}

				$buffer .= "</tr>\n";
			}
		}
			
	
		 self::$outputBuffer .= $buffer;
	}				
	
	public function output()
	{
		self::$outputBuffer .= self::$outputEnd;
		print(self::$outputBuffer);
	}	
}


class Form {
	
	private static $outputBuffer;
	private static $headerBuffer;
	private static $submitButton = null;
	private static $endzone = '</form>';
	private static $inputFields = array();
	
	public function __construct($method = 'get', $action = '',  $class = null) {
		$header = '<form action="' . $action . '" method="' . $method . '">';
		
		if(isset($class))
			$buffer = $buffer; //Add css-class handling later
		
		self::$headerBuffer = $header . "\n";
		
	}
	
	public function addField($name, $type="text", $value = '') {
		self::$inputFields[] = '<input type="' . $type . '" name="' . $name . '" value="' . $value . '" />';		
	}
	
	public function createSubmit($value, $class=null) {
		self::$submitButton = '<input type="submit" value="'.$value . '" ';
		if($class)
			self::$submitButton .= 'class="'.$class.'" '; 
		
		self::$submitButton .= '/>';
		
	}
	
	public function generateForm() {
		
		self::$outputBuffer = self::$headerBuffer;
		
		foreach(self::$inputFields as $field) {
			self::$outputBuffer .= $field."\n";
		}
		
		self::$outputBuffer .= self::$submitButton."\n";
		self::$outputBuffer .= "</form> \n";
	}
	
	public function output() {
		return self::$outputBuffer;
	}
	
	public function fetch_header() {
		return self::$headerBuffer;
	}
	
	public function fetch_fields() {
		return self::$inputFields;
	}
	
	public function submitButton() {
		if(self::$submitButton)
			return self::$submitButton;
	}
	
	public function close_form() {
		print self::$endzone;
	}
	
	
}




?>