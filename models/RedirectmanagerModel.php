<?php

namespace Craft;

class RedirectmanagerModel extends BaseModel
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
