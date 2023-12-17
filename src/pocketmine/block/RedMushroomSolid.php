<?php
namespace pocketmine\block;

use \pocketmine\item\Item;

class RedMushroomSolid extends Solid{
	
	protected $id = self::RED_MUSHROOM_BLOCK;
	
	public function __construct($meta = 0){
		$this->meta = $meta;
	}
	
	public function getDrops(Item $item){
		return [
			[Block::RED_MUSHROOM, 0, mt_rand(0, 2)]
		];
	}
	
	public function getName(){
		return "Mushroom";
	}
}