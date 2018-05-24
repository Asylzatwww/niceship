Pyramid.ui.layout('\
<div id="pyr_caption">\
  <span id="pyr_beta_sign"></span>\
	<h1>Borderlinx</h1>\
	<button id="pyr_minimize" title="Minimise">Minimise</button>\
	<button id="pyr_close" title="Close">Close</button>\
</div>\
<div id="pyr_tcc_totalprod" style="display:none"></div>\
<div id="pyr_content">\
    <a id="pyr_feedback" href="https://docs.google.com/forms/d/1MZqpt_7aJT4L7xyYX9-lLeRYnOfhgokvCpP9Pajk3_M/viewform" target="_blank">\
        <span class="pyr_question">Like it?</span>\
        <span class="pyr_action">Tell us</span>\
    </a>\
    <h2 id="pyr_shop_section">\
        You are shopping on <span id="pyr_shop" target="_blank"></span>\
    </h2>\
    <p id="pyr_currency_tools" style="display:none;">You are shopping in the <span id="pyr_merchant_country"></span>. Prices are expressed in <span id="pyr_merchant_currency"></span>.<br /> Not correct? Switch to <a href="#" id="pyr_switch_merchant_country">here</a>.</p>\
    <div id="pyr_not_product_page">To add a product in your cart, please open the widget on a product page of a supported merchant. See full list on <a href="http://www.borderlinx.com/" target="_blank">borderlinx.com</a>.</div>\
	<div id="pyr_product_section" style="display:none;">\
		<h2 class="line"><span class="border"></span><span class="hText">Add a product</span></h2>\
        <img id="pyr_product_image" src="" />\
		<div class="pyr_product_properties">\
			<div class="pyr_row">\
        <label for="pyr_descr">Product:</label>\
				<input type="text" name="name" id="pyr_descr" placeholder="Product name"/>\
        <label for="pyr_price">Price:</label>\
				<input type="text" name="price" id="pyr_price" placeholder="Price" />\
        <span id="pyr_product_form_currency"></span>\
			</div>\
			<div class="pyr_row">\
        <label for="pyr_size">Size:</label>\
				<select name="size" id="pyr_size">\
				</select>\
        <label for="pyr_color">Color:</label>\
				<input type="text" name="color" id="pyr_color" placeholder="Color"/>\
        <label for="pyr_qty">Quantity:</label>\
				<select name="qty" id="pyr_qty">\
					<option value="1">1</option>\
					<option value="2">2</option>\
					<option value="3">3</option>\
					<option value="4">4</option>\
					<option value="5">5</option>\
					<option value="6">6</option>\
					<option value="7">7</option>\
					<option value="8">8</option>\
					<option value="9">9</option>\
				</select>\
			</div>\
			<div class="pyr_row">\
				<input type="hidden" name="total" id="pyr_total" readonly />\
				<span id="pyr_total_dummy">Total</span>\
				<span id="pyr_total_curr"></span>\
			</div>\
			<div class="pyr_row">\
        <label for="pyr_product_name">Category:</label>\
        <span id="category_wrapper"><input type="text" name="category" id="pyr_product_name" value=""><select id="pyr_product_res" size="6"></select></span>\
        <input type="hidden" id="pyr_product_id" value="">\
				<button id="pyr_addtocart">Add to cart</button>\
			</div>\
      <div class="pyr_row pyr_class_instruction">Start typing a product category and select the most accurate one.</div>\
		</div>\
		<div class="pyr_clearfix"></div>\
		<div id="pyr_add_errors">\
		</div>\
	</div>\
	<div id="pyr_cart_section">\
		<h2 class="line"><span class="border"></span><span class="hText">Your cart</span></h2>\
		<ul id="pyr_cart"></ul>\
		<div id="pyr_cart_empty">You have no item in your cart.</div>\
	</div>\
\
	<div id="pyr_tax_section">\
		<div class="pyr_row">\
			<label for="pyr_taxes">Local taxes</label>\
			<input type="text" name="taxes" id="pyr_taxes" placeholder="" />\
			<div class="pyr_clearfix"></div>\
		</div>\
		<div class="pyr_row">\
			<label for="pyr_shipping_charges">Local shipping charges</label>\
			<input type="text" name="charges" id="pyr_shipping_charges" placeholder="" />\
			<div class="pyr_clearfix"></div>\
		</div>\
	</div>\
\
    <div id="pyr_country_section">\
        <label for="pyr_country">Select a country of delivery:</label>\
        <select id="pyr_country"></select>\
		<button id="pyr_calculate">\
			Calculate total cost\
		</button>\
    </div>\
\
    <div id="pyr_output_section">\
		<div class="pyr_row total">\
			<div class="pyr_label"><span class="bold" id="pyr_total_nb_products">TOTAL</span><br />(incl. local tax &amp; shipping charges)</div>\
			<div class="pyr_value pyr_cart_product_currency" id="pyr_tcc_total"></div>\
			<div class="pyr_value" id="pyr_tcc_total_country"></div>\
			<div class="pyr_clearfix"></div>\
		</div>\
		<div class="pyr_clearfix"></div>\
		<div id="pyr_worldwide">\
			<h2 class="line"><span class="border"></span><span class="hText">Estimation Of The Intl. Shipping, Tax And Duty</span></h2>\
			<p id="py_countries_details">We provide you an estimate of the costs to ship your parcels from <span id="pyr_worldwide_from">XXX</span> to your home address in <span id="pyr_worldwide_to">XXX</span> using Borderlinx freight forwarding services.</p>\
			<!--<p id="py_countries_details">This is the estimated cost to ship the products from <span id="pyr_worldwide_from">XXX</span> to <span id="pyr_worldwide_to">XXX</span> using Borderlinx.</p>-->\
      <table id="pyr_shipping_costs" summary="This is the estimated cost to ship the 3 products from U.S.A to Kuwait using Borderlinx." cellspacing="0" cellpadding="0" border="0">\
      <tfoot>\
        <tr class="grey">\
          <th id="pyr_shipping_costs_th1">Total shipping cost</th>\
          <td class="g" headings="pyr_shipping_costs_th1 pyr_shipping_costs_th4" id="total_shipping_costs_country"></td>\
          <td headings="pyr_shipping_costs_th1 pyr_shipping_costs_th3" id="total_shipping_costs"></td>\
        </tr>\
      </tfoot>\
      <tbody>\
        <tr class="grey">\
          <th id="pyr_shipping_costs_th2">Shipping charges</th>\
          <th id="pyr_shipping_costs_th4"><span>Your country currency currency</span></th>\
          <th id="pyr_shipping_costs_th3"><span>Merchant currency</span></th>\
        </tr>\
        <tr class="sep">\
          <th class="f" id="pyr_shipping_costs_th5">Shipping charges and Fuel surcharge</th>\
          <td class="g" headings="pyr_shipping_costs_th2 pyr_shipping_costs_th4 pyr_shipping_costs_th5" id="pyr_tcc_shipping_country">&nbsp;</td>\
          <td headings="pyr_shipping_costs_th2 pyr_shipping_costs_th3 pyr_shipping_costs_th5" id="pyr_tcc_shipping">&nbsp;</td>\
        </tr>\
        <tr>\
          <th class="f" id="pyr_shipping_costs_th6">Shipment protection</th>\
          <td class="g" headings="pyr_shipping_costs_th2 pyr_shipping_costs_th4 pyr_shipping_costs_th6" id="pyr_tcc_insurance_country">(optional)</td>\
          <td headings="pyr_shipping_costs_th2 pyr_shipping_costs_th3 pyr_shipping_costs_th6" id="pyr_tcc_insurance">(optional)</td>\
        </tr>\
        <tr class="grey">\
          <th id="pyr_shipping_costs_th7" colspan="3">Total custom charges</th>\
        </tr>\
        <tr class="sep">\
          <th class="f" id="pyr_shipping_costs_th8">Duty</th>\
          <td class="g" headings="pyr_shipping_costs_th7 pyr_shipping_costs_th4 pyr_shipping_costs_th8" id="pyr_tcc_duty_country">&nbsp;</td>\
          <td headings="pyr_shipping_costs_th7 pyr_shipping_costs_th3 pyr_shipping_costs_th8" id="pyr_tcc_duty">&nbsp;</td>\
        </tr>\
        <tr class="sep">\
          <th class="f" id="pyr_shipping_costs_th9">Tax</th>\
          <td class="g" headings="pyr_shipping_costs_th7 pyr_shipping_costs_th4 pyr_shipping_costs_th9" id="pyr_tcc_tax_country">&nbsp;</td>\
          <td headings="pyr_shipping_costs_th7 pyr_shipping_costs_th3 pyr_shipping_costs_th9" id="pyr_tcc_tax">&nbsp;</td>\
        </tr>\
        <tr>\
          <th class="f" id="pyr_shipping_costs_th10">Customs Clearance</th>\
          <td class="g" headings="pyr_shipping_costs_th7 pyr_shipping_costs_th4 pyr_shipping_costs_th10" id="pyr_tcc_customs_clearance_country">&nbsp;</td>\
          <td headings="pyr_shipping_costs_th7 pyr_shipping_costs_th3 pyr_shipping_costs_th8" id="pyr_tcc_customs_clearance">&nbsp;</td>\
        </tr>\
      </tbody>\
      </table>\
		<div class="pyr_clearfix"></div>\
    </div>\
	<div id="pyr_want_to">\
			<h2 class="line"><span class="border"></span><span class="hText">You want to buy these products?</span></h2>\
			<p>It&#39;s simple! You have 2 options to get your products:</p>\
      <p>\
        Order with the Borderlinx concierge service (<a href="https://www.borderlinx.com/pages/our-exclusive-concierge-service" title="learn more about concierge" target="_blank">learn more</a>) and let us take care of the payment on <span class="pyr_shop_name">this website</span> OR buy directly from <span class="pyr_shop_name">this website</span> and ship your purchase to your Borderlinx \'ship to\' address."\
      </p>\
			<div id="action">\
				<div id="left">\
			<p><a href="https://www.borderlinx.com/member/register" target="_blank" class="adress" id="pyr_bx_get_address">Get My Ship-to Address</a></p>\
			<p>and ship my purchases to<br />my Borderlinx &#39;ship to&#39; address</p>\
				</div>\
				<div id="right">\
			<p><a href="#" target="_blank" class="concierge" id="pyr_bx_concierge">order with concierge</a></p>\
            <p>and let your personal<br /> shopper assistant buy these products</p>\
				</div>\
			<div class="pyr_row"></div>\
			</div>\
		</div>\
	</div>\
</div>\
<div id="pyr_footer">\
	<p>&copy; Borderlinx 2013 &#124; All rights reserved</p>\
</div>');
Pyramid.ui.cartProduct('\
<div class="pyr_cart_delete">- remove</div>\
<!--div class="pyr_cart_edit">+ edit</div-->\
	<img class="pyr_cart_product_img" src="" />\
	<div class="pyr_cart_product_properties">\
		<div class="pyr_row">\
			<div class="pyr_label_none">Product: </div>\
			<a class="pyr_cart_product_descr" href="#"></a>\
		</div>\
		<div class="pyr_row">\
			<div class="pyr_cart_product_color_section">\
				<div class="pyr_label">Color: </div>\
				<div class="pyr_value pyr_cart_product_color_value"></div>\
				<span>&nbsp;&#124;&nbsp;</span>\
			</div>\
			<div class="pyr_cart_product_size_section">\
				<div class="pyr_label">Size: </div>\
				<div class="pyr_value pyr_cart_product_size_value"></div>\
			</div>\
		</div>\
		<div class="pyr_row">\
			<div class="pyr_label">Category: </div>\
			<div class="pyr_value pyr_cart_product_category"></div>\
      <div class="pyr_cart_product_category_id"></div>\
		</div>\
		<div class="pyr_cart_product_summary">\
			<div class="price_cart_area">\
				<div class="pyr_label_grey">price: </div>\
				<div class="pyr_cart_value">\
					<span class="pyr_cart_product_currency"></span>\
					<span class="pyr_cart_product_price"></span>\
				</div>\
			</div>\
			<div class="qty_cart_area">\
				<div class="pyr_label_grey">qty: </div>\
				<span class="pyr_cart_product_qty"></span>\
				<select name="qty" class="pyr_cart_product_qty">\
					<option value="1">1</option>\
					<option value="2">2</option>\
					<option value="3">3</option>\
					<option value="4">4</option>\
					<option value="5">5</option>\
					<option value="6">6</option>\
					<option value="7">7</option>\
					<option value="8">8</option>\
					<option value="9">9</option>\
				</select>\
			</div>\
			<div class="total_cart_area">\
				<div class="pyr_label_grey bold">total: </div>\
				<div class="pyr_cart_value">\
					<span class="pyr_cart_product_currency bold"></span>\
					<span class="pyr_cart_product_total bold"></span>\
				</div>\
			</div>\
			<div class="pyr_clearfix"></div>\
		</div>\
	</div>\
	<div class="pyr_clearfix"></div>\
</div>');
Pyramid.ui.show();