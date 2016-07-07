<?php
if (!defined('QA_VERSION')) { // don't allow this page to be requested directly from browser
	header('Location: ../../');
	exit;
}
require_once QA_INCLUDE_DIR.'qa-db-selects.php';

class hidden_restriction
{

	/**
	 * 与えられた日付(投稿日)が24時間経過しているかを返す
	 * 24時間経過後なら true
	 * @param  int $created 投稿日
	 * @return boolean true, false
	 */
	public static function passed_for_24_hours($created = null)
	{
		if (!isset($created)) {
			return false;
		}
		$now = new DateTime();
		if ( $now->modify('-1 days')->getTimestamp() >= $created ) {
			return true;
		}
		return false;
	}

	/**
	 * コメントの中で一番最後に投稿されたものかどうかを返す
	 * @param  int  $postid   ポストID
	 * @param  int  $parentid 親ポストID
	 * @return boolean           最後に投稿されたもの:true
	 */
	public static function is_last_comment($postid = null, $parentid = null)
	{
		if (!isset($postid) || !isset($parentid)) {
			return false;
		}
		$sql = "SELECT max(postid) as maxid FROM ^posts WHERE type = 'C' AND parentid = #";
		$result = qa_db_read_one_assoc(qa_db_query_sub($sql, $parentid));
		if ($postid == $result['maxid']) {
			return true;
		}
		return false;
	}

	public static function has_comment($postid)
	{
		if (!isset($postid)) {
			return false;
		}
		$sql = "SELECT count(*) FROM ^posts WHERE type = 'C' AND parentid = #";
		$result = qa_db_read_one_value(qa_db_query_sub($sql, $postid));

		if ($result > 0) {
			return true;
		}

		return false;
	}

	public static function is_best_answer($postid)
	{
		if (!isset($postid)) {
			return false;
		}
		$sql = "SELECT count(*) FROM ^posts WHERE type = 'Q' AND selchildid = #";
		$result = qa_db_read_one_value(qa_db_query_sub($sql, $postid));

		if ($result > 0) {
			return true;
		}

		return false;
	}

}
