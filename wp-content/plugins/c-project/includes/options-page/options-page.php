<?php
/* Options Page package 
 *
 * Author: Ha, Doan Ngoc
 * Email: hadoanngoc@gmail.com
 * Created: 2014, Feb 2nd
 * Version: 1.0
 *
 */
 
include 'classes/ioption.php';
include 'classes/op_option.php';

/*Directories that contain classes*/
global $classesDir; 
$classesDir = array (	
    dirname(__FILE__) .'/classes/elements/'
);

if(!class_exists('Options_Page')){
	/* Main class for Options Page */
	class Options_Page{
		private $_ID = 'osp';
		private $_labels = array(
			'page_title'=>'Select Your Settings',
			'submit_text'=>'Update'
		);
		
		private $_args = array(
			'option_file'=>'options.xml',
			'page_title'=>'Plugin Settings',
			'menu_title'=>'Options Page',
			'menu_position'=>'999'
			);
		
		private $_options = null;
		
		public function __construct($page_id, $args = array(), $labels = array()) {
			$this->_ID = $page_id;
			$this->_labels = array_merge($this->_labels,$labels);
			$this->_args = array_merge($this->_args,$args);
			
			$this->_options = unserialize(get_option($this->_ID));
			//echo 'ok';exit; 
			add_action('admin_menu', array($this,'_init'));
		}
		
		function _init() {
			global $osp_menu; 
			
			if(isset($this->_args['parent_menu'])){
				
				$osp_menu = add_submenu_page($this->_args['parent_menu'],$this->_args['page_title'],$this->_args['menu_title'],'administrator',$this->_ID,array($this,'_display_settings'));
			} else {
				
				$osp_menu = add_menu_page(
				$this->_args['page_title'],$this->_args['menu_title'], 
				/* Permissions */'administrator', 
				/* ID of options page*/$this->_ID, 
				/* Function to display options page */array($this,'_display_settings'),
				'',$this->_args['menu_position']);
			}
			
			global $classesDir;
			
			foreach($classesDir as $dir){
				foreach (glob($dir . '*.php') as $file)
					include_once( $file );
			}
			
			/* Hook to include scripts and styles in options page */
			add_action( 'admin_print_styles-' . $osp_menu, array($this,'_custom_css') );
			add_action( 'admin_print_scripts-' . $osp_menu, array($this,'_custom_js') );
		}

		/* Include CSS for options page */
		function _custom_css(){	
			wp_enqueue_style('uikit-css',plugins_url('uikit/css/uikit.min.css', __FILE__));
			wp_enqueue_style('uikit-css-gradient',plugins_url('uikit/css/uikit.gradient.min.css', __FILE__));			
			wp_enqueue_style('uikit-css-datepicker',plugins_url('uikit/addons/css/datepicker.min.css', __FILE__));			
			wp_enqueue_style('uikit-css-timepicker',plugins_url('uikit/addons/css/timepicker.min.css', __FILE__));	
			wp_enqueue_style('osp-style',plugins_url('css/style.css', __FILE__));
		}

		/* Include JS for options page */
		function _custom_js(){
			wp_enqueue_script('jquery');
			wp_enqueue_script('uikit-js',plugins_url('uikit/js/uikit.js', __FILE__),array('jquery'));
			wp_enqueue_script('uikit-js-datepicker',plugins_url('uikit/addons/js/datepicker.min.js', __FILE__),array('uikit-js'));
			wp_enqueue_script('uikit-js-timepicker',plugins_url('uikit/addons/js/timepicker.min.js', __FILE__),array('uikit-js'));
		}

		/* Display options page */
		function _display_settings() {
			$html = '<div class="wrap">';
			
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				// if submited
				$options = $_POST[$this->_ID];
				update_option($this->_ID,serialize($options));
				$html .= '<div class="uk-alert uk-alert-success"><i class="uk-icon-check-square"></i> Settings saved 
<a href="#close" class="icon-remove"></a></div>';
			}
			
			$options = unserialize(get_option($this->_ID));
			$html .= '<form action="admin.php?page='.$this->_ID.'" onsubmit="this.action += window.location.hash" method="post" class="uk-form" name="options">
						<h2>'.$this->_labels['page_title'].'</h2>
						' . wp_nonce_field('update-options');
			
			// Read options.xml
			if(file_exists($this->_args['option_file'])){
				try {
					$xmlstring = file_get_contents($this->_args['option_file']);
					
					$tab_titles = '<ul class="uk-tab uk-tab-left" data-uk-tab="{connect:\'#options-page-tab-content\'}">';
					$tab_contents = '<div id="options-page-tab-content" class="uk-switcher uk-margin">';
					
		
					$sxe = new SimpleXMLElement($xmlstring);
					$tabidx = 0;
					foreach($sxe->tab as $tab){
						$tabidx++;
						$tab_name = '';
						$tab_atts = $tab->attributes();
						
						$tab_name = $tab_atts['label'];
						$icon = isset($tab_atts['icon']) ? '<i class="uk-icon-' . $tab_atts['icon'] . '"></i> ' : '';
						
						$tab_titles .= '<li ' . ($tabidx == 1 ? 'class="uk-active"':'') .'><a href="#option-tab-'.$tabidx.'">'.$icon. $tab_name.'</a></li>';
						$tab_contents .= '<div id="option-tab-'.$tabidx.'" class="tab-content">';
						
						foreach($tab->group as $group){
							$group_name = '';
							$group_atts = $group->attributes();
							$group_name = $group_atts['label'];								
							$icon = isset($group_atts['icon']) ? '<i class="uk-icon-' . $tab_atts['icon'] . '"></i> ' : '';	
							
							$tab_contents .= 
								'<table class="uk-table" width="100%" cellpadding="0" cellspacing="0">';
									if($group_name != ''){
									$tab_contents .= '
									<thead>
										<th>'.$icon. $group_name.'</th>
									</thead>';
									}
									
							$tab_contents .= '<tbody>';
								
							foreach($group->fields as $fields){
								$fields_atts = $fields->attributes();
								
								$tab_contents .=
									'<tr class="row label '.(count($fields->description) > 0?'no-border':'').'">
										<td align="left">
											<label>'
												.$fields_atts['label'].'</label>
										</td>
									</tr>
									<tr class="row">
										<td>';
											foreach($fields->option as $option){
												$atts = $option->attributes();
												
												$props = '';
												if(isset($atts['tooltip'])){
													$props = ' data-uk-tooltip title="' . $atts['tooltip'] . '" ';
												}
												if(count($fields->option) > 1){
													$tab_contents .= '<div class="option" '.$props.'>';
												} else {
													$tab_contents .= '<div class="" '.$props.'>';
												}
												
												
												$selected = (isset($options[(string)$atts['id']])) ? $options[(string)$atts['id']] : (isset($atts['default'])?$atts['default']:'');

												if(isset($atts['label'])){
													$tab_contents .= '<label>' . $atts['label'] . ':</label>';
												}
												
												// call responsible option element to generate HTML
												if(class_exists('OP_Option_' . $atts['type'])){
													$r = new ReflectionClass('OP_Option_' . $atts['type']);
													$option_select = $r->newInstanceArgs(array($this->_ID . '['.$atts['id'].']'));
													$option_select->declareXML($option->asXML());
													$tab_contents .= $option_select->getOption($selected);
												}
												
												
												$tab_contents .= '</div>';
												
											}											
										'</td>
									</tr>';
									if(count($fields->description) > 0){
										foreach($fields->description as $desc){
											$tab_contents .= '<tr class="row description"><td>'.$desc->asXML().'</td></tr>';
										}
									}
							}
							
							$tab_contents .= '</tbody></table>';
						}
						$tab_contents .= '</div>';// end tab-content
					}
					
					$tab_contents .= '</div>';//end uk-tab-content
					$tab_titles .= '</ul>';
				} catch (Exception $e) {
					echo "Exception occurs: " . print_r($e);
				}
			}
			
			
			
		$html = $html . 
					'<div class="uk-grid">
						<div class="uk-width-medium-2-10">' .
							$tab_titles . 
						'</div>
						<div class="uk-width-medium-8-10" style="border: 1px solid rgb(221, 221, 221);
margin-left: -1px;">' .
							$tab_contents .
						'</div>
					</div>
					<button type="submit" name="Submit" class="uk-button uk-button-primary">'.$this->_labels['submit_text'].'</button></form>
				</div><!-- end Wrap -->
		';
			echo $html;

		}
		
		public function get($option_name){
			if($this->_options){
				return $this->_options[$option_name];
			}
		}
	}	
}

if(!function_exists('op_get')){
	function op_get($op_id, $option_name){
		if($GLOBALS[$op_id] && is_a($GLOBALS[$op_id], 'Options_Page')){			
			return $GLOBALS[$op_id]->get($option_name);
		}
		return null;
	}
}