<div class="wrap">

	<h1>Articles</h1>

	<div id="poststuff">

		<div id="post-body" class="metabox-holder columns-2">

			<!-- main content -->
			<div id="post-body-content">

				<div class="meta-box-sortables ui-sortable">

                    <?php if (!isset($pjrm_search) || $pjrm_search == '') : ?>

					<div class="postbox">

						<!-- Toggle -->

                        <h2 class="hndle">To load JSON Feed data, please insert some search text and the API key.</h2>

						<div class="inside">
							<form method="post" action="">

                            <input type="hidden" name="pjrm_form_submitted" value="Y">

                            <table class="form-table">
								<tr>
									<td><label for="pjrm_search">Seach</label></td>
									<td><input name="pjrm_search" id="pjrm_search" type="text" value="" class="regular-text" /></td>
								</tr>
								<tr>
									<td><label for="pjrm_apikey">API Key</label></td>
									<td><input name="pjrm_apikey" id="pjrm_apikey" type="text" value="" class="regular-text" /></td>
								</tr>
							</table>

							<p>
								<input class="button-primary" type="submit" name="pjrm_form_submit" value="Save" />
							</p>

							</form>
						</div>
						<!-- .inside -->

					</div>
                    <!-- .postbox -->
                    <?php else: ?>

					<div class="postbox">

						<div class="handlediv" title="Click to toggle"><br></div>
						<!-- Toggle -->

						<h2 class="hndle">Articles List</h2>

						    <div class="inside">

                                <ul class="pjrm-articles">
                                    <!-- PHP loop -->
								    <?php for( $i = 0; $i < 4; $i++ ):?>

                                        <li>
                                            <ul>

                                                <!-- Create condition to check if image exist in the array -->
                                                <?php if ( ! empty( $pjrm_results ) ) {
	                                                if( !empty($pjrm_results->{'toplists'}->{'575'}[$i]->{'logo'})): ?>

                                                    <li>
                                                        <img src="<?php echo $pjrm_results->{'toplists'}->{'575'}[$i]->{'logo'}; ?>" width="120px" alt="Casino">
                                                    </li>

                                                    <?php endif;
                                                } ?>

                                                <li>
                                                    <a href="https://www.site_url.com/<?php echo $pjrm_results->{'toplists'}->{'575'}[$i]->{'brand_id'}; ?>" target="_blank">Review</a>
                                                </li>

                                                <li>
		                                            <?php echo $pjrm_results->{'toplists'}->{'575'}[$i]->{'info'}->{'rating'}; ?>
                                                </li>

                                                <li>
		                                            <?php echo $pjrm_results->{'toplists'}->{'575'}[$i]->{'info'}->{'bonus'}; ?>
                                                </li>

                                                <li>
                                                    <a href="<?php echo $pjrm_results->{'toplists'}->{'575'}[$i]->{'play_url'}; ?>" target="_blank">PLAY</a>
                                                </li>

                                                <li>
		                                            <?php echo $pjrm_results->{'toplists'}->{'575'}[$i]->{'terms_and_conditions'}; ?>
                                                </li>

                                                <li>
		                                            <?php echo $pjrm_results->{'toplists'}->{'575'}[$i]->{'info'}->{'features'}[0]; ?>
                                                </li>

                                                <li>
		                                            <?php echo $pjrm_results->{'toplists'}->{'575'}[$i]->{'info'}->{'features'}[1]; ?>
                                                </li>

                                                <li>
		                                            <?php echo $pjrm_results->{'toplists'}->{'575'}[$i]->{'info'}->{'features'}[2]; ?>
                                                </li>

                                            </ul>

                                        </li>

								    <?php endfor; ?>

                                </ul>

                            </div>

					    </div>
					    <!-- .postbox -->

                    <?php endif; ?>

                    <div class="postbox">

                        <div class="handlediv" title="Click to toggle"><br></div>
                        <!-- Toggle -->

                        <h2>JSON Feed - For Development Proposes</h2>

                        <div class="inside">

							<pre><code><?php var_dump($pjrm_results); ?></code></pre>

                        </div>
                        <!-- .inside -->

                    </div>
                    <!-- .postbox -->

				</div>
				<!-- .meta-box-sortables .ui-sortable -->

			</div>
			<!-- post-body-content -->

			<!-- sidebar -->
			<div id="postbox-container-1" class="postbox-container">

				<div class="meta-box-sortables">

					<?php if (isset($pjrm_search) && $pjrm_search != ''): ?>

                    <div class="postbox">

                        <div class="handlediv" title="Click to toggle"><br></div>
                        <!-- Toggle -->

                        <h2>Settings</h2>

                        <div class="inside">

                            <form method="post" action="">
                                <input type="hidden" name="pjrm_form_submitted" value="Y">
                                <p>
                                    <label for="tablecell">Seach</label>
                                    <input name="pjrm_search" id="pjrm_search"  type="text" value="<?php echo $pjrm_search; ?>" class="all-options" />
                                </p>
                                <p>
                                    <label for="tablecell">API Key</label>
                                    <input name="pjrm_apikey" id="pjrm_apikey" type="text" value="<?php echo $pjrm_apikey; ?>" class="all-options" />
                                </p>
                                <input class="button-primary" type="submit" name="pjrm_form_submit" value="Update" />
                            </form>

                        </div>
                        <!-- .inside -->

                    </div>
                    <!-- .postbox -->

					<?php endif; ?>

                </div>
				<!-- .meta-box-sortables -->

			</div>
			<!-- #postbox-container-1 .postbox-container -->

		</div>
		<!-- #post-body .metabox-holder .columns-2 -->

		<br class="clear">
	</div>
	<!-- #poststuff -->

</div> <!-- .wrap -->
