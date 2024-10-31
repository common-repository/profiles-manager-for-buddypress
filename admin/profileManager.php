<?php
	global $wpdb;

	$groups = BP_XProfile_Group::get( array(
		'fetch_fields' => true
	));
	
	$license = "free"; //default license key
    $updated = ""; //Displays message when set to Y
	

    if($_GET['rmid']):
        $id = $_GET['rmid'];
        $wpdb->query(sprintf("DELETE FROM bpm_profile WHERE id='%s'", $id)); 
        $updated = "Y";
    endif;

    if($_GET['update']):
        $rndid = $_GET['update'];
        $new_pub = $_POST['public'];
        $new_mem = $_POST['member'];
        $wpdb->query(sprintf("UPDATE bpm_profile SET m_hidden='%s', p_hidden='%s' WHERE id='%s'", $new_mem, $new_pub, $rndid));
        $updated = "Y";
    endif;

    if($_POST['formid'] == "1"):
        $level = $_POST['level'];
        $group = $_POST['group'];
        $pub = $_POST['public'];
        $member = $_POST['member'];
        $wpdb->query(sprintf("INSERT INTO bpm_profile (wp_level, wp_group, m_hidden, p_hidden) VALUES ('%s', '%s', '%s', '%s')", $level, $group, $member, $pub));
        $updated = "Y";
    endif;

?>

<img src="<?php echo plugins_url( 'images/Elgunvo.png', __FILE__ );  ?>" alt="Built By Elbuntu" />

<div style="text-align: right; margin-right: 2%;">
    <span style="float: left;">Profiles Manager for BuddyPress Version 1.1</span>
    <a href="?page=bpm-menu">Settings</a> | <a href="?page=bpm-profile">Profile Manager</a> | <a href="?page=bpm-commerce">Subscription Manager</a>
</div>

<br />

<?php if($updated == "Y"): ?>
    <div id="message" class="updated" style="margin-left: 0px; width: 93.5%;">
    	<p><strong>Changes have been saved.</strong></p>
    </div>
<?php endif; ?>

<h2>Profile Group Configuration</h2>

<table class="widefat page" cellspacing="0" style="width:98%; margin-bottom: 10px;">
    <thead>  
        <tr>
            <th>Membership Level</th>
            <th>BuddyPress Group</th>
            <th>Visibility (Member)</th>
            <th>Visibility (Public)</th>
            <th></th>
        </tr>
    </thead>
    <?php 
    $get_items = $wpdb->get_results("SELECT * FROM bpm_profile");
    $i = '0';
    foreach ($get_items as $item) {
    ?>
    <form method="post" action="?page=bpm-profile&update=<?php echo $item->id; ?>" name="update">
    <tr>
        <td><?php echo $item->wp_level; ?></td>
        <td><?php echo $item->wp_group; ?></td>
        <td>
            <select name="member">
                <option value="<?php echo $item->member_hidden; ?>"><?php echo $item->m_hidden; ?></option>
                <option value="hidden">Hidden</option>
                <option value="shown">Shown</option>
            </select>
        </td>
        <td>
            <select name="public">
                <option value="<?php echo $item->public_hidden; ?>"><?php echo $item->p_hidden; ?></option>
                <option value="hidden">Hidden</option>
                <option value="shown">Shown</option>
            </select>
        </td>
        <td>
            <input type="button" onclick="window.location.href='?page=bpm-profile&rmid=<?php echo $item->id; ?>'" class="button" value="Remove" style="float: right;" />
            <input type="submit" class="button" value="Update" style="float: right; margin-right: 5px;" />
        </td>
    </tr>
    </form>
    <?php } ?>

<form method="post" action="#" name="pr_form2">
    <tr>
        <th valign="middle">
            <select name="level">
                <?php wp_dropdown_roles(); ?>
            </select>
        </th>
        <th valign="middle">
            <select name="group">
                <?php
                    for ( $i = 0; $i < count($groups); $i++ ) { // TODO: foreach
                        echo "<option value='" . sanitize_title( $groups[$i]->name ) . "'>";
                        echo $groups[$i]->name;
                        echo "</option>";
                    }
                ?>
            </select>
            <input type="hidden" name="formid" value="1" />
        </th>
        <th valign="middle" align="center">
            <select name="member">
                <option value="hidden">Hidden</option>
                <option value="shown">Shown</option>
            </select>
        </th>
        <th valign="middle" align="center">
            <select name="public">
                <option value="hidden">Hidden</option>
                <option value="shown">Shown</option>
            </select>
        </th>
        <td>
            <input type="submit" class="button" style="margin-top: 6px; float: right;" value="+ Add To Rules" />
            <input type="hidden" value="1" name="formid" />
        </td>
    </tr>
</form>
</table>

<div style="text-align: right; margin-right: 2%;">
    <span style="float: left;">Created by Ashley Johnson</span>
    <a href="http://elbuntu.com">Developers Website</a> | <a href="https://twitter.com/Ashley_GJohnson">Developers Twitter</a> | <a href="https://www.linkedin.com/pub/ashley-johnson/33/6a7/a98">Developers LinkedIn</a>
</div>