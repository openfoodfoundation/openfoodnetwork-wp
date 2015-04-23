<?php
/* GOOGLE ADSENSE RESPONSIVE ADS */
if(!function_exists('cactus_echo_responsive_ad')){
	function cactus_echo_responsive_ad($publisher_id,$ad_slot_id){
		$idx = rand(0,1000);
?>
    <div id="google-ads-<?php echo $idx;?>"></div>
     
    <script type="text/javascript">
     
    /* Calculate the width of available ad space */
    ad = document.getElementById('google-ads-<?php echo $idx;?>');
     
    if (ad.getBoundingClientRect().width) {
		adWidth = ad.getBoundingClientRect().width; // for modern browsers
    } else {
		adWidth = ad.offsetWidth; // for old IE
    }
     
    /* Replace ca-pub-XXX with your AdSense Publisher ID */
    google_ad_client = '<?php echo $publisher_id;?>';
     
    /* Replace 1234567890 with the AdSense Ad Slot ID */
    google_ad_slot = '<?php echo $ad_slot_id;?>';

    /* Do not change anything after this line */
    if ( adWidth >= 728 )
    google_ad_size = ["728", "90"]; /* Leaderboard 728x90 */
    else if ( adWidth >= 468 )
    google_ad_size = ["468", "60"]; /* Banner (468 x 60) */
    else if ( adWidth >= 336 )
    google_ad_size = ["336", "280"]; /* Large Rectangle (336 x 280) */
    else if ( adWidth >= 300 )
    google_ad_size = ["300", "250"]; /* Medium Rectangle (300 x 250) */
    else if ( adWidth >= 250 )
    google_ad_size = ["250", "250"]; /* Square (250 x 250) */
    else if ( adWidth >= 200 )
    google_ad_size = ["200", "200"]; /* Small Square (200 x 200) */
    else if ( adWidth >= 180 )
    google_ad_size = ["180", "150"]; /* Small Rectangle (180 x 150) */
    else
    google_ad_size = ["125", "125"]; /* Button (125 x 125) */
     
    document.write (
    '<ins class="adsbygoogle" style="display:inline-block;width:'
    + google_ad_size[0] + 'px;height:'
    + google_ad_size[1] + 'px" data-ad-client="'
    + google_ad_client + '" data-ad-slot="'
    + google_ad_slot + '"></ins>'
    );
    (adsbygoogle = window.adsbygoogle || []).push({});
     
    </script>
     
    <script async src="http://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js">
    </script>
<?php
	}
}

if(!function_exists('cactus_display_ads')){
	function cactus_display_ads($section){
	$ad_top_1 = ot_get_option($section);
	$adsense_publisher_id = ot_get_option('adsense_id');
	$adsense_slot_top_1 = ot_get_option('adsense_slot_' . $section);
	if($adsense_publisher_id != '' && $adsense_slot_top_1 != ''){
?>
		<div class='ad <?php echo $section;?>'><?php cactus_echo_responsive_ad($adsense_publisher_id, $adsense_slot_top_1);?></div>
	<?php
	} elseif($ad_top_1 != ''){?>
		<div class='ad <?php echo $section;?>'><?php echo $ad_top_1;?></div>
	<?php }
	}
}

if(!function_exists('tm_adsense_responsive')){
	function tm_adsense_responsive($atts){
		$pub_id = '';
		$slot_id = '';
		$class = '';
		if(isset($atts['pub']) && $atts['pub'] != '') $pub_id = $atts['pub'];
		if(isset($atts['slot']) && $atts['slot'] != '') $slot_id = $atts['slot'];
		if(isset($atts['class']) && $atts['class'] != '') $class = $atts['class'];
		
		if($pub_id != '' && $slot_id != ''){
?>
		<div class='ad <?php echo $class;?>'><?php cactus_echo_responsive_ad($pub_id,$slot_id);?></div>
<?php
		}
	}
}
add_shortcode('adsense','tm_adsense_responsive');
/* end GOOGLE ADSENSE RESPONSIVE ADS SUPPORT*/