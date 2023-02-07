<?php defined('ABSPATH') or die('No script kiddies please!'); ?>
<div class="wrap">
	<h1>QR Scanner Shortcode</h1>
	<h2 class="title">EXAMPLE:- [qrcs param1="arg1" param2="arg2" param3="arg3"]</h2>
	<table class="wp-list-table widefat plugins">
		<thead>
			<tr>
				<th scope="col" id="name" class="manage-column column-name column-primary">Params</th>
				<th scope="col" id="" class="manage-column column-name column-primary">Args</th>
				<th scope="col" id="description" class="manage-column column-description">Description</th>
			</tr>
		</thead>

		<tbody id="the-list">
			<tr class="inactive update">
				<td class="plugin-title column-primary"><strong>action</strong>
				</td>
				<td class="plugin-title column-primary"><strong><i>url | input</i></strong>
				</td>
				<td class="column-description desc">
					<div class="plugin-description">
						<ul>
							<li><strong>url:</strong>
								<p>Valid url value is read from QR code and redirection action is performed on that URL.</p>
							</li>
							<li><strong>input:</strong>
								<p>Any value is read from QR code and inserted in form input on the webpage. (Input Id is required to shortcode)</p>
							</li>
						</ul>
					</div>
				</td>
			</tr>
			<tr class="inactive update">
				<td class="plugin-title column-primary"><strong>button_text</strong>
				</td>
				<td class="plugin-title column-primary"><strong><i>button title text</i></strong>
				</td>
				<td class="column-description desc">
					<div class="plugin-description">
						<p>Scanning icon title text on hover.</p>
					</div>
				</td>
			</tr>
			<tr class="inactive update">
				<td class="plugin-title column-primary"><strong>button_class</strong>
				</td>
				<td class="plugin-title column-primary"><strong><i>button css class</i></strong>
				</td>
				<td class="column-description desc">
					<div class="plugin-description">
						<p>External css class for scanning icon.</p>
					</div>
				</td>
			</tr>
			<tr class="inactive update">
				<td class="plugin-title column-primary"><strong>input_id</strong>
				</td>
				<td class="plugin-title column-primary"><strong><i>form input id</i></strong>
				</td>
				<td class="column-description desc">
					<div class="plugin-description">
						<p>Form input id for field to insert QR code value (action input).</p>
					</div>
				</td>
			</tr>
	</table>
	<h2 class="title">Shortcode usage example:-</h2>
	<p><b>Note: </b><i>Website domain must be hosted on https or localhost.</i></p>
	<p>[qrcs action="url" button_text="click here to start scanning" button_class="valid_css_class"]</p>
	<p>[qrcs action="input" button_text="click here to start scanning" button_class="valid_css_class" input_id="form_input_id"]</p>
</div>