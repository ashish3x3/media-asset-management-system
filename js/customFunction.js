$('#parentView').on("click", "table tbody td:not(td:.button-column)", function(event){
 
    try{
        /*Extract the Primary Key from the CGridView's clicked row.
        "this" is the CGridView's clicked column or <td>.
        Go up one parent - which gives you the row.
        Go down to child(1) - which gives you the first column,
            containing the row's PK. */
        var gridRowPK = $(this).parent().children(':nth-child(1)').text();
 
        /*Display the loading.gif file via jquery and CSS*/
        $("#loadingPic").addClass("loadGIF");
 
        /* Call the Ajax function to update the Child CGridView via the
        controller’s actionAdmin.*/
 
        var request = $.ajax({ 
          url: array('role/admin'),
          type: "GET",
          cache: false,
          data: {parentID : gridRowPK},
          dataType: "html" 
        });
 
        /* Url Problems: 
        If you receive 404 errors about the request not finding the
        correct page or 'request failed' etc., then your url is 
        probably not getting formatted  correctly. (Use Firebug to see if the
        generated url contains both the controller and the action names.)
        However, this error sometimes results from code in a totally 
        different location.
 
        For example: I got this error when I had the following line in my 
        urlManager in the config/main.php file:
 
        '<controller:\w+>' =>'<controller>/admin', //if no action is 
        provided, use actionAdmin
 
        When the user clicks on my CHtml::link to go to my actionAdmin 
        for the first time, the above line caused CHtml::link to not 
        include the action's name in the url in the browser's address bar.
 
        This gave me a hint, than maybe, my url is not formatted correctly.*/
 
        request.done(function(response) { 
            try{
                /*since you are updating innerHTML, make sure the
                received data does not contain any javascript - 
                for security reasons*/
                if (response.indexOf('<script') == -1){
                    /*update the view with the data received 
                    from the server*/       
            document.getElementById('childView').innerHTML = response;
                }
                else {
                    throw new Error('Invalid Javascript in 
                    Response - possible hacking!');
                }
            }
            catch (ex){
                alert(ex.message); /*** Send this to the server 
                for logging when in production ***/
            }
            finally{
                /*Remove the loading.gif file via jquery and CSS*/
                $("#loadingPic").removeClass("loadGIF");
 
                /*clear the ajax object after use*/
                request = null;
            }
        });
 
        request.fail(function(jqXHR, textStatus) {
            try{
                throw new Error('Request failed: ' + textStatus );
            }
            catch (ex){
                alert(ex.message); /*** Send this to the server 
                for logging when in production ***/
            }
            finally{
                /*Remove the loading.gif file via jquery and CSS*/
                $("#loadingPic").removeClass("loadGIF");
 
                /*clear the ajax object after use*/
                request = null;
            }
        });
    }
    catch (ex){
        alert(ex.message); /*** Send this to the server for logging when 
        in production ***/
    }
});