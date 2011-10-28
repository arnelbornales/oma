<?php
    
function tab_style_1_css(){
?>    
<?php
}

function tab_style_1_js(){
?>
<script type="text/javascript">

jQuery(document).ready(function() {

    //Default Action
    jQuery(".tab_content").hide(); //Hide all content
    jQuery("ul.tabs li:first").addClass("active").show(); //Activate first tab
    jQuery(".tab_content:first").show(); //Show first tab content
    
    //On Click Event
    jQuery("ul.tabs li").click(function() {
        jQuery("ul.tabs li").removeClass("active"); //Remove any "active" class
        jQuery(this).addClass("active"); //Add "active" class to selected tab
        jQuery(".tab_content").hide(); //Hide all tab content
        var activeTab = jQuery(this).find("a").attr("href"); //Find the rel attribute value to identify the active tab + content
        jQuery(activeTab).fadeIn(); //Fade in the active content
        return false;
    });

});
</script>
<?php
}

function tab_style_1_html($tabs, $group_id){
    $html = '<div class="container">    
    <ul class="tabs">        
';

  foreach($tabs as $tab){
      $thtml .= '<li><a href="#tab'.$group_id.'_'.$tab['id'].'">'.stripcslashes($tab['tab_title']).'</a></li>';
      $chtml .= '<div id="tab'.$group_id.'_'.$tab['id'].'" class="tab_content">'.stripcslashes($tab['tab_content']).'</div>';
  }
  
  $html .= $thtml . '</ul><div class="tab_container">'. $chtml . '</div></div>';
 
 return $html;

}
