<?php
global $wpdb;

$groups = BP_XProfile_Group::get( array(
    'fetch_fields' => true
));

$updated = "N";

if($_GET['rmid']):
    $id = $_GET['rmid'];
    $wpdb->query("DELETE FROM bpm_commerce WHERE id='$id'"); 
    $updated = "Y";
endif;

if($_POST['formid'] == '4'):
    $price = $_POST['price'];
    $membership = $_POST['membership'];
    $term = $_POST['term'];
    $curr = $_POST['currency'];
    $wpdb->query("INSERT INTO bpm_commerce (price, membership, term, currency) VALUES ('$price', '$membership', '$term', '$curr')");
    $updated = "Y";
endif;

?>

<img src="<?php echo plugins_url( 'images/Elgunvo.png', __FILE__ );  ?>" alt="Built By Elbuntu" />

<div style="text-align: right; margin-right: 2%;">
    <span style="float: left;">Profiles Manager for BuddyPress Version 1.5</span>
    <a href="?page=bpm-menu">Settings</a> | <a href="?page=bpm-profile">Profile Manager</a> | <a href="?page=bpm-commerce">Subscription Manager</a>
</div>

<br/>

<?php if($updated == "Y"): ?>
<div id="message" class="updated" style="margin-left: 0px; margin-right: 2%;">
	<p><strong>The changes are made :)</strong></p>
</div>
<?php endif; ?>
<div id="message" class="updated" style="margin-left: 0px; margin-right: 2%;">
	<p><strong>To embed the subscriptions table into the subscriptions page use the shortcode [bpm-form]</strong></p>
</div>

<h2>Subscription Types</h2>
<table class="widefat page" cellspacing="0" style="width:98%; margin-bottom: 10px;">
<thead>  
<tr>
<th>
Price
</th>
<th>
Membership Level
</th>
<th>
Term
</th>
<th>
Currency Code
</th>
<th>
</th>
</tr>
</thead>
<?php 
$currency = $wpdb->get_var($wpdb->prepare("SELECT option_value FROM bpm_settings WHERE option_name = 'currency';"));
$get_items = $wpdb->get_results("SELECT * FROM bpm_commerce");
foreach ($get_items as $item) {
?>
<form method="post" name="formid4">
<tr>
<td>
<?php echo $item->price; ?>
</td>
<td valign="middle">
<?php echo $item->membership; ?>
</td>
<td>
<?php echo $item->term; ?>
</td>
<td>
<?php echo $item->currency; ?>
</td>
<td>
<input type="button" onclick="window.location.href='?page=bpm-commerce&rmid=<?php echo $item->id; ?>'" class="button" value="Remove" style="float: right;" />
</td>
</tr>
</form>
<?php } ?>
<form method="post" action="#" name="pr_form4">
<tr>
<th>
<input type="text" value="" name="price" />
</th>
<th valign="middle">
<select name="membership">
<?php wp_dropdown_roles(); ?>
</select>
</th>
<th>
    <select name="term">
        <option>One-Time Payment</option>
        <option>Monthly</option>
        <option>Yearly</option>
    </select>
</th>
<th>
    <input type="hidden" name="currency" value="<?php echo $currency; ?>" />
    <strong><?php echo $currency; ?></strong>
</th>
<td>
<input type="hidden" name="formid" value="4" />
<input type="submit" class="button" style="margin-top: 6px; float: right;" value="+ Add Option" />
</td>
</tr>
</table>
</form>

<div style="text-align: right; margin-right: 2%;">
    <span style="float: left;">Created by Ashley Johnson</span>
    <a href="http://elbuntu.com">Developers Website</a> | <a href="https://twitter.com/Ashley_GJohnson">Developers Twitter</a> | <a href="https://www.linkedin.com/pub/ashley-johnson/33/6a7/a98">Developers LinkedIn</a>
</div>