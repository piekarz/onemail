<?php
/** ################################################################################################**   
* Copyright (c)  2008  CJ.   
* Permission is granted to copy, distribute and/or modify this document   
* under the terms of the GNU Free Documentation License, Version 1.2   
* or any later version published by the Free Software Foundation;   
* Provided 'as is' with no warranties, nor shall the autor be responsible for any mis-use of the same.     
* A copy of the license is included in the section entitled 'GNU Free Documentation License'.   
*   
*   CJAX  5.0-Stable                $     
*   ajax made easy with cjax                    
*   -- DO NOT REMOVE THIS --                    
*   -- AUTHOR COPYRIGHT MUST REMAIN INTACT -   
*   Written by: CJ Galindo                  
*   Website: http://cjax.sourceforge.net                     $      
*   Email: cjxxi@msn.com    
*   Date: 2/12/2007                           $     
*   File Last Changed:  07/03/2012            $     
**####################################################################################################    */   

/**
 * Load core events
 */
require_once 'core.class.php';
require_once 'xmlItem.class.php';
class CJAX_FRAMEWORK Extends CoreEvents {
	
	public function __get($setting)
	{
		$value = self::input($setting);
		if(!$value) {
			if($a = self::input('a')) {
				if(isset($a[$setting])) {
					$value = $a[$setting];
				}
			}
		}
		if($value && function_exists('cleanInput')) {
			$value = cleanInput($value);
		} 
		return $value;
	}
	
	public function __call($method, $args)
	{
		$list = array();
		$params = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');

		$pParams = array();
		if($args) {
			foreach($args as $v) {
				$pParams[current($params)] =  $v;
				next($params);
			}
		}

		if(self::isPlugin($method)) {
			$entry_id = null;
			if($pParams) {
				$params = func_get_args();
				$data['do'] = plugin::method($method);
				$data['is_plugin'] = $method;
				$data['data'] = $pParams;
				$data['file'] = plugin::file($method);
				$data['filename'] = preg_replace("/.*\//",'', $data['file']);
				
				$entry_id = $this->xmlItem($this->xml($data), $method)->id;
			}
			$plugin = plugin::getPluginInstance($method, $params , $entry_id);
			plugin::instanceTriggers($plugin, $pParams);
			
			return $plugin;
		} else {
			$data = array();
			$data['do'] = '_fn';
			$data['fn'] = $method;
			$data['fn_data'] = $pParams;
			
			$item = $this->xmlItem($this->xml($data),'fn');
			$item->selector = $method;
			return  $item;
		}
	}
	
	function waitFor($file, $wait_for_file)
	{
		$xml = $this->import($file);
		
		$xml->waitfor = $wait_for_file;
	}
	
	/**
	 * 
	 * Prevent other APIS and saving them to stack that can be retrived by plugins.
	 * @param unknown_type $count
	 * @param unknown_type $call_id
	 */
	function prevent($plugin_name,$id, $count = 1)
	{
		$data['do'] = 'prevent';
		$data['count'] = $count;
		$data['uniqid'] = $id;
		$data['plugin_name'] = $plugin_name;
		$this->xml($data);
	}

	/**
	 *
	 * wait() - currently does not work in binded actions.
	 *
	 * evets:
	 *
	 * click
	 * change
	 * keydown
	 * keyup
	 * keypress
	 * 
	 * @param $element
	 * @param $actions
	 * @param $event
	 */
	function Exec($element , $actions , $event="click")
	{
		if(!self::getCache()) {
			return false;
		}
		if(is_array($element)) {
			$element = implode('|', $element);
		}
		if($event) {
			if(substr($event, 0,2)  != "on" && $event!='click') {
				$event = "on{$event}";
			}
			$this->event = $event;
		}
		$_actions =  array();
			
		if($actions && is_array($actions)) {
			
			$cache = CoreEvents::$cache;
			
			foreach($actions as $k => $v) {
				if(is_object($v) && is_a($v, 'xmlItem')) {
					$_actions[$v->id] = $v->xml();
					$v->delete();
				} else {
					if(is_object($v))  {
						//some functions return the ajax object?
						continue;
					}
					$_actions[$v] = CoreEvents::$cache[$v];
					unset(CoreEvents::$cache[$v]);
				}
			}
			
			return $this->AddEventTo($element,$_actions, $event);
		} else {
			
			if(is_a($actions,'xmlItem')) {
				$item = $actions->xml();
				$item['event'] = $event;
				$actions->delete();
				return $this->AddEventTo($element, array($actions->id => $item),$event);
			} else {
				$_actions = CoreEvents::$cache[$actions];
				$_actions['event'] = $event;
				$this->removeLastCache(1);
				return $this->AddEventTo($element, array($actions => $_actions),$event);
			}
			
		}
	}
    /**
	 * Create Ajax calls
	 *
	 * @param required string $url
	 * @param optional string $elem_id = null
	 * @param optional string $cmode = 'get'
	 * @return string
	 */
	public function call($url, $container_id=null, $confirm=null)
	{
		$ajax = CJAX::getInstance();
		
		if(preg_match('/^https?/', $url)) {
			$out['crossdomain'] = true;
		}
		$out['do'] = '_call';
		$out['url'] = $url;
		
		if($ajax->post)  {
			if(is_array($ajax->post)) {
				$args = http_build_query($ajax->post);
				$out['args'] = $args;
				$out['post'] = true;
			} else {
				$out['post'] = true;
			}
		}

		if($container_id) $out['container_id'] = $container_id;
		if(is_bool($ajax->text) && $ajax->text===false) {
			$out['text'] = "no_text";
		} else if($ajax->text) {
			$out['text'] = "{$ajax->text}";
		}
		
		if($confirm) $out['confirm'] = $confirm;

		if($ajax->loading) {
			$out['is_loading'] = true;
		}
		
		return $this->xmlItem($this->xml($out),'call','api');
	}
	
	
	public function __set($setting, $value)
	{
		if($this->isPlugin($setting)) {
			//is a plugin..
			return;
		}
		if(is_object($value)) {
			switch($value->name) {
				case 'call':
					$value->container_id = $setting;
				break;
				case 'form':
					$this->Exec($setting, $value->id);
				break;
			}
			return self::simpleCommit();
		} else {
			$xml =  $this->property($setting,$value);
			self::simpleCommit();
			return $xml;
		}
	}
	
	/**
	 * 
	 * is used to pass extra variables to POST ajax.
	 * currently used in iframe uploads
	 * 
	 * @param unknown_type $vars
	 */
	function ajaxVars($vars)
	{
		$data['do'] = 'ajaxVars';
		if(is_array($vars)) {
			$vars = http_build_query($vars);
		}
		$data['vars'] = $vars;
		$this->xml($data);
	}
	
	public function dialog($content, $title = null,$options = array())
	{
		$content = parent::dialog($content, $title);
		return $this->overlayContent($content, $options);
	}
	
	/**
	 * 
	 * Show overlay dialog provided information
	 * @param unknown_type $data
	 * @param unknown_type $title
	 */
	function debug($data, $title ='Debug Information', $extra = null)
	{
		if($extra) {
			$extra .= '<br />';
		}
		$this->dialog($extra.'<pre>'.print_r($data,1).'</pre>', $title, array('top'=> 100));
	}
	
	/**
	 * *set value to an element
	 * @param string $element_id
	 * @param string $value
	 */
	public function property($element_id,$value='',$clear_default=false,$select_text=false)
	{
		$options['do']  = 'property';
		$options['clear_text'] = $clear_default;
		$options['select_text'] = $select_text;
		$options['element_id'] = $element_id;
		$options['value'] = $value;
		//$options['options'] = $this->mkArray($options);
		
		return $this->xml($options);
	}

	function select($element,$options = array(),$allow_input = false)
	{
		$select['do'] = 'select';
		$select['element_id'] = $element;
		$select['options'] = $options;
		$select['allow_input'] = $allow_input;

		return $this->xml($select);
	}

    /**
     * Submit a form
     *
     * @param require string $url  url where the request will be sent to
     * @param require string $form_id  the form id
     * @param optional string $container_id = null  alternative element where to load the response
     * @param optional string $confirm  ask before sending the request
     * @return unknown
     */
    public function form($url, $form_id = null,$container_id = null,$confirm=null)
    {
        $ajax = CJAX::getInstance();
        
        $out = array();
        
        $out['do'] = '_form';
        $out['url'] = $url;
        if($form_id) $out['form_id'] = $form_id;
        if(!is_null($container_id)) {
        	$out['container'] = $container_id;
        }

    	if(!is_null($ajax->text)) {
			$out['text'] = $ajax->text;
		} elseif($ajax->text===false) {
			$out['text'] = 'Loading...';
		}

         if($confirm) {
         	$out['confirm'] = $confirm;
         }

        if(is_array($ajax->post)) {
        	$args = http_build_query($ajax->post);
        	$out['args'] = $args;
        	$out['post'] = true;
        } else {
        	$out['post'] = 1;
        }

        $xml = $this->xmlItem($this->xml($out),'form','api');
        
        return $xml;
    }


	/**
	 * assign styles to an element
	 *
	 * @param unknown_type $style
	 */
	function style($element_id,$style = array() )
	{
		$data['do'] = 'style';
		$data['element'] = $element_id;
		$data['style'] = $this->mkArray($style);
		return $this->xml($data);
	}

	private static $overLay = array();
	/**
	 *
	 * overlay url
	 * @param $url
	 * @param $use_cahe
	 * @param $options
	 * Accepted  $options Example
	 *  $options['top'] = '50px';
		$options['left'] = '100px';
		$options['transparent'] = '60%'; // from 1 transparent to 100 solid, how transparent should it be? default is 80.
		$options['color'] = '#FF8040'
	 */
	function overLay($url = null, $options = array(), $use_cahe = false)
	{
		$data['do'] = '_overLay';
		
		if($options && is_array($options)) {
			foreach($options as $k => $v) {
				if(is_a($v,'plugin')) {
					$xml = $v->xmlObject();
					$_data = $xml->pack();
					$xml->delete();
				} else {
					$_data = $v;
				}
				$data[$k] = $_data;
			}
			$data['options'] = $options;
		}
		$data['url'] = $url;
		$data['cache'] = $use_cahe;
		if($url) {
			$data['template'] = $this->template('overlay.html');
		}
		
		return $this->xmlItem($this->xml($data),'overlay','api');
	}

	/**
	 *
	 * Display an overlay with supplied html.
	 *
	 * Options -
	 * Examples:
 	    $options['transparent']	=	10;
		$options['color']	=	'#425769';
		$options['top'] = 200;
		$options['left'] = "50%";
	 * @param $content
	 * @param $options
	 */
	function overlayContent($content = null,$options = null)
	{
		$_options = array();

		$data['do'] = '_overLayContent';
		$data['content'] = $content;

		if($options && is_array($options)) {
			foreach($options as $k => $v ) {
				$data[$k] = $v;
			}
			$data['options'] = $this->mkArray($options);
		}
		$data['template'] = $this->encode($this->template('overlay.html'));

		return $this->xmlItem($this->xml($data),'overlayContent','api');
	}

	/**
	 * Display a message in the middle of the screen
	 *
	 * @param string $data
	 * @param integer $seconds if specified, this is the number of seconds the message will appear in the screen
	 * then it will dissapear.
	 */
	public function message($message,$seconds=3,$container_id='cjax_message')
	{
		$data['do'] = '_message';
		$data['message'] = $message;
		$data['time'] =  $seconds;
		$data['message_id'] = $container_id;
		return $this->xml($data);
	}
	
	/**
	 * 
	 * import css and javascript files
	 * @param mixed_type $file
	 * @param unknown_type $max_time
	 */
	public function import($file , $load_time = 0)
	{
		$data['do'] = '_import';
		$data['time'] = (int) $load_time;
		$data['is_import'] = 1;
		if(!is_array($file)) {
			$data['file'] = $file;
		} else  {
			$data = array_merge($data , $file);
		}
		
		return $this->xml($data);
		return $this->xmlItem($this->xml($data), 'import') ;
	}
	
	/**
	 * 
	 * import more than one file, waiting for the previous to load.
	 * @param mixed_type $file
	 * @param unknown_type $max_time
	 */
	public function imports($files = array() , &$data = array())
	{
		$data['do'] = '_imports';
		$data['files'] = $this->xmlIt($files,'file');
		$data['is_import'] = 1;
		
		$this->first();
		return $this->xml($data);
	}

	/**
	 * Update any element on the page by specifying the element ID
	 * Usage:  $ajax->update('element_id',$content);
	 * @param string $obj
	 * @param string $data
	 */
	public function update($element_id, $data=null)
	{
		$new['do'] = '_update';
		$new['element_id'] = $element_id;
		$new['data'] = $data;
		return $this->xml($new);
	}
	
	/**
	 * Add event to elements
	 * --
	 * AddEventTo();
	 *
	 * @param string $element
	 * @param string $event
	 * @param string $method
	 */
	public function AddEventTo($element,$actions,$event='onclick')
	{
		$data['do'] = 'AddEventTo';
		$data['element_id'] = $element;
		$data['event'] = $event;
		$data['events'] = $actions;
	
		return $this->xmlItem($this->xml($data),'AddEventTo','api');
	}

	/**
	 * Will execute a command in a specified amouth of time
	 * e.g $ajax->wait(5);
	 * Will wait 5 seconds before executes the next CJAX command
	 * 
	 *
	 * @param integer $seconds
	 * @param boolean $expand  - make other commands wait for this timeout also?
	 */

	public function wait($seconds, $expand = true)
	{
		$data['timeout'] = $seconds;
		if(!$seconds) {
			$data['no_wait'] = 1;
		} else {
			$data['expand'] = $expand;
		}
		$this->_flag = $data;
		return $this;
	}
	
	/**
	 * 
	 * Removes waiting times
	 */
	public function waitReset()
	{
		$data['do'] = '_wait';
		
		$data['time_reset'] = 1;
		
		return $this->xml($data);		
	}
	
	/**
	 * Flag function
	 * 
	 * Set command execution in high  priority preload mode.
	 */
	public function preload()
	{
		$this->flag('first');
	}

	/**
	 * Will remove an specified element from the page
	 *
	 * @param string $obj
	 */
	public function remove($obj)
	{
		$data['do'] = 'remove';
		$data['element_id'] = $obj;
		$this->xml($data);
	}

	/**
	 * Redirect the page.
	 * this is a recommended alternative to the built-in php function Header();
	 *
	 * @param string $where [URL]
	 */
	public function location($url = null)
	{
		$data['do'] = 'location';
		$data['url'] = $url;
		
		return self::xml($data);
	}


}