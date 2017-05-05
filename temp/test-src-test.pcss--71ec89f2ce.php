<?php
// source: E:\code\pcss\PCSS/test/src/test.pcss

use Latte\Runtime as LR;

class Template71ec89f2ce extends Latte\Runtime\Template
{

	function main()
	{
		extract($this->params);
		echo LR\Filters::escapeHtmlText($msg) /* line 1 */;
		return get_defined_vars();
	}

}
