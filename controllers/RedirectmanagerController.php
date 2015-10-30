<?php

namespace Craft;

class RedirectManagerController extends BaseController
{
	public function actionSaveRedirect()
	{
		$this->requirePostRequest();
		
		if ($id = craft()->request->getPost('redirectId')) {
			$model = craft()->redirectManager->getRedirectById($id);
		} else {
			$model = craft()->redirectManager->newRedirect($id);
		}
		
		$attributes = craft()->request->getPost('redirectRecord');
		$model->setAttributes($attributes);
		
		if (craft()->redirectManager->saveRedirect($model)) {
			craft()->userSession->setNotice(Craft::t('Redirect saved.'));
			return $this->redirectToPostedUrl(array('redirectId' => $model->getAttribute('id')));
		} else {
			craft()->userSession->setError(Craft::t("Couldn't save redirect."));
			craft()->urlManager->setRouteVariables(array('redirectId' => $model->getAttribute('id')));
		}
	}

	public function actionDeleteRedirect()
	{
		
		$this->requirePostRequest();
		$this->requireAjaxRequest();
		
		$id = craft()->request->getRequiredPost('id');
		craft()->redirectManager->deleteRedirectById($id);
		
		$this->returnJson(array('success' => true));
	}
}
