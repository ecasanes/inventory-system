<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
if (!function_exists('select_age_from'))
{
    function select_age_from(){
	
		$result = '';
		$n = 15;
		
		while($n < 99)
		{
			$result .= "<option value='{$n}'>{$n}</option>";
			$n++;
		}
		
		return $result;
	}
}


if (!function_exists('select_age_to'))
{
   function select_age_to(){

		
		$result = "<option value='99'>99</option>";

		$n = 0;
		
		while($n < 99)
		{
			$result .= "<option value='{$n}'>{$n}</option>";
			$n++;
		}
		
		return $result;
	}
}


//PLEASE ADD FUNCTION_EXIST AFTER
function image_thumbnail($image_path, $width, $height, $mandatory = false){

	$image = '<img src="'.$image_path.'" width="'.$width.'" height="'.$height.'" />';

	if($mandatory){
		if($image_path == ''){
			return $image;
		}else{
			return $image;
		}
	}else{
		if($image_path == ''){
			return '';
		}else{
			return $image;
		}
	}
}

function select_disability($default = ''){

	$result = '';
	$arrays = array(
		"disability_adhd" => "Attention-Deficit/Hyperactivity Disorders", 
		"disability_blindness" => "Blindness or Low Vision",
		"disability_brain_injuries" => "Brain Injuries",
		"disability_deaf" => "Deaf/Hard-of-Hearing",
		"disability_learning" => "Learning Disabilities",
		"disability_medical" => "Medical Disabilities",
		"disability_physical" => "Physical Disabilities",
		"disability_psychiatric" => "Psychiatric Disabilities",
		"disability_speech" => "Speech and Language Disabilities"
	);

	if($default == ""){
		$result .= "<option value=''>- SELECT DISABILITY -</option>";
	}else{
		$result .= "<option value='".$default."'>".$default."</option>";
	}

	foreach ($arrays as $key => $value)
	{
		$result .= "<option value='{$key}'>{$value}</option>";
	}
	
	return $result;

}


function select_award_status($default = ''){

	$result = '';
	$arrays = array(
		"awarded" => "awarded", 
		"" => "no award"
	);

	if($default == ""){
		$result .= "<option value=''>- SELECT AWARD STATUS -</option>";
	}else{
		$result .= "<option value='".$default."'>".$default."</option>";
	}

	foreach ($arrays as $key => $value)
	{
		$result .= "<option value='{$key}'>{$value}</option>";
	}
	
	return $result;

}




function select_role_simple($default_role = ''){

	if($default_role == 'admin'){
		$roles = array('admin', 'cashier');
	}else if($default_role == 'cashier'){
		$roles = array('cashier');
	}else{
		$roles = array('admin', 'cashier');
	}

	
	$result = "";

	if($default_role == ""){
		$result .= "<option value=''>- SELECT ROLE -</option>";
	}else{
		$result .= "<option value='".$default_role."'>".$default_role."</option>";
	}

	foreach($roles as $role){
		$result .= "<option value='".$role."'>".$role."</option>";
	}

	return $result;

}





function select_role($default_role = ''){

	if($default_role == 'superadmin'){
		$roles = array('user', 'admin', 'superadmin');
	}else if($default_role == 'admin'){
		$roles = array('user', 'admin');
	}else if($default_role == 'user'){
		$roles = array('user');
	}else{
		$roles = array('user', 'admin', 'superadmin');
	}

	
	$result = "";

	if($default_role == ""){
		$result .= "<option value=''>- SELECT ROLE -</option>";
	}else{
		$result .= "<option value='".$default_role."'>".$default_role."</option>";
	}

	foreach($roles as $role){
		$result .= "<option value='".$role."'>".$role."</option>";
	}

	return $result;

}


function markup_hidden($markup_uri){

	$CI =& get_instance();

	$result = $CI->has_permission(true, $markup_uri);

	return $result;

}


function verify_checkbox_active($value, $compare_string){

	$result = '';

	if($value == $compare_string){
		$result .= 'checked="checked"';
	}
	
	return $result;

}

function select_month($single_month = false, $month_start = 1){
	
	$monthOptions = '';
	
	//$month = $this->input->post('month');
	
	if($month_start == ''){
		$monthOptions .= "<option value=''>Month</option>";
	}else{
		if($single_month){
			$monthName = date("M", mktime(0, 0, 0, $month_start));
			$monthOptions .= "<option value=\"{$month_start}\">{$monthName}</option>\n";
		}else{
						
			for($month=$month_start; $month<=12; $month++){
				$monthName = date("M", mktime(0, 0, 0, $month));
				$monthOptions .= "<option value=\"{$month}\">{$monthName}</option>\n";
			}
		
		}
	}
	
						
	return $monthOptions;

}

function select_day(){

	$dayOptions = '';
	
	//$day = $this->input->post('day');
	
	/* if($day){
		$dayOptions .= "<option value=\"{$day}\">{$day}</option>\n";
	} */
						
	for($day=1; $day<=31; $day++){
		$dayOptions .= "<option value=\"{$day}\">{$day}</option>\n";
	}
						
	return $dayOptions;

}


function select_year(){

	$yearOptions = '';
	
	//$year = $this->input->post('year');
	
	/* if($year){
		$yearOptions .= "<option value=\"{$year}\">{$year}</option>\n";
	} */
						
	for($year=1950; $year<=2050; $year++){
		$yearOptions .= "<option value=\"{$year}\">{$year}</option>\n";
	}
						
	return $yearOptions;

}

function select_number($from, $to, $default = false){

	$result = '';

	if($default){
		$result .= "<option value='{$default}'>{$default}</option>";
	}

	$n = $from;
		
	while($n <= $to)
	{
		$result .= "<option value='{$n}'>{$n}</option>";
		$n++;
	}
		
	return $result;
}

function select_gender(){
	$result = '';
	$arrays = array("all", "male", "female");
	foreach ($arrays as $array)
	{
		$result .= "<option value='{$array}'>{$array}</option>";
	}
	
	return $result;
}

function select_status(){
	$result = '';
	$arrays = array("all", "single", "married", "widow", "separated");
	foreach ($arrays as $array)
	{
		$result .= "<option value='{$array}'>{$array}</option>";
	}
	
	return $result;
}

function select_occupation(){
	$result = '';
	$arrays = array("all", "self-employed", "un-employed", "employed");
	foreach ($arrays as $array)
	{
		$result .= "<option value='{$array}'>{$array}</option>";
	}
	
	return $result;
}

function select_property(){
	$result = '';
	$arrays = array("all", "totally damage", "partially damage", "n/a", "flooded");
	foreach ($arrays as $array)
	{
		$result .= "<option value='{$array}'>{$array}</option>";
	}
	
	return $result;
}

function select_limit($from = 0, $to = 100){
	$result = '';
	$n=$from;
	while($n < $to)
	{
		$result .= "<option value='{$n}'>{$n}</option>";
		$n++;
	}
	
	return $result;
}