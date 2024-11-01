/*
 * javascript used in the admin layout menu
 */
jQuery(document).ready(function($) {

    'use strict';

    /*
     * position all the players in the proper positions based on the hidden
     * input field available in the DOM
     */
    $("#daextsfve-field-player-1").css("left", ( $("#player-x-1").val() ) + "px" );
    $("#daextsfve-field-player-1").css("top", ( $("#player-y-1").val() ) + "px" );
    $("#daextsfve-field-player-2").css("left", ( $("#player-x-2").val() ) + "px" );
    $("#daextsfve-field-player-2").css("top", ( $("#player-y-2").val() ) + "px" );
    $("#daextsfve-field-player-3").css("left", ( $("#player-x-3").val() ) + "px" );
    $("#daextsfve-field-player-3").css("top", ( $("#player-y-3").val() ) + "px" );
    $("#daextsfve-field-player-4").css("left", ( $("#player-x-4").val() ) + "px" );
    $("#daextsfve-field-player-4").css("top", ( $("#player-y-4").val() ) + "px" );
    $("#daextsfve-field-player-5").css("left", ( $("#player-x-5").val() ) + "px" );
    $("#daextsfve-field-player-5").css("top", ( $("#player-y-5").val() ) + "px" );
    $("#daextsfve-field-player-6").css("left", ( $("#player-x-6").val() ) + "px" );
    $("#daextsfve-field-player-6").css("top", ( $("#player-y-6").val() ) + "px" );
    $("#daextsfve-field-player-7").css("left", ( $("#player-x-7").val() ) + "px" );
    $("#daextsfve-field-player-7").css("top", ( $("#player-y-7").val() ) + "px" );
    $("#daextsfve-field-player-8").css("left", ( $("#player-x-8").val() ) + "px" );
    $("#daextsfve-field-player-8").css("top", ( $("#player-y-8").val() ) + "px" );
    $("#daextsfve-field-player-9").css("left", ( $("#player-x-9").val() ) + "px" );
    $("#daextsfve-field-player-9").css("top", ( $("#player-y-9").val() ) + "px" );
    $("#daextsfve-field-player-10").css("left", ( $("#player-x-10").val() ) + "px" );
    $("#daextsfve-field-player-10").css("top", ( $("#player-y-10").val() ) + "px" );
    $("#daextsfve-field-player-11").css("left", ( $("#player-x-11").val() ) + "px" );
    $("#daextsfve-field-player-11").css("top", ( $("#player-y-11").val() ) + "px" );

    //Make the field visible
    $('#daextsfve-draggable-field').css('visibility', 'visible');

    /*
     * initilize the draggable field with the draggable jquery plugin
     */
    $( ".daextsfve-field-player" ).draggable({

        //snap to grid
        grid: [ 1, 1 ],
        
        //contain inside parent
        containment: "#daextsfve-draggable-field", scroll: false,

        /*
         * draggable stop event ( when an element is dropped )
         */
        stop: function() {

            'use strict';

            //get the drop position
            const stop_pos_left = parseInt( $(this).position().left, 10);
            const stop_pos_top = parseInt( $(this).position().top, 10);
            
            //assign value to the related hidden input fields
            const id = $(this).attr("data-id");
            $("#player-x-"+id).val( stop_pos_left );
            $("#player-y-"+id).val( stop_pos_top );
            
            //decrease z-index of the dropped player
            $(this).css("z-index","1");

        },
        
        /*
         * draggable drag event
         */
        drag: function() {

            'use strict';

            //increase z-index of the dragged player
            $(this).css("z-index","999998");
            
            //get the id of the dragged player
            const player_id = $(this).attr("id");
            
            /*
             * update the label of the dragged player with the updated
             * coordinates
             */
            $( "#" + player_id + " > .daextsfve-player-name" ).text( "X" + parseInt( $(this).position().left, 10) + " " + "Y" + parseInt( $(this).position().top, 10) );
            
        }
        
    });
    
    //show and hide a player when a "Show player x" checkbox is clicked
     $(document.body).on("change",".checkbox-player-show",function(){

        'use strict';

        if(parseInt($(this).val(), 10) === 1){
            $("#daextsfve-field-player-" + parseInt( $(this).attr("data-id"), 10 ) ).removeClass("daextsfve-hidden-player");
        }else{
            $("#daextsfve-field-player-" + parseInt( $(this).attr("data-id"), 10 ) ).addClass("daextsfve-hidden-player");
        }
        
    });
    
    //update the player position labels on document ready event
    for(let i=1; i<=11; i++ ){
        
        //get current position
        const player_x = parseInt( $( "#daextsfve-field-player-" + i ).css("left"), 10 );
        const player_y = parseInt( $( "#daextsfve-field-player-" + i ).css("top"), 10 );
        
        //set player position labels
        $( "#daextsfve-field-player-" + i + " > .daextsfve-player-name" ).text( "X" + player_x + " " + "Y" + player_y );
        
    }    
        
});