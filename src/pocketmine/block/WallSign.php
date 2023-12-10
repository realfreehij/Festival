<?php

/*
 *
 *  ____            _        _   __  __ _                  __  __ ____  
 * |  _ \ ___   ___| | _____| |_|  \/  (_)_ __   ___      |  \/  |  _ \ 
 * | |_) / _ \ / __| |/ / _ \ __| |\/| | | '_ \ / _ \_____| |\/| | |_) |
 * |  __/ (_) | (__|   <  __/ |_| |  | | | | | |  __/_____| |  | |  __/ 
 * |_|   \___/ \___|_|\_\___|\__|_|  |_|_|_| |_|\___|     |_|  |_|_| 
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author PocketMine Team
 * @link http://www.pocketmine.net/
 * 
 *
*/

namespace pocketmine\block;


class WallSign extends SignPost{
	static $meta2side = [
		2 => 3,
		3 => 2,
		4 => 5,
		5 => 4
	];
	protected $id = self::WALL_SIGN;

	public function getName(){
		return "Wall Sign";
	}

	public function onUpdate($type){
		$attached = $this->getSide(self::$meta2side[$this->meta]);
		if(!$attached->isSolid() && ($attached->getId() !== Block::WALL_SIGN && $attached->getId() !== Block::SIGN_POST)){
			$this->getLevel()->setBlock($this, new Air(), \true, \true);
		}
		
		return $type;
	}
}