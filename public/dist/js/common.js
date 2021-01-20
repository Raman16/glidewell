
//alert(APP_URL);
function notify(message,status){
    
    if(status=='success')
    {
      
      $.notify(message,
        {
              align:"right",
              verticalAlign:"top",
              animationType:"drop",
              type:'success'
        });
    }
    if(status=='error'){
      $.notify(message,
        {
              align:"right",
              verticalAlign:"top",
              animationType:"drop",
              type:'danger'
        });
    }

}