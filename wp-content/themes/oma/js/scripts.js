(function ($) {
  $(document).ready(function() {  
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
      
      
      $('ul#projects li').each(function(){
        
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
          $('ul#projects li').each(function(){
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