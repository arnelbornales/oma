(function ($) {
  $(document).ready(function() {  
    
    // Social Media Hover Intent in Header
    function makeTall() {
      $('#social-icons').animate({width: 132}, 'fast');
    }
    
    function makeShort() {
      $('#social-icons').animate({width: 72}, 'fast');
    }
    
    var config = {    
         over: makeTall,
         timeout: 200,
         out: makeShort
    };
    
    $("#social-icons").hoverIntent( config );
    
    // Alternate Colors on Blog Feed
    
    $('.blog article:odd').addClass('odd');
    
    // Project Filter Modal
    
    $('#project-all-btn a').click(function() {      
      $('.project-modal').toggle('fast', function() {
        });
        return false;
    });
    
    var projectFilter = $('#projects-filter dd input');
    
    projectFilter.click(function() {
      
      var activeFilterItems = [];
      
      projectFilter.each(function(index){
        
        if($(this).attr("checked")){
          
          var filterVal = $(this).val();
          
          activeFilterItems.push(filterVal);
          
        };
        
      });
      
      console.info(activeFilterItems);
      
      
      $('ul#all-projects li').each(function(){
        
        var $li = $(this),
        
           shouldShow = false;
        
        $(activeFilterItems).each(function(){
          
          var filter = this;
        
          if($li.hasClass(filter)){
            
            shouldShow = true;
            
          }else{
            
            shouldShow = false;
            
            return false;
            
          }
          
        });
        
        if (activeFilterItems < 1) {
          $('ul#all-projects li').each(function(){
            shouldShow = true;
          });
        }
        
        if(shouldShow){
          
          $li.fadeIn('slow').removeClass('hidden');  
          
        }else{
          
          $li.fadeOut('normal').addClass('hidden'); 
           
        };
        
      });
        
    });
  });
})(jQuery);