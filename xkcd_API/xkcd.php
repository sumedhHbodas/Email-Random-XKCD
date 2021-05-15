<?php

require_once('comic_xkcd.php');
class xkcd{
    private $cache = array(); //comic cache
	private $cacheindex = array();
	private $latestnum = 0; //the ID of the latest comic
	public $cachelimit = 50; //limitation of the number of the entries in cache
	
	function __construct(){
		$this->refresh();
	}
	
	public function refresh(){
		$raw = json_decode(file_get_contents('http://xkcd.com/info.0.json'), true); //get the latest comic info
		$comic = new xkcdcomic($raw, $this); //initalize a new comic object
		$this->addcache($comic);
		$this->latestnum = $comic->num;
	}
	
	public function get($num){
		$num = (int)$num;
		if($num > $this->latestnum || $num < 1){
            throw new Exception('Wrong comic ID specified!'); return null;
		}
		else{
			if(array_key_exists($num, $this->cache)){
				return $this->cache[$num];
			}else{
				$raw = json_decode(file_get_contents('http://xkcd.com/'.$num.'/info.0.json'), true);
				$comic = new xkcdcomic($raw, $this);
				$this->addcache($comic);
				return $comic;
			}
		}
	}
	
	public function random(){
		$rand = rand(1, $this->latestnum);
		return $this->get($rand);
	}
    
    public function latest(){
        return $this->get($this->latestnum);
    }
	
	private function addcache(xkcdcomic $comic){
		if(array_key_exists($comic->num, $this->cache)){ //already exists in cache
			$this->cache[$comic->num] = $comic; //update cache
		}else{
			while(count($this->cache) >= $this->cachelimit){ //cache limit exceeded
				foreach($this->cacheindex as $key => $num) break; 
				unset($this->cache[$num]);
				unset($this->cacheindex[$key]);
			}
			$this->cache[$comic->num] = $comic;
			$this->cacheindex[] = $comic->num;
		}
	}
	
	public function clearcache(){
		$this->cache = array();
		$this->cacheindex = array();
	}
}
