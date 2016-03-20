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

    public function getImportResultSuccess()
    {
        return craft()->httpSession->get('redirectmanager.result')['success'];
    }

    public function getImportResultFailed()
    {
        return craft()->httpSession->get('redirectmanager.result')['failed'];
    }
}
