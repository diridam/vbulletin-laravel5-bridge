<?php namespace diridam\Laravel5VbBridge\Services;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class VBulletinDataManager
{
	private $vbulletin;

	public function __construct($vbulletin, $dataman) {
		$this->vbulletin = $vbulletin;
		$this->db_prefix = Config::get('vbulletin.db_prefix');
	}

	/**
	 * @return string -> returns the number of threads from the vb forum's dbase
	 */
	function getThreadCount() {

		$q = DB::table($this->db_prefix.'forum')
            ->select('threadcount')
            ->get();

		$total = '';
		foreach($q as $row){
			$total += $row->threadcount;
		}
		return $total;
	}

	/**
	 * @return string  -> returns the number of posts from the vb forum's dbase
	 */
	function getPostCount()
	{
		$q = DB::table($this->db_prefix.'forum')
            ->select('replycount')
            ->get();

		$total = '';
		foreach($q as $row){
			$total += $row->replycount;
		}
		return $total;
	}
}