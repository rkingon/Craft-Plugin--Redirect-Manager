<?php

namespace Craft;

class RedirectManagerVariable
{
	
	public function getAllRedirects()
	{
		return craft()->redirectManager->getAllRedirects();
	}
	
	public function getRedirectById($id)
	{
		return craft()->redirectManager->getRedirectById($id);
	}
	
}
