<?php
/**
 * {ENGLISH}
 * 
 * This class allows you to retrieve the translated strings in different languages, 
 * without creating complex structures of internationalization 
 * 
 *  How to use: 
 * First you need to customize the three constants (STRING_ROOT, LANG_DEFAULT, FILE_TYPE) 
 *   STRING_ROOT: folder where there is the shade for the internationalization <abbreviazione_lingua> \ <file_con_le_stringhe> 
 *   LANG_DEFAULT: the default language that will be used in the case during the instantiation of the class was not passed. 
 *   FILE_TYPE: the type of file in which only the strings, you can choose between ini or xml 
 * 
 * Customize then the array $ FILE_LANGUAGE that contains the names of files related to languages 
 * in the __construct function select the appropriate function loader
 * The use of the class will be as follows:
 *  			require_once 'S.php';
 *					$S=new S('it');
 *
 *				print_r($S->string('test'));
 * 
 * {ITALIANO}
 * 
 * Questa classe permette di recuperare delle stringhe tradotte in diverse lingue, 
 * senza creare complesse strutture di internazionalizzazione 
 * 
 * Come si usa:
 * Per prima cosa devi personalizzare le tre costanti (STRING_ROOT,LANG_DEFAULT,FILE_TYPE)
 * 	STRING_ROOT : folder dove è presente l'alberatura per l'internazionalizzazione <abbreviazione_lingua>\<file_con_le_stringhe>
 *  LANG_DEFAULT: la lingua di default, che verrà utilizzata nel caso durante l'istanziazione della classe non fosse passata.
 *  FILE_TYPE   : la tipologia di file in cui solo le stringhe, è possibile scegliere tra .ini o .xml
 * 
 * Personalizzare quindi l'array $FILE_LANGUAGE che contiene i nomi dei file relativi alle lingue 
 * e nel __construct selezionare la funzione di loader apposita
 * 
 * L'utilizzo della classe sarà il seguente:
 * 
 * 				require_once 'S.php';
 *					$S=new S('it');
 *
 *				print_r($S->string('test'));
 * 
 * 
 */
define ("STRING_ROOT","string".DIRECTORY_SEPARATOR);
define ("LANG_DEFAULT","it");
define ("FILE_TYPE","XML");

class S{
	private $Lang;
	private $Strings;
	private $Xml;
	
	/*
	 * private $FILE_LANGUAGE=array("it"=>"it_IT.ini",
	 *	   						    "en"=>"en_EN.ini");
    */
	
	private $FILE_LANGUAGE=array("it"=>"it_IT.xml",
								 "en"=>"en_EN.xml");
	
	public function __construct($language=null){
		$this->Lang=(isset($language))?$language:LANG_DEFAULT;
		//$this->getStringsFromIniFile();
		$this->getStringsFromXmlFile();
	}
	
	public function string($content){
		return (FILE_TYPE==="XML")?@utf8_decode($this->Xml->{$content}->asXML()):@$this->Strings[$content];
	}
	
	private function getStringsFromIniFile(){
		if($this->FILE_LANGUAGE[$this->Lang]!='')
			$this->Strings= parse_ini_file(STRING_ROOT.DIRECTORY_SEPARATOR.$this->Lang.DIRECTORY_SEPARATOR.$this->FILE_LANGUAGE[$this->Lang],true);
	}
	
	private function getStringsFromXmlFile(){
		if($this->FILE_LANGUAGE[$this->Lang]!='')
			$this->Xml=simplexml_load_file("http://localhost/laboratorio/RESOURCE/Res/string/it/it_IT.xml");
	}
}
