<?php
    global $wpdb;

    if($_POST['settings'] == "1"):
        $paypal_email = $_POST['paypal'];
        $msg = $_POST['message'];
        $currency = $_POST['currency'];
        $btn_en = $_POST['button_en'];
        $btn_link = $_POST['button_link'];
        $btn_text = $_POST['button_text'];
        $wpdb->query("UPDATE bpm_settings SET option_value='$msg' WHERE option_name='message'");
        $wpdb->query("UPDATE bpm_settings SET option_value='$btn_en' WHERE option_name='button_en'");
        $wpdb->query("UPDATE bpm_settings SET option_value='$btn_text' WHERE option_name='button_text'");
        $wpdb->query("UPDATE bpm_settings SET option_value='$btn_link' WHERE option_name='button_link'");
        $wpdb->query("UPDATE bpm_settings SET option_value='$currency' WHERE option_name='currency'");
        $wpdb->query("UPDATE bpm_settings SET option_value='$paypal_email' WHERE option_name='paypal'");
        $updated = "Y";
    endif;
?>

<img src="<?php echo plugins_url( 'images/Elgunvo.png', __FILE__ );  ?>" alt="Built By Elbuntu" />

<div style="text-align: right; margin-right: 2%;">
    <span style="float: left;">Profiles Manager for BuddyPress Version 1.2</span>
    <a href="?page=bpm-menu">Settings</a> | <a href="?page=bpm-profile">Profile Manager</a> | <a href="?page=bpm-commerce">Subscription Manager</a>
</div>

<?php 
    $paypal = $wpdb->get_var($wpdb->prepare("SELECT option_value FROM bpm_settings WHERE option_name = '%s';", "paypal")); 
    $message = $wpdb->get_var($wpdb->prepare("SELECT option_value FROM bpm_settings WHERE option_name = '%s';", "message"));
    $btn_en = $wpdb->get_var($wpdb->prepare("SELECT option_value FROM bpm_settings WHERE option_name = '%s';", "button_en"));
    $btn_text = $wpdb->get_var($wpdb->prepare("SELECT option_value FROM bpm_settings WHERE option_name = '%s';", "button_text"));
    $btn_link = $wpdb->get_var($wpdb->prepare("SELECT option_value FROM bpm_settings WHERE option_name = '%s';", "button_link"));
    $currency = $wpdb->get_var($wpdb->prepare("SELECT option_value FROM bpm_settings WHERE option_name = '%s';", "currency"));
?>

<?php if($updated == "Y"): ?>
    <br />
    <div id="message" class="updated" style="margin-left: 0px; margin-right: 2%;">
        <p><strong>Settings have been updated...</strong></p>
    </div>
<?php endif; ?>

<form method="post" action="?page=bpm-menu">
<table class="widefat page" cellspacing="0" style="width: 98%; margin-top: 10px; margin-bottom: 10px; margin-right: 5px;">
    <thead>  
        <tr>
            <th colspan="2">
                <strong>Settings</strong>
            </th>
        </tr>
    </thead> 
    <tbody>
        <tr>
            <td colspan="2" style="background: #eee;">Paypal Settings (for Subscription Manager)</td>
        </tr>
        <tr>
            <td>Email Address: </td>
            <td><input type="text" value="<?php echo $paypal; ?>" name="paypal" style="width: 300px;"></td>
        </tr>
        <tr>
            <td>Currency: </td>
            <td>
                <select name="currency">
                    <option <?php if($currency == "EUR") { echo "selected"; }; ?>>EUR</option>
                    <option <?php if($currency == "USD") { echo "selected"; }; ?>>USD</option>
                    <option <?php if($currency == "GBP") { echo "selected"; }; ?>>GBP</option>
                </select> Current: <strong><?php echo $currency; ?></strong>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="background: #eee;">Profile Manager Settings</td>
        </tr>
        <tr>
            <td>Upgrade Button: </td>
            <td><input type="checkbox" <?php if ($btn_en == 'on') { echo 'checked'; } ?> name="button_en"> <i>Adds a menu item to the profile edit menu that links to your membership upgrade page</i></td>
        </tr>
        <tr>
            <td>Button Text: </td>
            <td><input type="text" value="<?php echo $btn_text; ?>" name="button_text" style="width: 300px;"></td>
        </tr>
        <tr>
            <td>Button URL: </td>
            <td><input type="text" value="<?php echo $btn_link; ?>" name="button_link" style="width: 300px;"></td>
        </tr>
        <tr>
            <td>Message to User: </td>
            <td><textarea style="width: 100%; height: 200px;" name="message"><?php echo $message; ?></textarea></td>
        </tr>
        <tr>
            <td colspan="2" align="right">
                <input type="hidden" name="settings" value="1" />
                <input type="submit" value="Update Settings" class="button" />
            </td>
        </tr>
    </tbody>
</table>
</form>

<table class="widefat page" cellspacing="0" style="width: 98%; margin-top: 10px; margin-bottom: 10px; margin-right: 5px;">
    <thead>  
        <tr>
            <th>
                <strong>Help &amp; Support</strong>
            </th>
        </tr>
    </thead> 
    <tbody>
        <tr>
            <td>
                <p>If the plugin isn't working for you or you are recieving errors then please contact me with subject "Profiles Manager" at ashley.gary.johnson@gmail.com</p>
            </td>
        </tr>
    </tbody>
</table>

<table class="widefat page" cellspacing="0" style="width: 98%; margin-top: 10px; margin-bottom: 10px; margin-right: 5px;">
    <thead>  
        <tr>
            <th>
                <strong>Your Donations Count!</strong>
            </th>
        </tr>
    </thead> 
    <tbody>
        <tr>
            <td>
                <p>Although this plugin is free to use and distribute donations enable us
                to develop new features and fix bugs. if you like this plugin we kindly 
                ask that you donate using the form below:</p>
                <strong>Donation Form</strong>
                <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
                    <input type="hidden" name="cmd" value="_donations">
                    <input type="hidden" name="business" value="ashley.gary.johnson@gmail.com">
                    <input type="hidden" name="lc" value="US">
                    <input type="hidden" name="item_name" value="Elbuntu Plugin Donations">
                    <input type="hidden" name="item_number" value="109998">
                    Amount: <select name="amount">
                        <option value="2.50">€2,50</option>
                        <option value="5.00">€5</option>
                        <option value="10.00">€10</option>
                        <option value="15.00">€15</option>
                    </select>
                    <input type="hidden" name="currency_code" value="EUR">
                    <input type="hidden" name="no_note" value="0">
                    <input type="hidden" name="currency_code" value="EUR">
                    <input type="hidden" name="bn" value="PP-DonationsBF:btn_donateCC_LG.gif:NonHostedGuest">
                    <input type="submit" value="Donate Via Paypal" class="button" />
                    <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                </form>
            </td>
        </tr>
    </tbody>
</table>

<div style="text-align: right; margin-right: 2%;">
    <span style="float: left;">Created by Ashley Johnson</span>
    <a href="http://elbuntu.com">Developers Website</a> | <a href="https://twitter.com/Ashley_GJohnson">Developers Twitter</a> | <a href="https://www.linkedin.com/pub/ashley-johnson/33/6a7/a98">Developers LinkedIn</a>
</div>