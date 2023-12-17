<?php

namespace pocketmine\block;

use \pocketmine\item\Item;

class BrownMushroomSolid extends Solid{
	
	protected $id = self::BROWN_MUSHROOM_BLOCK;
	
	public function __construct($meta = 0){
		$this->meta = $meta;
	}
	
	public function getDrops(Item $item){
		return [
			[Block::BROWN_MUSHROOM, 0, mt_rand(0, 2)]
		];
	}
	
	public function getName(){
		return "Mushroom";
	}
}