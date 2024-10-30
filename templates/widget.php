<?php
// Get all script from db
global $wpdb;
$table_name_link = $wpdb->prefix . 'klikwa_links';
$link_db = $wpdb->get_row("SELECT * FROM {$table_name_link} WHERE id=1");

$pop_up_event_click = $link_db->pop_up_event_click ?? "";
$chat_event_click = $link_db->chat_event_click ?? "";

// Remove escape slash (\)
$pop_up_event_click = stripslashes($pop_up_event_click);
$chat_event_click = stripslashes($chat_event_click);

// Get all general data from db
$table_name_general = $wpdb->prefix . 'klikwa_general';

$general_db = $wpdb->get_row("SELECT * FROM {$table_name_general} WHERE id=1");
$float_style = $general_db->float_style;
$float_text = $general_db->float_text;
$headline = $general_db->headline;
$sub_headline = $general_db->sub_headline;
$t_response = $general_db->t_response;
$bubble_side = $general_db->bubble_side;

?>

<div class="page-user" style="cursor:pointer">
    <div class="whatsapp-float <?php echo $bubble_side == "Left" ? "__left" : "" ?>">
        <div class="whatsapp-float__inner animate__animated animate__zoomIn" id="whatsappInner">
            <div class="inner-head">
                <i class="fa fa-whatsapp"></i>
                <div class="inner-head__text">
                    <h3><?php echo $headline ?></h3>
                    <p><?php echo $sub_headline ?></p>
                </div>
            </div>
            <div class="inner-body">
                <div class="typical-response">
                    <p><?php echo $t_response ?></p>
                </div>
                <div class="support-list">
                    <?php
                    $table_name_cs = $wpdb->prefix . 'klikwa_cs';
                    $cs_dbs = $wpdb->get_results("SELECT * FROM {$table_name_cs}");
                    ?>

                    <?php foreach ($cs_dbs as $cs_db) { ?>
                        <!-- cek if cs is active -->
                        <?php if ($cs_db->active_status == 'Yes') : ?>
                            <a onclick="chatClick()" href="<?php echo $cs_db->link ?>" target="_blank" class="support-item" style="text-decoration: none; color: inherit;">
                                <img src="<?php echo $cs_db->image_path ?>" alt="" class="support-image">
                                <div class="support-text">
                                    <div class="text-hold">
                                        <div class="support__name">
                                            <h4><?php echo $cs_db->name ?></h4>
                                        </div>
                                        <div class="support__job-title">
                                            <p><?php echo $cs_db->title ?></p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        <?php endif; ?>
                    <?php } ?>

                </div>
                <div class="powerred-by text-center text-secondary">
                    <p>Whatsapp Button Widget by <a href="http://klikwa.net/">klikWA.net</a></p>
                </div>
            </div>
        </div>
        <div class="whatsapp-float__outer">
            <div class="outer-hold">
                <p onclick="whatsappClick();popupClick();" class="whatsapp-label" id="whatsappLabel" style="<?php echo $float_style == "I" ? "display: none;" : "" ?>"><?php echo $float_text ?></p>
                <a onclick="whatsappClick();popupClick();" class="whatsapp-button">
                    <div class="icon-hold">
                        <i class="fa fa-whatsapp whatsapp-button__icon" id="whatsappButtonIcon" style="width: 33px;margin-top: 8px;"></i>
                    </div>

                    <?php if ($float_style == 'ITB') : ?>
                        <span class="notification-bubble" id="whatsappBubble" style="opacity: 0;">
                            1
                        </span>
                    <?php endif; ?>

                </a>
            </div>
        </div>
    </div>
</div>

<!-- Script to add script from db -->
<?php
// Function to add popup and chat clicked
echo "
        <script defer>
        function chatClick() {
            $chat_event_click
        }
        function popupClick() {
            $pop_up_event_click
        }
        </script>
    ";
?>

<script defer>
    var whatsappButtonIcon = document.getElementById("whatsappButtonIcon");
    var whatsapplabel = document.getElementById("whatsappLabel");
    var whatsappBubble = document.getElementById("whatsappBubble");

    // show bubble on 10 seconds
    window.onload = function() {
        setTimeout(function() {
            whatsappBubble.className = "notification-bubble animate__animated animate__fadeIn"
        }, 10000);
    }

    function whatsappClick() {

        if (whatsappButtonIcon.className === "fa fa-whatsapp whatsapp-button__icon") {
            whatsapplabel.className = "whatsapp-label animate__animated animate__fadeOutDown";
            whatsappButtonIcon.className = "fal fa-times whatsapp-button__icon animate__animated animate__rotateIn";
            document.getElementById("whatsappInner").style.display = "block";

            whatsappBubble.className = "notification-bubble animate__animated animate__fadeOut";
        } else if (whatsappButtonIcon.className === "fal fa-times whatsapp-button__icon animate__animated animate__rotateIn") {
            whatsapplabel.className = "whatsapp-label animate__animated animate__fadeInUp";
            whatsappButtonIcon.className = "fa fa-whatsapp whatsapp-button__icon animate__animated animate__fadeIn";
            document.getElementById("whatsappInner").className = "whatsapp-float__inner animate__animated animate__zoomOut";

            whatsappBubble.className = "notification-bubble animate__animated animate__fadeIn";
        } else if (whatsappButtonIcon.className === "fa fa-whatsapp whatsapp-button__icon animate__animated animate__fadeIn") {
            whatsapplabel.className = "whatsapp-label animate__animated animate__fadeOutDown";
            whatsappButtonIcon.className = "fal fa-times whatsapp-button__icon animate__animated animate__rotateIn";
            document.getElementById("whatsappInner").style.display = "block";
            document.getElementById("whatsappInner").className = "whatsapp-float__inner animate__animated animate__zoomIn";

            whatsappBubble.className = "notification-bubble animate__animated animate__fadeOut";

        }
    }
</script>