

   // ClassicEditor
      //  .create( document.querySelector( '#body' ) )
        //.catch( error => {
         //   console.error( error );
        //} );


$(document).ready(function(){
    
    $('#selectAllBoxes').click(function(event){
        
        if(this.checked){
            $('.checkBoxes'). each(function(){
                
                this.checked= true;
            });
        }
        else{
            $('.checkBoxes'). each(function(){
                
                this.checked= false;
            });
            
            
            
        }
    
    });// script for bulk option operation  
     
    
    var div_box = "<div id='load-screen'><div id='loading'></div></div>"; //check style.css for id

    $("body").prepend(div_box);

     $('#load-screen').delay(200).fadeOut(100, function(){
    $(this).remove();
     }); //scripts for loader

    
    
    
});

function loadUsersOnline() {


        $.get("functions.php?onlineusers=result", function(data){

            $(".usersonline").text(data);


        });

    }


    setInterval(function(){

        loadUsersOnline();


    },500);










    
