<?php
/* (C) Websplosion LLC, 2001-2021

IMPORTANT: This is a commercial software product
and any kind of using it must agree to the Websplosion's license agreement.
It can be found at http://www.chameleonsocial.com/license.doc

This notice may not be removed from the source code. */

Class TemplateEdgeProfileInfo extends CHtmlBlock
{
	function parseBlock(&$html)
	{
		TemplateEdge::parseColumn($html, guid());

		parent::parseBlock($html);
	}
}