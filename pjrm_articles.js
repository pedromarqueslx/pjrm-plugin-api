jQuery(document).ready(function($){

    $.post(ajaxurl, {

        action: 'pjrm_articles_refresh_results'

    }, function( response ) {

        console.log( 'AJAX complete' );

    });

});
