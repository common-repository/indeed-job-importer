<?php
if (!function_exists('indeed_job_importer_formate_date')):
function indeed_job_importer_formate_date($raw_date,$format='%d %b %Y  %I:%M %p')
{
 if ( ($raw_date == '0000-00-00 00:00:00') || ($raw_date == '') ) 
  return false;
 $year = (int)substr($raw_date, 0, 4);
 $month = (int)substr($raw_date, 5, 2);
 $day = (int)substr($raw_date, 8, 2);
 $hour = (int)substr($raw_date, 11, 2);
 $minute = (int)substr($raw_date, 14, 2);
 $second = (int)substr($raw_date, 17, 2);
 return strftime($format, mktime($hour,$minute,$second,$month,$day,$year));
}
endif;
///////////
if (!function_exists('indeed_job_importer_draw_pull_down_menu')):
function indeed_job_importer_draw_pull_down_menu($name, $values, $default = '', $parameters = '', $required = false) 
{
 $field = '<select name="' . htmlspecialchars($name) . '"';
 if ($parameters!='') 
  $field .= ' ' . $parameters;
 $field .= '>';
 for ($i=0, $n=sizeof($values); $i<$n; $i++) 
 {
  $field .= '<option value="' . htmlspecialchars($values[$i]['id']) . '"';
  if(is_array($default))
  {
   if(in_array($values[$i]['id'],$default))
   {
    $field .= ' SELECTED';
   }
  }
  else
  {
   if($default==$values[$i]['id'])
   {
    $field .= ' SELECTED';
   }
  }
  $field .= '>' . htmlspecialchars($values[$i]['text'],ENT_QUOTES) . '</option>';
 }
 $field .= '</select>';
 if ($required == true) $field .= '&nbsp;<span class="inputRequirement">*</span>';;
  return $field;
}
endif;
/////////////
if (!function_exists('indeed_job_importer_job_type_drop_down')):
function indeed_job_importer_job_type_drop_down($name='job_type',$parameters='',$selected="",$header="",$header_value="")
{
 $required_list = array();
 if($header!='')
 $required_list[0] =array('id'=>$header_value,'text'=>$header);
 $required_list[] =array('id'=>'contract','text'=>'Contract');
 $required_list[] =array('id'=>'fulltime','text'=>'Full-time');
 $required_list[] =array('id'=>'parttime','text'=>'Part-time');
 $required_list[] =array('id'=>'internship','text'=>'Internship');
 $required_list[] =array('id'=>'temporary','text'=>'Temporary');
 return indeed_job_importer_draw_pull_down_menu($name, $required_list, $selected,$parameters);
}
endif;
///////////
if (!function_exists('indeed_job_importer_country_drop_down')):
function indeed_job_importer_country_drop_down($name='country',$parameters='',$selected="",$header="",$header_value="")
{
 $country_list = array();
 if($header!='')
 $country_list[0] =array('id'=>$header_value,'text'=>$header);
 $country_list1 =indeed_job_importer_country_list();
 $country_list=array_merge($country_list,$country_list1);
 return indeed_job_importer_draw_pull_down_menu($name, $country_list, $selected,$parameters);
}
endif;
////////
if (!function_exists('indeed_job_importer_country_list')):
function indeed_job_importer_country_list()
{
 $country_list = array();
 $country_list[]=array('id'=>'us','text'=>'United States');
 $country_list[]=array('id'=>'au','text'=>'Australia');
 $country_list[]=array('id'=>'at','text'=>'Austria');
 $country_list[]=array('id'=>'bh','text'=>'Bahrain');
 $country_list[]=array('id'=>'be','text'=>'Belgium');
 $country_list[]=array('id'=>'br','text'=>'Brazil');
 $country_list[]=array('id'=>'ca','text'=>'Canada');
 $country_list[]=array('id'=>'cl','text'=>'Chile');
 $country_list[]=array('id'=>'dk','text'=>'Denmark');
 $country_list[]=array('id'=>'fr','text'=>'France');
 $country_list[]=array('id'=>'de','text'=>'Germany');
 $country_list[]=array('id'=>'hk','text'=>'Hong Kong');
 $country_list[]=array('id'=>'in','text'=>'India');
 $country_list[]=array('id'=>'ie','text'=>'Ireland');
 $country_list[]=array('id'=>'it','text'=>'Italy');
 $country_list[]=array('id'=>'my','text'=>'Malaysia');
 $country_list[]=array('id'=>'mx','text'=>'Mexico');
 $country_list[]=array('id'=>'nl','text'=>'Netherlands');
 $country_list[]=array('id'=>'nz','text'=>'New Zealand');
 $country_list[]=array('id'=>'pk','text'=>'Pakistan');
 $country_list[]=array('id'=>'pt','text'=>'Portugal');
 $country_list[]=array('id'=>'qa','text'=>'Qatar');
 $country_list[]=array('id'=>'ro','text'=>'Romania');
 $country_list[]=array('id'=>'sa','text'=>'Saudi Arabia');
 $country_list[]=array('id'=>'sg','text'=>'Singapore');
 $country_list[]=array('id'=>'za','text'=>'South Africa');
 $country_list[]=array('id'=>'es','text'=>'Spain');
 $country_list[]=array('id'=>'se','text'=>'Sweden');
 $country_list[]=array('id'=>'ch','text'=>'Switzerland');
 $country_list[]=array('id'=>'ae','text'=>'United Arab Emirates');
 $country_list[]=array('id'=>'gb','text'=>'United Kingdom');
 return $country_list;
}
endif;
/////////////////
if (!function_exists('indeed_job_importer_get_category_list')) :
function indeed_job_importer_get_category_list($parent=0,$level=0)
{
 $args = array(
	'type'                     => 'post',
	'child_of'                 => 0,
	'parent'                   => $parent,
	'orderby'                  => 'name',
	'order'                    => 'ASC',
	'hide_empty'               => 0,
	'hierarchical'             => 1,
	'exclude'                  => '',
	'include'                  => '',
	'number'                   => '',
	'taxonomy'                 => 'category',
	'pad_counts'               => false );
 $list_set =array();
 $categories = get_categories( $args );
 foreach($categories as $category)
 {
  $list_set[]=array('id'=>$category->term_id,'text'=>$category->name,'level'=>$level);
  $list= indeed_job_importer_get_category_list( $category->term_id ,($level+1));
  if(is_array($list) && count($list)>0)
  $list_set =array_merge($list_set,$list);
 }
 return $list_set;
}
endif;
///////////
if (!function_exists('indeed_job_importer_get_category_drop_down')):
function indeed_job_importer_get_category_drop_down($name='category',$parameters='',$selected="",$header="",$header_value="",$hierarchical=true)
{
 $cat_list =array();
 if($header!='')
 $cat_list[0] =array('id'=>$header_value,'text'=>$header);
 $cat_list= array_merge($cat_list,indeed_job_importer_get_category_list());
 if($hierarchical)
 foreach($cat_list as $key =>$value)
 {
  $cat_list[$key]['text_pad'] = str_repeat(' - ',$value['level']);
 }
 return indeed_job_importer_draw_pull_down_menu($name, $cat_list, $selected,$parameters);
}
endif;
////////
if (!function_exists('indeed_job_importer_next_runtime')):
function indeed_job_importer_next_runtime($occurrence,$occurrence_type,$start_date)
{
 $end_date   = current_time('mysql');
 $occurrence = (int) $occurrence;
 $year    = substr($start_date,0,4);
 $month   = substr($start_date,5,2);
 $day     = substr($start_date,8,2);
 $hour    = substr($start_date,11,2);
 $minutes = substr($start_date,14,2);
 $seconds = substr($start_date,17,2);
 if(!checkdate ( (int)$month, (int) $day, (int) $year))
 $start_date ='0000-00-00 00:00:00';
 switch($occurrence_type)
 {
  case "hour":
   if($start_date=="" ||$start_date=='0000-00-00 00:00:00')
    $end_date=date("Y-m-d H:i:s",mktime(date('H')+$occurrence,date('i'),date('s'),date('m'),date('d'),date('Y')));
   else
    $end_date=date("Y-m-d H:i:s",mktime($hour+$occurrence,$minutes,$seconds,$month,$day,$year));
   break;
  case "day":
   if($start_date=="" ||$start_date=='0000-00-00 00:00:00')
    $end_date=date("Y-m-d H:i:s",mktime(date('H'),date('i'),date('s'),date('m'),date('d')+$occurrence,date('Y')));
   else
    $end_date=date("Y-m-d H:i:s",mktime($hour,$minutes,$seconds,$month,$day+$occurrence,$year));
   break;
  case "week":
   if($start_date=="" ||$start_date=='0000-00-00 00:00:00')
    $end_date=date("Y-m-d H:i:s",mktime(date('H'),date('i'),date('s'),date('m'),date('d')+($occurrence*7),date('Y')));
   else
    $end_date=date("Y-m-d H:i:s",mktime($hour,$minutes,$seconds,$month,$day+($occurrence*7),$year));
   break;
 }
 return $end_date;
}
endif;
////////
if (!function_exists('indeed_job_importer_feed_import')):
function indeed_job_importer_feed_import($feed_ids='',$current_time='')
{
 global $wpdb;
 $indeed_job_importer_dbtable = $wpdb->base_prefix . "indeed_job_importer";	
 $add_whereClause='';

 if($feed_ids!='')
 $add_whereClause.=" and  y.feed_id in (".$feed_ids.") ";

 if($current_time!='')
 $add_whereClause.=" and  y.next_activate <= '".esc_sql($current_time)."'";
 
 $query = "select y.* from ".$indeed_job_importer_dbtable."  as y  where y.status='active' $add_whereClause   order by y.feed_id";
 $records = $wpdb->get_results($query,'ARRAY_A');
 foreach ($records as $row)
 {
  $blog_id          = wp_filter_nohtml_kses($row['blog_id']);
  $switch = false;
  if (function_exists('is_multisite') && is_multisite())
  {
   if ( get_current_blog_id() != $blog_id ) {
    $switch = true;
    switch_to_blog( $blog_id );
   }
  }
  $publisher_id     = wp_filter_nohtml_kses($row['publisher_id']);
  $feed_keyword     = wp_filter_nohtml_kses($row['feed_keyword']);
  $feed_country     = wp_filter_nohtml_kses($row['feed_country']);
  $feed_location    = wp_filter_nohtml_kses($row['feed_location']);
  $feed_job_type    = wp_filter_nohtml_kses($row['feed_job_type']);
  $max_feed         = wp_filter_nohtml_kses($row['max_feed']);
  $wp_category      = wp_filter_nohtml_kses($row['wp_category']);
  $occurrence       = wp_filter_nohtml_kses($row['occurrence']);
  $occurrence_type  = wp_filter_nohtml_kses($row['occurrence_type']);
  $publish_status   = wp_filter_nohtml_kses($row['publish_status']);
  $display_template = stripslashes($row['template_format']);
  $feed_id          = wp_filter_nohtml_kses($row['feed_id']);
  $import_items     = wp_filter_nohtml_kses($row['import_items']);
  $import_count     = 0;
  $data             = json_decode($row['other_parameter']);
  $channel          = wp_filter_nohtml_kses($data->channel);
  $page=1;
  if($import_items>0)
  {
   $page= floor($import_items / 10);
   if($page==0)
   $page=1;
  }
  $max_item1 = $max_feed;
  if($max_feed < 5)
  $max_item1=5; 

  $api_url         = 'http://api.indeed.com/ads/apisearch?publisher='.urlencode($publisher_id).'&q='.urlencode($feed_keyword).'&l='.urlencode($feed_location).'&sort='.urlencode($sort_by).'&radius=&st=&jt='.urlencode($feed_job_type).'&start=&limit='.urlencode($max_item1).'&fromage=%20&filter=&latlong=&co='.urlencode($feed_country).'&&userip='.indeed_job_importer_user_ip_address().'&v=2&useragent='.urlencode(isset( $_SERVER['HTTP_USER_AGENT'] ) ? $_SERVER['HTTP_USER_AGENT'] : "Mozilla/5.0 (compatible; Konqueror/4.0; Microsoft Windows) KHTML/4.0.80 (like Gecko)").(($channel!='')?'&chnl='.urlencode($channel):'');
  $content         = indeed_job_importer_readFeeds($api_url);
  $bitly_data = json_decode(get_option('indeed_importer_option'));
  $bitly_token  = $bitly_data->oauth_token;
  $bitly_domain  = $bitly_data->bitly_domain;

  $total_records = count($content);
  if($total_records >0 && is_array($content))
  for($i=0;$i<$total_records && $import_count<$max_feed ;$i++)
  {
   $error          = false;
   $item_id        = wp_filter_nohtml_kses($content[$i]['id']);
   $item_title     = wp_filter_nohtml_kses($content[$i]['title']);
   $item_url       = wp_filter_nohtml_kses($content[$i]['url']);
   $item_description = stripslashes($content[$i]['description']);
   $item_city      = wp_filter_nohtml_kses($content[$i]['city']);
   $item_state     = wp_filter_nohtml_kses($content[$i]['state']);
   $item_country   = wp_filter_nohtml_kses($content[$i]['country']);
   $item_f_location= wp_filter_nohtml_kses($content[$i]['formatted_loc']);
   $item_f_location_full = wp_filter_nohtml_kses($content[$i]['formatted_loc_full']);
   $item_company   = wp_filter_nohtml_kses($content[$i]['company']);
   $item_onmousedown = wp_filter_nohtml_kses($content[$i]['onmousedown']);
   if(strlen($item_title)<=0)
   {
    $error=true;
   }
   elseif($result1=$wpdb->get_var($wpdb->prepare("select post_title FROM $wpdb->posts  INNER JOIN $wpdb->postmeta ON ($wpdb->posts.ID = $wpdb->postmeta.post_id) WHERE    meta_key = '_indeed_jobkey' AND meta_value='%s'",$item_id)))
   {
    $error=true;
   }  
   if(!$error)
   {
    $sql_data_array=array();
    $sql_data_array=array(
                          'post_title'    => $item_title,
                          'post_content'  => $item_description,
                          'post_author'   => 1,
                          'post_status' => $publish_status,
                         );
    ////////////////////////////////////////////
   
    
    $template_format=$display_template;
    if($template_format!='')
    {
	 $template_format = nl2br($template_format);
     
     
     if($item_company!='')
      $template_format = str_replace("{job_company}",'<span class="feed_company">'.$item_company.'</span>' ,$template_format);
     else
      $template_format = str_replace("{job_company}",'' ,$template_format);

     if($item_city!='')
      $template_format = str_replace("{job_city}",'<span class="feed_city">'.$item_city.'</span>' ,$template_format);
     else
      $template_format = str_replace("{job_city}",'' ,$template_format);

     if($item_state!='')
      $template_format = str_replace("{job_state}",'<span class="feed_state">'.$item_state.'</span>' ,$template_format);
     else
      $template_format = str_replace("{job_state}",'' ,$template_format);

	 if($item_country!='')
      $template_format = str_replace("{job_country}",'<span class="feed_state">'.$item_country.'</span>' ,$template_format);
     else
      $template_format = str_replace("{job_country}",'' ,$template_format);

	 if($item_f_location!='')
      $template_format = str_replace("{job_location}",'<span class="feed_state">'.$item_f_location.'</span>' ,$template_format);
     else
      $template_format = str_replace("{job_location}",'' ,$template_format);

	 if($item_f_location_full!='')
      $template_format = str_replace("{job_location_full}",'<span class="feed_state">'.$item_f_location_full.'</span>' ,$template_format);
     else
      $template_format = str_replace("{job_location_full}",'' ,$template_format);

	 $template_format = str_replace("{job_description}",$item_description ,$template_format);

     if($item_url!='')
     {
      $template_format = str_replace("{job_detail_url}",$item_url ,$template_format); 
      $template_format = str_replace("{job_detail_link}","<span class='feed_url_link'><a href='".$item_url."' target='_blank'>".$item_url."</a></span>" ,$template_format); 
      $template_format = str_replace("{job_detail_more_link}","<span class='feed_url'><a href='".$item_url."' target='_blank'>More >></a></span>" ,$template_format); 
	  if($item_onmousedown !='')
      $template_format = str_replace("{job_detail_more_link_onmousedown}","<span class='feed_url'><a onmousedown=\"".$item_onmousedown."\" href='".$item_url."' target='_blank'>More >></a></span>" ,$template_format); 
      else
      $template_format = str_replace("{job_detail_more_link_onmousedown}","<span class='feed_url'><a  href='".$item_url."' target='_blank'>More >></a></span>" ,$template_format); 
		  
	  if($bitly_token!='')
	  {
       if( preg_match( '/\{job_detail_bitly_url\}/', $display_template))
	   {
        $bitly_url= indeed_job_importer_bitlu_shorten($item_url);
        if($bitly_url!='')
        $template_format = str_replace("{job_detail_bitly_url}",$bitly_url,$template_format); 
        $template_format = str_replace("{job_detail_bitly_url}",$item_url,$template_format); 
	   }
	  }
     }	 
    }
    else
    $template_format =$item_description;
    //echo $template_format ;die();
    $sql_data_array['post_content'] = $template_format;
    ///////////////////////////////////////////
    $now=current_time('mysql');
    $sql_data_array['post_date']=$now;
    $sql_data_array['post_date_gmt']=current_time('mysql',1);
    if($post_ID = wp_insert_post($sql_data_array))
    {
	 wp_set_post_terms( $post_ID, $wp_category, 'category');
     update_post_meta($post_ID,'source','indeed');	
 	 update_post_meta($post_ID,'_indeed_jobkey',$item_id);	
     if($item_city!='')
     update_post_meta($post_ID,'job_city',$item_city);	
	 $import_count=$import_count+1;
     $import_items=$import_items+1;
    }
   }
  }
  $next_activate = indeed_job_importer_next_runtime($occurrence,$occurrence_type,current_time('mysql'));
  $query="update ".$indeed_job_importer_dbtable." set  last_import='".$import_count."',import_items='".$import_items."',last_active='".current_time('mysql')."',next_activate='".$next_activate."'  where feed_id='".$feed_id."'"; 
  $results = $wpdb->query($query);
  if($switch)
  restore_current_blog();
 }
}
endif;
///////
if (!function_exists('indeed_job_importer_readFeeds')):
function indeed_job_importer_readFeeds($url)
{
 $indeed_content=array();
 if (function_exists('curl_init') )
 {
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_USERAGENT, (isset( $_SERVER['HTTP_USER_AGENT'] ) ? $_SERVER['HTTP_USER_AGENT'] : "Mozilla/5.0 (compatible; Konqueror/4.0; Microsoft Windows) KHTML/4.0.80 (like Gecko)"));
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_URL,$url);
  curl_setopt($ch, CURLOPT_TIMEOUT, 60);
  $data = curl_exec($ch);
  curl_close($ch);
  if($data)
  {
   $parsed_xml = simplexml_load_string($data);
   $i=0;
   if($parsed_xml->results->result)
   foreach($parsed_xml->results->result as $current)
   {
     $jobkey    =  wp_filter_nohtml_kses($current->jobkey); 
     $jobtitle  =  wp_filter_nohtml_kses($current->jobtitle); 
     $company   =  wp_filter_nohtml_kses($current->company); 
     $city      =  wp_filter_nohtml_kses($current->city); 
     $state     =  wp_filter_nohtml_kses($current->state); 
     $country   =  wp_filter_nohtml_kses($current->country); 
     $description =  wp_filter_nohtml_kses($current->snippet); 
     $url       =  wp_filter_nohtml_kses($current->url); 
     $formatted_loc =  wp_filter_nohtml_kses($current->formattedLocation); 
     $formatted_loc_full =  wp_filter_nohtml_kses($current->formattedLocationFull); 
     $onmousedown   =  wp_filter_nohtml_kses($current->onmousedown); 

     $indeed_content[$i]=array(
                        'id'          => $jobkey,
                        'title'       => $jobtitle,
                        'company'     => $company,
                        'city'        => $city,
                        'state'       => $state,
                        'country'     => $country,
                        'description' => $description,
                        'formatted_loc'=> $formatted_loc,
                        'formatted_loc_full'=> $formatted_loc_full,
                        'url'          => $url,
                        'onmousedown'  => $onmousedown,
                       );
     $i++;
    }
   }
  }
 return $indeed_content;
}
endif;
if (!function_exists('indeed_job_importer_user_ip_address')):
function indeed_job_importer_user_ip_address() 
{
 if (isset($_SERVER)) 
 {
  if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) 
  {
   $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
  } 
  elseif (isset($_SERVER['HTTP_CLIENT_IP'])) 
  {
   $ip = $_SERVER['HTTP_CLIENT_IP'];
  } 
  else 
  {
   $ip = $_SERVER['REMOTE_ADDR'];
  }
 } 
 else 
 {
  if (getenv('HTTP_X_FORWARDED_FOR')) 
  {
   $ip = getenv('HTTP_X_FORWARDED_FOR');
  } 
  elseif (getenv('HTTP_CLIENT_IP')) 
  {
   $ip = getenv('HTTP_CLIENT_IP');
  } 
  else 
  {
   $ip = getenv('REMOTE_ADDR');
  }
 }
 return $ip;
}
endif;
?>