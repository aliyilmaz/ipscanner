$(function(){

    window.setInterval(function(){
        isconnection();
    }, 500);
    function isconnection(){
        if (navigator.onLine === true) {
            var message = 'You have internet connection!';
        } else {
            var message = 'No internet connection!';
        }
        $('strong#status').html('').append(message);
        return status;
    }
    
    $('button#ipscanner').on('click', function(){
        send($(this).attr('id'));
    });

    function send(type){
        formdata = '';
        response = '';
        
        formdata = $('form#'+type).serialize();   
        $.ajax({ 
            type:'POST',  
            url:'class.php',  
            data:formdata,
            beforeSend: function() {
              $('div#response').html('').append('Scanning...');
            }, 
            success:function(response){ 
               $('div#response').html('').append('REQUEST: <br><code>'+formdata+'</code><br><br>RESPONSE: <br><code>'+response+'</code>');
            }
        });
        
    }

});
