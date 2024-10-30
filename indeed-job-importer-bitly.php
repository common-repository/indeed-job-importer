<?php
/*
***************************************************
**********# Name  : Shambhu Prasad Patnaik #*******
***************************************************
*/
if (!function_exists('indeed_job_importer_bitlu_shorten')):
function indeed_job_importer_bitlu_shorten($long_url)
{
 $bitly_url='';
 $data = json_decode(get_option('indeed_importer_option'));
 $oauth_token  = $data->oauth_token;
 $bitly_domain  = $data->bitly_domain;
 if($oauth_token=='')
 return $bitly_url;

 if (function_exists('curl_init') )
 {
  $ch = curl_init();
  $url='https://api-ssl.bitly.com/v3/shorten?access_token='.urlencode($oauth_token).'&longUrl='.urlencode($long_url).'&domain='.urlencode($bitly_domain);
  curl_setopt($ch, CURLOPT_USERAGENT,(isset( $_SERVER['HTTP_USER_AGENT'] ) ? $_SERVER['HTTP_USER_AGENT'] : "Mozilla/5.0 (compatible; Konqueror/4.0; Microsoft Windows) KHTML/4.0.80 (like Gecko)"));
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_URL,$url);
  curl_setopt($ch, CURLOPT_TIMEOUT, 20);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  $data = curl_exec($ch);
  $error = curl_error($ch);
  $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  curl_close($ch);
  if($data && $error=='' && $http_code==200)
  {
   $r=json_decode($data,true);
   $bitly_url=$r['data']['url'];
  }
 }
 return $bitly_url;
}
endif;

if (!function_exists('indeed_job_importer_bitly')):
function indeed_job_importer_bitly()
{
 $action ='';
 if(isset($_GET['action']))
 $action = wp_filter_nohtml_kses($_GET['action']);
 $error_message='';
 $error=false;			

 if ($action!="") 
 {
  switch ($action) 
  {
   case 'save':
    update_option('indeed_job_importer_message','Successfully Update');
    $oauth_token = stripslashes_deep($_POST['oauth_token']);
    $bitly_domain = stripslashes_deep($_POST['bitly_domain']);

    $data =array('oauth_token' => $oauth_token,'bitly_domain' =>$bitly_domain);
    $data=json_encode($data);
    update_option('indeed_importer_option',$data); 
    echo "<meta http-equiv='refresh' content='0;url=".admin_url('admin.php?page=indeed_job_importer_bitly')."' />"; 
    die();
    break;
  }
 }
 $data = json_decode(get_option('indeed_importer_option'));
 //print_r($data);die();
 $oauth_token  = $data->oauth_token;
 $bitly_domain  = $data->bitly_domain;

 $domain_bitly_array=array();
 $domain_bitly_array[]=array('id'=>'bit.ly','text'=>'bit.ly');
 $domain_bitly_array[]=array('id'=>'bitly.com','text'=>'bitly.com');
 $domain_bitly_array[]=array('id'=>'j.mp','text'=>'j.mp');

 echo'<link rel="stylesheet" type="text/css" href="'.plugins_url('stylesheet.css', __FILE__).'">';

if($indeed_job_importer_message = get_option('indeed_job_importer_message'))
 {
  echo' <div class="updated"><p>'.$indeed_job_importer_message.'</p></div>';
  update_option('indeed_job_importer_message','');
 }
 echo '<div class="wrap">
       <div><h2>Bitly Short URL Setting</h2></div>';
	 ?>
     <?php
   $form_action=admin_url('admin.php?page=indeed_job_importer_bitly&action=save');
   $form_button='<input type="submit"  class="button button-primary"" value="Save">';

echo'<div>
      <table border="0" cellspacing="3" cellpadding="2" width="80%" >
	   <tr><form method="post" action="'.$form_action.'" onsubmit="return importerValidateForm(this)">
        <td width="135" >OAuth Token</td>
        <td colspan="2"><input name="oauth_token" type="text" value="'.$oauth_token.'" class="indeedImporterInput"><br> <span style="color:#444444;font-size:11px;">Your OAuth Token from bitly. Don\'t you have such a key? <a href="https://bitly.com/a/wordpress_oauth_app" target="_blank" class="blue"><u>Request one here</u></a>.</span></td>
       </tr>
       <tr>
        <td valign="top"><nobr>Domain</nobr></td>
        <td valign="top" colspan="2">'.indeed_job_importer_draw_pull_down_menu('bitly_domain', $domain_bitly_array, $bitly_domain,'').'</td>
       </tr>   
       <tr>
        <td>'.$form_button.'</td>
       </tr></form>
      </table>
	 </div>
	</div>';
 ?>
<?php
}
endif;
?>