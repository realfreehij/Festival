<?php

namespace pocketmine\scheduler;

use pocketmine\block\NetherReactor;

class ReactorActivateTask extends Task{
	const TYPE_SPAWN_ITEMS = 0;
	const TYPE_GLOW = 1;
	const TYPE_DESTROY = 2;

	public $type, $data, $reactor;

	public function __construct(NetherReactor $reactor, $type, $data = []){
		$this->reactor = $reactor;
		$this->type = $type;
		$this->data = $data;
	}

	public function onRun($currentTick){
		switch($this->type){
			case self::TYPE_GLOW:
				$this->reactor->glow($this->data[0]);
				break;
			case self::TYPE_SPAWN_ITEMS:
				$this->reactor->spawnItems($this->data);
				break;
			case self::TYPE_DESTROY:
				$this->reactor->destroy();
		}
	}
}