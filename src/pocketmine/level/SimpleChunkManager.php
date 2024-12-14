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

namespace pocketmine\level;

use pocketmine\level\format\FullChunk;
use const PHP_INT_SIZE;

class SimpleChunkManager implements ChunkManager{

	/** @var FullChunk[] */
	protected $chunks = [];

	protected $seed;

	public function __construct($seed){
		$this->seed = $seed;
	}

	/**
	 * Gets the raw block id.
	 *
	 * @param int $x
	 * @param int $y
	 * @param int $z
	 *
	 * @return int 0-255
	 */
	public function getBlockIdAt($x, $y, $z){
		$chunk = $this->getChunk((int) $x >> 4, (int) $z >> 4);
		if($chunk){
			return $chunk->getBlockId((int) $x & 0xf, (int) $y & 0x7f, (int) $z & 0xf);
		}
		return 0;
	}

	/**
	 * Sets the raw block id.
	 *
	 * @param int $x
	 * @param int $y
	 * @param int $z
	 * @param int $id 0-255
	 */
	public function setBlockIdAt($x, $y, $z, $id){
		$chunk = $this->getChunk((int) $x >> 4, (int) $z >> 4);
		if($chunk){
			$chunk->setBlockId((int) $x & 0xf, (int) $y & 0x7f, (int) $z & 0xf, $id);
		}
	}

	/**
	 * Gets the raw block metadata
	 *
	 * @param int $x
	 * @param int $y
	 * @param int $z
	 *
	 * @return int 0-15
	 */
	public function getBlockDataAt($x, $y, $z){
		$chunk = $this->getChunk((int) $x >> 4, (int) $z >> 4);
		if($chunk){
			return $chunk->getBlockData((int) $x & 0xf, (int) $y & 0x7f, (int) $z & 0xf);
		}
		return 0;
	}

	/**
	 * Sets the raw block metadata.
	 *
	 * @param int $x
	 * @param int $y
	 * @param int $z
	 * @param int $data 0-15
	 */
	public function setBlockDataAt($x, $y, $z, $data){
		$chunk = $this->getChunk((int) $x >> 4, (int) $z >> 4);
		if($chunk){
			$chunk->setBlockData((int) $x & 0xf, (int) $y & 0x7f, (int) $z & 0xf, $data);
		}
	}

	/**
	 * @param int $chunkX
	 * @param int $chunkZ
	 *
	 * @return FullChunk
	 */
	public function getChunk($chunkX, $chunkZ){
		return isset($this->chunks[$index = (PHP_INT_SIZE === 8 ? ((($chunkX) & 0xFFFFFFFF) << 32) | (( $chunkZ) & 0xFFFFFFFF) : ($chunkX) . ":" . ( $chunkZ))]) ? $this->chunks[$index] : null;
	}

	/**
	 * @param int $chunkX
	 * @param int $chunkZ
	 */
	public function setChunk($chunkX, $chunkZ, FullChunk $chunk = null){
		if($chunk === null){
			unset($this->chunks[(PHP_INT_SIZE === 8 ? ((($chunkX) & 0xFFFFFFFF) << 32) | (( $chunkZ) & 0xFFFFFFFF) : ($chunkX) . ":" . ( $chunkZ))]);
			return;
		}
		$this->chunks[(PHP_INT_SIZE === 8 ? ((($chunkX) & 0xFFFFFFFF) << 32) | (( $chunkZ) & 0xFFFFFFFF) : ($chunkX) . ":" . ( $chunkZ))] = $chunk;
	}

	public function cleanChunks(){
		$this->chunks = [];
	}

	/**
	 * Gets the level seed
	 *
	 * @return int
	 */
	public function getSeed(){
		return $this->seed;
	}
}
