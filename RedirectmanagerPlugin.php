<?php

namespace Craft;

class RedirectmanagerPlugin extends BasePlugin
{
	public function getName()
	{
		return Craft::t('Redirect Manager');
	}

	public function getVersion()
	{
		return 'Beta';
	}

	public function getDeveloper()
	{
		return 'Roi Kingon';
	}

	public function getDeveloperUrl()
	{
		return 'http://www.roikingon.com';
	}

	public function hasCpSection()
	{
		return true;
	}

	public function init()
	{
		// redirects only take place out of the CP (and should not happen in live preview)
		if(craft()->request->isSiteRequest() && !craft()->request->isLivePreview()){
			$path = craft()->request->getPath();
			if( $location = craft()->redirectmanager->processRedirect($path) )
			{
				header("Location: ".$location['url'], true, $location['type']);
				exit();
			}
		}
	}

	public function registerCpRoutes()
	{
		return array(
			'redirectmanager\/new' => 'redirectmanager/_edit',
			'redirectmanager\/(?P<redirectId>\d+)' => 'redirectmanager/_edit'
		);
	}
	public function onAfterInstall()
	{
		$redirects = array(
			array('uri' => '#^bad(.*)$#', 'location' => 'good$1', 'type' => "302")
		);

		foreach ($redirects as $redirect) {
			craft()->db->createCommand()->insert('redirectmanager', $redirect);
		}
	}
}
