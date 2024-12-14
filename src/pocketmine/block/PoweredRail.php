<?php

namespace pocketmine\block;

use pocketmine\item\Item;
use pocketmine\level\Level;
use pocketmine\Player;

class PoweredRail extends Flowable{

	protected $id = self::POWERED_RAIL;

	public function __construct(){

	}

	public function getName(){
		return "Powered Rail";
	}

	public function onUpdate($type){
		if($type === Level::BLOCK_UPDATE_NORMAL){
			if($this->getSide(0)->isTransparent()){
				$this->getLevel()->useBreakOn($this);
				return Level::BLOCK_UPDATE_NORMAL;
			}
		}

		return false;
	}

	public function place(Item $item, Block $block, Block $target, $face, $fx, $fy, $fz, Player $player = null){
		$down = $this->getSide(0);
		if(!$down->isTransparent()){
			$this->getLevel()->setBlock($block, $this, true, true);
			return true;
		}

		return false;
	}
}
