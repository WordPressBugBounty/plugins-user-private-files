<?php
/*
* load register functionality
*/

// Exit if accessed directly
if ( ! defined('ABSPATH') ) {
   exit;
}

class UPFP_REGISTER_FUNC {

	function upvf_pro_register_menu(){
		if (!current_user_can('manage_options')){
			wp_die( __('You do not have sufficient permissions to access this page.', 'user-private-files-pro') );
		}
		?>
		<div class="wrap" id="upfp_register_option_page">
			<div class="upfp_setting-container">
				<form method="post" action="">
						<div class="upfp_thumb_heading">
							<h2 class="heading">Register Options (PRO Feature)</h2>
							<p style="margin-right: 12px; font-weight: bold; font-size: 16px;">Shortcode - [upf_register]</p>
						</div>
						<div class="upfp_inner-container">
							<div class="upfp_col-1">
								<label>Register Message</label>
							</div>
							<div class="upfp_col-2">
								<input type="text" disabled readonly="readonly" class="upfp_input" placeholder="Leave blank for no message">
							</div>								
						</div>
							
						<div class="upfp_inner-container">
							<div class="upfp_col-1">
								<label>Username Label</label>
							</div>
							<div class="upfp_col-2">
								<input type="text" disabled readonly="readonly" class="upfp_input" placeholder="Leave blank for default label">
							</div>								
						</div>

						<div class="upfp_inner-container">
							<div class="upfp_col-1">
								<label>Email Label</label>
							</div>
							<div class="upfp_col-2">
								<input type="text" disabled readonly="readonly" class="upfp_input" placeholder="Leave blank for default label">
							</div>								
						</div>

						<div class="upfp_inner-container">
							<div class="upfp_col-1">
								<label>Display First name</label>
							</div>

							<div class="upfp_col-2">
								<div id="upfp_setting-toggle" class="upfp_toggle_btn upfp_toggle_setting">
									<div class="upfp_toggle-check">
										<input type="checkbox">
										<div class="upfp_round"></div>
									</div>
								</div>
							</div>
						</div>

						<div class = "upfp_toggle_wrapper upfp-hidden">
							<div class="upfp_inner-container">
								<div class="upfp_col-1">
									<label>First name Label</label>
								</div>
								<div class="upfp_col-2">
									<input type="text" disabled readonly="readonly" class="upfp_input" placeholder="Leave blank for default label">
								</div>								
							</div>

							<div class="upfp_inner-container">
								<div class="upfp_col-1">
									<label>First name required</label>
								</div>

								<div class="upfp_col-2">
									<div id="upfp_setting-toggle" class="upfp_toggle_btn upfp_toggle_setting">
										<div class="upfp_toggle-check">
											<input type="checkbox">
											<div class="upfp_round"></div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="upfp_inner-container">
							<div class="upfp_col-1">
								<label>Display Last name</label>
							</div>

							<div class="upfp_col-2">
								<div id="upfp_setting-toggle" class="upfp_toggle_btn upfp_toggle_setting">
									<div class="upfp_toggle-check">
										<input type="checkbox">
										<div class="upfp_round"></div>
									</div>
								</div>
							</div>
						</div>

						<div class = "upfp_toggle_wrapper upfp-hidden">
							<div class="upfp_inner-container">
								<div class="upfp_col-1">
									<label>Last name Label</label>
								</div>
								<div class="upfp_col-2">
									<input type="text" disabled readonly="readonly" class="upfp_input" placeholder="Leave blank for default label">
								</div>								
							</div>

							<div class="upfp_inner-container">
								<div class="upfp_col-1">
									<label>Last name required</label>
								</div>

								<div class="upfp_col-2">
									<div id="upfp_setting-toggle" class="upfp_toggle_btn upfp_toggle_setting">
										<div class="upfp_toggle-check">
											<input type="checkbox">
											<div class="upfp_round"></div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="upfp_inner-container">
							<div class="upfp_col-1">
								<label>Display Website</label>
							</div>

							<div class="upfp_col-2">
								<div id="upfp_setting-toggle" class="upfp_toggle_btn upfp_toggle_setting">
									<div class="upfp_toggle-check">
										<input type="checkbox">
										<div class="upfp_round"></div>
									</div>
								</div>
							</div>
						</div>

						<div class = "upfp_toggle_wrapper upfp-hidden">
							<div class="upfp_inner-container">
								<div class="upfp_col-1">
									<label>Website Label</label>
								</div>
								<div class="upfp_col-2">
									<input type="text" disabled readonly="readonly" class="upfp_input" placeholder="Leave blank for default label">
								</div>								
							</div>

							<div class="upfp_inner-container">
								<div class="upfp_col-1">
									<label>Website required</label>
								</div>

								<div class="upfp_col-2">
									<div id="upfp_setting-toggle" class="upfp_toggle_btn upfp_toggle_setting">
										<div class="upfp_toggle-check">
											<input type="checkbox">
											<div class="upfp_round"></div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="upfp_inner-container">
							<div class="upfp_col-1">
								<label>Success Message</label>
							</div>
							<div class="upfp_col-2">
								<input type="text" disabled readonly="readonly" class="upfp_input" placeholder="Leave blank for default message">
							</div>								
						</div>

						<div class="upfp_inner-container">
							<div class="upfp_col-1">
								<label>Success Message Color</label>
							</div>
							<div class="upfp_col-2">
								<input type="color" class="upfp_color">
								<input disabled readonly="readonly" type="text" class="upfp_color-input">
							</div>							
						</div>

						<div class="upfp_inner-container">
							<div class="upfp_col-1">
								<label>Display Google reCAPTCHA v2</label>
							</div>

							<div class="upfp_col-2">
								<div id="upfp_setting-toggle" class="upfp_toggle_btn upfp_toggle_setting">
									<div class="upfp_toggle-check">
										<input type="checkbox">
										<div class="upfp_round"></div>
									</div>
								</div>
							</div>
						</div>

						<div class = "upfp_toggle_wrapper upfp-hidden">
							<div class="upfp_inner-container">
								<div class="upfp_col-1">
									<label>Google reCAPTCHA site Key</label>
								</div>
								<div class="upfp_col-2">
									<input type="text" disabled readonly="readonly" class="upfp_input" placeholder="Enter site key">
								</div>
							</div>

							<div class="upfp_inner-container">
								<div class="upfp_col-1">
									<label>Google reCAPTCHA secret Key</label>
								</div>
								<div class="upfp_col-2">
									<input type="text" disabled readonly="readonly" class="upfp_input" placeholder="Enter secret key">
								</div>
							</div>
						</div>

						<div class="upfp_inner-container">
							<div class="upfp_col-1">
								<label>Register Button Label</label>
							</div>
							<div class="upfp_col-2">
								<input type="text" disabled readonly="readonly" class="upfp_input" placeholder="Leave blank for default label">
							</div>								
						</div>

					<div class="upfp_admin_save">
						<input type="submit" name="upfp_register_settings_submit" class="button-primary" value="Save"/>
					</div>
					
				</form>
			</div>

			<div class="upfp_setting-container">			
				<div class="upfp_thumb_heading">
					<h2 class="heading">Manage Custom Registration Fields (PRO Feature)</h2>
					<button class="upfp_btn" id="upfp_rf_add_new_btn">Add New</button>
				</div>
				
				<div class="upfp_rf_wrapper">
					<div class="upfp_inner-container">
						<div class="upf_rf_admin_col">Label</div>
						<div class="upf_rf_admin_col">Type</div>
						<div class="upf_rf_admin_col">Required</div>
						<div class="upf_rf_admin_col">Display</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Add new field POPUP -->	
		<div class="upfp-popup upfp-hidden upf_rf_new_field_popup">
			<div class="upf_inner">
				<h4>Add New Field</h4>
				<span class="closePopup upf_rf_new_field_closePopup"><i class="fa-solid fa-xmark"></i></span>
				
				<form>
					<div class="upfp_inner-container">
						<div class="upfp_col-1">
							<label>Label: </label>
						</div>
						<div class="upfp_col-2">
							<input disabled readonly="readonly" type="text" placeholder="Enter here" required>
						</div>
					</div>

					<div class="upfp_inner-container">
						<div class="upfp_col-1">
							<label>Type: </label>
						</div>
						<div class="upfp_col-2">
						<select>
							<option value="text" selected>text</option>
							<option value="number">number</option>
							<option value="radio">radio</option>
							<option value="checkbox">checkbox</option>
							<option value="date">date</option>
							<option value="tel">tel</option>
							<option value="textarea">textarea</option>
							<option value="dropdown">dropdown</option>
						</select>
						</div>
					</div>

					<div class="upfp_inner-container">
						<div class="upfp_col-1">
							<label>Options: </label>
							<p>(comma separated values)</p>
						</div>
						<div class="upfp_col-2">
							<textarea disabled readonly="readonly" placeholder="Enter options here"></textarea>
						</div>
					</div>

					<div class="upfp_inner-container">
						<div class="upfp_col-1">
							<label>Required: </label>
						</div>
						<div class="upfp_col-2">
						<input disabled readonly="readonly" type="checkbox">
						</div>
					</div>

					<div class="upfp_inner-container">
						<div class="upfp_col-1">
							<label>Display: </label>
						</div>
						<div class="upfp_col-2">
						<input disabled readonly="readonly" type="checkbox" checked>
						</div>
					</div>
					
					<div class="upfp_inner-container">
						<div class="upfp_btn">Save</div>
					</div>
				</form>
			</div>
		</div>
		<?php	
	}
	
}?>
