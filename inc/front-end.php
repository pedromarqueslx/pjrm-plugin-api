<?php
    $before_widget = '';
    $before_title = '';
    $title = '';
    $after_title = '';
    $after_widget = '';
    echo $before_widget;
    echo $before_title . $title . $after_title ;
?>

<ul class="pjrm-articles frontend">

	<?php

	if ( isset( $pjrm_results ) ) {
		$total_articles = count( $pjrm_results->{'toplists'}->{'575'} );
	}

	for( $i = $total_articles - 1; $i >= $total_articles - $num_articles; $i-- ):

	;?>

	<li class="pjrm-articles">

        <div class="pjrm-articles-info">
            <?php if( $display_image == '1' ): ?>

	            <?php if( isset($pjrm_results->{'toplists'}->{'575'}[$i]->{'logo'}) ): ?>

                    <img src="<?php echo $pjrm_results->{'toplists'}->{'575'}[$i]->{'logo'}; ?>" width="120px" alt="Casino">

                <?php endif; ?>

            <?php endif; ?>

            <p class="pjrm-articles-name">
                <a href="<?php echo $pjrm_results->{'toplists'}->{'575'}[$i]->{'play_url'}; ?>">
                    PLAY
                </a>
            </p>

            <p>
	            <?php echo $pjrm_results->{'toplists'}->{'575'}[$i]->{'info'}->{'bonus'}; ?>
            </p>

        </div>

	</li>

	<?php endfor; ?>

</ul>

<?php
	echo $after_widget;
?>
