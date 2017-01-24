<?Php
 /**
  * Contact Us Widget
  * 
  * Provides an interactive widget to show to the user phone number, fax, email, address and trading hours
  * pulled in from the theme customizer
  */
 class el_contact_us_widget extends WP_widget{
 	
	 /**
	 * Constrcutor 
	 */
	public function __construct(){
		
		$args = array(
			'description'	=> 'Displays a contact widget that shows various contact elements such as number, fax, email, address etc'
		);
		
		parent::__construct(
			'el_contact_us_widget', esc_html__('Contact Widget', 'ycc'), $args
		);
		
	}

	
	
	/**
	 * Visual output frontend
	 */
	public function widget($args, $instance){
		
		$eq_faq = el_faq::getInstance();
		
		$html = '';
		
		$html .= $args['before_widget'];
		
			$html .= '<div class="widget-wrap">';
				
				$title = isset($instance['title']) ? $instance['title'] : '';
				$contact_options = isset($instance['contact_options']) ? $instance['contact_options'] : '';
				if(!empty($contact_options)){
					$contact_options = json_decode($contact_options);
				}
				
				//title if supplied
				if(isset($instance['title'])){
					$html .= $args['before_title'];
						$html .= $title;
					$html .= $args['after_title'];	
				}
				
				//Customizer settings
				$el_phone = get_theme_mod('el_phone');
				$el_fax = get_theme_mod('el_fax');
				$el_email = get_theme_mod('el_email');
				$el_address = get_theme_mod('el_address');
				
				
				//main content
				$html .= '<div class="widget-content">';
					$html .= '<div class="widget-wrap">';	
				
					//Display Phone
					if(is_array($contact_options) && in_array('phone', $contact_options)){
						$html .= '<div class="element el-row nested phone small-margin-bottom-medium">';
							$html .= '<div class="el-col-small-6 el-col-medium-3 el-col-large-2 image">';
								$html .= '<img src="' . get_stylesheet_directory_uri() . '/img/icon-phone.png"/>';
							$html .= '</div>';
							
							$html .= '<div class="el-col-small-6 el-col-medium-9 el-col-large-10 content">';
								$html .= '<h4 class="small-margin-bottom-none">' . __('24 Hour Phone', 'ycc') . '</h4>';
								$html .= '<a class="h4 black" href="tel:' . trim($el_phone) . '">' . $el_phone . '</a>';
								
							$html .= '</div>';	
						$html .= '</div>';
					}
					//Display Fax
					if(is_array($contact_options) && in_array('fax', $contact_options)){
						$html .= '<div class="element el-row nested fax small-margin-bottom-medium">';
							$html .= '<div class="el-col-small-6 el-col-medium-3 el-col-large-2 image">';
								$html .= '<img src="' . get_stylesheet_directory_uri() . '/img/icon-fax.png"/>';
							$html .= '</div>';
							
							$html .= '<div class="el-col-small-6 el-col-medium-9 el-col-large-10 content">';
								$html .= '<h4 class="small-margin-bottom-none">' . __('24 Hour Fax', 'ycc') . '</h4>';
								$html .= '<div class="h4 black">' . $el_fax . '</div>';
								
							$html .= '</div>';	
						$html .= '</div>';
					}
					//Email
					if(is_array($contact_options) && in_array('email', $contact_options)){
						$html .= '<div class="element el-row nested email small-margin-bottom-medium">';
							$html .= '<div class="el-col-small-6 el-col-medium-3 el-col-large-2 image">';
								$html .= '<img src="' . get_stylesheet_directory_uri() . '/img/icon-mail.png"/>';
							$html .= '</div>';
							
							$html .= '<div class="el-col-small-6 el-col-medium-9 el-col-large-10 content">';
								$html .= '<h4 class="small-margin-bottom-none">' . __('Email', 'ycc') . '</h4>';
								$html .= '<a class="black" href="mailto:' . $el_email . '">' . $el_email . '</a>';
								
							$html .= '</div>';	
						$html .= '</div>';
					}
					//Address
					if(is_array($contact_options) && in_array('address', $contact_options)){
						$html .= '<div class="element el-row nested address small-margin-bottom-medium">';
							$html .= '<div class="el-col-small-6 el-col-medium-3 el-col-large-2 image">';
								$html .= '<img src="' . get_stylesheet_directory_uri() . '/img/icon-location.png"/>';
							$html .= '</div>';
							
							$html .= '<div class="el-col-small-6 el-col-medium-9 el-col-large-10 content">';
								$html .= '<h4 class="small-margin-bottom-none">' . __('Address', 'ycc') . '</h4>';
								$html .= '<div>' . $el_address . '</div>';
								
							$html .= '</div>';	
						$html .= '</div>';
					}
					//Opening Hours
					if(is_array($contact_options) && in_array('hours', $contact_options)){
						$html .= '<div class="element el-row nested hours small-margin-bottom-medium">';
							$html .= '<div class="el-col-small-6 el-col-medium-3 el-col-large-2 image">';
								$html .= '<img src="' . get_stylesheet_directory_uri() . '/img/icon-clock.png"/>';
							$html .= '</div>';
							
							$html .= '<div class="el-col-small-6 el-col-medium-9 el-col-large-10 content">';
								$html .= '<h4 class="small-margin-bottom-none">' . __('Trading Hours', 'ycc') . '</h4>';
								
								$el_trading_hours_monday_friday = get_theme_mod('el_trading_hours_monday_friday');
								$el_trading_hours_saturday = get_theme_mod('el_trading_hours_saturday');
								$el_trading_hours_holidays = get_theme_mod('el_trading_hours_holidays');
								
								if(!empty($el_trading_hours_monday_friday)){
									$html .= '<div>';
									$html .= __('Monay - Friday: ', 'ycc') . $el_trading_hours_monday_friday;
									$html .= '</div>';
								}
								if(!empty($el_trading_hours_saturday)){
									$html .= '<div>';
									$html .= __('Saturday: ', 'ycc') . $el_trading_hours_saturday;
									$html .= '</div>';
								}
								if(!empty($el_trading_hours_holidays)){
									$html .= '<div>';
									$html .= __('Public Holidays / Sunday: ', 'ycc') . $el_trading_hours_holidays;
									$html .= '</div>';
								}

							$html .= '</div>';	
						$html .= '</div>';
					}
					
				
					$html .= '</div>';
				$html .= '</div>';
				
			$html .= '</div>';
			
		$html .= $args['after_widget'];
		
		
		echo $html;
		
		
	}
	
	/**
	 * Form output on admin
	 */
	public function form($instance){
			
		$title = isset($instance['title']) ? $instance['title'] : '';
		$contact_options = isset($instance['contact_options']) ? $instance['contact_options'] : '';
		
		if(!empty($contact_options)){
			$contact_options = json_decode($contact_options);
		}
		
		
		$html = '';
		$html .= '<p>';
			$html .= '<label for="' . $this->get_field_id('title') . '">' . __('Title', 'ycc') .'</label>';
			$html .= '<input class="widefat" type="text" name="' . $this->get_field_name('title') . '" id="' . $this->get_field_id('title') . '" value="' . $title .'"/>';
		$html .= '</p>';
		
		//Select which elemnents to displauyw
		$html .= '<p>';
			$html .= '<label>' . __('Which contact elements do you want displayed?', 'ycc') .'</label><br/>';
			
			//Various contact options
			
			//PHONE
			$html .= '<p>';
				if(is_array($contact_options) && in_array('phone',$contact_options)){				
					$html .= '<input checked type="checkbox" id="' . $this->get_field_id('contact_options') .'-phone" name="' . $this->get_field_name('contact_options[]') . '" value="phone"/>';
				}else{
					$html .= '<input type="checkbox" id="' . $this->get_field_id('contact_options') .'-phone" name="' . $this->get_field_name('contact_options[]') . '" value="phone"/>';
				}
				$html .= '<label for="' . $this->get_field_id('contact_options') . '-phone">Show Phone</label>';	
			$html .= '</p>';
				
			//FAX
			$html .= '<p>';
				if(is_array($contact_options) && in_array('fax',$contact_options)){				
					$html .= '<input checked type="checkbox" id="' . $this->get_field_id('contact_options') .'-fax" name="' . $this->get_field_name('contact_options[]') . '" value="fax"/>';
				}else{
					$html .= '<input type="checkbox" id="' . $this->get_field_id('contact_options') .'-fax" name="' . $this->get_field_name('contact_options[]') . '" value="fax"/>';
				}
				$html .= '<label for="' . $this->get_field_id('contact_options') . '-fax">Show Fax</label>';		
			$html .= '</p>';
			
			//Email
			$html .= '<p>';
				if(is_array($contact_options) && in_array('email',$contact_options)){				
					$html .= '<input checked type="checkbox" id="' . $this->get_field_id('contact_options') .'-email" name="' . $this->get_field_name('contact_options[]') . '" value="email"/>';
				}else{
					$html .= '<input type="checkbox" id="' . $this->get_field_id('contact_options') .'-email" name="' . $this->get_field_name('contact_options[]') . '" value="email"/>';
				}
				$html .= '<label for="' . $this->get_field_id('contact_options') . '-email">Show Email</label>';		
			$html .= '</p>';
				
			//Address
			$html .= '<p>';
				if(is_array($contact_options) && in_array('address',$contact_options)){				
					$html .= '<input checked type="checkbox" id="' . $this->get_field_id('contact_options') .'-address" name="' . $this->get_field_name('contact_options[]') . '" value="address"/>';
				}else{
					$html .= '<input type="checkbox" id="' . $this->get_field_id('contact_options') .'-address" name="' . $this->get_field_name('contact_options[]') . '" value="address"/>';
				}
				$html .= '<label for="' . $this->get_field_id('contact_options') . '-address">Show Address</label>';		
			$html .= '</p>';
			
			//Opening Hours
			$html .= '<p>';
				if(is_array($contact_options) && in_array('hours',$contact_options)){				
					$html .= '<input checked type="checkbox" id="' . $this->get_field_id('contact_options') .'-hours" name="' . $this->get_field_name('contact_options[]') . '" value="hours"/>';
				}else{
					$html .= '<input type="checkbox" id="' . $this->get_field_id('contact_options') .'-hours" name="' . $this->get_field_name('contact_options[]') . '" value="hours"/>';
				}
				$html .= '<label for="' . $this->get_field_id('contact_options') . '-hours">Show Opening Hours</label>';		
			$html .= '</p>';
			
		$html .= '</p>';
		
		
		echo $html;
	}
	
	/**
	 * Save callback
	 */
	public function update($new_instance, $old_instance){
		
		$instance = array();
		
		$instance['title'] = isset($new_instance['title']) ? sanitize_text_field($new_instance['title']) : '';
		
		if(isset($new_instance['contact_options'])){
			$values = json_encode($new_instance['contact_options']);
		}else{
			$values = '';
		}
		$instance['contact_options'] = $values;
	
		
		return $instance;
		
	}
	
 }
 ?>