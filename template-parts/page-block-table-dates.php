<?php

$table = get_field( 'calendar_dates', 'options' );

if ( $table ): ?>

    <h3><?php _e('Key Dates','csdschools'); ?></h3>
    <div class="table-responsive">
	    <table class="table table-white table-bordered">';

        <?php if ( $table['header'] ) {

            echo '<thead>';

                echo '<tr>';

                    foreach ( $table['header'] as $th ) {

                        echo '<th>';
                            echo $th['c'];
                        echo '</th>';
                    }

                echo '</tr>';

            echo '</thead>';
        }

        echo '<tbody>';

            foreach ( $table['body'] as $tr ) {

                echo '<tr>';

                    foreach ( $tr as $td ) {

                        echo '<td>';
                            echo $td['c'];
                        echo '</td>';
                    }

                echo '</tr>';
            }

        echo '</tbody>';

    echo '</table></div>';
    
endif;
?>