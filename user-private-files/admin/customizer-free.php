<?php
// Exit if accessed directly
if ( ! defined('ABSPATH') ) {
   exit;
}

if (!function_exists('upvf_pro_customiser_callback')) 
{
	function upvf_pro_customiser_callback()
	{
		if (!current_user_can('manage_options'))
		{
			wp_die( __('You do not have sufficient permissions to access this page.', 'user-private-files') );
		}
		
		global $upf_plugin_url;
		?>
		

				<div class="wrap" >
					<form method="post" action="" enctype="multipart/form-data">

                        <div class="upfp_setting-container">
                            <h2 class="heading">General (PRO Feature)</h2>
                            <div class="upfp_inner-container">
							<div class="upfp_col-1">								
								<label>Disable full width of Frontend dashboard</label>
							</div>

							<div class="upfp_col-2">
								<div id="upfp_setting-toggle" class="upfp_toggle_setting">
									<div class="upfp_toggle-check">
										<input type="checkbox">	
										<div class="upfp_round"></div>
									</div>
								</div>
							</div>
						</div>
                        </div>

                        <div class="upfp_setting-container">
                            <h2 class="heading">Branding (PRO Feature)</h2>
                            <div class="upfp_inner-container">
                                <div class="upfp_col-1">
                                    <label>Logo</label>
                                </div>
                                <div class="upfp_col-2 upfp_thumb_col-2">
                                    <input type="file" class="upfp_thumb" accept="image/png, image/jpeg, image/webp">
                                </div>						
                            </div>

                            <div class="upfp_inner-container">
                                <div class="upfp_col-1">
                                    <label>Watermark</label>
                                </div>
                                <div class="upfp_col-2 upfp_thumb_col-2">
                                    <input type="file" class="upfp_thumb" name="upfp_cust_watermark_thumbnail" accept="image/png, image/jpeg, image/webp">
                                </div>						
                            </div>

                            <div class="upfp_inner-container">
                                <div class="upfp_col-1">
                                    <label>Watermark Settngs :</label>
                                </div>
                            </div>

                            <div class="upfp_inner-container">
                                <div class="upfp_col-1">                                   
                                    <label>Size</label>
                                </div>
                                <div class="upfp_col-2">
                                <select class="upfp_input">
                                    <option value="auto">Auto</option>
                                    <option value="cover">Cover</option>
                                    <option value="contain">Contain</option>
                                </select>
                                </div>
                            </div>

                            <div class="upfp_inner-container">
                                <div class="upfp_col-1">
                                    <label>Width</label>
                                </div>
                                <div class="upfp_col-2">
                                <select class="upfp_input">
                                    <option value="10%">10%</option>
                                    <option value="20%">20%</option>
                                    <option value="30%">30%</option>
                                    <option value="40%">40%</option>
                                    <option value="50%">50%</option>
                                    <option value="60%">60%</option>
                                    <option value="70%">70%</option>
                                    <option value="80%">80%</option>
                                    <option value="90%">90%</option>
                                    <option value="100%">100%</option>
                                </select>
                                </div>
                            </div>

                            <div class="upfp_inner-container">
                                <div class="upfp_col-1">                                   
                                    <label>Height</label>
                                </div>
                                <div class="upfp_col-2">
                                <select class="upfp_input">
                                    <option value="10%">10%</option>
                                    <option value="20%">20%</option>
                                    <option value="30%">30%</option>
                                    <option value="40%">40%</option>
                                    <option value="50%">50%</option>
                                    <option value="60%">60%</option>
                                    <option value="70%">70%</option>
                                    <option value="80%">80%</option>
                                    <option value="90%">90%</option>
                                    <option value="100%">100%</option>
                                </select>
                                </div>
                            </div>

                            <div class="upfp_inner-container">
                                <div class="upfp_col-1">
                                    <label>Opacity</label>
                                </div>
                                <div class="upfp_col-2">
                                <select class="upfp_input">
                                    <option value="0.1">0.1</option>
                                    <option value="0.2">0.2</option>
                                    <option value="0.3">0.3</option>
                                    <option value="0.4">0.4</option>
                                    <option value="0.5">0.5</option>
                                    <option value="0.6">0.6</option>
                                    <option value="0.7">0.7</option>
                                    <option value="0.8">0.8</option>
                                    <option value="0.9">0.9</option>
                                    <option value="1.0">1.0</option>
                                </select>
                                </div>
                            </div>

                            <div class="upfp_inner-container">
                                <div class="upfp_col-1">
                                    <label>Position</label>
                                </div>
                                <div class="upfp_col-2">
                                <select class="upfp_input">
                                    <option value="left">Left</option>
                                    <option value="right">Right</option>
                                    <option value="top">Top</option>
                                    <option value="bottom">Bottom</option>
                                    <option value="center">Center</option>
                                </select>
                                </div>
                            </div>

                            <div class="upfp_inner-container">
                                <div class="upfp_col-1">
                                    <label>Repeat</label>
                                </div>
                                <div class="upfp_col-2">
                                <select class="upfp_input">
                                    <option value="repeat">Repeat</option>
                                    <option value="no-repeat">No-Repeat</option>
                                    <option value="repeat-x">Repeat-X</option>
                                    <option value="repeat-y">Repeat-Y</option>
                                </select>
                                </div>
                            </div>
                        </div>

						<div class="upfp_setting-container">
                            <h2 class="heading">Colors (PRO Feature)</h2>
                            <div class="upfp_inner-container">
                                <div class="upfp_col-1">
                                    <label for="upfp_cust_clr1">Primary Color</label>
                                </div>
                                <div class="upfp_col-2">
                                    <input type="color" class="upfp_color" name="upfp_cust_clr1" id="upfp_cust_clr1" value="#444444">
                                    <input type="text" class="upfp_color-input" id="upfp_color-val1" name="upfp_color-val1" value="#444444">
                                </div>							
                            </div>
                                
                            <div class="upfp_inner-container">
                                <div class="upfp_col-1">
                                    <label for="upfp_cust_clr2">Secondary Color</label>
                                </div>
                                <div class="upfp_col-2">
                                    <input type="color" class="upfp_color" name="upfp_cust_clr2" id="upfp_cust_clr2" value="#444444">
                                    <input type="text" class="upfp_color-input" id="upfp_color-val2" name="upfp_color-val2" value="#444444">
                                </div>								
                            </div>

                            <div class="upfp_inner-container">
                                <div class="upfp_col-1">
                                    <label for="upfp_cust_clr2">Hover Color</label>
                                </div>
                                <div class="upfp_col-2">
                                    <input type="color" class="upfp_color" name="upfp_cust_clr3" id="upfp_cust_clr3" value="#0071a1">
                                    <input type="text" class="upfp_color-input" id="upfp_color-val3" name="upfp_color-val3" value="#0071a1">
                                </div>								
                            </div>
                        </div>

                        <div class="upfp_setting-container">
                            <div class="upfp_thumb_heading">
                                <h2 class="heading">Thumbnails (PRO Feature)</h2>
                                <button class="upfp_btn" id="upfp_add_new-btn">Add New</button>
                            </div>
                            <!-- Display default thumbnail types -->
                            <div class="upfp_inner-container">
                                <div class="upfp_col-1">
                                    <label for="upfp_cust_folder_thumb">Folder Thumbnail</label>
                                </div>
                                <div class="upfp_col-2 upfp_thumb_col-2">
                                    <input type="file" class="upfp_thumb" name="upfp_cust_folder_thumb" id="upfp_cust_folder_thumb" accept="image/png, image/jpeg, image/webp">
                                    <img src="<?php echo $upf_plugin_url . 'images/folder-150.png'; ?>" alt="Preview" class="upfp_thumb-prev" id="upfp_thumb-prev-folder">
                                </div>								
                            </div>
							
							<div class="upfp_inner-container">
                                <div class="upfp_col-1">
                                    <label for="upfp_cust_premade_folder_thumb">Premade Folder Thumbnail</label>
                                </div>
                                <div class="upfp_col-2 upfp_thumb_col-2">
                                    <input type="file" class="upfp_thumb" name="upfp_cust_premade_folder_thumb" id="upfp_cust_premade_folder_thumb" accept="image/png, image/jpeg, image/webp">
                                    <img src="<?php echo $upf_plugin_url . 'images/premade_folder.png'; ?>" alt="Preview" class="upfp_thumb-prev" id="upfp_thumb-prev-folder">
                                </div>								
                            </div>
                                
                            <div class="upfp_inner-container">
                                <div class="upfp_col-1">
                                    <label for="upfp_cust_pdf_thumb">PDF Thumbnail</label>
                                </div>
                                <div class="upfp_col-2 upfp_thumb_col-2">
                                    <input type="file" class="upfp_thumb" name="upfp_cust_pdf_thumb" id="upfp_cust_pdf_thumb" accept="image/png, image/jpeg, image/webp">
                                    <img src="<?php echo $upf_plugin_url . 'images/PDF_thumbnail.png'; ?>" alt="Preview" class="upfp_thumb-prev" id="upfp_thumb-prev-pdf">
                                </div>								
                            </div>

                            <div class="upfp_inner-container">
                                <div class="upfp_col-1">
                                    <label for="upfp_cust_zip_thumb">Zip file Thumbnail</label>
                                </div>
                                <div class="upfp_col-2 upfp_thumb_col-2">
                                    <input type="file" class="upfp_thumb" name="upfp_cust_zip_thumb" id="upfp_cust_zip_thumb" accept="image/png, image/jpeg, image/webp">
                                    <img src="<?php echo $upf_plugin_url . 'images/Zip_thumbnail.png'; ?>" alt="Preview" class="upfp_thumb-prev" id="upfp_thumb-prev-zip">
                                </div>								
                            </div>

                            <div class="upfp_inner-container">
                                <div class="upfp_col-1">
                                    <label for="upfp_cust_audio_thumb">Audio file Thumbnail</label>
                                </div>
                                <div class="upfp_col-2 upfp_thumb_col-2">
                                    <input type="file" class="upfp_thumb" name="upfp_cust_audio_thumb" id="upfp_cust_audio_thumb" accept="image/png, image/jpeg, image/webp">
                                    <img src="<?php echo $upf_plugin_url . 'images/Audio_thumbnail.png'; ?>" alt="Preview" class="upfp_thumb-prev" id="upfp_thumb-prev-audio">
                                </div>								
                            </div>

                            <div class="upfp_inner-container">
                                <div class="upfp_col-1">
                                    <label for="upfp_cust_video_thumb">Video file Thumbnail</label>
                                </div>
                                <div class="upfp_col-2 upfp_thumb_col-2">
                                    <input type="file" class="upfp_thumb" name="upfp_cust_video_thumb" id="upfp_cust_video_thumb" accept="image/png, image/jpeg, image/webp">
                                    <img src="<?php echo $upf_plugin_url . 'images/Video_thumbnail.png'; ?>" alt="Preview" class="upfp_thumb-prev" id="upfp_thumb-prev-video">
                                </div>								
                            </div>

                            <div class="upfp_inner-container">
                                <div class="upfp_col-1">
                                    <label for="upfp_cust_docs_thumb">Docs Files</label>
                                </div>
                                <div class="upfp_col-2 upfp_thumb_col-2">
                                    <input type="file" class="upfp_thumb" name="upfp_cust_docs_thumb" id="upfp_cust_docs_thumb" accept="image/png, image/jpeg, image/webp">
                                    <img src="<?php echo $upf_plugin_url . 'images/Doc_thumbnail.png'; ?>" alt="Preview" class="upfp_thumb-prev" id="upfp_thumb-prev-docs">
                                </div>								
                            </div>

                            <!-- Display default thumbnail -->
                            <div class="upfp_inner-container">
                                <div class="upfp_col-1">
                                    <label for="upfp_cust_default_thumb">Default Thumbnail</label>
                                </div>
                                <div class="upfp_col-2 upfp_thumb_col-2">
                                    <input type="file" class="upfp_thumb" name="upfp_cust_default_thumb" id="upfp_cust_default_thumb" accept="image/png, image/jpeg, image/webp">
                                    <img src="<?php echo $upf_plugin_url . 'images/File_thumbnail.png'; ?>" alt="Preview" class="upfp_thumb-prev" id="upfp_thumb-prev-default">
                                </div>	
                            </div>
                        </div>
        
                        <div class="upfp_setting-container">
							<h2 class="heading">File View Mode (PRO Feature)</h2>
                            <div class="upfp_inner-container">
                                <div class="upfp_col-1">
                                    
                                    <label for="upfp_toggle_view_modes">Enable users to toggle view modes</label>
                                </div>
                                <div class="upfp_col-2">
                                    <div id="upfp_setting-toggle" class="upfp_toggle_setting">
                                        <div class="upfp_toggle-check">
											<input type="checkbox" id="upfp_toggle_view_modes" disabled="disabled">
											<div class="upfp_round"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="upfp_inner-container">
                                <div class="upfp_col-1">
                                    <label for="upfp_select_view_modes">Default view</label>
                                </div>
                                <div class="upfp_col-2">
                                <select class="upfp_input" id="upfp_select_view_modes">
                                    <option value="grid">Grid View</option>
                                    <option value="list">List View</option>
                                </select>
                                </div>
                            </div>
                        </div>

                        <div class="upfp_admin_save">
                            <input type="submit" class="button-primary" value="Save"/>
                        </div>
                        
                    </form>
                </div>
				
			<?php
            }
            
        }?>