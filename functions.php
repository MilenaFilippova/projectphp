<?php

	function array_get($array,$key,$default = null)
	{
		return $array[$key];
	}
	
	function e($value)
	{
		return htmlspecialchars($value);
	}
	
	
	function get_from_request($keys)
	{
		$data=[];
		foreach($keys as $key)
		{
			$data[$key]=trim(array_get(get_post(),$key,''));
		}
		return $data;
	}
	
	function save_file($path,$contents)
	{
		$dir = dirname($path);
		if (!file_exists($dir))
		{
			mkdir($dir,0777,true);
		}
		return file_put_contents($path,$contents);
	}
	
	function save_json($path,$array)
	{
		return save_file($path,json_encode($array));
	}
	
	function get_validation_rules()
	{
		return[
			'topic' =>[
				'not_empty'=>'Не казана тема!',
			],
			'date_reserv' =>[
				'not_empty'=>'Не указана дата!',
			],
			'time_reserv' => [
				'not_empty' => 'Не указано время!',
			],
		];
	}
	
	function die_r($value)
	{
		echo '<pre>';
		print_r($value);
		echo '</pre>';
		die();
	}

	
	function get_post()
	{
		return $_POST;
	}
	
	
	function get_get()
	{
		return $_POST;
	}
	
	function generate_uniq_filename($ext = '.txt')
	{
		return date('Ymd_His'). '-' . rand(100,999) . $ext;
	}
	
	
	function  validate_request($validation_rules,$fields)
	{
		$errors=[];
		
		foreach($validation_rules as $key=>$rules)
		{
			foreach($rules as $rule=>$error_text)
			{
				switch($rule)
				{
					case 'not_empty':
						if(!$fields[$key])
						{
							$errors[$key]=$error_text;
						}
					break;
					
					case 'valid_name':
						if(!preg_match_all('/^[А-ЯЁ]{1}[а-я-А-ЯёЁ]{2,29}/',$fields[$key]))
						{
							$errors[$key]=$error_text;
						}
					break;
					
					case 'valid_lastname':
						if(!preg_match_all('/^[А-ЯЁ]{1}[а-я-А-ЯёЁ]{2,29}/',$fields[$key]))
						{
							$errors[$key]=$error_text;
						}
					break;
					
					
					case 'valid_email':
						if(!preg_match_all('/^[\w\-\.]+@([\w\-]+\.)*[\w\-]+\.[a-z]{2,}$/',$fields[$key]))
						{
							$errors[$key]=$error_text;
						}
					break;
					
					case 'valid_phone':
						if(!preg_match_all('/^(\+7|8)\d{10}$/',$fields[$key])  )
						{
							$errors[$key]=$error_text;
						}
					break;
					
					
					case 'valid_phone_two':
						if(!preg_match_all('/(\+)?\d(\s(\d){3}){2}(\-?\d){4}/',$fields[$key]))
						{
							$errors[$key]=$error_text;
						}
					else
					{
						//приведение телефона к формату перед сохранением
						format_phone($fields['phone']);
					}
					break;
				}
			}
		}
		return $errors;
	}

	function format_phone($phone)
	{	
			$patterns= ['/^(\+7|8)((\d){3})((\d){3})((\d){2})(\d{2})$/'];	//+79991234566
			$replacements = ['${1} ${2} ${4}-${6}-${8}'];	////+7 999 123-45-66
			$phone= preg_replace($patterns, $replacements, $phone);
	}
	
	