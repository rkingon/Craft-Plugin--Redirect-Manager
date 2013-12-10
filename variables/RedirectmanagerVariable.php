<?php

namespace Craft;

class RedirectManagerVariable
{
	
	public function getAllRedirects()
	{
		return craft()->redirectmanager->getAllRedirects();
	}
	
	public function getRedirectById($id)
	{
		return craft()->redirectmanager->getRedirectById($id);
	}
	
}
