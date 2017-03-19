/* FORMULAIRE PAGE INSCRIPTION */

$(document).ready(function() {
    
    $('Formumu').submit(function(event)
    {
         event.preventDefault();
        $(":required").each(function()
        {
            if( ($(this).val()=='') && !($(this).hasClass("error")))
            {
                $(this).removeClass("error");
                $(this).next('.error').remove();
            }
            if( ($(this).val()=='') && !($(this).hasClass("error")))
            {
                $(this).after('Remplir le champ manquant!');
                $(this).addClass("error");
            }
        });
     });
});