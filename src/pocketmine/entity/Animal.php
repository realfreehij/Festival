<?php

namespace pocketmine\entity;

use pocketmine\nbt\tag\ByteTag;
use function mt_rand;

abstract class Animal extends Creature implements Ageable{

	protected function initEntity(){
		parent::initEntity();
		if(!isset($this->namedtag->Baby) || !($this->namedtag->Baby instanceof ByteTag)) $this->namedtag->Baby = new ByteTag("Baby", mt_rand(0, 5) == 0 ? self::DATA_FLAG_BABY : self::DATA_FLAG_NOTBABY);
		if($this->getDataProperty(self::DATA_AGEABLE) === null){
			$this->setDataProperty(self::DATA_AGEABLE, self::DATA_TYPE_BYTE, $this->namedtag->Baby->getValue());
		}

		if($this->isBaby()){
			$this->width /= 2;
			$this->height /= 2;
			$this->setPosition($this);
		}
	}

	public function isBaby(){
		return $this->getDataFlag(self::DATA_AGEABLE, self::DATA_FLAG_NOTBABY);
	}
}
