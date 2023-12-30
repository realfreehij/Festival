<?php
namespace pocketmine\item;

class RottenFlesh extends Item{
	public function __construct($meta = 0, $count = 1){
		parent::__construct(self::ROTTEN_FLESH, $meta, $count, "Rotten Flesh");
	}

}