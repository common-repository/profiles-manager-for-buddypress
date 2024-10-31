<?php
global $current_user;
	$user_name = $current_user->user_login;
global $wpdb;
    $get_items = $wpdb->get_results("SELECT * FROM bpm_commerce");
    $pay_email = $wpdb->get_var($wpdb->prepare("SELECT option_value FROM bpm_settings WHERE option_name = '%s';", "paypal"));
    $currency = $wpdb->get_var($wpdb->prepare("SELECT option_value FROM bpm_settings WHERE option_name = '%s';", "currency"));
    
?>
    <table cellpadding='5' border='0' style='width:600px!important'>
    <tr>
    <td>Membership</td>
    <td>Term</td>
    <td>Price</td>
    <td></td>
    </tr>
<?php
    foreach ($get_items as $item) {
        echo "<tr>";
        echo "<td>".$item->membership."</td>";
        echo "<td>".$item->term."</td>";
        echo "<td>".$item->price.",- ".$currency."</td>";
        if ($item->term == "One-Time Payment"):
        echo <<<CONTENT
            <td>
                <form name="_xclick" action="https://www.paypal.com/cgi-bin/webscr" method="post">
                <input type="hidden" name="cmd" value="_xclick">
                <input type="hidden" name="business" value="$pay_email">
                <input type="hidden" name="item_name" value="Upgrade to $item->membership, User: $user_name">
                <input type="hidden" name="currency_code" value="$currency">
                <input type="hidden" name="amount" value="$item->price"> 
                <input type="hidden" name="return" value=""> 
                <input type="submit" value="Proceed & Pay" />
                </form>
           </td>
CONTENT;
        elseif ($item->term == "Monthly"): 
        echo <<<CONTENT
            <td>
                <form action="https://www.paypal.com/cgi-bin/webscr" method="post">  
                <input type="hidden" name="business" value="$pay_email">  
                <input type="hidden" name="cmd" value="_xclick-subscriptions">  
 
                <!-- Identify the subscription. -->  
                <input type="hidden" name="item_name" value="Upgrade to $item->membership">
                <input type="hidden" name="item_number" value="User: $user_name"> 
                <input type="hidden" name="currency_code" value="$currency">
                <input type="hidden" name="a3" value="$item->price">   <!-- Subscription Amount --> 
                <input type="hidden" name="p3" value="1">     <!-- Duration  1 --> 
                <input type="hidden" name="t3" value="M">    <!-- Frequency Month --> 
                <input type="submit" value="Proceed & Pay" />
                </form> 
           </td>
CONTENT;
        elseif ($item->term == "Yearly"):
        echo <<<CONTENT
            <td>
                <form action="https://www.paypal.com/cgi-bin/webscr" method="post">  
                <input type="hidden" name="business" value="$pay_email">  
                <input type="hidden" name="cmd" value="_xclick-subscriptions">  
 
                <!-- Identify the subscription. -->  
                <input type="hidden" name="item_name" value="Upgrade to $item->membership">
                <input type="hidden" name="item_number" value="User: $user_name"> 
                <input type="hidden" name="currency_code" value="$currency">
                <input type="hidden" name="a3" value="$item->price">   <!-- Subscription Amount --> 
                <input type="hidden" name="p3" value="1">     <!-- Duration  1 --> 
                <input type="hidden" name="t3" value="Y">    <!-- Frequency Year --> 
                <input type="submit" value="Proceed & Pay" />
                </form> 
           </td>
CONTENT;
        endif;
        echo "</tr>";
    }
    
?>
</table>