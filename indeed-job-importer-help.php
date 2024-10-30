<?php
/*
***************************************************
**********# Name  : Shambhu Prasad Patnaik #*******
***************************************************
*/

if (!function_exists('indeed_job_importer_help')):
function indeed_job_importer_help()
{
 echo'<link rel="stylesheet" type="text/css" href="'.plugins_url('stylesheet.css', __FILE__).'">';

 echo '<div class="wrap">';
	 ?>
   <div>
	 
   <p class="intro">Indeed Job Importer Plugin Import job from indeed according to your given parameter.</p>
	 
	 <ol id="ul_indeed_help">
	  <li><h3 class="indeed_heading">Install Indeed Job Importer WordPress Plugin</h3>
	  <ul class="indeed_help_square">
	   <li>Upload the Indeed Job Importer WordPress Plugin folder to the /wp-content/plugins/ directory</li>
	   <li>Activate the Indeed Job Importer WordPress Plugin through the 'Plugins' menu in WordPress</li>
	   <li>Go <b>Indeed Importer</b> in admin menu and add new importer search parameter click save button</li>
	   <li>In importer list click <b>Featch Now</b> link.</li>
	  </ul>
	 </li>
	 <li><h3 class="indeed_heading">Plugin Help File</h3>
	 After installing Indeed Job Importer WordPress Plugin, click on - <b>Add New</b>. The products are imported from Indeed Database to WordPress Blog.
	  <ul class="indeed_help_lower-alpha">
	   <li><h4 class="indeed_heading1">Indeed Job Importer Settings</h4>
	    <ul>
	     <li>
	      <ul class="indeed_help_square">
		   <li><strong>Campaign Name</strong><br>Run multiple campaigns like &ldquo;PHP&rdquo;,&ldquo;IT&ldquo; etc with multiple Indeed Accounts and fetch products from Indeed.this is only for differnciate importer.</li>
		   <li><strong>Publisher  Id</strong><br>Enter your Publisher  ID for Indeed, Your Publisher ID from indeed.Don't you have such a key- <a href="https://ads.indeed.com/jobroll/" target="_balnk">Request one here</a>.</li>
		   <li><strong>Keyword<br></strong>Import this keyword base</li>
		   <li><strong>Country<br></strong>Import this County jobs</li>
		   <li><strong>Location<br></strong>Import this Location jobs</li>
		   <li><strong>Max Items to Import<br></strong>Maximum value is 20; we recommend that you set the Max Item Import parameter to 10</li>
		   <li><strong>Feed Status<br></strong>The products will be auto fetched if the feed status is active</li>
		  </ul>
         </li>
	    </ul>
	   </li>
	   <li>
	    <h4 class="indeed_heading1">WordPress Settings</h4>
	    <ul>
	     <li>
		  <ul class="indeed_help_square">
		   <li><strong>New Post Status </strong><br>The products can be directly published in the blog or stored in draft section for approval at a later stage</li>
		   <li><strong>Category Name</strong><br>List of Categories from WordPress Blog. The Indeed job imported from above settings will be inserted in that category</li>
		   <li><strong>Run Every</strong><br>Built in cron feature that automatically fetches products from Indeed site that can be set to run after specific periods like day, week etc<br></li>
		   <li><strong>Display Template</strong><br>List of fields that will be displayed in the product description page like job_company job_city, job_description etc.</li>
		  </ul>
	  	 </li>
	    </ul>
	   </li>
	  </ul>
	 </li>
	</ol>
   </div>
   <?php
echo'
 <div>
   <h3 class="indeed_heading"><a id="template_macro"></a></a>Display Template Macro</h3>
 <table border="0" width="97%" cellspacing="1" cellpadding="2" class="middle_table1">
   <tr>
     <td valign="top">
       <table border="0" width="100%" cellspacing="1" cellpadding="4" class="middle_table2">
        <tr class="dataTableHeadingRow">
         <td class="dataTableHeadingContent"  align="center">Name</td>
         <td class="dataTableHeadingContent"   align="center">Description</td>
        </tr>
        <tr class="dataTableRow1">
         <td class="dataTableContent" valign="top">{job_company}</td>
         <td class="dataTableContent"  valign="top">Job source company name display.</td>
        </tr>
        <tr class="dataTableRow2">
         <td class="dataTableContent"  valign="top">{job_description}</td>
         <td class="dataTableContent"  valign="top" >Job description display.</td>
        </tr>
        <tr class="dataTableRow1">
         <td class="dataTableContent"  valign="top">{job_city}</td>
         <td class="dataTableContent"  valign="top">Job city name display</td>
        </tr>
        <tr class="dataTableRow2">
         <td class="dataTableContent"  valign="top">{job_location}</td>
         <td class="dataTableContent"  valign="top">Job location display like Austin,TX (formated location from indeed rss provied) </td>
        </tr>
        <tr class="dataTableRow1">
         <td class="dataTableContent"  valign="top">{job_location_full}</td>
         <td class="dataTableContent"  valign="top">Job full location display like Austin,TX (formated location from indeed rss provied) </td>
        </tr>
         <tr class="dataTableRow2">
         <td class="dataTableContent"  valign="top">{job_country}</td>
         <td class="dataTableContent"  valign="top">Job county name display.</td>
        </tr>
        <tr class="dataTableRow1">
         <td class="dataTableContent"  valign="top">{job_detail_url}</td>
         <td class="dataTableContent"  valign="top">Job detail url from indeed like <i>http://www.indeed.co.in</i> </td>
        </tr>
        <tr class="dataTableRow2">
         <td class="dataTableContent"  valign="top">{job_detail_url_link}</td>
         <td class="dataTableContent"  valign="top">Job detail url with link from indeed like <a href="http://www.indeed.co.in" target="_blank">http://www.indeed.co.in</a></td>
        </tr>
        <tr class="dataTableRow1">
         <td class="dataTableContent"  valign="top">{job_detail_url_more_link}</td>
         <td class="dataTableContent"  valign="top">Job detail url link from indeed like <a href="http://www.indeed.co.in" target="_blank">More >></a></td>
        </tr>
		<tr class="dataTableRow2">
         <td class="dataTableContent"  valign="top">{job_detail_more_link_onmousedown}</td>
         <td class="dataTableContent"  valign="top">Job detail url link from indeed like  with  onmousedown indeed traker <a href="http://www.indeed.co.in" target="_blank">More >></a></td>
        </tr>
        <tr class="dataTableRow1">
         <td class="dataTableContent"  valign="top">{job_detail_bitly_url}</td>
         <td class="dataTableContent"  valign="top">Job detail bitly short url like  <i>http://bit.ly/1ldR48K</i></td>
        </tr>			
       </table>
      </td>
     </tr>
    </table>';?>
	<br>
	<div>More Detail - <a href="http://socialcms.wordpress.com/" target="_blank">http://socialcms.wordpress.com</a></div>
	<div>In case of any clarifications, pl. contact us at - <a href="http://profiles.wordpress.org/shambhu-patnaik/" target="_blank">http://profiles.wordpress.org/shambhu-patnaik/</a></div>
	<br>
	<div><b>Thanks a Lot</b></div>
	<br>
	<br>
    <div align="center">********************</div>
</div>
<?php
}
endif;
?>