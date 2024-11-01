jQuery(document).ready(function($) {

    'use strict';
    
    /*
     * On the window load event set the player size and set the players
     * positions, the load event is sent to an element when it and all
     * sub-elements have been completely loaded.
     * 
     */
    $( window ).on("load", function() {

        'use strict';

        //set container size
        daextsfve_set_container_size();

        //set players size
        daextsfve_set_players_size();
        
        //set players positions
        daextsfve_set_players_position();

    });
     
    /*
     * On window resize event set the player size and set the players positions.
     */
    $(window).resize(function() {

        'use strict';

        //set container size
        daextsfve_set_container_size();
        
        //set players size
        daextsfve_set_players_size();

        //set players position
        daextsfve_set_players_position();
        
    });

    function daextsfve_set_container_size(){

        'use strict';

        //parse all the fields
        $(".daextsfve-container").each(function(index){
            
            //field height field width ratio
            const FIELD_H_FIELD_W = 785 / 710;
            
            //get parent width
            const parent_width = $(this).parent().width();
            
            //set container width as the parent width
            $(this).css("width", parent_width + "px");
            
            //set container height
            $(this).css("height", parent_width * FIELD_H_FIELD_W + "px");

        });
        
    }

    /*
     * Set the player size, include font size and drop shadows based on the
     * actual dimension of the field. This function is called both on the window
     * onload event and on the window resize event.
     */
    function daextsfve_set_players_size(){

        'use strict';

        //parse all the fields
        $(".daextsfve-container").each(function(){

            'use strict';

            //CALCULATE VALUES -------------------------------------------------
            
            //define constants
            const PLAYER_W_FIELD_W_RATIO = 191 / 710;
            const PLAYER_H_FIELD_H_RATIO = 32 / 785;
            const PLAYER_NUMBER_W_FIELD_W_RATIO = 38 / 710;
            const PLAYER_NAME_W_FIELD_W_RATIO = 153 / 710;
            const FONT_SIZE_FIELD_W_RATIO = window.DAEXTSFVE_PARAMETERS.font_size / 710;
            
            //get the id selector of this specific field
            const field_id = "#" + $(this).attr("id");
            
            //get field width
            const field_width = $(this).width();
            
            //current field width - default field width ( 710 ) ratio
            const CURRENT_FIELD_W_DEFAULT_FIELD_W = field_width / 710;
            
            //get field height
            const field_height = $(this).height();
            
            //calculate player width
            const player_width = PLAYER_W_FIELD_W_RATIO * field_width;
            
            //calculate player height
            const player_height = PLAYER_H_FIELD_H_RATIO * field_height;
            
            //calculate player number width
            const player_number_width = PLAYER_NUMBER_W_FIELD_W_RATIO * field_width;
            
            //calculate player name width
            const player_name_width = PLAYER_NAME_W_FIELD_W_RATIO * field_width;
            
            //calculate font size
            const font_size = FONT_SIZE_FIELD_W_RATIO * field_width;
            
            //calculate player drop shadow
            const ds_offset_x = 2.5 * CURRENT_FIELD_W_DEFAULT_FIELD_W;
            const ds_offset_y = 4.33 * CURRENT_FIELD_W_DEFAULT_FIELD_W;
            const ds_blur_radius = 5 * CURRENT_FIELD_W_DEFAULT_FIELD_W;
            
            //SET VALUES -------------------------------------------------------
            
            //set player width
            $(field_id + " > .daextsfve-player-container").css("width", player_width + "px");
            
            //set player height
            $(field_id + " > .daextsfve-player-container").css("height", player_height + "px");
            
            //set player number width
            $(field_id + " > .daextsfve-player-container > .daextsfve-player-number").css("width", player_number_width + "px");
            
            //set player number height
            $(field_id + " > .daextsfve-player-container > .daextsfve-player-number").css("height", player_height + "px");
            
            //set player name width
            $(field_id + " > .daextsfve-player-container > .daextsfve-player-name").css("width", player_name_width + "px");
            
            //set player name height
            $(field_id + " > .daextsfve-player-container > .daextsfve-player-name").css("height", player_height + "px");
            
            //set player name left position
            $(field_id + " > .daextsfve-player-container > .daextsfve-player-name").css("left", player_number_width + "px");
            
            //set font size
            $(field_id + " > .daextsfve-player-container > .daextsfve-player-number, " + field_id + " > .daextsfve-player-container > .daextsfve-player-name").css("font-size", font_size + "px");
            
            //set line height
            $(field_id + " > .daextsfve-player-container > .daextsfve-player-number, " + field_id + " > .daextsfve-player-container > .daextsfve-player-name").css("line-height", player_height + "px");
            
            //set drop shadow
            $(field_id + " > .daextsfve-player-container").css("box-shadow", ds_offset_x + "px " + ds_offset_y + "px " + ds_blur_radius + "px 0px rgba(0, 0, 0, 0.5)");
            
        });
        
    }
    
    /*
     * Calculate the positions in percentage of the players based on the
     * positions available in the .daextsfve-position-x-[x] hidden fields availble in
     * the DOM.
     */
    function daextsfve_set_players_position(){

        'use strict';

        //parse all the fields
        $(".daextsfve-container").each(function(){

            'use strict';

            //get the id selector of this specific field
            const field_id = "#" + $(this).attr("id");
            
            //get field width
            const field_width = $(this).width();

            //current field width - default field width ( 710 ) ratio
            const CURRENT_FIELD_W_DEFAULT_FIELD_W = field_width / 710;
            
            //set positions
            for(let i=1;i<=11;i++){
                
                //get player position from the hidden fields
                let x_position = parseInt( $(field_id + " .daextsfve-position-x-" + i).attr("data-id"), 10 );
                let y_position = parseInt( $(field_id + " .daextsfve-position-y-" + i).attr("data-id"), 10 );
                
                //modify the player position based on the current field width
                x_position = x_position * CURRENT_FIELD_W_DEFAULT_FIELD_W;
                y_position = y_position * CURRENT_FIELD_W_DEFAULT_FIELD_W;
                
                //set the player position in the css
                $(field_id + " .daextsfve-player-container-" + i).css("left", x_position).css("top", y_position);
                
                //make this field visible if this field is hidden
                if( $(field_id).css("visibility") == "hidden" ){ $(field_id).css("visibility", "visible"); }
                    
            }
            
        });

    }

});