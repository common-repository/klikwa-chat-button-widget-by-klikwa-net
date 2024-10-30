<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Need a Floating Whatsapp Button on Website that link to your number? Enable your visitor to Click and start Chat with your Business on their Phone (open Whatapp web in Desktop). klikWA Whatsapp link Button/Widget on Website for Wordpress is for You.">

	<script>
		jQuery(document).ready(function() {
			var tabs = document.querySelectorAll("ul.nav-tabs > li");

			for (i = 0; i < tabs.length; i++) {
				tabs[i].addEventListener("click", switchTab);
			}

			function switchTab(event) {
				event.preventDefault();

				document.querySelector("ul.nav-tabs li.active").classList.remove("active");
				document.querySelector(".tab-pane.active").classList.remove("active");

				var clickedTab = event.currentTarget;
				var anchor = event.target;
				var activePaneID = anchor.getAttribute("href");

				clickedTab.classList.add("active");
				document.querySelector(activePaneID).classList.add("active");

				window.localStorage.setItem('tabHref', activePaneID);
			}
			var tabHref = window.localStorage.getItem('tabHref');
			var tabNumber = tabHref.replace(/\D/g, "");
			var anchorId = "li#anchor-to-" + tabNumber;

			jQuery(window.location).attr('href', tabHref);

			document.querySelector(".tab-pane.active").classList.remove("active");
			document.querySelector(tabHref).classList.add("active");

			document.querySelector("ul.nav-tabs li.active").classList.remove("active");
			document.querySelector(anchorId).classList.add("active");
		});
	</script>
</head>

<body>
	<!-- BELOW THIS IS THE LIST OF FUNCTION FOR INSERTING DATABASE WITH MYSQL METHOD -->

	<?php
	global $wpdb;

	// --- Function TAB 2 TWO -- General Tab DISPLAY DATA --

	$table_name_general = $wpdb->prefix . 'klikwa_general';

	$general_db = $wpdb->get_row("SELECT * FROM {$table_name_general} WHERE id=1");
	$float_style = isset($general_db->float_style) ? $general_db->float_style : "";
	$float_text = isset($general_db->float_text) ? $general_db->float_text : "";
	$headline = isset($general_db->headline) ? $general_db->headline : "";
	$sub_headline = isset($general_db->sub_headline) ? $general_db->sub_headline : "";
	$t_response = isset($general_db->t_response) ? $general_db->t_response : "";
	$bubble_side = isset($general_db->bubble_side) ? $general_db->bubble_side : "";

	// Function TAB 2 TWO -- General Tab CREATE & UPDATE 

	if (isset($_POST['submit_general'])) {
		$float_style_post = sanitize_text_field($_POST['float_style']);
		$float_text_post = sanitize_text_field($_POST['float_text']);
		$headline_post = sanitize_text_field($_POST['headline']);
		$sub_headline_post = sanitize_text_field($_POST['sub_headline']);
		$t_response_post = sanitize_text_field($_POST['t_response']);
		$bubble_side_post = sanitize_text_field($_POST['bubble_side']);

		if (!empty($general_db)) {
			// If the table is not empty then we have to update it.

			$wpdb->update(
				$table_name_general,
				[ // inserting the 'table on sql' => $data from _POST
					'float_style' => $float_style_post,
					'float_text' => $float_text_post,
					'headline' => $headline_post,
					'sub_headline' => $sub_headline_post,
					't_response' => $t_response_post,
					'bubble_side' => $bubble_side_post
				],
				[
					// target which query that we want to target
					'id' => 1
				],
				[ // validator for each field, if theres empty field it would return error.
					'%s', // float_style
					'%s', // float_text
					'%s', // headline
					'%s', // sub_headline
					'%s', // t_response
					'%s'  // bubble_side
				]
			);
		} else {
			// if the table is empty then we have to create it

			$wpdb->insert(
				$table_name_general,
				[ // inserting the 'table on sql' => $data from _POST
					'float_style' => $float_style_post,
					'float_text' => $float_text_post,
					'headline' => $headline_post,
					'sub_headline' => $sub_headline_post,
					't_response' => $t_response_post,
					'bubble_side' => $bubble_side_post
				],
				[ // validator for each field, if theres empty field it would return error.
					'%s', // float_style
					'%s', // float_text
					'%s', // headline
					'%s', // sub_headline
					'%s', // t_response
					'%s'  // bubble_side
				]
			);
		}
		// reload page after updated
		echo '<script type="text/JavaScript">window.location.reload()</script>';
	}

	// --- Function TAB 3 THREE -- CS Tab DISPLAY DATA --

	$table_name_cs = $wpdb->prefix . 'klikwa_cs';

	$cs_dbs = $wpdb->get_results("SELECT * FROM {$table_name_cs}");
	// Get count
	$cs_dbs_count = $wpdb->num_rows;

	// Function TAB 3 THREE -- Add CS
	if (isset($_POST['add_cs_button'])) {
		$name_post = sanitize_text_field($_POST['addcs_name']);
		$title_post = sanitize_text_field($_POST['addcs_title']);
		$link_post = sanitize_text_field($_POST['addcs_link']);

		// target directory and files for images
		$target_dir_array = wp_upload_dir();
		$target_dir = $target_dir_array['path'];
		$target_file = $target_dir . basename(sanitize_file_name($_FILES['addcs_image_path']['name']));

		if (move_uploaded_file($_FILES['addcs_image_path']['tmp_name'], $target_file)) {
			// echo wp_get_upload_dir()['url'] . $_FILES['addcs_image_path']['name'];
		} else {
			echo 'No Images has been uploaded';
		}

		$wpdb->insert(
			$table_name_cs,
			[ // inserting the 'table on sql' => $data from _POST
				'name' => $name_post,
				'title' => $title_post,
				'link' => $link_post,
				'image_path' => wp_get_upload_dir()['url'] .sanitize_file_name($_FILES['addcs_image_path']['name']),
				'active_status' => 'Yes',
				'default_data' => 'No'
			],
			[ // validator for each field, if theres empty field it would return error.
				'%s', // name
				'%s', // title
				'%s', // link
				'%s', // image_path
				'%s', // active_status
				'%s'  // default_data
			]
		);

		// reload page after updated
		echo '<script type="text/JavaScript">window.location.reload()</script>';
	}

	// ------------------------------------------------------------------------

	// --- Function TAB 4 FOUR -- Script Tab DISPLAY DATA --

	$table_name_link = $wpdb->prefix . 'klikwa_links';

	$link_db = $wpdb->get_row("SELECT * FROM {$table_name_link} WHERE id=1");
	$l_script = isset($link_db->l_script) ? $link_db->l_script : "";
	$pop_up_event_click = isset($link_db->pop_up_event_click) ? $link_db->pop_up_event_click : "";
	$chat_event_click = isset($link_db->chat_event_click) ? $link_db->chat_event_click : "";

	// Remove escape slash (\)
	$l_script = stripslashes($l_script);
	$pop_up_event_click = stripslashes($pop_up_event_click);
	$chat_event_click = stripslashes($chat_event_click);

	// Function TAB 4 FOUR -- Script Tab CREATE & UPDATE 
	if (isset($_POST['submit_links'])) {
		$l_script_post = sanitize_text_field($_POST['l_script']);
		$pop_up_event_click_post = sanitize_text_field($_POST['pop_up_event_click']);
		$chat_event_click_post = sanitize_text_field($_POST['chat_event_click']);

		if (!empty($link_db)) {
			// If the table is not empty then we have to update it.

			$wpdb->update(
				$table_name_link,
				[ // inserting the 'table on sql' => $data from _POST
					'l_script' => $l_script_post,
					'pop_up_event_click' => $pop_up_event_click_post,
					'chat_event_click' => $chat_event_click_post
				],
				[
					// target which query that we want to target
					'id' => 1
				],
				[ // validator for each field, if theres empty field it would return error.
					'%s', // l_script
					'%s', // pop_up_event_click
					'%s', // chat_event_click
				]
			);
		} else {
			// if the table is empty then we have to create it

			$wpdb->insert(
				$table_name_link,
				[ // inserting the 'table on sql' => $data from _POST
					'l_script' => $l_script_post,
					'pop_up_event_click' => $pop_up_event_click_post,
					'chat_event_click' => $chat_event_click_post
				],
				[ // validator for each field, if theres empty field it would return error.
					'%s', // l_script
					'%s', // pop_up_event_click
					'%s', // chat_event_click
				]
			);
		}

		// reload page after updated
		echo '<script type="text/JavaScript">window.location.reload()</script>';
	}

	?>
	<div class="wrap page-admin">
		<h1>KlikWA Plugin</h1>
		<?php settings_errors(); ?>

		<ul class="nav nav-tabs">
			<li class="active" id="anchor-to-1"><a href="#tab-1" class="nav-tab__item">Welcome</a></li>
			<li id="anchor-to-2"><a href="#tab-2" class="nav-tab__item">General</a></li>
			<li id="anchor-to-3"><a href="#tab-3" class="nav-tab__item">Whatsapp</a></li>
			<li id="anchor-to-4"><a href="#tab-4" class="nav-tab__item">Script</a></li>
			<li id="anchor-to-5"><a href="#tab-5" class="nav-tab__item">Analytic</a></li>
		</ul>

		<!------- TAB 1 ONE------->
		<div class="tab-content">
			<div id="tab-1" class="tab-pane active">
				<div class="tab-contain">
					<div class="tab-title">
						<h1>Watch this video below to Setup your <br> Whatsapp Button in 5 minutes.</h1>
					</div>
					<div class="tab-desc">
						<p>
							Enable your visitor to Click and Start Chatting with your Business on their Phone (open Whatapp web in Desktop).
						</p>
						<p>
							✔️ How to Add Multi Whatsapp Destination/Department
							<br>
							✔️ Boost Conversion using default Chat message
							<br>
							✔️ Setup Conversion Tracking (FB & Google Tag manager)
							<br>
							✔️ Analytic: Track clicks for each Campaign, Traffic Source
						</p>
					</div>
					<div class="klikwa__video">
						<iframe src="https://www.youtube.com/embed/4U76b4LCCE4" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
					</div>
					<div class="klikwa__cta">
						<button class="btn-success btn">
							Call to Action
						</button>
					</div>
					<div class="klikwa__link-list">
						<ul>
							<li>
								<a href="http://klikwa.net/">klikWA.net</a>
							</li>
							<li>
								<p>1 Whatsapp</p>
							</li>
							<li>
								<p>Send WA OTP, Order Notification via API</p>
							</li>
						</ul>
					</div>
				</div>
			</div>

			<!------- TAB 2 TWO------->
			<div id="tab-2" class="tab-pane">
				<div class="tab-contain">
					<div class="tab-title">
						<h1>General</h1>
					</div>

					<a href="https://www.klikwa.net/" target="_blank" rel="noopener noreferrer">
						<button class="submit-btn btn btn-success" type="button">
							Upgrade
						</button>
					</a>

					<form method="post">
						<div class="form-table">
							<div class="form-row">
								<div class="form-group row">
									<label class="col-lg-3">Display</label>
									<div class="col-lg-9">
										<select class="input-class custom-select" name="float_style">
											<option value="ITB" <?php if ($float_style == 'ITB') echo 'selected'; ?>>Icon + Text + Baloon</option>
											<option value="IT" <?php if ($float_style == 'IT') echo 'selected'; ?>>Icon + Text</option>
											<option value="I" <?php if ($float_style == 'I') echo 'selected'; ?>>Icon only</option>
										</select>
									</div>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group row">
									<label class="col-lg-3">Float Text</label>
									<div class="col-lg-9">
										<input class="input-class form-control" type="text" name="float_text" value="<?php echo $float_text; ?>" placeholder="Start a Conversation" required>
									</div>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group row">
									<label class="col-lg-3">Headline</label>
									<div class="col-lg-9">
										<input class="input-class form-control" type="text" name="headline" value="<?php echo $headline; ?>" placeholder="e.g. Start a conversation" required>
									</div>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group row">
									<label class="col-lg-3">Subhead</label>
									<div class="col-lg-9">
										<input class="input-class form-control" type="text" name="sub_headline" value="<?php echo $sub_headline; ?>" placeholder="Hi! Please click one of our member below to chat on Whatsapp" required>
									</div>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group row">
									<label class="col-lg-3">Typical response</label>
									<div class="col-lg-9">
										<input class="input-class form-control" type="text" name="t_response" value="<?php echo $t_response; ?>" placeholder="Typically response in 5 minutes !" required>
									</div>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group row">
									<label class="col-lg-3">Bubble Chat Placement</label>
									<div class="col-lg-9">
										<div class="row">
											<div class="input-half-row col-md-6 custom-radio">
												<input name="bubble_side" type="radio" class="custom-control-input" id="floatLeft" value="Left" <?php if ($bubble_side == 'Left') echo 'checked'; ?>>
												<label class="custom-control-label" for="floatLeft">Float bottom left</label>
											</div>
											<div class="input-half-row col-md-6 custom-radio">
												<input name="bubble_side" type="radio" class="custom-control-input" id="floatRight" value="Right" <?php if ($bubble_side == 'Right') echo 'checked'; ?> <?php if (!isset($bubble_side)) echo 'checked'; ?>>
												<label class="custom-control-label" for="floatRight">Float bottom right</label>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="submit-toggle">
								<button class="submit-btn btn btn-success" type="submit" name="submit_general">
									Submit
								</button>
							</div>
						</div>
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
									<?php foreach ($cs_dbs as $cs_db) { ?>
										<div class="support-item" style="cursor:pointer">
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
										</div>
									<?php } ?>
								</div>
								<div class="powerred-by text-center">
									<p>Whatsapp Button Widget by <a href="http://klikwa.net/">klikWA.net</a></p>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>

			<!------- TAB 3 THREE------->
			<div id="tab-3" class="tab-pane">
				<form method="post" enctype="multipart/form-data">
					<div class="tab-contain">
						<div class="tab-title">
							<h1>Customer Service</h1>
						</div>

						<div class="add-cs-toggle">
							<?php if ($cs_dbs_count < 3) : ?>
								<button class="add-cs-btn btn btn-success" type="button" id="addCSButton" data-toggle="modal" data-target="#modalAddCS">
									+ Add CS
								</button>
							<?php else : ?>
								<button class="add-cs-btn btn btn-success" type="button" id="addCSButton" data-toggle="modal" data-target="#modalAddLimitCS">
									+ Add CS
								</button>
							<?php endif; ?>
						</div>

						<?php foreach ($cs_dbs as $cs_db) { ?>
							<div class="form-table">
								<div class="support-list" id="csList">
									<div class="support-item">
										<div class="left-col">
											<div class="support-img-row">
												<img src="<?php echo $cs_db->image_path ?>" alt="" class="support-img__preview" />
												<?php $editcs_image_path_target = "editcs_image_path" . $cs_db->id; ?>
												<input type="file" class="support-img__upload" name="<?php echo $editcs_image_path_target; ?>">
											</div>
											<div class="support-input">
												<div class="form-table">
													<div class="form-row">
														<div class="form-group row">
															<label class="col-lg-3">Name</label>
															<div class="col-lg-9">
																<?php $target_editcs_name = "editcs_name" . $cs_db->id; ?>
																<input class="input-class form-control" type="text" name="<?php echo $target_editcs_name; ?>" value="<?php echo $cs_db->name ?>" placeholder="e.g. Tommy Wilton" required>
															</div>
														</div>
													</div>
													<div class="form-row">
														<div class="form-group row">
															<label class="col-lg-3">Job Title</label>
															<div class="col-lg-9">
																<?php $target_editcs_title = "editcs_title" . $cs_db->id; ?>
																<input class="input-class form-control" type="text" name="<?php echo $target_editcs_title; ?>" value="<?php echo $cs_db->title ?>" placeholder="e.g. Customer Support" required>
															</div>
														</div>
													</div>
													<div class="form-row">
														<div class="form-group row">
															<label class="col-lg-3">Link</label>
															<div class="col-lg-9">
																<?php $target_editcs_link = "editcs_link" . $cs_db->id; ?>
																<input class="input-class form-control" type="text" name="<?php echo $target_editcs_link; ?>" value="<?php echo $cs_db->link ?>" placeholder="e.g. Link to Something" required>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="right-col">
											<div class="form-table">
												<div class="form-row">
													<?php $target_editcs_active_status = "editcs_active_status" . $cs_db->id; ?>
													<div class="custom-control custom-checkbox">
														<input name="<?php echo $target_editcs_active_status ?>" type="checkbox" class="custom-control-input" id="aktif.<?php echo $cs_db->id ?>" <?php if ($cs_db->active_status == 'Yes') echo 'checked'; ?>>
														<label class="custom-control-label" for="aktif.<?php echo $cs_db->id ?>">Aktif</label>
													</div>
												</div>
											</div>
										</div>
										<div class="submit-toggle mt-4">
											<?php
											$editCSButton = "cs_edit" . $cs_db->id;
											$deleteCSButton = "cs_delete" . $cs_db->id;
											?>
											<button class="submit-btn btn btn-success" type="submit" name="cs_edit<?php echo $cs_db->id; ?>">
												Save Edit
											</button>
											<button class="submit-btn btn btn-danger" type="submit" name="cs_delete<?php echo $cs_db->id; ?>">
												Delete
											</button>

											<?php

											// Function TAB 3 THREE -- Delete CS
											if (isset($_POST[$deleteCSButton])) {
												$wpdb->delete($table_name_cs, array('id' => $cs_db->id));

												// reload page after updated
												echo '<script type="text/JavaScript">window.location.reload()</script>';
											}

											// Function TAB 3 THREE -- Edit CS

											if (isset($_POST[$editCSButton])) {
												$edit_name_post = sanitize_text_field($_POST[$target_editcs_name]);
												$edit_title_post = sanitize_text_field($_POST[$target_editcs_title]);
												$edit_link_post = sanitize_text_field($_POST[$target_editcs_link]);
												$edit_active_status_post = isset($_POST[$target_editcs_active_status]) ? 'Yes' : 'No';
												$edit_image_post = $cs_db->image_path;

												// cek if image exist
												if (isset($_FILES[$editcs_image_path_target])) {
													// target directory and files for images
													$edit_target_dir_array = wp_upload_dir();
													$edit_target_dir = $edit_target_dir_array['path'];
													$edit_target_file = $edit_target_dir . basename(sanitize_file_name($_FILES[$editcs_image_path_target]['name']));

													if (move_uploaded_file($_FILES[$editcs_image_path_target]['tmp_name'], $edit_target_file)) {
														echo wp_get_upload_dir()['url'] . sanitize_file_name($_FILES[$editcs_image_path_target]['name']);
														// echo $edit_name_post;
														// echo $edit_title_post;
														// echo $edit_link_post;

														$edit_image_post = wp_get_upload_dir()['url'] . sanitize_file_name($_FILES[$editcs_image_path_target]['name']);
													}
												}

												$wpdb->update(
													$table_name_cs,
													[ // inserting the 'table on sql' => $data from _POST
														'name' => $edit_name_post,
														'title' => $edit_title_post,
														'link' => $edit_link_post,
														'image_path' => $edit_image_post,
														'active_status' => $edit_active_status_post,
														'default_data' => 'No'
													],
													[
														// target which query that we want to target
														'id' => $cs_db->id,
													],
													[ // validator for each field, if theres empty field it would return error.
														'%s', // name
														'%s', // title
														'%s', // link
														'%s', // image_path
														'%s', // active_status
														'%s'  // default_data
													]
												);

												// reload page after updated
												echo '<script type="text/JavaScript">window.location.reload()</script>';

												// echo $edit_name_post.$cs_db->id;
											}

											?>
										</div>
									</div>
								</div>
							</div>
						<?php } ?>
					</div>
				</form>
			</div>

			<div id="tab-4" class="tab-pane">
				<div class="tab-contain">
					<div class="tab-title">
						<h1>Scripts</h1>
					</div>

					<p>
						Script hanya bisa diakses untuk versi premium. Silahkan upgrade untuk melanjutkan
					</p>

					<a href="https://www.klikwa.net/" target="_blank" rel="noopener noreferrer">
						<button class="save-button-modal btn btn-success" type="button">
							Upgrade
						</button>
					</a>
				</div>
			</div>

			<div id="tab-5" class="tab-pane">
				<div class="tab-contain">
					<div class="tab-title">
						<h1>Analytic</h1>
					</div>

					<div class="text-center">

						<div class="d-block mb-3">
							<img src="<?php echo plugin_dir_url( __FILE__ ) ?>../asset/images/00-KlikWA-Teams-Web-Dashboard.jpg" alt="">
						</div>

						<div class="d-block mb-3">
							<img src="<?php echo plugin_dir_url( __FILE__ ) ?>../asset/images/kb_hybrid.jpg" alt="">
						</div>

						<div class="d-block mb-3">
							<img src="<?php echo plugin_dir_url( __FILE__ ) ?>../asset/images/kwa-link.jpg" alt="">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- modal add cs -->
	<div class="modal fade modalAddCS" id="modalAddCS" tabindex="-1" role="dialog" aria-labelledby="modalAddCS" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<form method="post" enctype="multipart/form-data">
					<div class="support-head">
						<i class="fa fa-whatsapp"></i>
						<div class="support-head__text">
							<h3>Add Customer Service</h3>
						</div>
					</div>
					<div class="support-item">
						<div class="left-col">
							<div class="support-img-row">
								<div class="img-row">
									<div class="img-hold">
										<img src="<?php echo plugin_dir_url( __FILE__ ) ?>../asset/images/aditama.jpg" alt="" class="support-img__preview" />
									</div>
									<input type="file" class="support-img__upload" name="addcs_image_path" required>
								</div>
							</div>
							<div class="support-input">
								<div class="form-table">
									<div class="form-row">
										<div class="form-group row">
											<label class="col-lg-3">Name</label>
											<div class="col-lg-9">
												<input class="input-class form-control" type="text" name="addcs_name" value="" placeholder="e.g. Tommy Wilton" required>
											</div>
										</div>
									</div>
									<div class="form-row">
										<div class="form-group row">
											<label class="col-lg-3">Job Title</label>
											<div class="col-lg-9">
												<input class="input-class form-control" type="text" name="addcs_title" value="" placeholder="e.g. Customer Support" required>
											</div>
										</div>
									</div>
									<div class="form-row">
										<div class="form-group row">
											<label class="col-lg-3">Link</label>
											<div class="col-lg-9">
												<input class="input-class form-control" type="text" name="addcs_link" value="" placeholder="e.g. Link to Something" required>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="save-toggle">
						<button class="save-button-modal btn btn-success" type="submit" name="add_cs_button">
							Add Customer Service
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- end modal add cs -->

	<!-- modal add limit cs -->
	<div class="modal fade modalAddCS" id="modalAddLimitCS" tabindex="-1" role="dialog" aria-labelledby="modalAddLimitCS" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="support-head">
					<i class="fa fa-whatsapp"></i>
					<div class="support-head__text">
						<h3>Add Customer Service</h3>
					</div>
				</div>
				<div class="support-item">
					<div class="support-input">
						Versi gratis limit 3 customer service. Silahkan upgrade untuk menambah customer service
					</div>
				</div>
				<div class="save-toggle">
					<a href="https://www.klikwa.net/" target="_blank" rel="noopener noreferrer">
						<button class="save-button-modal btn btn-success" type="button">
							Upgrade
						</button>
					</a>
				</div>
			</div>
		</div>
	</div>
	<!-- end modal add limit cs -->
</body>

</html>