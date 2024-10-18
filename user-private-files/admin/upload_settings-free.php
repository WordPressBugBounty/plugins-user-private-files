<?php
// Exit if accessed directly
if ( ! defined('ABSPATH') ) {
   exit;
}

if (!function_exists('upvf_pro_upload_callback')) 
{
	function upvf_pro_upload_callback()
	{
		if (!current_user_can('manage_options'))
		{
			wp_die( __('You do not have sufficient permissions to access this page.', 'user-private-files-pro') );
		}

        // Add default file types in option
        $upfp_allowed_mime_types = [];

        $upfp_allowed_mime_types['psd'] = array(
            'mime_type' => 'image/vnd.adobe.photoshop',
            'allowed' => false,
            'default' => true
        );

        $upfp_allowed_mime_types['php'] = array(
            'mime_type' => 'text/plain,text/x-php',
            'allowed' => false,
            'default' => true
        );
        
        $upfp_allowed_mime_types['exe'] = array(
            'mime_type' => 'application/x-msdownload,application/dosexec,application/x-dosexec,application/ms-dos-executable,application/msdownload,application/octet-stream',
            'allowed' => false,
            'default' => true
        );

        $upfp_allowed_mime_types['bin'] = array(
            'mime_type' => 'application/octet-stream,application/saturn-rom,application/sega-cd-rom',
            'allowed' => false,
            'default' => true
        );

        $upfp_allowed_mime_types['sh'] = array(
            'mime_type' => 'text/x-shellscript,application/x-sh,application/executable,application/sh,application/shellscript,text/plain,text/sh',
            'allowed' => false,
            'default' => true
        );

        $upfp_allowed_mime_types['bz'] = array(
            'mime_type' => 'application/x-bzip,application/bzip,application/bzip2',
            'allowed' => false,
            'default' => true
        );

        $upfp_allowed_mime_types['dtd'] = array(
            'mime_type' => 'application/xml-dtd,text/dtd,text/plain',
            'allowed' => false,
            'default' => true
        );

        $upfp_allowed_mime_types['dwg'] = array(
            'mime_type' => 'image/vnd.dwg,application/acad,application/autocad,application/autocaddwg,application/dwg,drawing/dwg,image/dwg',
            'allowed' => false,
            'default' => true
        );

        $upfp_allowed_mime_types['epub'] = array(
            'mime_type' => 'application/epub+zip,application/zip',
            'allowed' => false,
            'default' => true
        );

        $upfp_allowed_mime_types['jar'] = array(
            'mime_type' => 'application/jar,application/java-archive,application/osgi.bundle,application/zip',
            'allowed' => false,
            'default' => true
        );

        $upfp_allowed_mime_types['svg'] = array(
            'mime_type' => 'application/xml,image/svg+xml',
            'allowed' => false,
            'default' => true
        );
            
        ?>

            <div class="wrap upfp_upload_wrapper" >
            <form method='POST' action="">
                    
                    <div class="upfp_setting-container">
                        <div class="upfp_srvr_fldr_heading">
                            <h2 class="heading">File Upload/Download Restrictions (PRO Feature)</h2>
                        </div>

                        <div class="upf_setting_msg"></div>

                        <div class="upfp_inner-container">
                            <div class="upfp_col-1">
                                <?php 
                                    $upload_max_filesize = ini_get('upload_max_filesize');
                                ?>
                                <label>Maximum Upload File Size</label>
                                <i class="fas fa-info-circle upfp_icon upfp_info_btn"></i>
                                <div class="upfp-popup upfp-hidden upfp_settings_info_popup">
                                    <div class="upf_inner">
                                        <h4>Maximum Upload File Size</h4>
                                        <span class="closePopup  upfp_close_info_pp"><i class="fa-solid fa-xmark"></i></span>
                                        <p>Enable this option to set maximum upload file size. Enabling this option will restrict users from uploading files larger than the limit specified. This option will have no effect on admin users.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="upfp_col-2">
                                <div id="upfp_setting-toggle" class="upfp_toggle_setting">
                                    <div class="upfp_toggle-check">
                                        <input type="checkbox">	
                                        <div class="upfp_round"></div>
                                    </div>
                                </div>
                                <input type="text" disabled readonly="readonly" class="upfp_input" placeholder="Insert value in MB">
                                <span>Server Max limit: <?php echo $upload_max_filesize; ?></span>
                            </div>
                        </div>

                        <div class="upfp_inner-container">
                            <div class="upfp_col-1">
                                <label for="upfp_upload_max_count_enabled">Maximum Upload File Count</label>
                                <i class="fas fa-info-circle upfp_icon upfp_info_btn"></i>
                                <div class="upfp-popup upfp-hidden upfp_settings_info_popup">
                                    <div class="upf_inner">
                                        <h4>Maximum Upload File Count</h4>
                                        <span class="closePopup  upfp_close_info_pp"><i class="fa-solid fa-xmark"></i></span>
                                        <p>Enable this option to set maximum upload file count. Enabling this option will limit the total files uploaded by a user. This option will have no effect on admin users.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="upfp_col-2">
                                <div id="upfp_setting-toggle" class="upfp_toggle_setting">
                                    <div class="upfp_toggle-check">
                                        <input type="checkbox">	
                                        <div class="upfp_round"></div>
                                    </div>
                                </div>
                                <input disabled readonly="readonly" type="text" class="upfp_input" placeholder="Insert value">
                                <span>Server Max limit: Infinite</span>
                            </div>
                        </div>

                        <div class="upfp_inner-container">
                            <div class="upfp_col-1">
                                <label for="upfp_download_max_count_enabled">Download Count Limit</label>
                                <i class="fas fa-info-circle upfp_icon upfp_info_btn"></i>
                                <div class="upfp-popup upfp-hidden upfp_settings_info_popup">
                                    <div class="upf_inner">
                                        <h4>Download Count Limit</h4>
                                        <span class="closePopup  upfp_close_info_pp"><i class="fa-solid fa-xmark"></i></span>
                                        <p>Enable this option to set limit to total downloads of a file. Downloads by owner of the file will be ignored.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="upfp_col-2">
                                <div id="upfp_setting-toggle" class="upfp_toggle_setting">
                                    <div class="upfp_toggle-check">
                                        <input type="checkbox">	
                                        <div class="upfp_round"></div>
                                    </div>
                                </div>
                                <input disabled readonly="readonly" type="text" class="upfp_input" placeholder="Insert value">
                                <span>Max limit: Infinite</span>
                            </div>
                        </div>

                    </div>

                    <?php 
                        $access_type = get_filesystem_method();
                        if($access_type != 'direct') {
                    ?>
                        <div class="upfp_setting-container">
                            <div class="upfp_ftp_heading">
                                <h2 class="heading">FTP (PRO Feature)</h2>
                                <button class="upfp_btn">Save</button>
                            </div>
                            <div class="upfp_ftp_msg">Please enter your FTP credentials. If you do not remember your credentials, you should contact your web host.</div>
                            <div class="upfp_inner-container">
                                <div class="upfp_col-1">
                                    <label>Hostname</label>
                                </div>
                                <div class="upfp_col-2">
                                    <input disabled readonly="readonly" type="text">
                                </div>							
                            </div>
                            <div class="upfp_inner-container">
                                <div class="upfp_col-1">
                                    <label>User</label>
                                </div>	
                                <div class="upfp_col-2">
                                    <input disabled readonly="readonly" type="text">
                                </div>						
                            </div>
                            <div class="upfp_inner-container">
                                <div class="upfp_col-1">
                                    <label>Password</label>
                                </div>	
                                <div class="upfp_col-2">
                                    <input disabled readonly="readonly" type="password">
                                </div>					
                            </div>
                            <div class="upfp_inner-container">
                                <div class="upfp_col-1">
                                    <label>Connection type</label>
                                </div>	
                                <div class="upfp_col-2">
                                    <input disabled readonly="readonly" type="text" palceholder="ftp">
                                </div>					
                            </div>
                            <div class="upfp_inner-container">
                                <div class="upfp_col-1">
                                    <label>Public key (for ssh2)</label>
                                </div>	
                                <div class="upfp_col-2">
                                    <input disabled readonly="readonly" type="text">
                                </div>					
                            </div>
                            <div class="upfp_inner-container">
                                <div class="upfp_col-1">
                                    <label>Private key(for ssh2)</label>
                                </div>	
                                <div class="upfp_col-2">
                                    <input disabled readonly="readonly" type="text">
                                </div>					
                            </div>
                            <div class="upf_setting_msg"></div>
                        </div>
                    <?php } ?>

                    <div class="upfp_setting-container upfp_srvr_folder_wrapper">
                        <div class="upfp_srvr_fldr_heading">
                            <h2 class="heading">Sync Server Folder (PRO Feature)</h2>
                        </div>
                        <div class="upfp_inner-container">
                            <div class="upfp_col-1">
                                <label>Server folder path</label>
                            </div>
                            <div class="upfp_col-2">
                                <input disabled readonly="readonly" type="text" class="upfp_input" placeholder="Enter path">
                                <div class="upfp_btn">Sync</div>
                                <div class="upfp_btn" id="upfp_srvr_fldr_logs">Logs</div>
                            </div>							
                        </div>
                        <div class="upf_setting_msg upfp-hidden">No Logs</div>
                    </div>
                    
                    <div class="upfp_setting-container upfp_allowed_type_wrapper">
                        <div class="upfp_file_type_heading">
                            <h2 class="heading">Allowed File Types (PRO Feature)</h2>
                            <button class="upfp_btn" id="upfp_add_new_file_type_btn">Add New</button>
                        </div>
                        <!-- Header -->
                        <div class="upfp_inner-container upfp_file_type_header_wrapper upfp_file_type_wrapper">
                            <div class="">
                                Extension
                            </div>
                            <div class="">
                                Mime Type
                            </div>
                            <div class="">
                                Allowed
                            </div>
                            <div class="">
                                Restricted
                            </div>
                            <div></div>
                        </div>
                            
                        <!-- Display default Allowed types -->
                        <?php foreach($upfp_allowed_mime_types as $ext => $data) {?>
                            <div class="upfp_inner-container upfp_file_type_wrapper" default="<?php echo $data['default'] ? 'true' : 'false'; ?>">
                                <div class="upfp_custom_file_ext" data="<?php echo $ext; ?>">
                                    <?php echo $ext; ?>
                                </div>
                                <div class="upfp_custom_file_mime" data="<?php echo $data['mime_type']; ?>">
                                <?php
                                    $mime_type_arr = explode(',', $data['mime_type']);
                                    foreach ( $mime_type_arr as $mime_type) {
                                        echo $mime_type . "<br>";
                                    }
                                ?>
                                </div>
                                <div class="">
                                    <input type="radio" value="allowed" class="upfp_custom_file_allowed" <?php echo ($data['allowed'] ? 'checked' : ''); ?>>
                                </div>
                                <div class="">
                                    <input type="radio" value="restricted" class="upfp_custom_file_allowed" <?php echo (!$data['allowed'] ? 'checked' : ''); ?>>
                                </div>
                                <div>
                                </div>
                            </div>
                        <?php } ?>
                        
                    </div>

                    <div class="upfp_admin_save">
                        <input type="submit" name="upfp_upload_submit" class="button-primary" value="Save"/>
                    </div>

                </form>
            </div>

            <!--Add new file type POPUP-->	
            <div class="upfp-popup upfp-hidden addNewFileType_popup">
                <div class="upf_inner">
                    <h4>Add new file type</h4>
                    <span class="closePopup addNewFileType_closePopup"><i class="fa-solid fa-xmark"></i></span>
                    <form>
                        <input disabled readonly="readonly" type="text" placeholder="extension (in lowercase)">
                        <input disabled readonly="readonly" type="text" placeholder="Mime types">
                        <div class="upfp-err"></div>
                        <div class="upfp_btn">Add Type</div> 
                    </form>
                    <div>* In case of multiple mime types, separate using commas.</div>            
                </div>
            </div>  
        <?php	
    }
    
}?>