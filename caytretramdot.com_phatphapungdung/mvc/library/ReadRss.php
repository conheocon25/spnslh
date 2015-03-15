<?php
Namespace MVC\Library;
class ReadRss {
	protected static $_doc;
	protected static $_loaded;
	protected static $_rssUrl;
	
	function __clone(){}
	
	public function __construct($rssUrl) {        
		self::$_rssUrl = $rssUrl;		
		self::$_loaded = FALSE;
    }
	/**
	* Load the xml from url by curl
	*/
	function ReadRssXMLByCurl()
	{
		$curl_handle=curl_init();
		curl_setopt($curl_handle, CURLOPT_URL,self::$_rssUrl);
		curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 5);
		curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl_handle, CURLOPT_HEADER, 0);	
		curl_setopt($curl_handle, CURLOPT_BINARYTRANSFER, true);
		curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, FALSE);			
		curl_setopt($curl_handle, CURLOPT_USERAGENT, 'user');
		$xmlcontent = curl_exec($curl_handle);
		curl_close($curl_handle);
		
		self::$_doc = new \DOMDocument();		
		@self::$_doc = dom_import_simplexml(simplexml_load_string($xmlcontent));		
		self::$_loaded = TRUE;
		
		
		$ch = self::$_doc->getElementsByTagName('channel')->item(0);
		
		$result = array();		
		if ( ! is_null($ch))
		{
				if ($ch->hasChildNodes())
				{
					$i = 0;
					foreach ($ch->getElementsByTagName('item') as $tag)
					{
						$result['item_'.$i] = array();
						
						foreach ($tag->getElementsByTagName('*') as $item)
							$result['item_'.$i][$item->tagName] = html_entity_decode($item->nodeValue, ENT_QUOTES, 'UTF-8') ;

						$i++;
						
					}
				}
			}
		return $result;
	}
	/**
	* Load the xml document
	*/
	function Load()
	{
		if (is_null(self::$_rssUrl) or strlen(self::$_rssUrl) < 1)
			exit("Error in ".__CLASS__.'::'.__FUNCTION__.'<br/>The path to the rss file is missing!');
		// LOAD XML DOCUMENT
		/*
		$curl_handle=curl_init();
		curl_setopt($curl_handle, CURLOPT_URL,$filePath);
		curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
		curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl_handle, CURLOPT_HEADER, 0);		
		curl_setopt($curl_handle, CURLOPT_USERAGENT, 'Your application name');
		$xmlcontent = curl_exec($curl_handle);
		curl_close($curl_handle);
		*/
		
		//@self::$_doc = dom_import_simplexml(simplexml_load_string($xmlcontent));
		
		if (@self::$_doc->load(self::$_rssUrl))
			self::$_loaded = TRUE;
		else exit("Error: The rss file could not be opened!");
	}
	/**
	* Get the channel tags as an associative array
	* @return array
	*/
	final public function GetChannelTags()
	{
		$result = array();
		if ( ! self::$_loaded) return $result;

		$ch = self::$_doc->getElementsByTagName('channel')->item(0);
		if ( ! is_null($ch))
		{
			if ($ch->hasChildNodes())
			{
				foreach ($ch->getElementsByTagName('*') as $tag)
				{
					// do not select item tags
					if ($tag->hasChildNodes() and ($tag->tagName <> 'item'))
						$result[$tag->tagName] = html_entity_decode($tag->nodeValue, ENT_QUOTES, 'UTF-8') ;
				}
			}
		}
		return $result;
	}
	/**
	* Get the channel items as an associative array
	*
	* @param int $maxLimit  The maximum number of channel items to retrieve from the document.
	* If $maxLimit = 0 all records will be retrieved.
	* @return array
	*/
	final public function GetItems( $maxLimit = 0 )
	{
		$result = array();
		if ( ! self::$_loaded) return $result;

		$ch = self::$_doc->getElementsByTagName('channel')->item(0);
		if ( ! is_null($ch))
		{
			if ($ch->hasChildNodes())
			{
				$i = 0;
				foreach ($ch->getElementsByTagName('item') as $tag)
				{
					$result['item_'.$i] = array();
					
					foreach ($tag->getElementsByTagName('*') as $item)
						$result['item_'.$i][$item->tagName] = html_entity_decode($item->nodeValue, ENT_QUOTES, 'UTF-8') ;

					$i++;
					if ($maxLimit == $i) break;
				}
			}
		}
		return $result;
	}

	/**
	* Get all data from the rss feed as an associative array
	* @return array
	*/
	final public function GetAll()
	{
		$result = array();
		if ( ! self::$_loaded) return $result;

		$channelTags = self::$GetChannelTags();
		$channelItems = self::$GetItems();

		$result = array_merge($channelTags, $channelItems);

		return $result;
	}
}
?>