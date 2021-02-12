<div class="wrap">

	<h1>Articles</h1>

	<div id="poststuff">

		<div id="post-body" class="metabox-holder columns-2">

			<!-- main content -->
			<div id="post-body-content">

				<div class="meta-box-sortables ui-sortable">

                    <?php if (!isset($pjrm_search) || $pjrm_search == '') : ?>

					<div class="postbox">

						<div class="handlediv" title="Click to toggle"><br></div>
						<!-- Toggle -->

						<h2 class="hndle">Main</h2>

						<div class="inside">
							<form method="post" action="">

                            <input type="hidden" name="pjrm_form_submitted" value="Y">

                            <table class="form-table">
								<tr valign="top">
									<td scope="row"><label for="tablecell">Seach String</label></td>
									<td><input name="pjrm_search" id="pjrm_search"  type="text" value="" class="regular-text" /></td>
								</tr>
								<tr valign="top">
									<td scope="row"><label for="tablecell">API Key</label></td>
									<td><input name="pjrm_apikey" id="pjrm_apikey"  type="text" value="" class="regular-text" /></td>
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

								<?php for( $i = 0; $i < 10; $i++ ):?>
                                    <li>
                                        <ul>
                                            <li>
                                                <img width="120px" src="<?php echo $plugin_url . '/images/pg_dummy.jpg' ?>">
                                            </li>
                                            <li class="pjrm-articles-name">
                                                <a href="#">
                                                link
                                                </a>
                                            </li>
                                            <li class="pjrm-articles-paragraph">
                                                <p>Content</p>
                                            </li>
                                        </ul>
                                    </li>
								<?php endfor; ?>
                            </ul>


						</div>
						<!-- .inside -->

					</div>
					<!-- .postbox -->

                    <?php endif; ?>

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
                                <p><input name="pjrm_search" id="pjrm_search"  type="text" value="<?php echo $pjrm_search; ?>" class="all-options" /></p>
                                <p><input name="pjrm_apikey" id="pjrm_apikey"  type="text" value="<?php echo $pjrm_apikey; ?>" class="all-options" /></p>
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
