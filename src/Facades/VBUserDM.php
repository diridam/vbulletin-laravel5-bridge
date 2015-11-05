<?php

namespace jon5477\VBBridge\Facades;

use Illuminate\Support\Facades\Facade;

class VBUserDM extends Facade
{
	protected static function getFacadeAccessor() {
		return 'vbuserdm';
	}
}