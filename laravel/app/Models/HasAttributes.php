<?php namespace App\Models;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

trait HasAttributes {
	
	protected $attributes = [];
	
	public function hasAttribute(string $attribute) :bool {
		return key_exists($attribute, $this->attributes);
	}
	
	/**
	 * @param string $key
	 * @param        $value
	 */
	public function setAttribute(string $key, $value) {
		$method = "set" . Str::ucfirst($key);
		$method = Str::camel($method) . 'Attribute';
		
		if(method_exists($this, $method)) {
			$this->{$method}($value);
		} else {
			Arr::set($this->attributes, $key, $value);
		}
	}
	
	/**
	 * @param string $key
	 * @return mixed
	 */
	public function getAttribute(string $key) {
		$method = "get" . Str::ucfirst($key);
		$method = Str::camel($method) . 'Attribute';
		
		if(method_exists($this, $method)) {
			return call_user_func_array([$this, $method], []);
		} else {
			return Arr::get($this->attributes, $key);
		}
	}
	
	public function getAttributes():array {
		return $this->attributes;
	}
	
	public function setAttributes(array $attributes) {
		foreach ($attributes as $key => $value) {
			$this->setAttribute($key, $value);
		}
	}
	
	public function pushAttributes(array $attributes) {
		$this->attributes = $attributes;
	}
}
