<?php
Namespace MVC\Library;
class String {
	private $value;
	public $lenght ;
	public $word_count ;
	public $history = array();
	
	function __construct( $string) {
		if(isset($string)) {
    		$this->setString($string) ;
    	} else {
    		$this->setString("");
    	}
    }
		
	/** -------------------------------------------------------------------
     *  Cắt bỏ hết khoảng trắng
     ** -------------------------------------------------------------------*/
    function stripSpaces() {
    	$this->setString(str_replace(" ","",$this->value));
    	return $this ;
    }
        
	/** -------------------------------------------------------------------
     *  Cắt bỏ hết khoảng trắng trước chuỗi
     ** -------------------------------------------------------------------*/ 
    function stripSpacesBefore() {
    	$this->setString(ltrim($this->value)); 
    	return $this ;	
    }
        
	/** -------------------------------------------------------------------
     *  Cắt bỏ hết khoảng trắng sau chuỗi
     ** -------------------------------------------------------------------*/ 
    function stripSpacesAfter() {
    	$this->setString(rtrim($this->value));
    	return $this ;
    }
        
	/** -------------------------------------------------------------------
     *  Cắt bỏ hết khoảng trắng trước và sau chuỗi
     ** -------------------------------------------------------------------*/ 
    function trim() {
    	$this->setString(trim($this->value));  
    	return $this ;  	
    }
        
	/** -------------------------------------------------------------------
     *  Thêm chuỗi mới và cuối chuỗi
     ** -------------------------------------------------------------------*/ 
    function concat($new){
    	$this->value .= $new ;
    	$this->setString($this->value);
    	return $this ;
    }
        
	/** -------------------------------------------------------------------
    * Explode(divide/split) this string, and return its array
     * May choose ignore case TRUE
     * Can use REGEX
     * -------------------------------------------------------------------*/  
    function explode($delimiter,$ignore_case=false){
    	if($ignore_case)
    		return explode($delimiter,$this->value);
    	else
    		return explode($delimiter,$this->value);
    }
        
	/** -------------------------------------------------------------------
     *  Kiểm tra 1 chuỗi có chứa trong chuỗi hiện tại hay không ?
     ** -------------------------------------------------------------------*/ 
    function contain($str,$ignore_case=false) {    	
    	if($ignore_case)
	    	if(stripos($this->value,$str) === false)
	    		return false;
	    	else
	    		return true ;
	   	else
	    	if(strpos($this->value,$str) === false)
	    		return false;
	    	else
	    		return true;
    }
        
	/** -------------------------------------------------------------------
     *  Ereg at actual string, and return MATCHES
     ** -------------------------------------------------------------------*/ 
    function find($str) {
    	
    	if(ereg($str,$this->value,$reg)) {
	    	return $reg ;
	    }    		
	    
    	return  null;
    }
    
	/** -------------------------------------------------------------------
     *  Replace a string for another in actual string
     ** -------------------------------------------------------------------*/  
    function replace($find,$replace,$ignore_case=false) {
    	
    	if($ignore_case)
    		$this->setString(str_ireplace($find,$replace,$this->value));
    	else     	
    		$this->setString(str_replace($find,$replace,$this->value));
    		
    	
    	return $this ;
    }
        
	/** -------------------------------------------------------------------
     *  Same as replace, but ereg .
     ** -------------------------------------------------------------------*/   
    function eregReplace($find,$replace,$ignore_case=false) {
    	
    	if($ignore_case)
    		$this->setString(ereg_replace($find,$replace,$this->value));
    	else     	
    		$this->setString(eregi_replace($find,$replace,$this->value));
    		
    	
    	return $this ;
    }
    
	/** -------------------------------------------------------------------
     *  Returns char at given position
     ** -------------------------------------------------------------------*/
    function charAt($pos) {
    	return $this->value{$pos};    	
    }
    
	/** -------------------------------------------------------------------
     *  returns "part" of the string
     ** -------------------------------------------------------------------*/ 
    function subString($start,$end=null) {
    	return substr($this->value,$start,$end);
    }    
	
	/** -------------------------------------------------------------------
     *  cut out part of string, between $start and $end ;
     ** -------------------------------------------------------------------*/  
    function cut($start,$end) {
    	$this->setString(substr($this->value,$start,$end));
    	return $this ;
    }
        
	/** -------------------------------------------------------------------
     *  Parse string as a URL valid.
     ** -------------------------------------------------------------------*/   
   	function toURL() {
    	return urlencode(utf8_decode($this->value));
    }
        
	/** -------------------------------------------------------------------
     *  Parse string as HTML encoded, NOT WORKING AS I THINK
     ** -------------------------------------------------------------------*/
    function htmlEncode($ent=null) {
    	$this->setString(htmlentities(html_entity_decode(utf8_decode($this->value))));
    	return $this ;
    }
        
	/** -------------------------------------------------------------------
     *  Uncode string into html
     ** -------------------------------------------------------------------*/ 
    function htmlDecode($ent=null) {
    	$this->setString(html_entity_decode(utf8_decode($this->value)),$ent);
    	return $this ;
    }
        
	/** -------------------------------------------------------------------
     *  Codify as html code just words, ignoes quotes and tags
     ** -------------------------------------------------------------------*/
    function htmlEncodeWords() {
    	$this->htmlEncode(ENT_NOQUOTES);
    	$this->replace("&lt;","<");
    	$this->replace("&gt;",">");
    	$this->replace("/&gt;",">");
    	return $this ;
    }
        
	/** -------------------------------------------------------------------
     *  Cleans up the string, good for filenames, logins and etc
     ** -------------------------------------------------------------------*/ 
    function clean() {    	$this->stripTags();
    	$this->htmlEncode();
    	$this->eregReplace("&([a-zA-Z])([a-zA-Z]*);","\\1");
    	$this->replace(" ","_");
    	$this->setString($this->toURL());
    	$this->eregReplace("%([a-zA-Z0-9]{2})","_");    	
    	return $this ;
    }
        
	/** -------------------------------------------------------------------
     *  Utf8 encode
     ** -------------------------------------------------------------------*/  
     function utf8Encode() {
     	$this->setString(utf8_encode($this->value));
     }
     
	/** -------------------------------------------------------------------
     *  Utf8 decode
     ** -------------------------------------------------------------------*/
     function utf8Decode() {
     	$this->setString(utf8_decode($this->value));
     }
         
	/** -------------------------------------------------------------------
     *  Strip tags
     ** -------------------------------------------------------------------*/ 
    function stripTags($tagsAllowed=null) {
    	$this->setString(strip_tags($this->value,$tagsAllowed));
    	return $this ;    	
    }
	
    /** -------------------------------------------------------------------
     * Remove slashes
     ** -------------------------------------------------------------------*/     
    function removeSlashes() {
    	$this->setString(stripslashes($this->value));
    	return $this ;
    }
	
    /** -------------------------------------------------------------------
     * Turn string into uppercar
     ** -------------------------------------------------------------------*/     
    function upperCase() {
    	$this->setString(strtoupper($this->value));
    	return $this ;
    }
	
    /** -------------------------------------------------------------------
     * Firsts letters of each word as upper casePrimeiras letras de cada palavra em mausculo
     ** -------------------------------------------------------------------*/     
    function upperCaseWords() {
    	$this->setString(ucwords($this->value));
    	return $this;
    }
	
    /** -------------------------------------------------------------------
     * First letter of string in uppercase
     ** -------------------------------------------------------------------*/ 
    function upperCaseFirst() {
    	$this->setString(ucfirst($this->value));
    	return $this ;
    }
	
    /** -------------------------------------------------------------------
     * All lowcase
     ** -------------------------------------------------------------------*/ 
    function lowerCase() {
    	$this->setString(strtolower($this->value));
    	return $this ;
    }
	
    /** -------------------------------------------------------------------
     * Turns line breaks into <br />
     ** -------------------------------------------------------------------*/     
    function nlToBR() {
    	$this->setString(nl2br($this->value));    	
    	return $this ;
    }
	
    /** -------------------------------------------------------------------
     * <br /> back to line breaks
     ** -------------------------------------------------------------------*/     
    function BRToNl() {
    	$this->setString(str_replace("<br />","\n",$this->value));
    	return $this ;    	
    }
	
	/** -------------------------------------------------------------------
     * Alias for BRToNl()
     ** -------------------------------------------------------------------*/ 	
    function nl2br() {
    	return $this->nlToBR();
    }
    /** -------------------------------------------------------------------
	  * Alias for BRToNl()
     ** -------------------------------------------------------------------*/    	
    function br2nl() {
    	return $this->BRToNl();
    	
    }
    /** -------------------------------------------------------------------
     * Undo changes
     ** -------------------------------------------------------------------*/     
    function undo($int=1) {
    	    	
    	for($i=0;$i<$int;$i++) {
		    $this->value = prev($this->history) ;
		    $this->lenght = strlen($this->value) ;
		    $this->word_count = str_word_count($this->value) ;
	    }
	    
    	return $this ;
    }
    /** -------------------------------------------------------------------
     * Redo "undos"
     ** -------------------------------------------------------------------*/     
    function redo($int=1) {    	
    	for($i=0;$i<$int;$i++) {
	    	$this->value = next($this->history) ;
	    	$this->lenght = strlen($this->value);
	    	$this->word_count = str_word_count($this->value);
    	}
    	return $this ;
    }
	
    /** -------------------------------------------------------------------
     * Return the string it self
     ** -------------------------------------------------------------------*/     
    function getString() {
    	return $this->value ;
    }
    /** -------------------------------------------------------------------
     * Changes the string
     ** -------------------------------------------------------------------*/
    function setString($string) {
    	
    	$this->history[] = $string ;    	  	
    	end($this->history) ; 
    	
    	$this->value = $string ;
    	$this->lenght = strlen($string);
    	$this->word_count = str_word_count($string);
    	
    	return $this ;
    }
	/** -------------------------------------------------------------------
     * Alias for getString()
     ** -------------------------------------------------------------------*/
    function getValue() {
    	return $this->getString();
    }
	
    /** -------------------------------------------------------------------
     * Alias for setString()
     ** -------------------------------------------------------------------*/     
    function setValue($str) {
    	$this->setString($str);
    }
	
    /** -------------------------------------------------------------------
     * Auto return the string in case of echo or alike
     ** -------------------------------------------------------------------*/     
    function __toString() {
    	return " ".$this->value;
    }
	
    /** -------------------------------------------------------------------
      * alias to __toString()
     ** -------------------------------------------------------------------*/
    function toString() {
    	return $this->__toString();
    }
	
    /** -------------------------------------------------------------------
     * Return this string as xml, must whatout for special chars and tags.
     ** -------------------------------------------------------------------*/     
    function __toXml() {
    	$xml = "<string length=\"{$this->length}\">\n\t<value>{$this->value}</value>\n</string>";
    	return $xml ;
    }
	
    /** -------------------------------------------------------------------
     * A alias to __toXMl()
     ** -------------------------------------------------------------------*/     
    function toXML() {
    	return $this->__toXML();
    }
	
	/** -------------------------------------------------------------------
     *  Rút gọn nội dung của một chuỗi
     ** -------------------------------------------------------------------*/
	function reduce($max = 50, $rep = '...'){
		$strlen = strlen($this->value);
		if ($strlen <= $max){
			return $this->value;
		}
		
		$lengthtokeep = $max - strlen($rep);
		$start = 0;
		$end = 0;
		
		if (($lengthtokeep % 2) == 0) {
			$start = $lengthtokeep / 2;
			$end = $start;
		}else{
			$start = intval($lengthtokeep / 2);
			$end = $start + 1;
		}
		$i = $start;
		$tmp_string = $this->value;
		while ($i < $strlen) {
			if (isset($tmp_string[$i]) and $tmp_string[$i] == ' ') {
				$tmp_string = substr($tmp_string, 0, $i) . $rep;
				$return = $tmp_string;
			}
			$i++;
		}
		$i = $end;
		$tmp_string = strrev($this->value);
		while ($i < $strlen){
			if (isset($tmp_string[$i]) and $tmp_string[$i] == ' ') {
				$tmp_string = substr($tmp_string, 0, $i);
				$return .= strrev ($tmp_string);
			}
			$i++;
		}
		return $return;		
	}
	/** -------------------------------------------------------------------
     *  Rút gọn nội dung của một chuỗi có HTML Tag
     ** -------------------------------------------------------------------*/
	function reduceHTML($max = 50, $rep = '...'){
		$this->stripTags();
		return $this->reduce($max, $rep);
	}
	/** -------------------------------------------------------------------
     *  Làm đẹp URL
     ** -------------------------------------------------------------------*/
	function utf8convert($str){
    if(!$str) return false;
		$utf8 = array(
			'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
			'd'=>'đ|Đ',
			'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
			'i'=>'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị',
			'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
			'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
			'y'=>'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ',
		);
		foreach($utf8 as $ascii=>$uni) $str = preg_replace("/($uni)/i",$ascii,$str);
		return $str;
	}
	
	function utf8tourl($text){
		$text = strtolower($this->utf8convert($text));
		$text = str_replace( "ß", "ss", $text);
		$text = str_replace( "%", "", $text);
		$text = preg_replace("/[^_a-zA-Z0-9 -]/", "",$text);
		$text = str_replace(array('%20', ' '), '-', $text);
		$text = str_replace("----","-",$text);
		$text = str_replace("---","-",$text);
		$text = str_replace("--","-",$text);
		return $text;
	}
	function converturl(){
		return $this->utf8tourl($this->utf8convert($this->value));
	}
}
?>