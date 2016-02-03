<?php

namespace Craft;

class RedirectManagerPlugin extends BasePlugin
{
	public function getName()
	{
		return Craft::t('Redirect Manager');
	}

	public function getVersion()
	{
		return '1.9.1';
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
		// redirects only take place out of the CP
		if(craft()->request->isSiteRequest() && !craft()->request->isLivePreview())
		{
			// only init if it's a legit 404
			craft()->onException = function(\CExceptionEvent $event)
			{
				if(!empty($event->exception->statusCode) && ($event->exception->statusCode == 404))
				{
					$path = craft()->request->getPath();
					$query = craft()->request->getQueryStringWithoutPath();
					if ($query)
					{
						$path .= '?' . $query;
					}
					if( $location = craft()->redirectManager->processRedirect($path) )
					{
						$event->handled = true;
						craft()->request->redirect($location['url'], true, $location['type']);
					}
				}
			};
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
