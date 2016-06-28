<?php

class qa_html_theme_layer extends qa_html_theme_base
{
	public function q_view_buttons($q_view)
	{
		if ($this->template == 'question') {
			$button = array( 'tags' => 'name="a'.$q_view['raw']['postid'] .
			 '" onclick="return false"',
							 'label' => '非表示不可(詳細)',
							 'popup' => '' );
			$q_view['form']['buttons']['hide'] = $button;
		}
		qa_html_theme_base::q_view_buttons($q_view);

	}

}
