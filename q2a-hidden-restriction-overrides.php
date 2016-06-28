<?php

function qa_page_q_post_rules($post, $parentpost=null, $siblingposts=null, $childposts=null)
{
	$rules = qa_page_q_post_rules_base($post, $parentpost, $siblingposts, $childposts);
	return $rules;
}
