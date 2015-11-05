<?php

namespace diridam\Laravel5VbBridge\Facades;

use Illuminate\Support\Facades\Facade;

class VBUserDM extends Facade
{
	protected static function getFacadeAccessor() {
		return 'vbuserdm';
	}
}