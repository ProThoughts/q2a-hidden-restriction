<?php
if (!defined('QA_VERSION')) { // don't allow this page to be requested directly from browser
	header('Location: ../../');
	exit;
}
require_once QA_PLUGIN_DIR.'q2a-hidden-restriction/hidden-restriction.php';

function qa_page_q_post_rules($post, $parentpost=null, $siblingposts=null, $childposts=null)
{
	$rules = qa_page_q_post_rules_base($post, $parentpost, $siblingposts, $childposts);
	if ($post['basetype'] === 'C') {
		if (hidden_restriction::passed_for_24_hours($post['created']) ||
			!hidden_restriction::is_last_comment($post['postid'], $parentpost['postid'])) {
			$rules['hideable'] = false;
		}
	} elseif ($post['basetype'] === 'A') {
		if ( qa_get_logged_in_level() < QA_USER_LEVEL_ADMIN &&
			(hidden_restriction::passed_for_24_hours($post['created']) ||
			hidden_restriction::has_comment($post['postid']) ||
			hidden_restriction::is_best_answer($post['postid']))) {
			$rules['hideable'] = false;
		}
	}
	return $rules;
}
