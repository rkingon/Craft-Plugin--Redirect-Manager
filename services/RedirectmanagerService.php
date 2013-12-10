<?php

namespace Craft;

class RedirectmanagerService extends BaseApplicationComponent
{
	protected $redirectRecord;


	public function __construct($redirectRecord = null)
	{
		$this->redirectRecord = $redirectRecord;
		if (is_null($this->redirectRecord)) {
			$this->redirectRecord = RedirectmanagerRecord::model();
		}
	}
	
	public function processRedirect($uri)
	{
		$records = $this->getAllRedirects();
		$doRedirect = false;
		
		foreach($records as $record)
		{
			$record = $record->attributes;
			
			// Standard match
			if ($record['uri'] == $uri)
			{
				$redirectLocation = $record['location'];
				break;
			}
			
			// Regex / wildcard match
			if(preg_match("/^#(.+)#$/", $record['uri'], $matches)){
				$record['uri'] = $matches[1];
			}elseif(strpos($record['uri'], "*")){
				$record['uri'] = "^".str_replace(array("*","/"), array("(.*)", "\/"), $record['uri']);
			}
			
			if(preg_match("/".$record['uri']."/", $uri)){
				$redirectLocation = preg_replace("/".$record['uri']."/", $record['location'], $uri);
				break;
			}
		}
		return (isset($redirectLocation)) ? array("url" => ( strpos($record['location'], "http") === 0 ) ? $redirectLocation : UrlHelper::getSiteUrl($redirectLocation), "type" => $record['type']) : false;
	}

	public function newRedirect($attributes = array())
	{
		$model = new RedirectmanagerModel();
		$model->setAttributes($attributes);

		return $model;
	}

	public function getAllRedirects()
	{
		$records = $this->redirectRecord->findAll(array('order'=>'id'));
		return RedirectmanagerModel::populateModels($records, 'id');
	}

	public function getRedirectById($id)
	{
		if ($record = $this->redirectRecord->findByPk($id)) {
			return RedirectmanagerModel::populateModel($record);
		}
	}

	public function saveRedirect(RedirectmanagerModel &$model)
	{
		if ($id = $model->getAttribute('id')) {
			if (null === ($record = $this->redirectRecord->findByPk($id))) {
				throw new Exception(Craft::t('Can\'t find a redirect with ID "{id}"', array('id' => $id)));
			}
		} else {
			$record = $this->redirectRecord->create();
		}

		$record->setAttributes($model->getAttributes());
		if ($record->save()) {
			// update id on model (for new records)
			$model->setAttribute('id', $record->getAttribute('id'));

			return true;
		} else {
			$model->addErrors($record->getErrors());

			return false;
		}
	}

	public function deleteRedirectById($id)
	{
		return $this->redirectRecord->deleteByPk($id);
	}
	
	private function _processRegexMatch($uriToMatch, $uri)
	{
		preg_match("/^#(.+)#$/", $uriToMatch, $matches);
		// return ($matches[1] == $uri) ;
	}
	
	private function _processWildcardMatch($val)
	{
		
	}
}
