<?php

namespace Craft;

class RedirectManagerRecord extends BaseRecord
{
	
	public function getTableName()
	{
		return 'redirectmanager';
	}
	
	public function defineAttributes()
	{
		return array(
			'uri' => array(AttributeType::String, 'required' => true, 'unique' => true),
			'location' => array(AttributeType::String, 'required' => true, 'unique' => false),
			'type' => array(AttributeType::String, 'required' => true, 'unique' => false)
		);
	}
	
	public function create()
	{
		$class = get_class($this);
		$record = new $class();
		return $record;
	}
}
