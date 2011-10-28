<?php 
	global $current_user; 
	get_currentuserinfo();
?>
<div class="alert_gray wrap alignright" style="width:30%; padding:10px; margin-bottom:10px;">
	<h2><?php _e("￼Get an ExactTarget Account Today!", "gravity-forms-exacttarget"); ?></h2>
	
	<?php if(isset($_GET['ty'])) { ?>
			<h3><?php _e("Your request has been submitted. An ExactTarget representative will contact you soon.", "gravity-forms-exacttarget"); ?></h3></div>
	<?php 
			return true;
		}  else {
	?>
		<h3><?php _e("Do you need an ExactTarget account? Fill out this form and a representative will contact you.", "gravity-forms-exacttarget"); ?></h3>
	<?php	}
	
	?>
    <form id="PoweredByForm" action="http<?php echo is_ssl() ? 's': ''; ?>://pages.exacttarget.com/partner_agent" method="post" class="form-table">
    			<div style="float: left; width: 98px; text-align: right;">
                    <label for="Email"><?php _e("Email Address*", "gravity-forms-exacttarget"); ?></label>
                </div>

                <div style="float: left; padding-left: 5px;">
                    <input type="text" value="<?php _e(get_bloginfo('admin_email')) ?>" style="width: 190px;" class="text-field required" id="Email" name="Email" />
                </div><br />
                <br />

                <div style="float: left; width: 98px; text-align: right;">
                    <label for="Phone"><?php _e("Phone Number*", "gravity-forms-exacttarget"); ?></label>
                </div>

                <div style="float: left; padding-left: 5px;">
                    <input type="text" value="" style="width: 190px;" class="text-field required" id="Phone" name="Phone" />
                </div>
                <br />
                <br />

                <div style="float: left; width: 98px; text-align: right;">
                    <label for="FirstName"><?php _e("First Name*", "gravity-forms-exacttarget"); ?></label>
                </div>

                <div style="float: left; padding-left: 5px;">
                    <input type="text" value="<?php echo isset($current_user->data->first_name) ? esc_html($current_user->data->first_name) : ''; ?>" style="width: 190px;" class="text-field required" id="FirstName" name="FirstName" />
                </div><br />
                <br />

                <div style="float: left; width: 98px; text-align: right;">
                    <label for="LastName"><?php _e("Last Name*", "gravity-forms-exacttarget"); ?></label>
                </div>

                <div style="float: left; padding-left: 5px;">
                    <input type="text" value="<?php echo isset($current_user->data->first_name) ? esc_html($current_user->data->last_name) : ''; ?>" style="width: 190px;" class="text-field required" id="LastName" name="LastName" />
                </div><br />
                <br />

                <div style="float: left; width: 98px; text-align: right;">
                    <label for="Title"><?php _e("Occupation*", "gravity-forms-exacttarget"); ?></label>
                </div>

                <div style="float: left; padding-left: 5px;">
                    <input type="text" value="<?php echo isset($current_user->data->title) ? esc_html($current_user->data->title) : ''; ?>" style="width: 190px;" class="text-field required" id="Title" name="Title" />
                </div><br />
                <br />

                <div style="float: left; width: 98px; text-align: right;">
                    <label for="Company"><?php _e("Company*", "gravity-forms-exacttarget"); ?></label>
                </div>

                <div style="float: left; padding-left: 5px;">
                    <input type="text" value="<?php echo isset($current_user->data->company) ? esc_html($current_user->data->company) : ''; ?>" style="width: 190px;" class="text-field required" id="Company" name="Company" />
                </div><br />
                <br />

                <div style="float: left; width: 98px; text-align: right;">
                    <label for="Country"><?php _e("Country*", "gravity-forms-exacttarget"); ?></label>
                </div>

                <div style="float: left; padding-left: 5px;">
                    <select name="Country" onchange="getState();" id="Country">
                        <option value="" selected="selected">
                             <?php _e("-- Select --", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="United States">
                             <?php _e("United States", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option onclick="setUK();" value="United Kingdom">
                             <?php _e("United Kingdom", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Canada">
                             <?php _e("Canada", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Mexico">
                             <?php _e("Mexico", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Virgin Islands - US">
                             <?php _e("Virgin Islands - US", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Albania">
                             <?php _e("Albania", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Algeria">
                             <?php _e("Algeria", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="American Samoa">
                             <?php _e("American Samoa", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option onclick="setUK();" value="Andorra">
                             <?php _e("Andorra", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Angola">
                             <?php _e("Angola", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Anguilla">
                             <?php _e("Anguilla", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Antigua">
                             <?php _e("Antigua", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Argentina">
                             <?php _e("Argentina", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Armenia">
                             <?php _e("Armenia", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Aruba">
                             <?php _e("Aruba", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Australia">
                             <?php _e("Australia", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option onclick="setUK();" value="Austria">
                             <?php _e("Austria", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Azerbaijan">
                             <?php _e("Azerbaijan", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Bahamas">
                             <?php _e("Bahamas", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Bahrain">
                             <?php _e("Bahrain", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Bangladesh">
                             <?php _e("Bangladesh", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Barbados">
                             <?php _e("Barbados", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Barbuda">
                             <?php _e("Barbuda", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option onclick="setUK();" value="Belgium">
                             <?php _e("Belgium", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Belize">
                             <?php _e("Belize", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Benin">
                             <?php _e("Benin", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Bermuda">
                             <?php _e("Bermuda", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Bhutan">
                             <?php _e("Bhutan", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Bolivia">
                             <?php _e("Bolivia", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Bonaire">
                             <?php _e("Bonaire", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Botswana">
                             <?php _e("Botswana", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Brazil">
                             <?php _e("Brazil", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="British Virgin Isl.">
                             <?php _e("British Virgin Isl", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Brunei">
                             <?php _e("Brunei", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option onclick="setUK();" value="Bulgaria">
                             <?php _e("Bulgaria", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Burundi">
                             <?php _e("Burundi", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Cambodia">
                             <?php _e("Cambodia", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Cameroon">
                             <?php _e("Cameroon", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Cape Verde">
                             <?php _e("Cape Verde", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Cayman Islands">
                             <?php _e("Cayman Isl", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Central African Rep.">
                             <?php _e("Central African Rep", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Chad">
                             <?php _e("Chad", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option onclick="setUK();" value="Channel Islands">
                             <?php _e("Channel Islands", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Chile">
                             <?php _e("Chile", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="China">
                             <?php _e("China", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Colombia">
                             <?php _e("Colombia", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Congo">
                             <?php _e("Congo", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Cook Islands">
                             <?php _e("Cook Islands", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Costa Rica">
                             <?php _e("Costa Rica", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option onclick="setUK();" value="Croatia">
                             <?php _e("Croatia", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Curacao">
                             <?php _e("Curacao", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option onclick="setUK();" value="Cyprus">
                             <?php _e("Cyprus", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option onclick="setUK();" value="Czech Republic">
                             <?php _e("Czech Republic", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option onclick="setUK();" value="Denmark">
                             <?php _e("Denmark", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Djibouti">
                             <?php _e("Djibouti", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Dominica">
                             <?php _e("Dominica", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Dominican Republic">
                             <?php _e("Dominican Republic", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Ecuador">
                             <?php _e("Ecuador", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Egypt">
                             <?php _e("Egypt", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="El Salvador">
                             <?php _e("El Salvador", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Equatorial Guinea">
                             <?php _e("Equatorial Guinea", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Eritrea">
                             <?php _e("Eritrea", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option onclick="setUK();" value="Estonia">
                             <?php _e("Estonia", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Ethiopia">
                             <?php _e("Ethiopia", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Faeroe Islands">
                             <?php _e("Faeroe Islands", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Fiji">
                             <?php _e("Fiji", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option onclick="setUK();" value="Finland">
                             <?php _e("Finland", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option onclick="setUK();" value="France">
                             <?php _e("France", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="French Guiana">
                             <?php _e("French Guiana", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="French Polynesia">
                             <?php _e("French Polynesia", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Gabon">
                             <?php _e("Gabon", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Gambia">
                             <?php _e("Gambia", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Georgia">
                             <?php _e("Georgia", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option onclick="setUK();" value="Germany">
                             <?php _e("Germany", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Ghana">
                             <?php _e("Ghana", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option onclick="setUK();" value="Gibraltar">
                             <?php _e("Gibraltar", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option onclick="setUK();" value="Greece">
                             <?php _e("Greece", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Greenland">
                             <?php _e("Greenland", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option onclick="setUK();" value="Grenada">
                             <?php _e("Grenada", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Guadeloupe">
                             <?php _e("Guadeloupe", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Guam">
                             <?php _e("Guam", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Guatemala">
                             <?php _e("Guatemala", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Guinea">
                             <?php _e("Guinea", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Guinea Bissau">
                             <?php _e("Guinea Bissau", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Guyana">
                             <?php _e("Guyana", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Haiti">
                             <?php _e("Haiti", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Honduras">
                             <?php _e("Honduras", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Hong Kong">
                             <?php _e("Hong Kong", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option onclick="setUK();" value="Hungary">
                             <?php _e("Hungary", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option onclick="setUK();" value="Iceland">
                             <?php _e("Iceland", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="India">
                             <?php _e("India", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Indonesia">
                             <?php _e("Indonesia", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Irak">
                             <?php _e("Iraq", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option onclick="setUK();" value="Iran">
                             <?php _e("Iran", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option onclick="setUK();" value="Ireland">
                             <?php _e("Ireland", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option onclick="setUK();" value="Northern Ireland">
                             <?php _e("Northern Ireland", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option onclick="setUK();" value="Israel">
                             <?php _e("Israel", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option onclick="setUK();" value="Italy">
                             <?php _e("Italy", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Ivory Coast">
                             <?php _e("Ivory Coast", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Jamaica">
                             <?php _e("Jamaica", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Japan">
                             <?php _e("Japan", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Jordan">
                             <?php _e("Jordan", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Kazakhstan">
                             <?php _e("Kazakhstan", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Kenya">
                             <?php _e("Kenya", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option onclick="setUK();" value="Kuwait">
                             <?php _e("Kuwait", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Kyrgyzstan">
                             <?php _e("Kyrgyzstan", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Latvia">
                             <?php _e("Latvia", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Lebanon">
                             <?php _e("Lebanon", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Liberia">
                             <?php _e("Liberia", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Liechtenstein">
                             <?php _e("Liechtenstein", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Lithuania">
                             <?php _e("Lithuania", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option onclick="setUK();" value="Luxembourg">
                             <?php _e("Luxembourg", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Macau">
                             <?php _e("Macau", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Macedonia">
                             <?php _e("Macedonia", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Madagascar">
                             <?php _e("Madagascar", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Malawi">
                             <?php _e("Malawi", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Malaysia">
                             <?php _e("Malaysia", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Maldives">
                             <?php _e("Maldives", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Mali">
                             <?php _e("Mali", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option onclick="setUK();" value="Malta">
                             <?php _e("Malta", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Marshall Islands">
                             <?php _e("Marshall Islands", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Martinique">
                             <?php _e("Martinique", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Mauritania">
                             <?php _e("Mauritania", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Mauritius">
                             <?php _e("Mauritius", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Micronesia">
                             <?php _e("Micronesia", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Moldova">
                             <?php _e("Moldova", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option onclick="setUK();" value="Monaco">
                             <?php _e("Monaco", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Mongolia">
                             <?php _e("Mongolia", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Montserrat">
                             <?php _e("Montserrat", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Morocco">
                             <?php _e("Morocco", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Mozambique">
                             <?php _e("Mozambique", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Myanmar/Burma">
                             <?php _e("Myanmar", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Namibia">
                             <?php _e("Namibia", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Nepal">
                             <?php _e("Nepal", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option onclick="setUK();" value="Netherlands">
                             <?php _e("Netherlands", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Netherlands Antilles">
                             <?php _e("Netherlands Antilles", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="new Caledonia">
                             <?php _e("New Caledonia", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="new Zealand">
                             <?php _e("new Zealand", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Nicaragua">
                             <?php _e("Nicaragua", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Niger">
                             <?php _e("Niger", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Nigeria">
                             <?php _e("Nigeria", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option onclick="setUK();" value="Norway">
                             <?php _e("Norway", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Oman">
                             <?php _e("Oman", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Palau">
                             <?php _e("Palau", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Panama">
                             <?php _e("Panama", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Papua new Guinea">
                             <?php _e("Papua new Guinea", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Paraguay">
                             <?php _e("Paraguay", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Peru">
                             <?php _e("Peru", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Philippines">
                             <?php _e("Philippines", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option onclick="setUK();" value="Poland">
                             <?php _e("Poland", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option onclick="setUK();" value="Portugal">
                             <?php _e("Portugal", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Puerto Rico">
                             <?php _e("Puerto Rico", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option onclick="setUK();" value="Qatar">
                             <?php _e("Qatar", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Reunion">
                             <?php _e("Reunion", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Rwanda">
                             <?php _e("Rwanda", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Saba">
                             <?php _e("Saba", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Saipan">
                             <?php _e("Saipan", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option onclick="setUK();" value="Saudi Arabia">
                             <?php _e("Saudi Arabia", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option onclick="setUK();" value="Scotland">
                             <?php _e("Scotland", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Senegal">
                             <?php _e("Senegal", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Seychelles">
                             <?php _e("Seychelles", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Sierra Leone">
                             <?php _e("Sierra Leone", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Singapore">
                             <?php _e("Singapore", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option onclick="setUK();" value="Slovak Republic">
                             <?php _e("Slovac Republic", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option onclick="setUK();" value="Slovenia">
                             <?php _e("Slovenia", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option onclick="setUK();" value="South Africa">
                             <?php _e("South Africa", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="South Korea">
                             <?php _e("South Korea", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option onclick="setUK();" value="Spain">
                             <?php _e("Spain", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option onclick="setUK();" value="Sri Lanka">
                             <?php _e("Sri Lanka", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Sudan">
                             <?php _e("Sudan", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Suriname">
                             <?php _e("Suriname", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Swaziland">
                             <?php _e("Swaziland", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option onclick="setUK();" value="Sweden">
                             <?php _e("Sweden", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option onclick="setUK();" value="Switzerland">
                             <?php _e("Switzerland", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Syria">
                             <?php _e("Syria", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Taiwan">
                             <?php _e("Taiwan", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Tanzania">
                             <?php _e("Tanzania", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Thailand">
                             <?php _e("Thailand", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Togo">
                             <?php _e("Togo", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Trinidad-Tobago">
                             <?php _e("Trinidad-Tobago", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option onclick="setUK();" value="Tunisia">
                             <?php _e("Tunesia", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option onclick="setUK();" value="Turkey">
                             <?php _e("Turkey", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Turkmenistan">
                             <?php _e("Turkmenistan", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option onclick="setUK();" value="United Arab Emirates">
                             <?php _e("United Arab Emirates", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Uganda">
                             <?php _e("Uganda", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Uruguay">
                             <?php _e("Uruguay", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Uzbekistan">
                             <?php _e("Uzbekistan", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Vanuatu">
                             <?php _e("Vanuatu", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Vatican City">
                             <?php _e("Vatican City", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Venezuela">
                             <?php _e("Venezuela", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Vietnam">
                             <?php _e("Vietnam", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option onclick="setUK();" value="Wales">
                             <?php _e("Wales", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Yemen">
                             <?php _e("Yemen", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Zaire">
                             <?php _e("Zaire", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Zambia">
                             <?php _e("Zambia", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Zimbabwe">
                             <?php _e("Zimbabwe", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="Other">
                             <?php _e("Other", "gravity-forms-exacttarget"); ?>
                        </option>
                    </select>
                </div><br />
                <br />

                <div style="float: left; width: 98px; text-align: right;">
                    <label style="display: none;" for="State" id="state_label">State</label>
                </div>

                <div style="float: left; padding-left: 5px;">
                    <select style="display: none;" id="State" name="State">
                        <option disabled="disabled" value="" selected="selected">
                             <?php _e("-- Select --", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option class="United States" value="AL">
                             <?php _e("Alabama", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option class="United States" value="AK">
                             <?php _e("Alaska", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option class="United States" value="AZ">
                             <?php _e("Arizona", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option class="United States" value="AR">
                             <?php _e("Arkansas", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option class="United States" value="CA">
                             <?php _e("California", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option class="United States" value="CO">
                             <?php _e("Colorado", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option class="United States" value="CT">
                             <?php _e("Connecticut", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option class="United States" value="DE">
                             <?php _e("Delaware", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option class="United States" value="DC">
                             <?php _e("District Of Columbia", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option class="United States" value="FL">
                             <?php _e("Florida", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option class="United States" value="GA">
                             <?php _e("Georgia", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option class="United States" value="HI">
                             <?php _e("Hawaii", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option class="United States" value="ID">
                             <?php _e("Idaho", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option class="United States" value="IL">
                             <?php _e("Illinois", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option class="United States" value="IN">
                             <?php _e("Indiana", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option class="United States" value="IA">
                             <?php _e("Iowa", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option class="United States" value="KS">
                             <?php _e("Kansas", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option class="United States" value="KY">
                             <?php _e("Kentucky", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option class="United States" value="LA">
                             <?php _e("Louisiana", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option class="United States" value="ME">
                             <?php _e("Maine", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option class="United States" value="MD">
                             <?php _e("Maryland", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option class="United States" value="MA">
                             <?php _e("Massachusetts", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option class="United States" value="MI">
                             <?php _e("Michigan", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option class="United States" value="MN">
                             <?php _e("Minnesota", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option class="United States" value="MS">
                             <?php _e("Mississippi", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option class="United States" value="MO">
                             <?php _e("Missouri", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option class="United States" value="MT">
                             <?php _e("Montana", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option class="United States" value="NE">
                             <?php _e("Nebraska", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option class="United States" value="NV">
                             <?php _e("Nevada", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option class="United States" value="NH">
                             <?php _e("New Hampshire", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option class="United States" value="NJ">
                             <?php _e("New Jersey", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option class="United States" value="NM">
                             <?php _e("New Mexico", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option class="United States" value="NY">
                             <?php _e("New York", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option class="United States" value="NC">
                             <?php _e("North Carolina", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option class="United States" value="ND">
                             <?php _e("North Dakota", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option class="United States" value="OH">
                             <?php _e("Ohio", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option class="United States" value="OK">
                             <?php _e("Oklahoma", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option class="United States" value="OR">
                             <?php _e("Oregon", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option class="United States" value="PA">
                             <?php _e("Pennsylvania", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option class="United States" value="RI">
                             <?php _e("Rhode Island", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option class="United States" value="SC">
                             <?php _e("South Carolina", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option class="United States" value="SD">
                             <?php _e("South Dakota", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option class="United States" value="TN">
                             <?php _e("Tennessee", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option class="United States" value="TX">
                             <?php _e("Texas", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option class="United States" value="UT">
                             <?php _e("Utah", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option class="United States" value="VT">
                             <?php _e("Vermont", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option class="United States" value="VA">
                             <?php _e("Virginia", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option class="United States" value="WA">
                             <?php _e("Washington", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option class="United States" value="WV">
                             <?php _e("West Virginia", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option class="United States" value="WI">
                             <?php _e("Wisconsin", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option class="United States" value="WY">
                             <?php _e("Wyoming", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option class="Canada" value="Alberta">
                             <?php _e("Alberta", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option class="Canada" value="British Columbia">
                             <?php _e("British Columbia", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option class="Canada" value="Manitoba">
                             <?php _e("Manitoba", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option class="Canada" value="New Brunswick">
                             <?php _e("New Brunswick", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option class="Canada" value="Newfoundland and Labrador">
                             <?php _e("Newfoundland and Labrador", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option class="Canada" value="Nova Scotia">
                             <?php _e("Nova Scotia", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option class="Canada" value="Nunavut">
                             <?php _e("Nunavut", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option class="Canada" value="Ontario">
                             <?php _e("Ontario", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option class="Canada" value="Prince Edward Island">
                             <?php _e("Prince Edward Island", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option class="Canada" value="Quebec">
                             <?php _e("Quebec", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option class="Canada" value="Saskatchewan">
                             <?php _e("Saskatchewan", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option class="Canada" value="Yukon">
                             <?php _e("Yukon", "gravity-forms-exacttarget"); ?>
                        </option>
                    </select> <select style="display: none;" id="AUState" name="AUState">
                        <option disabled="disabled" value="" selected="selected">
                             <?php _e("-- Select --", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="ACT">
                             <?php _e("Australian Capital Territory", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="NSW">
                             <?php _e("New South Wales", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="NT">
                             <?php _e("Northern Territory", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="QLD">
                             <?php _e("Queensland", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="SA">
                             <?php _e("South Australia", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="TAS">
                             <?php _e("Tasmania", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="VIC">
                             <?php _e("Victoria", "gravity-forms-exacttarget"); ?>
                        </option>

                        <option value="WA">
                             <?php _e("Western Australia", "gravity-forms-exacttarget"); ?>
                        </option>
                    </select>
                </div>
	
		<div class="clear"></div>
               
        <div id="notvalid" style="display:none; margin:10px 0;" class="alert_red">
            <p style="padding:.25em .5em;"><?php _e("Please Fill Out All Required Information", "gravity-forms-exacttarget"); ?></p>
		</div>
				
        <div class="clear"></div>
        	
        <div style="margin-top:10px;">
	        <input type="image" src="http://image.exct.net/lib/fef9117476660c/m/1/etweb_submit.gif" value=""  style="height:29px; width:125px; margin-left: 103px;" />
	        	
        	<p class="description"><?php _e(sprintf("Some fields may have been pre-filled with your %sprofile information%s. ExactTarget respects your privacy. %sView our policy%s.", '<a href="'.admin_url('profile.php').'">', '</a>', '<a href="http://pages.exacttarget.com/Redirect.aspx?EQ=5c591a8916642e731465d3922c5bdef0d63e597964cf3b996c6aceb8b68b514260eb6ef62f970036544118fae8db41b3dcfabd76359c10e8f674d8ef8b7099163bc90ce5a79ebea820c7c77c0b6f7661d96237ce017aa00c6e53b44477ca784b2150eb0f0d659c1ad4be824e0b4a5e53f75f615a956676c958af05e60db8a795ae61332d2e90376bb99643d7d49b3fd202afeb39eea772e0c93db0540a3f1263b002485fbdecf4d85ea54ef0bcbda315080928ca588927cbbc8b533de06610e1e6836ce6bbea460c8129019949cb401cf1761a32fa27516a" target="_blank">', '</a>'), "gravity-forms-exacttarget"); ?></p>
            <input type="hidden" value="Zack" id="ReferralContactFirstName__c" name="ReferralContactFirstName__c" /> 
	        <input type="hidden" value="Katz" id="ReferralContactLastName__c" name="ReferralContactLastName__c" />
	        <input type="hidden" value="zack@katzwebservices.com" id="ReferralContactEmailAddress__c" name="ReferralContactEmailAddress__c" /> 
	        <input type="hidden" value="970-882-1477" id="ReferralContactPhoneNumber__c" name="ReferralContactPhoneNumber__c" />
			<input type="hidden" value="" id="etrid" name="etrid" />
			<input type="hidden" name="__successPage" id="__successPage" value="<?php echo add_query_arg(array('ty' => true)); ?>" />
			<input type="hidden" name="__errorPage" id="__errorPage" value="http://pages.exacttarget.com/partner_referral_er?s=2" />
			<input type="hidden" name="__contextName" id="__contextName" value="FormPost" />
			<input type="hidden" name="__executionContext" id="__executionContext" value="Post" />
			<input type="hidden" name="isuk" id="isuk" value="" />
			<input type="hidden" name="IntegrationId__c" id="IntegrationId__c" value="" />
			<input type="hidden" name="accountname" id="accountname" value="DirectMailInsight" />
			<input type="hidden" name="camp" id="camp" value="" />
			<input type="hidden" name="comp" id="comp" value="KatzWebServices" />
        </div>
    </form>
    <style type="text/css">
    	input.error,
    	select.error {
/*     		background-color: #ffffcc; */
			border-color:#CFADB3;
    		color: #832525; background-color: #FAF2F5;
    	}
    	.text-field {
    		padding: 4px;
    	}
    	label.error { color:red; font-weight: bold;}
    </style>
	<script type="text/javascript">
	
		function getState() {
			var whatCount = jQuery('#Country').val();
			if (whatCount == "United States") {
				jQuery('#AUState').hide();
				jQuery("#AUState").val("");			
				jQuery('#State').fadeIn("slow");
				jQuery('#state_label').fadeIn("slow");
			} else if (whatCount == "Australia") {
				jQuery('#State').hide();
				jQuery("#State").val("");
				jQuery('#AUState').fadeIn("slow");
				jQuery('#state_label').fadeIn("slow");
			} else {
				jQuery('#State,#state_label').hide();
			}
		}
	
		function setUK() {
			jQuery("#isuk").val('yes');
		}
		
		function emailCheck(){
			var wholemail = jQuery("#Email").val();
			var broke = wholemail.split("@");
			if (broke[1]){return true;};
			return false;
		}
		
		function refemailCheck(){
			var wholemail = jQuery("#ReferralContactEmailAddress__c").val();
			var broke = wholemail.split("@");
			if (broke[1]){return true;};
			return false;
		}
		
		jQuery(document).ready(function($) {
		
			$("#PoweredByForm").submit(function(e) {
				
				if(checkNewErrors($(this), true)) {
					return true;
				}
				
				return false;
			
			});
			
			$('.error').live('change', function() {
				$(this).removeClass('error');
				$("label[for="+$(this).prop('id')+"]").removeClass('error');
				checkNewErrors($("#PoweredByForm"), false);
			});
			
			function checkNewErrors($this, submit){
				$('#notvalid').hide();
				$("#FirstName").val() == '' ? $("#FirstName").addClass('error') : $("#FirstName").removeClass('error');
				$("#LastName").val() == '' ? $("#LastName").addClass('error') : $("#LastName").removeClass('error');
				$("#Title").val() == '' ? $("#Title").addClass('error') : $("#Title").removeClass('error');
				$("#Company").val() == '' ? $("#Company").addClass('error') : $("#Company").removeClass('error');
				$("#Country").val() == '' ? $("#Country").addClass('error') : $("#Country").removeClass('error');
				!emailCheck() ? $("#Email").addClass('error') : $("#Email").removeClass('error');
				
				($("#Phone").val().length < 10) ? $("#Phone").addClass('error') : $("#Phone").removeClass('error');
				
				if ($('.error', $("#PoweredByForm")).length == 0) {
					if(submit) { return true; }
					return false;
				} else {
					if(submit) {
						$('#notvalid').show();
					}
					
					$('input.error,select.error').each(function() {
						$("label[for="+$(this).prop('id')+"]").addClass('error');
					});
					
					return false;
				}
			}
		});
	</script>

</div>