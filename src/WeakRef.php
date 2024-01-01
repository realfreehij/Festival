<?php
class WeakRef{
	private $weakRef;
	private $object;
	public function __construct($object){
		$this->object = $object;
		$this->weakRef = WeakReference::create($this->object);
	}
	public function acquire(){
		//i am too lazy wth this thing supposed to do
	}
	public function get(){
		return $this->weakRef->get();
	}
	public function release(){
		unset($this->object);
	}
	public function valid(){
		return $this->weakRef->get() != null;
	}
}