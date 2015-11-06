<?php namespace diridam\Laravel5VbBridge\Facades;

use Illuminate\Support\Facades\Facade;

class VBDM extends Facade
{
	protected static function getFacadeAccessor() {
		return 'vbdm';
	}
}