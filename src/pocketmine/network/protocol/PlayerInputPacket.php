<?php

namespace pocketmine\network\protocol;

class PlayerInputPacket extends DataPacket{
	const NETWORK_ID = Info::PLAYER_INPUT_PACKET;

	public $moveForward;
	public $moveStrafe;

	public $jumping;
	public $sneaking;

	public function decode(){
		$this->moveForward = $this->getFloat();
		$this->moveStrafe = $this->getFloat();
		$flags = $this->getByte();
		$this->jumping = (($flags & 0x80) > 0); //TODO might be different
		$this->sneaking = (($flags & 0x40) > 0);
	}

	public function encode(){

	}

}
