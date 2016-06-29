<?php

require_once QA_PLUGIN_DIR.'q2a-hidden-restriction/hidden-restriction.php';

class qa_html_theme_layer extends qa_html_theme_base
{
	public function q_view_buttons($q_view)
	{
		if ($this->template == 'question' &&
			isset($q_view['form']['buttons']['hide']) &&
			!empty($q_view['form']['buttons']['hide'])) {

			$postid = $q_view['raw']['postid'];
			$acount = $q_view['raw']['acount'];
			$created = $q_view['raw']['created'];

			if(hidden_restriction::passed_for_24_hours($created) ||
				$acount > 0) {
				$button = array( 'tags' => 'name="a'.$q_view['raw']['postid'] .
				 '" onclick="location.href=\'' . '/使-い-方#hidden' .
				 '\';return false"',
								 'label' => qa_lang_html('qa_hidden_restrictioin_lang/button_value'),
								 'popup' => qa_lang_html('qa_hidden_restrictioin_lang/popup'));
				$q_view['form']['buttons']['hide'] = $button;
			}
		}
		qa_html_theme_base::q_view_buttons($q_view);

	}

	public function head_script()
	{
		qa_html_theme_base::head_script();
		$script = "
<script type='text/javascript'>
$(document).ready(function(){
	$('input[name=\"q_dohide\"]').click(function(){
		$('#null').hide();
		if (confirm('". qa_lang_html('qa_hidden_restrictioin_lang/hideconfirm') ."')) {
			$('#null').show();
		} else {
			return false;
		}
	});
});
</script>
";
		$this->output($script);
	}
}
