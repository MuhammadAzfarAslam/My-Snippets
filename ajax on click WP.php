<script>
  // 
  // Add following code in footer, header or anywhere JS works (action name should be same as function name in function.php)
  // 

  jQuery('.zoom_info a.stm-join-btn').click(function(event) {
    var href = jQuery('a.btn.stm-join-btn.outline').attr('href');
    var hrefArr = href.split("/");
    var last = hrefArr[hrefArr.length - 1]
    let lesson_id = stm_lms_lesson_id;
    var btn_click = false;
    jQuery('.zoom_info a.stm-join-btn').attr("disabled", "disabled");
    console.log("I am Clicked");
    console.log(my_script_vars.postID);
    if (btn_click == false) {
      jQuery.ajax({
        type: "POST",
        url: my_ajax_object.ajax_url,
        data: {
          'action': 'update_view_pref',
          'last': last,
          'lesson_id': lesson_id
        },
        success: function(data) {
          //console.log(data);
          console.log("success!");
          btn_click = true;
          jQuery('.zoom_info a.stm-join-btn').removeAttr('disabled').click();
        },
        error: function(errorThrown) {
          console.log(data);
          console.log(errorThrown);
          console.log("fail");
        }
      });
    }
  });
</script>


<?php
//
// Add this code in function.php (Function name should be same as action name in Ajax)
// 
add_action('wp_ajax_update_view_pref', 'update_view_pref');
function update_view_pref()
{
  if (empty($_POST) || !isset($_POST)) {
    ajaxStatus('error', 'Nothing to update.');
  } else {
    try {
      $user = wp_get_current_user();
      $user_meta = get_user_meta(get_current_user_id(), '_wpuf_subscription_pack', true);
      $subscription_pack_unserialize  = $user_meta;
      $subscription_pack_unserialize['posts']['post'] = $subscription_pack_unserialize['posts']['post'] + 1;
      $update = update_usermeta(get_current_user_id(), '_wpuf_subscription_pack', $subscription_pack_unserialize);
      if (is_wp_error($update)) {
        $error_code = array_key_first($update->errors);
        print_r($error_code);
        echo $error_message = $update->errors[$error_code][0];
      } else {
        echo "no error";
      }
      print_r($subscription_pack_unserialize);
    } catch (Exception $e) {
      echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
  }
}

function my_enqueue()
{
  wp_enqueue_script('ajax-script', get_template_directory_uri() . '/assets/js/zoom_meeting.js', array('jquery'));
  wp_localize_script('ajax-script', 'my_ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts', 'my_enqueue');

function th_form_register_script()
{
  wp_localize_script('th_form_js', 'myAjax', array(
    'ajaxurl' => admin_url('admin-ajax.php'),
    'nonce' => wp_create_nonce('ajax-nonce')
  ));
  $theme_url = get_template_directory_uri();
  wp_enqueue_script("th_form_js", $theme_url . '/assets/js/zoom_meeting.js', array(), '1.1', false);
}
add_action('wp_enqueue_scripts', 'th_form_register_script');
?>


<script>
  jQuery(document).ready(function() {
    jQuery('.zoom_info a.stm-join-btn').click(function(event) {
      event.preventDefault();
      console.log("I am Clicked");
      var newViewPreference = "Hello World";
      jQuery.ajax({
        type: "POST",
        url: `${ajax_url}`,
        data: {
          'action': 'update_view_pref',
          //'viewPref': newViewPreference
        },
        success: function(data) {
          console.log(data);
          console.log("success!");
          //         $( 'a.wpuf-posts-options.wpuf-posts-delete' ).click();
        },
        error: function(errorThrown) {
          console.log(errorThrown);
          console.log("fail");
        }
      });
    });
  });
</script>


<script>
  var href = jQuery('a.btn.stm-join-btn.outline').attr('href');
  var hrefArr = href.split("/");
  var last = hrefArr[hrefArr.length - 1]
  console.log(last);
</script>


<?php
function zoom_function()
{
  $user = wp_get_current_user();
  global $post;
  $curl = curl_init();
  global $wpdb;
  $mcourse_id = $_COOKIE['course_id'];
  $results = $wpdb->get_row("SELECT `meeting_id` FROM `wp_zoom_api` where `user_email` = '$user->user_email' AND `course_id`= $mcourse_id");
  echo $results;
    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.zoom.us/v2/report/meetings/$results->meeting_id/participants",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => array(
        "authorization: Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOm51bGwsImlzcyI6IllISXpiY1hjVGppbjlBTWU0NjR4YmciLCJleHAiOjE2NTUxOTc2ODAsImlhdCI6MTYyMzY1NjM0N30.u3N-ldYyGK2L47BBQLox9Ssm0BtqQw0RmBr2G3s-_PU",
        "content-type: application/json"
      ),
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
    $dat = json_decode($response);
    echo "<pre>";
    print_r($dat);
    echo "</pre>";
    echo $result->meeting_id;
}
add_shortcode('zoom_validation', 'zoom_function');

?>


$P$BCFlfhX4PJgOcGenVawPVig9UgNFcH/