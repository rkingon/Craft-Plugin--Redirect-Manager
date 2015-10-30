<?php

namespace Craft;

class RedirectManagerModel extends BaseModel
{
	public function defineAttributes()
	{
		return array(
			'id' => AttributeType::Number,
			'uri' => AttributeType::String,
			'location' => AttributeType::String,
			'type' => AttributeType::String,
		);
	}
}
