<?php

namespace pocketmine\block;

use pocketmine\item\Item;

class InvisibleBedrock extends Solid{

	protected $id = self::INVISIBLE_BEDROCK;

	public function __construct(){

	}

	public function getName(){
		return "Invisible Bedrock";
	}

	public function getHardness(){
		return 18000000;
	}

	public function isBreakable(Item $item){
		return \false;
	}

}