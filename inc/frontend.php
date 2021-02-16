<?php

    $before_widget = '';
    $before_title = '';
    $title = '';
    $after_title = '';
    $after_widget = '';
    echo $before_widget;
    echo $before_title . $title . $after_title ;

?>
<div class="container">

    <div class="row" style="background-color: #b87f00">

        <div class="col-12 col-md-3 col-lg-3 text-center p-4">

            <p>Casino</p>

        </div>

        <div class="col-12 col-md-3 col-lg-3 text-center p-4">

            <p>Bonus</p>

        </div>

        <div class="col-12 col-md-3 col-lg-3 text-center p-4">

            <p>Features</p>

        </div>

        <div class="col-12 col-md-3 col-lg-3 text-center p-4">

            <p>Play</p>

        </div>

    </div>

	<?php

	if ( isset( $pjrm_results ) ) {
		$total_articles = count( $pjrm_results->{'toplists'}->{'575'} );
	}
    // PHP loop
	//for( $i = $total_articles - 1; $i >= $total_articles - $num_articles; $i-- ):
	for( $i = 0; $i < 4; $i++ ):
	;?>

    <div class="row">

        <div class="col-12 col-md-3 col-lg-3 text-center p-4">

	        <?php if( $display_image == '1' ): ?>

	            <?php if( isset($pjrm_results->{'toplists'}->{'575'}[$i]->{'logo'}) ): ?>

                    <img src="<?php echo $pjrm_results->{'toplists'}->{'575'}[$i]->{'logo'}; ?>" class="img-fluid" alt="">

                <?php endif; ?>

            <?php endif; ?>

             <p><a href="<?php echo $pjrm_results->{'toplists'}->{'575'}[$i]->{'brand_id'}; ?>" target="_blank">Review</a></p>

        </div>

        <div class="col-12 col-md-3 col-lg-3 text-center p-4">

            <p>5</p>
            <p class="small"><?php echo $pjrm_results->{'toplists'}->{'575'}[$i]->{'info'}->{'bonus'}; ?></p>

        </div>

        <div class="col-12 col-md-3 col-lg-3 text-center p-4">

            <ul>
                <li><?php echo $pjrm_results->{'toplists'}->{'575'}[$i]->{'info'}->{'features'}[0]; ?></li>
                <li><?php echo $pjrm_results->{'toplists'}->{'575'}[$i]->{'info'}->{'features'}[1]; ?></li>
                <li><?php echo $pjrm_results->{'toplists'}->{'575'}[$i]->{'info'}->{'features'}[2]; ?></li>
            </ul>

        </div>

        <div class="col-12 col-md-3 col-lg-3 text-center p-4">

            <a class="btn btn-success" href="<?php echo $pjrm_results->{'toplists'}->{'575'}[$i]->{'play_url'}; ?>" target="_blank">PLAY NOW</a>
            <p class="small"><?php echo $pjrm_results->{'toplists'}->{'575'}[$i]->{'terms_and_conditions'}; ?></p>

        </div>

    </div>

	<?php endfor; ?>

</div>




<?php
	echo $after_widget;
?>
