<?php

//класс формы
class Calendar
{
	public $topic;
	public $type_n;
	public $place;
	public $date_reserv;
	public $time_reserv;
	public $length;
	public $comment;
	
	
	protected $errors=[];
	protected $id=[];
	
	//для получения защищенного айдишника из вне
	public function getID()
	{
		return $this->id;
	}
	
	//айдишники защищены 
	protected function setID()
	{
		return $this->id;
	}
	

	protected static $attributes = 
	[
		'topic',
		'type_n',
		'place',
		'date_reserv',
		'time_reserv',
		'length',
		'comment',
	];
	  
	public static $array_type = 
	[
		1 => 'Встреча', 
		2 => 'Звонок', 
		3 => 'Совещание',
		4 => 'Дело',
	];
	
	
	//public static $test='tested well';
	
	//массив полей
	public function fill($array)
	{
	//	$attributes=array_keys($this->getFields());
		foreach($array as $key=>$value)
		{
			//if(in_array($key,$attributes))
			//{
				$this->$key = trim($value);	//обращаемся к имени свойства,которое содержит в себе переменная key	
			//}
		}
	}
	
	
	
	//возвращает массив из объектов самого же себя
	public function getAll()
	{
		//читаем данные из файла
		$files =glob(static::getDataDir().'*.json');
		$requests=[];
		foreach($files as $file)
		{
			//без конкретного имени класса
			$form=new static;
			$form->fill(json_decode(file_get_contents($file),true));
			$form->setId(basename($file,'.json'));
			
			$requests[]=$form;
		}
		return $requests;
	}
	
	//создает объект саамого себя и загружает туда данные
	public static function loadById($id)
	{
		$id =static::sanitizeId($id);
		$filename = static::getDataDir().$id . '.json';
		$file=file_get_contents($filename);
		$fields=json_decode($file,true);
		//экземляр самого себя
		$form= new static;
	
		$form->setId($id);
		//заполняем в форму имеющиеся поля
		$form->fill($fields);
		//возвращаем заполненную форму
		return $form;
	}
	
	//для сохранения в необходимую константую директорию
	protected static function getDataDir()
	{
		return APP_PATH . '/data/';
	}
	

	public function getFields()
	{
		return
		[
			'topic'=>$this->topic,
			'place'=>$this->place,
			'date_reserv'=>$this->date_reserv,
			'time_reserv'=>$this->time_reserv,
			'length'=>$this->length,
			'comment'=>$this->comment,
		];
	}

	
	protected  function generateUniqFilename($text='.txt')
	{
		return date('Ymd_His') . '-' . rand(100,999) . $text;
	}
	
	
	
	/*public function save()
	{
		if($this->getId())
		{
			$filename=static::getDataDir().$this->getID().'.json';
		}
		else 
		{
			$filename=static::getDataDir().$this->generateUniqFilename('.json');
		}
		if(save_json($filename,$this->getFields()))
		{
			return true;
		}
		//исключение(если оно сработает ,то выполнение кода остановится)
		throw new InviteFormException('Failed to save data');
		
	}*/
	

	public function save()
	{
		if (!$this->getValidationRules())	//???????????
		{
			return false;
		}
		else
		{
		  $sql = static::get_pdo()->prepare('INSERT INTO `' . static::$table . '` (`' . implode('`, `', static::$attributes) . '`) VALUES (:' . implode(', :', static::$attributes) . ');');

		  $data = [];
		  $Fields = $this->getFields();

		  foreach (static::$attributes as $attribute)
		  {
			$data[$attribute] = $Fields[$attribute];
		  }

		  $sql->execute($data);
				return $sql->rowCount() === 1;
		}
	}
	
		protected static function get_pdo()
	   {
			return Database::get_pdo();
	   } 
	
	protected function getValidationRules()
	{
		return
		[
			'topic' =>[
				'not_empty'=>'Не указана тема!',
			],
			'date_reserv' =>[
				'not_empty'=>'Не указанa дата!',
			],
			'time_reserv' => [
				'not_empty' => 'Не указано время!',
			],
		
		];
	}
	
	//проверка на валидность всех данных
	public function validate()
	{
		$this->errors =validate_request($this->getValidationRules(),$this->getFields());
			$this->getFields();
		return !$this->hasErrors();	//вернет true если список ошибок пуст
		
	}
	
	
	//для получения одной конкретной ошибки
	public function getError($key)
	{
		return array_get($this->errors,$key,'');	//проверяем ключ через array_get,если не найдем ошибку,то вернем пустую строку
	}
	
	//для доступа ко всем  ошибкам
	public function getErrors()
	{
		return $this->errors;
	}
	
	//есть ли ошибки
	public function hasErrors()
	{
		return count($this->errors);	//возвращаем true или false
	}
	
	
	//для очистки от символов(замена их на пустую строку)
	protected static  function sanitizeId($id)
	{
		return str_replace(['..','/'], '',$id);
	}
		
}