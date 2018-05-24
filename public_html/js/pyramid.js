Pyramid = {};

Pyramid.from_countries = {
  'US' : 'United States',
  'GB' : 'Great Britain'
};

Pyramid.data = {
    bgahost : null,
    tccResult: null,
    transactionId : null,
    tccParams: {
        "merchant_name" : "",
        "merchant_domain_name" : "",
        "from_country_id" : "US",
        "to_country_id" : null,
        "to_state_id" : "",
        "delivery_types" : "X",
        "reference" : "",
        "currency" : "USD",
        "local_tax" : 0,
        "local_shipping_charge" : 0,
        "products" : []
    },
    parsed: null
};

Pyramid.keypress_delay = (function(){
    var timer = 0;
    return function(callback, ms){
        clearTimeout(timer);
        timer = setTimeout(callback, ms);
    };
})();

Pyramid.categories = {
  ids: [],
  labels:[]
};

// list of required fields.
// when parsing the dom, they are always prefixed with "pyr_"
Pyramid.required_product_fields = ['descr','price','color','qty','product_id','product_name'];

Pyramid.dom = (function(){

    if (typeof window.PYHOST === 'undefined' || window.PYHOST == '') {
        window.PYHOST = 'jws.borderlinx.com';
    }

    var homeURL = location.protocol+'//'+window.PYHOST+'/';
    
    var hasClass = function(el, className) {
      return new RegExp(' ' + className + ' ').test(' ' + el.className + ' ');
    };
    
return {
    nul : function(t)
    {
        return t ? t : '';
    },

    byId : function(e)
    {
        return document.getElementById(e);
    },

    byClass : function(first, second)
    {
        var elt, classname;
        if(arguments.length == 2)
        {
            elt = first;
            classname = second;
        }
        else
        {
            elt = document;
            classname = first;
        }

        if (elt.getElementsByClassName)
        {
            return elt.getElementsByClassName(classname);
        }
        else // IE
        {
            try
            {
                var a = [];
                var re = new RegExp('(^| )'+classname+'( |$)');
                var els = elt.getElementsByTagName("*");
                for(var p=0,q=els.length; p<q; p++)
                {
                    if(re.test(els[p].className)){
                        a.push(els[p]);
                    }
                }
                return a;
            }
            catch (error)
            {
                return null;
            }
        }
    },

    byNotClass: function (first, second, tag_selected) {
        var elt, classname;
        if (arguments.length >= 2) {
            elt = first;
            classname = second;
        }
        else {
            elt = document;
            classname = first;
        }

        if (arguments.length==3&&tag_selected)
            var els = elt;
        else
            var els = elt.getElementsByTagName("*");

        var a = [];
        var re = new RegExp('(^| )' + classname + '( |$)');
        for (var p = 0, q = els.length; p < q; p++) {
            if (!re.test(els[p].className)) {
                a.push(els[p]);
            }
        }
        return a;
    },

    innerText : function(e, v)
    {
        if (arguments.length == 2)
        {
            if (!e) return;
            if ('textContent' in e) e.textContent = v;
            else e.innerText = v;
        }
        else
        {
            if (!e) return '';
            if ('textContent' in e) return e.textContent;
            else return e.innerText;
        }
    },

    deleteTags : function(e)
    {
        if (!e) return '';
        e = e.innerHTML;
        if (!e) return '';
        else return e.replace(/<(?:.|\n)*?>.*<(?:.|\n)*?>/gm, '');
    },

    addScript : function(s, callback)
    {
        if (s.indexOf(location.protocol+'//') !== 0) {
            s = homeURL + s;
        }
        var o = document.createElement('script');
        o.setAttribute('src', s);
        if (callback)
        {
            o.onreadystatechange = function () {
                if (o.readyState === 'loaded' || o.readyState === 'complete') {
                    o.onreadystatechange = null;
                    callback();
                }
            };
            // others
            o.onload = function () {
                callback();
            };
        }
        document.getElementsByTagName('head')[0].appendChild(o);
    },

    addStyle : function(s)
    {
        if (s.indexOf(location.protocol+'//') !== 0)
        {
            s = homeURL + s;
        }
        var o = document.createElement('link');
        o.setAttribute('rel', 'stylesheet');
        o.setAttribute('type', 'text/css');
        o.setAttribute('href', s  + '?r=' + Math.random());
        document.getElementsByTagName('head')[0].appendChild(o);
    },
    
    addClass : function(el,className){
      if (!hasClass(el, className)) {
        el.className += ' '+className;
      }
    },
    
    removeClass : function(el,className){
      var newClass = ' ' + el.className.replace( /[\t\r\n]/g, ' ') + ' ';
      if (hasClass(el, className)) {
        while (newClass.indexOf(' ' + className + ' ') >= 0 ) {
          newClass = newClass.replace(' ' + className + ' ', ' ');
        }
        el.className = newClass.replace(/^\s+|\s+$/g, '');
      }
    },
    
    addEventHandler : function(el, eventType, handler) {
      if (el.addEventListener) {
        el.addEventListener(eventType, handler, false);
      }
      else if (el.attachEvent) {
        el.attachEvent('on'+eventType, handler);
      }
      else {
        return 0;
      }
      return 1;
    },

    init : function()
    {
        if(!String.prototype.trim){
            String.prototype.trim = function ()
            {
                return this.replace(/^\s+|\s+$/g,'');
            };
        }
        if(!Array.prototype.indexOf) {
          Array.prototype.indexOf = function(needle) {
            for(var i = 0; i < this.length; i++) {
              if(this[i] === needle) {
                return i;
              }
            }
            return -1;
          };
        }
    }
};
})();

Pyramid.ga = (function(){
  var dom = Pyramid.dom;
  var homeURL = location.protocol+'//'+window.PYHOST+'/analytics/trigger/';

  var refreshIframe = function(src) {
    var frame = dom.byId('pyr_ga_frame');
    if (frame) {
      document.body.removeChild(frame);
    }
    var tmp = document.createElement('iframe');
    tmp.setAttribute("id", "pyr_ga_frame");
    tmp.setAttribute("src", src);
    document.body.appendChild(tmp);
  }

  return {
    triggerTCClick: function (label, value) {
      refreshIframe(homeURL + ['CalculateTotal', 'Clicked', label, value].join('/'));
    },
    triggerGSAddress: function (label, value) {
      refreshIframe(homeURL + ['GetAddressButton', 'Clicked', label, value].join('/'));
    },
    triggerNotMerchant: function (label) {
      refreshIframe(homeURL + ['NonMerchantPage', 'Activated', label, 0].join('/'));
    }
  };
})();

Pyramid.ui = (function(){

    var dom = Pyramid.dom;
    var cartKey = 'cart_' + window.location.hostname;

    var dragObj = new Object();
    var isIE = (navigator.userAgent.indexOf('MSIE') != -1);

    var fixPriceFormating = function(price) {
      if (!price) {
        return '';
      }
      // remove thousands separator since parseFloat cant work with it
      price = price.replace(/(.*)([\,\.])(\d{3,})(.*)/g,'$1$3$4');
      // force "." as decimal separator
      price = price.replace(/(.*)([\,]+)(\d{2})$/g,'$1.$3');
      return price;
    };

    var populate = function()
    {
        // parse page and populate from page
        var p = Pyramid.parser.parse();
        if (p.price) {
          p.price.price = fixPriceFormating(p.price.price);
        }
        Pyramid.data.parsed = p;
        
        // merchant name
        Pyramid.data.tccParams.merchant_name = p.shop;
        // merchant domain
        Pyramid.data.tccParams.merchant_domain_name = window.location.hostname;
        
        // criteria for an "ok" product: image, price and descr
        // if missing, display alt content, with cart content anyway.
        if( p.price && p.descr && p.image ){
          // init merchant currency
          Pyramid.data.tccParams.currency = p.price.curr;
          // determine the origin country (based on merchant currency - not perfect and should ultimately be replace by something more reliable
          Pyramid.data.tccParams.from_country_id = ( Pyramid.data.tccParams.currency == 'USD' ) ? 'US' : 'GB' ;
          dom.byId('pyr_product_section').style.display = 'block';
          dom.byId('pyr_currency_tools').style.display = 'block';
          dom.byId('pyr_not_product_page').style.display = 'none';
        }
        
        // extract tld hostname for shop name
        var shopName = window.location.hostname.split('.').slice(1).join('.');
        dom.innerText(dom.byId('pyr_shop'), shopName);
        if (!p.shop) {
          Pyramid.ga.triggerNotMerchant(window.location.hostname);
          dom.innerText(dom.byId('pyr_shop_section'), "This website is not supported by Borderlinx.");
        }
        
        
        var content = dom.byId('pyr_want_to');
        var shopNames = dom.byClass(content, 'pyr_shop_name');
        for ( var i=0,n=shopNames.length;i<n;++i ){
          shopNames[i].innerHTML = p.shop;
        }

        // merchant home url
        // dom.byId('pyr_shop').setAttribute('href',p.shop_url);
        
        dom.byId('pyr_descr').value = dom.nul(p.descr);
        dom.byId('pyr_product_image').setAttribute('src', dom.nul(p.image));
        if (p.price){
            dom.byId('pyr_price').value = dom.nul(p.price.price);
        }
        dom.byId('pyr_color').value = dom.nul(p.color);
        // replace size select with text input when size is empty or null
        if( p.size == '' ){
          var size_input = document.createElement('input');
          size_input.name = 'size';
          size_input.type = 'text';
          size_input.id = 'pyr_size';
          size_input.value = '';
          size_input.placeholder = 'Size';
          dom.byId('pyr_size').parentNode.replaceChild(size_input,dom.byId('pyr_size'));
        }
        else if (p.sizes && p.sizes.length)
        {
            var select = dom.byId('pyr_size');
            for(var i=0; i < p.sizes.length; i++) {
                var d = p.sizes[i];
                select.options.add(new Option(d, d));
            }
            select.value = p.size;
        }
        if( p.quantity ){
          dom.byId('pyr_qty').value = p.quantity;
        }
    };

    var serializeCurrent = function()
    {
        var size = dom.byId('pyr_size').value;
        if (size.toLowerCase().indexOf('select') === 0) {
          size = '';
        }
        return {
            'product_id' : dom.byId('pyr_product_id').value,
            'product_name' : dom.byId('pyr_product_name').value,
            'image' : dom.byId('pyr_product_image').getAttribute('src'),
            'descr' : dom.byId('pyr_descr').value,
            'qty' : dom.byId('pyr_qty').value,
            'price' : fixPriceFormating(dom.byId('pyr_price').value),
            'size' : size,
            'colour' : dom.byId('pyr_color').value,
            'url' : window.location.href,
            'gtin' : '',
            'brand' : ''
        };
    };

    /**
    Inserts a product's markup in the document
    */
    var createCartProduct = function(data){
        var o = document.createElement('li');
        o.className = 'pyr_cart_product';
        o.innerHTML = cartProduct;
        dom.byClass(o, 'pyr_cart_product_img')[0].setAttribute('src', data.image);
        dom.innerText( dom.byClass(o, 'pyr_cart_product_descr')[0], data.descr);
        // href
        dom.byClass(o, 'pyr_cart_product_descr')[0].href = data.url;
        dom.innerText( dom.byClass(o, 'pyr_cart_product_category_id')[0], data.product_id);
        // get category/product name
        var product_name = Pyramid.categories.labels[ Pyramid.categories.ids.indexOf(data.product_id) ];
        dom.innerText( dom.byClass(o, 'pyr_cart_product_category')[0], product_name);
        if (data.size !== '') {
          dom.innerText( dom.byClass(o, 'pyr_cart_product_size_value')[0], data.size);
        } else {
          dom.byClass(o, 'pyr_cart_product_size_section')[0].style.display = 'none';
        }
        if (data.colour !== '') {
          dom.innerText( dom.byClass(o, 'pyr_cart_product_color_value')[0], data.colour);
        } else {
          dom.byClass(o, 'pyr_cart_product_color_section')[0].style.display = 'none';
        }
        dom.innerText( dom.byClass(o, 'pyr_cart_product_price')[0], data.price);

        var cart = dom.byId('pyr_layer');
        var cart_prices = dom.byClass(cart, 'pyr_cart_product_currency');
        for ( var i=0,n=cart_prices.length;i<n;++i ){
          cart_prices[i].innerHTML = Pyramid.data.tccParams.currency;
        }

        dom.byClass(o, 'pyr_cart_product_qty')[1].value = data.qty;
        
        // listen to delete
        dom.byClass(o, 'pyr_cart_delete')[0].onclick = Pyramid.ui.deleteProduct;
        // listen to qty change
        dom.byClass(o, 'pyr_cart_product_qty')[1].onchange = function(e){
          updateSubtotal();
          resetTccResult();
          dom.byId('pyr_output_section').style.display='none';
        };
        
        dom.innerText( dom.byClass(o, 'pyr_cart_product_total')[0], data.qty * parseFloat(data.price.replace(',','')));
        dom.byId('pyr_cart').appendChild(o);

        displayMerchantCurrency();
    };

    /**
    Reads the DOM and generates a cart form it
    */
    var serializeCart = function() {
        var cartItems = dom.byId('pyr_cart').children;
        var o = [],
            item,
            p;
        for ( var i=0, n=cartItems.length; i<n; i++ ){
            item = cartItems[i];
            p = {
                'image' : dom.byClass(item, 'pyr_cart_product_img')[0].getAttribute('src'),
                'descr' : dom.innerText( dom.byClass(item, 'pyr_cart_product_descr')[0]),
                'url' : dom.byClass(item, 'pyr_cart_product_descr')[0].getAttribute('href'),
                'qty' : dom.byClass(item, 'pyr_cart_product_qty')[1].value,
                'price' : dom.innerText( dom.byClass(item, 'pyr_cart_product_price')[0]),
                'size' : dom.innerText( dom.byClass(item, 'pyr_cart_product_size_value')[0]),
                'colour' : dom.innerText( dom.byClass(item, 'pyr_cart_product_color_value')[0]),
                'product_id' : dom.innerText( dom.byClass(item, 'pyr_cart_product_category_id')[0]),
                'gtin' : '',
                'brand' : ''
            };
            o.push(p);
        }
        return o;
    };

    /**
    Inserts the cart content (data) into the document
    */
    var unserializeCart = function(data){
        for (var i=0, n=data.length; i < n; i++){
            createCartProduct(data[i]);
        }
        updateSubtotal();
        // handle display if cart not empty
        if( data.length>0 ){
          dom.byId('pyr_cart_empty').style.display = 'none';
          dom.byId('pyr_tax_section').style.display = 'block';
          dom.byId('pyr_country_section').style.display = 'block';
        }
    };
    
    var displayMerchantCurrency = function(){
      dom.byId('pyr_product_form_currency').innerHTML = dom.byId('pyr_merchant_currency').innerHTML = (Pyramid.data.tccParams.currency=='USD') ? 'USD' : 'GBP';
      dom.byId('pyr_merchant_country').innerHTML = (Pyramid.data.tccParams.currency=='USD') ? 'US' : 'UK';
      dom.byId('pyr_switch_merchant_country').innerHTML = (Pyramid.data.tccParams.currency=='USD') ? 'UK' : 'US';

      // dom.byId('pyr_switch_merchant_currency').innerHTML = (Pyramid.data.tccParams.currency=='USD') ? 'GBP' : 'USD' ;
      // change currency display on cart lines
      var cart = dom.byId('pyr_cart');
      var cart_prices = dom.byClass(cart, 'pyr_cart_product_currency');
      for ( var i=0,n=cart_prices.length;i<n;++i ){
        cart_prices[i].innerHTML = Pyramid.data.tccParams.currency;
      }
      // update from country in the results
      dom.byId('pyr_worldwide_from').innerHTML = (Pyramid.data.tccParams.currency=='USD') ? Pyramid.from_countries['US'] : Pyramid.from_countries['GB'] ;
    };
    
    var switchMerchantCurrency = function(){
      resetTccResult();
      dom.byId('pyr_output_section').style.display='none';
      Pyramid.data.tccParams.currency = (Pyramid.data.tccParams.currency=='USD') ? 'GBP' : 'USD' ;
      // determine the origin country (based on merchant currency - not perfect and should ultimately be replace by something more reliable
      Pyramid.data.tccParams.from_country_id = ( Pyramid.data.tccParams.currency == 'USD' ) ? 'US' : 'GB' ;
      displayMerchantCurrency();
    };
    
    // addEventHandler
    var categoryAutocomplete = function(){
      // get elements
      var pyr_category_el = dom.byId('pyr_product_name');
      var res = dom.byId('pyr_product_res');
      res.innerHTML = '';
      
      // then listen
      
      // listen to keys on search field
      dom.addEventHandler(
        pyr_category_el,
        'keyup',
        function(e){
          var str = pyr_category_el.value.trim();
          if( str.length > 2 ){
            // some styling
            res.style.display = 'none';
            dom.addClass(pyr_category_el,'wait-input');
            
            // which key?
            var keycode = e.keyCode || e.which;
            
            // not arrow down was pressed, nor enter
            if( keycode != 40 && keycode != 13){
            
              Pyramid.keypress_delay(function(){
                
                // now the real thing
                // loop on categories
                var label;
                for( var i=0, n=Pyramid.categories.labels.length;i<n;++i ){
                  label = Pyramid.categories.labels[i];
                  // if match, enrich select with option
                  if( label.match(str.toLowerCase()) ){
                    res.options.add(new Option(label, Pyramid.categories.ids[i]));
                  }
                }
                res.selectedIndex = 0;
                res.style.display = 'block';
                
                dom.removeClass(pyr_category_el,'wait-input');
                
                
              },500);
              
            }
            // arrow down was pressed, so focus on the select
            else{
              res.style.display = 'block';
              dom.removeClass(pyr_category_el,'wait-input');
              res.focus();
            }
          }
          else{
            res.style.display = 'none';
            res.innerHTML = '';
          }
        }
      );
      
      // listen to arrow key up on select
      dom.addEventHandler(
        res,
        'keyup',
        function(e){
          // which key?
          var keycode = e.keyCode || e.which;
          // if arrow and first option is select, move to search field
          if( keycode == 38 && res.selectedIndex == 0){
            pyr_category_el.focus();
          }
          // if enter is pressed, select and hide
          if( keycode == 13 ){
            categoryAutocompleteListen();
          }
        }
      );
      
    };
    
    var categoryAutocompleteReset = function(){
      dom.byId('pyr_product_res').style.display = 'none';
      dom.byId('pyr_product_res').innerHTML = '';
    };
    
    // listen to click on auto complete
    var categoryAutocompleteListen = function(){
      var res = dom.byId('pyr_product_res');
      var choice_label = res.options[res.selectedIndex].text;
      var choice_id = res.options[res.selectedIndex].value;
      dom.byId('pyr_product_name').value = choice_label;
      dom.byId('pyr_product_id').value = choice_id;
      categoryAutocompleteReset();
    };

    var centerOnScreen = function(o, width)
    {
        var winW = 1024;
        if (document.body && document.body.offsetWidth) {
            winW = document.body.offsetWidth;
        }
        if (document.compatMode=='CSS1Compat' &&
            document.documentElement &&
            document.documentElement.offsetWidth ) {
            winW = document.documentElement.offsetWidth;
        }
        if (window.innerWidth && window.innerHeight) {
            winW = window.innerWidth;
        }
        o.style.left = (winW / 2 - width/2)+'px';
        o.style.top = '20px';
    };

    /**
    Parses the cart content to generate a list of products
    */
    var getProducts = function(){
        var cart = dom.byId('pyr_cart');
        var products = dom.byClass(cart, 'pyr_cart_product');
        var out = [];
        for (var i = 0, len = products.length; i < len; i++){
            var product = products[i];
            out.push({
              "product_id" : dom.innerText( dom.byClass(product, 'pyr_cart_product_category_id')[0] ),
              "descr": dom.innerText( dom.byClass(product, 'pyr_cart_product_descr')[0] ),
              "qty": dom.byClass(product, 'pyr_cart_product_qty')[1].value,
              "price": dom.innerText( dom.byClass(product, 'pyr_cart_product_price')[0] ),
              "gtin": "",
              "brand": "",
              "size": dom.innerText( dom.byClass(product, 'pyr_cart_product_size_value')[0] ),
              "colour": dom.innerText( dom.byClass(product, 'pyr_cart_product_color_value')[0] ),
              "url": dom.byClass(product, 'pyr_cart_product_descr')[0].getAttribute('href'),
              "image": dom.byClass(product, 'pyr_cart_product_img')[0].getAttribute('src')
            });
        }
        return out;
    };

    var saveCart = function()
    {
        var ser = serializeCart();
        if (ser.length){
            JWS.keySet(cartKey, ser, function(ok){
            });
        }
        else{
            JWS.keyClear(cartKey, function(ok){
            });
        }
    };

    /**
    Updates the subtotal display for a product in the cart
    */
    var updateSubtotal = function()
    {
        var cart = dom.byId('pyr_cart');
        var products = dom.byClass(cart, 'pyr_cart_product');

        // local tax
        dom.byId('pyr_tcc_tax').innerHTML = '';
        dom.byId('pyr_tcc_tax_country').innerHTML = '';
        dom.byId('pyr_tcc_customs_clearance').innerHTML = '';
        dom.byId('pyr_tcc_customs_clearance_country').innerHTML = '';
        // shipping
        dom.byId('pyr_tcc_shipping').innerHTML = '';
        dom.byId('pyr_tcc_shipping_country').innerHTML = '';
        // product total - expressed only in merchant currency
        dom.byId('pyr_tcc_total').innerHTML = '';
        // total prod
        dom.byId('pyr_tcc_totalprod').innerHTML = '';

        var total = 0.0;
        if (products.length == 0){
            resetTccResult();
        }
        else{
          var quantity = 1;
          for (var i=0, n=products.length; i<n; i++)
          {
              quantity = parseInt( dom.byClass(products[i], 'pyr_cart_product_qty')[1].value, 10 );
              total = parseFloat(dom.innerText(dom.byClass(products[i], 'pyr_cart_product_price')[0])) * quantity;
              dom.byClass(products[i], 'pyr_cart_product_total')[0].innerHTML = total.toFixed(2);
              total = 0;
          }
        }
    };
    
    var resetTccResult = function(){
      var ids = [
        // merchant currency
        'pyr_tcc_total','pyr_tcc_shipping','pyr_tcc_duty','pyr_tcc_tax', 'pyr_tcc_customs_clearance','total_shipping_costs',
        // local currency
        'pyr_tcc_total_country','pyr_tcc_shipping_country','pyr_tcc_duty_country','pyr_tcc_tax_country', 'pyr_tcc_customs_clearance_country','total_shipping_costs_country',
        // errors
        'pyr_add_errors'
      ];
      for( var i=0,n=ids.length;i<n;++i ){
        dom.byId(ids[i]).innerHTML = '';
      }
      // insurance
      dom.byId('pyr_tcc_insurance').innerHTML = '(optional)';
      dom.byId('pyr_tcc_insurance_country').innerHTML = '(optional)';
    };

    
return {

    layout : function (newLayout)
    {
        layout = newLayout;
    },
   
    cartProduct : function (newcartProduct)
    {
        cartProduct = newcartProduct;
    },

    init : function()
    {
        
        if (this.initialized) return;
        
        // insert empty container
        var o = document.createElement('div');
            o.setAttribute('id', 'pyr_layer');
            dom.addClass(o,'wait');
        centerOnScreen(o, 530);
        document.getElementsByTagName('body')[0].appendChild(o);
        
        // dom.addStyle('css/pyramid.css');
//        dom.addStyle('css/merchants/'+window.BXMERCHID+'.css');
//        dom.addScript('js/merchants/'+window.BXMERCHID+'.js?r='+Math.random(), function(){
        dom.addStyle('css/'+window.BXMERCHID+'.css');
        dom.addScript('js/'+window.BXMERCHID+'.js?r='+Math.random(), function(){
          // src : jws/src/views/jwsload.twig
          dom.addScript('jwsload.js?id='+window.BXMERCHID+'&r='+Math.random(), Pyramid.ui.populateFromJWS);
          this.initialized = true;
        });
    },

    drag : function (handle, elem)
    {

        handle.onmousedown = function (event)
        {
            var x, y;

            dragObj.elNode = elem;

            if (isIE)
            {
                x = window.event.clientX + document.documentElement.scrollLeft
                    + document.body.scrollLeft;
                y = window.event.clientY + document.documentElement.scrollTop
                    + document.body.scrollTop;
            } else
            {
                x = event.clientX + window.scrollX;
                y = event.clientY + window.scrollY;
            }

            dragObj.cursorStartX = x;
            dragObj.cursorStartY = y;
            dragObj.elStartLeft  = parseInt(dragObj.elNode.style.left, 10);
            dragObj.elStartTop   = parseInt(dragObj.elNode.style.top,  10);

            if (isNaN(dragObj.elStartLeft))
                dragObj.elStartLeft = 0;
            if (isNaN(dragObj.elStartTop))
                dragObj.elStartTop  = 0;

            dragObj.oldborder = elem.style.border;

            if (isIE)
            {
                document.attachEvent("onmousemove", Pyramid.ui.dragGo);
                window.event.cancelBubble = true;
                window.event.returnValue = false;
            } else
            {
                document.addEventListener("mousemove", Pyramid.ui.dragGo,   true);
                event.preventDefault();
            }
        };

        handle.onmouseup = function (event)
        {
            if (isIE) {
                document.detachEvent("onmousemove", Pyramid.ui.dragGo);
            } else
            {
                document.removeEventListener("mousemove", Pyramid.ui.dragGo,   true);
            }
        };

    },


    dragGo : function(event)
    {
        var x, y;

        if (isIE)
        {
            x = window.event.clientX + document.documentElement.scrollLeft + document.body.scrollLeft;
            y = window.event.clientY + document.documentElement.scrollTop + document.body.scrollTop;
        } else
        {
            x = event.clientX + window.scrollX;
            y = event.clientY + window.scrollY;
        }

        dragObj.elNode.style.left = (dragObj.elStartLeft + x - dragObj.cursorStartX) + "px";
        dragObj.elNode.style.top  = (dragObj.elStartTop  + y - dragObj.cursorStartY) + "px";

        if (isIE)
        {
            window.event.cancelBubble = true;
            window.event.returnValue = false;
        } else
            event.preventDefault();
    },

    show : function()
    {
        var pyr_layer = dom.byId('pyr_layer');
            
        // insert HTML here
        pyr_layer.innerHTML = layout;
        // document.getElementsByTagName('body')[0].appendChild(o);
        
        Pyramid.ui.drag(dom.byId('pyr_caption'), pyr_layer);
        dom.byId('pyr_addtocart').onclick = Pyramid.ui.addToCart;
        dom.byId('pyr_minimize').onclick = Pyramid.ui.toggleMinimize;
        dom.byId('pyr_close').onclick = Pyramid.ui.close;
        dom.byId('pyr_price').onchange
            = dom.byId('pyr_qty').onchange
            = Pyramid.ui.updateTotal;
        dom.byId('pyr_calculate').onclick = Pyramid.ui.calculateTcc;
        
        populate();
        
        // merchant currency display
        displayMerchantCurrency();
        // listen to user switch
        dom.byId('pyr_switch_merchant_country').onclick = switchMerchantCurrency;
        
        // autocomplete
        categoryAutocomplete();
        // listen to select on autocomplete
        dom.byId('pyr_product_res').onclick = categoryAutocompleteListen;
       
        Pyramid.ui.updateTotal();
        
        // remove wait state
        window.setTimeout(function(){
          dom.removeClass(pyr_layer,'wait');
        },1000);

    },
    
    toggleMinimize : function(){
      var c = dom.byId('pyr_content');
      c.style.display = (c.style.display == 'none' ? 'block' : 'none');
      
      var f = dom.byId('pyr_footer');
      f.style.display = (f.style.display == 'none' ? 'block' : 'none');
    },

    populateFromJWS : function()
    {
        JWS.getCountries("en", function(ok, result){
            if (ok == 1)
            {
                var select = dom.byId('pyr_country');
                select.options.add(new Option("Select...", ""));
                var r = result.result;
                for(var i=0; i < r.length; i++) {
                    var d = r[i];
                    select.options.add(new Option(d[1], d[0]));
                }
            }
        });
        
        // category is text field with autocomplete
        JWS.getProductCategories("en",function(ok, result){
          if( ok == 1 ){
            var cat;
            for( var i=0,n=result.result.length;i<n;++i ){
              cat = result.result[i];
              // push ID
              Pyramid.categories.ids.push(cat[0]);
              // push label
              Pyramid.categories.labels.push(cat[1]);
            }
          }
        });
        
        // get BGA host
        Pyramid.data.bgahost = JWS.getBgaHost();
        // hardcode for dev
        // Pyramid.data.bgahost = 'extapp.meslier.borderlinx.be/borderlinx/checkout/';
        

        JWS.keyGet(cartKey, function(ok, value){
            if (ok)
            {
                var data = value.result;
                unserializeCart(data);
            }
        });
    },

    /**
    Highlights the erroring fields for adding a product
    */
    displayProductErrorFields : function(fields){
      for( var i=0,n=fields.length; i<n; ++i ){
        dom.addClass(dom.byId('pyr_'+fields[i]),'error');
      }
    },
    
    /**
    Resets the product field, removing the error class from them
    */
    resetProductErrorFields : function(fields){
      for( var i=0,n=fields.length; i<n; ++i ){
        dom.removeClass(dom.byId('pyr_'+fields[i]),'error');
      }
    },
    
    /**
    Adds an item to the cart
    certain fields must be filled in - or an error will be shown
    */
    addToCart : function(){
        
        // reset errors
        dom.byId('pyr_add_errors').innerHTML  = '';
        // reset fields potentially in error mode
        Pyramid.ui.resetProductErrorFields(Pyramid.required_product_fields);
        
        // check for products limit
        var products = getProducts();
        if( products.length > 9 ){
          dom.byId('pyr_add_errors').innerHTML += 'We are not sorry but you cannot add more than 10 products to your cart.';
          return;
        }
        
        var data = serializeCurrent();
        var missing_fields = [];
        
        // check for missing field values  
        var data_el;
        for( var key in data ){
          data_el = data[key];
          if( Pyramid.required_product_fields.indexOf(key)!=-1){
            if (typeof data_el === 'string' && data_el.replace(/^\s+|\s+$/g,'') === '') {
              missing_fields.push(key);
            } else if (!data_el) {
              missing_fields.push(key);
            }
          }
        }
        // invalidate size field if there are options but none is selected
        if (dom.byId('pyr_size').options !== undefined && dom.byId('pyr_size').options.length > 1 && data['size'] === '') {
          missing_fields.push('size');
        }
        
        // not valid, so show errors
        if( missing_fields.length > 0 ) {
          // hilight the error fields
          Pyramid.ui.displayProductErrorFields(missing_fields);
          dom.byId('pyr_add_errors').innerHTML = 'Missing details for the product. Please check the fields highlighted above.';
        } else {
          createCartProduct(data);
          dom.byId('pyr_cart_empty').style.display='none';
          dom.byId('pyr_tax_section').style.display='block';
          dom.byId('pyr_country_section').style.display='block';
          updateSubtotal();
          saveCart();
        }
    },

    deleteProduct : function(e)
    {
        var block = this.parentNode;
        block.parentNode.removeChild(block);

        var cart = dom.byId('pyr_cart');

        if (dom.byClass(cart, 'pyr_cart_product').length == 0)
        {
            dom.byId('pyr_cart_empty').style.display='block';
            dom.byId('pyr_tax_section').style.display='none';
            dom.byId('pyr_country_section').style.display='none';
            dom.byId('pyr_output_section').style.display='none';
        }
        updateSubtotal();
        resetTccResult();
        saveCart();
        return false;
    },

    close : function()
    {
        var c = dom.byId('pyr_layer');
        c.parentNode.removeChild(c);
        // c.style.display = 'none';
    },

    updateTotal : function()
    {
        var price = fixPriceFormating(dom.byId('pyr_price').value);
        var qty = dom.byId('pyr_qty');
        var prVal = parseFloat(price);
        var qtyVal = +qty.value;
        dom.byId('pyr_total').value = prVal * qtyVal;
        dom.byId('pyr_total_dummy').innerHTML = prVal * qtyVal;
        dom.innerText ( dom.byId('pyr_total_curr'), Pyramid.data.tccParams.currency);
    },
    
    calculateTcc : function()
    {
        dom.byId('pyr_calculate').disabled = true;
        dom.byId('pyr_calculate').className = 'loading';
        dom.byId('pyr_tcc_totalprod').innerHTML = '';
        dom.byId('pyr_tcc_total').innerHTML = '';
        dom.byId('pyr_tcc_total_country').innerHTML = '';
        dom.byId('pyr_tcc_shipping_country').innerHTML = '';
        dom.byId('pyr_tcc_duty_country').innerHTML = '';
        dom.byId('pyr_tcc_duty').innerHTML = '';
        dom.byId('pyr_tcc_tax_country').innerHTML = '';
        dom.byId('pyr_tcc_customs_clearance').innerHTML = '';
        dom.byId('pyr_tcc_customs_clearance_country').innerHTML = '';
        dom.byId('total_shipping_costs_country').innerHTML = '';
        if(dom.byId('total_shipping_costs').children[0] !== undefined) {
          dom.byId('total_shipping_costs').children[0].innerHTML = '';
        }
        dom.byId('pyr_tcc_shipping').innerHTML = '';
        dom.byId('pyr_tcc_tax').innerHTML = '';

        dom.byId('pyr_add_errors').innerHTML = '';
        
        // display the correct FROM country and TO country
        dom.byId('pyr_worldwide_from').innerHTML = Pyramid.from_countries[Pyramid.data.tccParams.from_country_id];
        dom.byId('pyr_worldwide_to').innerHTML = dom.byId('pyr_country').options[dom.byId('pyr_country').selectedIndex].text;
        dom.byId('py_countries_details').style.display = 'block';

        // required fields
        var is_valid = true;
        if( dom.byId('pyr_country').value == '' ){
          is_valid = false;
          dom.byId('pyr_add_errors').innerHTML +='<br>Please select a country of delivery.';
        }
        if( dom.byId('pyr_taxes').value == '' || isNaN(parseFloat(dom.byId('pyr_taxes').value)) ){
          is_valid = false;
          dom.byId('pyr_add_errors').innerHTML +='<br>Please enter an amount for local taxes.';
        }
        if( dom.byId('pyr_shipping_charges').value == '' || isNaN(parseFloat(dom.byId('pyr_shipping_charges').value)) ){
          is_valid = false;
          dom.byId('pyr_add_errors').innerHTML +='<br>Please enter an amount for local shipping charges.';
        }
        if( !is_valid ){
          dom.byId('pyr_calculate').disabled = false;
          dom.byId('pyr_calculate').className = '';
          return false;
        }
        
        var products = getProducts();
        if (!products.length){
          dom.byId('pyr_add_errors').innerHTML +='<br>Please put items to your cart first.';
        }
        else{
            var params = Pyramid.data.tccParams;
            // country ID will be translated by JWS into a local currency
            params["to_country_id"] = dom.byId('pyr_country').value;
            // this is the products currency
            params["currency"] = Pyramid.data.tccParams.currency;
            params["products"] = products;
            params["local_tax"] = dom.byId('pyr_taxes').value;
            params["local_shipping_charge"] = dom.byId('pyr_shipping_charges').value;
            JWS.tcc(params, Pyramid.ui.tccCallback);
        }
        return false;
    },

    /**
    Callback run once JWS answers back with the TCC response
    This response is expressed intow currencies:
    . merchant currency
    . "customer currency", which really is the to_country_id currency
    */
    tccCallback : function(rc, res)
    {
        dom.byId('pyr_calculate').disabled = false;
        dom.byId('pyr_calculate').className = '';
        if (rc == 1){
            
            // update transaction ID
            Pyramid.data.transactionId = res.result.transaction_id;
            // update concierge link
            dom.byId('pyr_bx_concierge').href = [
              JWS.getBgaProtocol(),
              '://',
              JWS.getBgaHost(),
              Pyramid.data.transactionId
            ].join('');
            
            var merchant_res = res.result.merchant;
            var to_country_res = res.result.to_country;

            Pyramid.ga.triggerTCClick(Pyramid.data.tccParams.merchant_name, merchant_res.total_shipping);

            dom.byId('pyr_bx_get_address').onclick = function(){
              Pyramid.ga.triggerGSAddress(Pyramid.data.tccParams.merchant_name, merchant_res.total_shipping);
            };
            
            // update in merchant currency
            dom.byId('pyr_tcc_total').innerHTML = [merchant_res.symbol, merchant_res.total_products].join(' ');
            dom.byId('pyr_tcc_shipping').innerHTML = [merchant_res.symbol, merchant_res.shipping].join(' ');
            dom.byId('pyr_tcc_duty').innerHTML = [merchant_res.symbol, merchant_res.duties].join(' ');
            dom.byId('pyr_tcc_tax').innerHTML = [merchant_res.symbol, merchant_res.tax].join(' ');
            // total
            dom.byId('total_shipping_costs').innerHTML = '<span class="bold">'+[merchant_res.symbol, merchant_res.total_shipping].join(' ')+'</span>';
            // optional insurance
            if( merchant_res.insurance ){
              dom.byId('pyr_tcc_insurance').innerHTML = [merchant_res.symbol, merchant_res.insurance].join(' ');
            }

            // optional customs_clearance
            if( merchant_res.customs_clearance ){
              dom.byId('pyr_tcc_customs_clearance').innerHTML = [merchant_res.symbol, merchant_res.customs_clearance].join(' ');
            } else {
              dom.byId('pyr_tcc_customs_clearance').innerHTML = [merchant_res.symbol, (0.0).toFixed(2)].join(' ');
            }
            
            // update in customer currency
            dom.byId('pyr_tcc_total_country').innerHTML = [to_country_res.symbol, to_country_res.total_products].join(' ');
            dom.byId('pyr_tcc_shipping_country').innerHTML = [to_country_res.symbol, to_country_res.shipping].join(' ');
            dom.byId('pyr_tcc_duty_country').innerHTML = [to_country_res.symbol, to_country_res.duties ].join(' ');
            dom.byId('pyr_tcc_tax_country').innerHTML = [to_country_res.symbol, to_country_res.tax].join(' ');
            // total
            dom.byId('total_shipping_costs_country').innerHTML = [to_country_res.symbol, to_country_res.total_shipping].join(' ');
            // optional insurance
            if( to_country_res.insurance ){
              dom.byId('pyr_tcc_insurance_country').innerHTML = [to_country_res.symbol, to_country_res.insurance].join(' ');
            }

            // optional customs_clearance
            if( to_country_res.customs_clearance ){
              dom.byId('pyr_tcc_customs_clearance_country').innerHTML = [to_country_res.symbol, to_country_res.customs_clearance].join(' ');
            } else {
              dom.byId('pyr_tcc_customs_clearance_country').innerHTML = [to_country_res.symbol, (0.0).toFixed(2)].join(' ');
            }
            
            // get and display nb products in blue block
            var nb_products = 0;
            for( var i=0,n=Pyramid.data.tccParams.products.length;i<n;++i ){
              nb_products += parseInt( Pyramid.data.tccParams.products[i].qty , 10 );
            }
            dom.byId('pyr_total_nb_products').innerHTML = 'TOTAL FOR '+nb_products+' PRODUCTS';
            
            dom.byId('pyr_add_errors').innerHTML = '';

            Pyramid.ui.tccLoadingFinished();
        }
        else if (res.errors){
            dom.byId('pyr_add_errors').innerHTML = res.errors;
        }
        return false;
    },

    tccLoadingFinished : function () {
      dom.byId('pyr_output_section').style.display='block';
    },

    destroy : function () {
        document.body.removeChild(dom.byId('pyr_layer'));
    }
    
    };
})();


Pyramid.parser = (function(){

    /*
     Pattern meaning :

     #identifier - calls getElementById
     .classname - searches by class
     0 (or any number) - gets array element
     :attr - gets attribule
     -{function} - calls processing function

     patterns started with " are not parsed, considered as string constants
     */
    var patterns = {
           'amazon': {
               'shop': '"Amazon',
               'shop_url': '#nav-logo :href',
               'quantity': '#quantity -selected',
               'price': ['#priceblock_saleprice -text -price','#priceblock_ourprice -text -price', '#actualPriceValue -text -price', '.a-color-price 0 -text -price', '#priceBlock .priceLarge 0 -text -price'],
               'descr': ['#btAsinTitle -text', '#btAsinTitle -text', '#title -text'],
               'image': ['#main-image-container .selected 0 img 0 :src','#main-image :src' /**chrome**/, '#original-main-image :src' /**chrome**/, '#imgBlkFront :src', '#landingImage :src' /**firefox**/,'.kib-image-ma 0 :src', '#imageBlockThumbs .imageThumb 0 img 0 :src'],
               'size': ['#native_dropdown_selected_size_name -selected', '#dropdown_selected_size_name -selected', '#size_name -selected', '#selected_size_name .variationLabel 0 -text', '#variation_size_name .a-row 0 .selection 0 -text'],
               'sizes': ['#native_dropdown_selected_size_name -options', '#dropdown_selected_size_name -options', '#size_name -options', '#selected_size_name .variationLabel -texts', '#variation_size_name .a-row 0 .selection -texts'],
               'color': ['#variation_color_name .selection 0 -text', '#selected_color_name .variationLabel 0 -text', '#asinRedirect -selected']
           },

           'ebay': {
               'shop': '"Ebay',
               'price': ['#prcIsum -text -price', '#w1-15-_bidPrice -text -price', '#w1-12-_bidPrice -text -price', '#prcIsum_bidPrice -text -price'],
               'descr': '#itemTitle -textWithoutTags',
               'image': '#icImg :src',
               'size': '.selected-size 0 -text',
               'sizes': '.size-select 0 .size-name -texts',
               'color': '#msku-sel-2 -selected'
           },

           'zara': {
               'shop': '"Zara',
               'descr'  : '#product h1 0 -text',
               'image': '#bigImage :src',
               'color': '.colors 0 .checked 0 -parent span 0 -text',
               'price': ['.price 0 .sale 0 -text -price', '.price 0 .price 0 -text -price'],
               'size': '#size-btn .selected 0 -text',
               'sizes': '#size-btn .product-size -texts'
           },

           'yoox': {
               'shop': '"Yoox',
               'descr': '#itemTitle -text',
               'image': '#mainImage :src',
               'price': ['#itemPrice .newprice 0 -text -price', '#itemPrice -text -price'],
               'sizes': '#itemSizes li -texts',
               'size': '#itemSizes .selected 0 -text',
               'color': '#itemColors .selected 0 img 0 :title'
           },

           'mwave': {
               'shop': '"Mwave',
               'descr': ['#ctl00_main_ucIndividualPhoneBlock_lblPhoneName', '#tblMain div 2 -text'],
               'image': '#productImage :src',
               'price': '.design-box 0 span 1 -text -price'
           },

           'plantsonwalls': {
               'shop': '"Plants On Walls',
               'descr': '.productnamecolorLARGE 0 -text',
               'image': '#product_photo_zoom_url :href',
               'price': '.colors_pricebox 0 span 1 -text -price',
               'color': '.colors_pricebox 0 -textColor'
           },

           'modcloth': {
               'shop': '"Modcloth',
               'descr': ['#product-name -text', '#pdp-product-name -text'],
               'image': '#big_image :src',
               'price': ['#product-price .sale-price 0 -text -price', '#product-price -text -price', '#pdp-price span 0 -text -price'],
               'size': ['.in-stock-selected 0 :value', '.outer_container 0 input 0 :value'],
               'sizes': ['.outer_container 0 input -values', '.outer_container 0 input -values', '.ui-variant-container 0 input -values']
           },

           'onekingslane': {
               'shop': '"ONE KINGS LANE',
               'descr': '.serif 1 -text',
               'price': '#oklPriceLabel -text -price',
               'image': '#productImage :src'
           },

           'katespade': {
               'shop': '"kate spade',
               'descr': '#product-content h1 0 -text',
               'price': ['.price-sales 0 -text -price', '.product-price 0 -text -price'],
               'size': ['.swatches 0 .selected 0 -text', '.swatches .selected 2 a 0 -text', '.swatches .selected 1 a 0 :title'],
               'sizes': ['.swatches 0 li!.visually-hidden -texts', '.swatches 0 li!.visually-hidden -texts', '.swatches 0 li!.visually-hidden -texts'],
               'color': '.swatches 1 .selected 0 a 0 :title',
               'image': '.product-col-1 0 img 0 :src'
           },

           'bodybuilding': {
               'shop': '"Bodybuilding',
               'descr': '.fn 0 -text',
               'image': '.bb-image-viewer 0 :href',
               'price': '.price 0 -text -price',
               'sizes': '#right-content-prod .flavor-table-sub -texts',
               'size': '#right-content-prod .noflavors 0 -text'
           },

           'jcrew': {
               'shop': '"J.CREW',
               'descr': '#productDetailsContainer0 h1 0 -text',
               'price': ['#productDetailsContainer0 .sale-price 0 -text -price', '#productDetailsContainer0 .full-price 0 span 0 -text -price',  '#productDetailsContainer0 .full-price 0 -text -price' ],
               'size': ['#sizes0 .selected 0 -text', '#sizes0 .size-box 0 -text'],
               'sizes': ['#sizes0 .size-box -texts', '#sizes0 .size-box -texts'],
               'color': '#productDetailsContainer0 .color-name 0 -text',
               'image': '#pdpMainImg0 :src'
           },

           'groupon': {
               'shop': '"Groupon',
               'price': ['#purchase-cluster .price 0 -text -price', '#amount -text -price', '.buy 0 .price 0 -text -price'],
               'descr': ['.deal-page-title 0 -text', '.module-body 1 .deal-title 0 -text', '.title_container 0 h2 0 -text', '.deal-title 0 -text'],
               'image': ['.galleria-image -nonempty img 0 :src', '.photos 0 img 0 :src', '#featured-image :src', '#gallery-image-c1 :src', '#gallery-image-c3 :src']
           },

           'ralphlauren': {
               'shop': '"Ralph Lauren',
               'price': ['.templateSalePrice 0 -text -price', '.prodourprice 0 -text -price'],
               'descr': '.prodtitleLG 0 h1 0 -text',
               'image': '#imageDiv img 0 :src',
               'size': '.sizeDropDowntexts 0 -selected',
               'sizes': '.sizeDropDowntexts 0 -options',
               'color': ['.colorDropDowntexts 0 -selected', '.colorHeader 0 span 0 -text']
           },

           'gap': {
               'shop': '"Gap',
               'price': ['#selectionContent .salePrice 0 -text -price', '#selectionContent #priceText -text -price', '.quickLookMupMessage 1 -text -price'],
               'descr': '.productName 0 -text',
               'image': '#product_image :src',
               'size': ['#textSizeDimension1 .swatchLabelName 0 -text', '#sizeDimension1Swatches button 0 -text'],
               'sizes': ['#sizeDimension1Swatches button!.soldOut -texts', '#sizeDimension1Swatches button!.soldOut -texts'],
               'color': '#textColor .swatchLabelName 0 -text'
           },

           'drugstore': {
               'shop': '"Drugstore.com',
               'price': ['#productprice .sale 0 -text -price', '#productprice b 0 -text -price', '#productprice .price 0 -text -price'],
               'descr': '.captionText 0 -text',
               'image': '#divPImage a 0 img 0 :src'
           },

           'carters': {
               'shop': '"Carter\'s',
               'price': '.price-sales 0 -text -price',
               'descr': '.product-name 0 -text',
               'image': '.zoomPad 0 img 0 :src',
               'size': ['.size 0 .selected 0 -text', '.size 0 .emptyswatch 0 -text'],
               'sizes': ['.size 0 li -texts', '.size 0 li -texts'],
               'color': '.selectedColor 0 -text'
           },

           'victoriassecret': {
               'shop': '"Victoria\'s Secret',
               'price': ['.price 0 p 0 -text -price', '.price 0 -text -price'],
               'descr': '#vsImage :alt',
               'image': '#vsImage :src',
               'size': ['.size 0 .selected 0 span 0 -text', '.size 0 .scroll 0 span 0 -text'],
               'sizes': ['.size 0 .scroll 0 a -texts', '.size 0 .scroll 0 a -texts'],
               'color': '.color 0 .selected 0 span 0 -text'
           },

           'sephora': {
               'shop': '"Sephora',
               'price': '.list-price 0 -text -price',
               'descr': '.hero-main-image 0 img 0 :alt',
               'image': '.hero-main-image 0 img 0 :src -absolute',
               'size': '.size 0 .value 0 -text',
               'sizes': '.size 0 .value -texts'
           },

           'nordstrom': {
               'shop': '"Nordstrom',
               'price': ['#itemNumberPriceOuter .price 0 .sale 0 -text -price', '#itemNumberPriceOuter .price 0 .regular 0 -text -price', '#price .item-price 0 span 0 -text -price'],
               'descr': 'h1 1 -text',
               'image': ['.fashion-photo-wrapper 0 img 0 :src -absolute', '#product-image img 0 :src -absolute'],
               'size': ['#skuSelector_size1Value .clearfix 0 .selected 0 label 0 -text', '#skuSelector_size1Value .clearfix 0 label 0 -text', '#size-buttons .selected 0 .option-label 0 :value'],
               'sizes': ['#skuSelector_size1Value .clearfix 0 label -texts', '#skuSelector_size1Value .clearfix 0 label -texts', '#size-buttons .option-label -values'],
               'color': '#color-selector -selected'
           },

           'forever21': {
               'shop': '"Forever 21',
               'price': ['.rform 0 table 0 .items_price 0 -text -price', '.rform 0 table 0 .items_name 1 -text -price', '.rform 0 table 0 .product-price 0 -text -price'],
               'descr': ['.rform 0 table 0 .items_name 0 -text', '.rform 0 table 0 .product-title 0 -text'],
               'image': '#ctl00_MainContent_productImage :src -absolute',
               'size': '#ctl00_MainContent_ddlSize -selected',
               'sizes': '#ctl00_MainContent_ddlSize -options',
               'color': '#ctl00_MainContent_ddlColor -selected'
           },

           'eastbay': {
               'shop': '"Eastbay',
               'price': ['.salePrice 0 -text -price', '.current_price 0 -text -price'],
               'descr': '#pdp_title h1 0 -text',
               'image': '#productImage img 0 :src -absolute',
               'size': '#pdp_sizes .selected 0 -text',
               'sizes': '#pdp_sizes .available -texts',
               'color': '#productAttributes -text'
           },

           'zappos': {
               'shop': '"Zappos',
               'price': ['#priceSlot .salePrice 0 -text -price', '.nowPrice 0 -text -price'],
               'descr': 'h1 0 -text',
               'image': '.actor 0 img 0 :src -absolute',
               'size': ['#d13 -selected', '#d15 -selected'],
               'sizes': ['#d13 -options', '#d15 -options'],
               'color': '#color -selected'
           },

           'eyeslipsface': {
               'shop': '"E. L. F',
               'price': '.price 0 -text -price',
               'descr': 'h1 0 -text',
               'image': '.zoomPad 0 img 0 :src -absolute',
               'color': '.color-options 0 select 0 -selected',
               'size': '.size 0 -text',
               'sizes': '.size -texts'
           },

           'marksandspencer': {
               'shop': '"M&S',
               'price': ['.priceString 0 -text -price', '.pricing 0 .price1 0 span 0 -text -price'],
               'descr': 'h1 0 -text',
               'image': ['.custom-wrap 0 .zoom 0 :src -absolute', '.productImage 0 :src -absolute'],
               'size': ['.size-info 0 .selected 0 .selected-unit 0 -text'],
               'sizes': ['.sizes 0 label -texts'],
               // ['#skuSelector_size1Value .clearfix 0 label -texts', '#skuSelector_size1Value .clearfix 0 label -texts']
               'color': ['.colour-heading 0 .selected-unit 0 -text', '.selectedSwatchInfo 0 -text']
           },

           'gnc': {
               'shop': '"GNC',
               'price': ['.priceNow 0 -text -price', '.product-price 0 .now 0 -text -price'],
               'descr': ['.productDescriptionBlock 0 h2 0 -text', '#product-title h2 0 -text'],
               'image': ['#mainProductImage :src -absolute', '.prod-image 0 :src -absolute']
           },

           'luggageonline': {
               'shop': '"Luggage Online',
               'price': ['.special-price_pp 0 .price_pp 0 -text -price', '.regular-price_pp 0 .price_pp 0 -text -price'],
               'descr': '.product-shop 0 h1 0 -text',
               'image': '#MagicZoomPlusImagemagictoolbox1 img 0 :src -absolute',
               'color': '#attribute272 -selected'
           },

           'myhabit': {
               'shop': '"MY HABIT',
               'price': '#ourPrice -text -price',
               'descr': '#pdHeader -text',
               'image': '#dpCenterImage img 0 :src -absolute',
               'size': '.variationDropdown 0 -selected',
               'sizes': '.variationDropdown 0 -options',
               'color': '.variationSelectOn 0 -text'
           },

           'macys': {
               'shop': '"macys',
               'price': ['.priceSale 0 -text -price', '#priceInfo .standardProdPricingGroup 0 span 0 -text -price'],
               'descr': '#productTitle -text',
               'image': '#mainView_1 :src -absolute',
               'size': ['.sizes 0 .selected 0 -text', '.sizes 0 li 0 -text'],
               'sizes': ['.sizes 0 li -texts', '.sizes 0 li -texts'],
               'color': '.productColor 0 -text'
           },

           'ruelala': {
               'shop': '"Ruelala',
               'price': ['#salePrice -text -price'],
               'descr': '#productName -text',
               'image': '#imgDetail :src -absolute',
               'size': ['#sizeSwatches .selected 0 -text', '#sizeSwatches li 0 -text'],
               'sizes': ['#sizeSwatches a!.soldOut -texts', '#sizeSwatches a!.soldOut -texts']
           },

           'johnlewis': {
               'shop': '"John Lewis',
               'price': ['#prod-price strong 0 -text -price'],
               'descr': '#prod-title -text',
               'image': '.media-player 0 img 0 :src -absolute',
               'size': ['#product-sizes-section .selection-grid 0 .selected 0 span 0 -text', '#product-sizes-section .selection-grid 0 span 0 -text'],
               'sizes': ['#product-sizes-section .selection-grid 0 li!.out-of-stock -texts', '#product-sizes-section .selection-grid 0 li!.out-of-stock -texts'],
               'color': '#prod-product-colour .detail-pair 0 p 0 -text'
           },

           'karenmillen': {
               'shop': '"Karen Millen',
               'price': ['.product_price 0 -text -price', '.productDetailPrice 0 .price 0 -text -price'],
               'descr': ['#product_title -text', '#productTitle span 0 -text'],
               'image': ['#product_image .product_image 0 :src -absolute', '#productImage :src -absolute'],
               'size': ['#select_size ul 0 .selected 0 -text', '#select_size ul 0 li 0 -text', '#size_dropdown -selected'],
               'sizes': ['#select_size ul 0 li!.no_stock -texts', '#select_size ul 0 li!.no_stock -texts', '#size_dropdown -options'],
               'color': '#colour_variants ul 0 .selected 0 span 0 -text'
           },

           'harrods': {
               'shop': '"Harrods',
               'price': ['.product_right_box 0 .price_all 0 -text -price', '.product_right_box 0 .price 0 -text -price'],
               'descr': 'h1 1 -text',
               'image': '.product_img 0 :src -absolute',
               'size': '#size -selected',
               'sizes': '#size -options',
               'color': '#colour -selected'
           },

           'sportsdirect': {
               'shop': '"Sports Direct',
               'price': '#lblSellingPrice -text -price',
               'descr': '#ProductName -text',
               'image': ['#imgProduct :src -absolute', '#img1 :src -absolute'],
               'size': '#sizeDdl -selected',
               'sizes': '#sizeDdl -options',
               'color': ['#colourName -text', '#colourDdl -selected']
           },

           'boots': {
               'shop': '"Boots',
               'price': ['.price 0 -text -price', '.productOfferPrice 0 -text -price'],
               'descr': '.pd_productNameSpan 0 -text',
               'image': ['#genericzoomSmall img 0 :src -absolute', '#ZoomMX :data -bootsImageUrl', '#imageGallery .s7staticimage 0 img 0 :src -absolute'],
               'size': ['#size_x -selected'],
               'sizes': ['#size_x -options'],
               'color': '#colourDdl -selected'
           },

           'debenhams': {
               'shop': '"DEBENHAMS',
               'price': ['#product_pricing .now2 0 -text -price', '.bn_g_result_minprice 0 -text -price'],
               'descr': 'h1 0 -text',
               'image': '#prodImg img 0 :src -absolute',
               'size': ['.prod_sizes 0 .selected 0 span 0 -text', '.prod_sizes 0 ul 0 span 0 -text', '.prod_sizes 0 .drop_down 0 -selected'],
               'sizes': ['.prod_sizes 0 ul 0 li!.out -texts', '.prod_sizes 0 ul 0 li!.out -texts', '.prod_sizes 0 .drop_down 0 -options']
           },

           'mothercare': {
               'shop': '"mothercare',
               'price': ['.mt2-new-pricing 0 .mt2-sales 0 td 1 -text -price', '.pricing 0 .sales 0 -text -price'],
               'descr': '.productname 0 -text',
               'image': ['#zoomImgVdflyzoom :src -absolute', '#dflyzoom .largeimage 0 :src -absolute'],
               'size': ['.swatchesdisplay 0 .selected 0 span 0 -text', '.swatchesdisplay 0 span 0 -text'],
               'sizes': ['.swatchesdisplay 0 span -texts', '.swatchesdisplay 0 span -texts'],
               'color': '.color 0 .selected 0 .checker 0  -text'
           },

           'boohoo': {
               'shop': '"boohoo',
               'price': ['#atrPrice .atrPrice 0 -text -price'],
               'descr': 'h1 0 -text',
               'image': '#mainimg img 0 :src -absolute',
               'size': ['#gridtable thead 0 .highlight 0 span 0 -text', '#gridtable thead 0 tr 0 span 0 -text'],
               'sizes': ['#gridtable thead 0 tr 0 span -texts', '#gridtable thead 0 tr 0 span -texts'],
               'color': '#gridtable tbody 0 .highlight 0 span 0 -text'
           }
       };

    var parseItem = function(pattern)
    {
        if (pattern instanceof Array)
        {
            for (var i=0; i < pattern.length; i++)
            {
                var result = parseItem(pattern[i]);
                if (result) return result;
            }
            return '';
        }
        else if (pattern.indexOf('"') === 0)
        {
            return pattern.substring(1);
        }
        else
        {
            var chunks = pattern.split(' ');
            var current = document;
            for (var i=0; i < chunks.length; i++)
            {
                var chunk = chunks[i].trim();
                if (chunk.indexOf('#') === 0) // ID selector
                {
                    current = document.getElementById(chunk.substring(1));
                    if (!current) return '';
                }
                else if (chunk.indexOf('.') === 0) // class selector
                {
                    var classname = chunk.substring(1);
                    current = Pyramid.dom.byClass(current, classname);
                    if (!current || !current.length) return '';
                }
                else if (chunk.indexOf('!.') === 0) // not class selector
                {
                    var classname = chunk.substring(2);
                    current = Pyramid.dom.byNotClass(current, classname);
                    if (!current.length) return '';
                }
                else if (chunk.indexOf('!.') > 0 ) // not class with tag selector
                {
                    var element = chunk.substring(0, chunk.indexOf('!.'));
                    var classname = chunk.substring(chunk.indexOf('!.')+2);

                    current = current.getElementsByTagName(element);
                    if (!current.length) return '';

                    current = Pyramid.dom.byNotClass(current, classname, true);
                    if (!current.length) return '';

                }
                else if (chunk.indexOf(':') === 0) // attribute selector
                {
                    current = current.getAttribute(chunk.substring(1));

                    // image source can be base64 encoded data so we need to limit size of the attribute data
                    if (!current || !current.length || current.length > 1000) return '';
                }
                else if (!isNaN(chunk)) // array item
                {
                    if ( !current.length) return '';
                    var index = parseInt(chunk);
                    if (chunk > current.length) return '';
                    current = current[index];
                }
                else if (chunk.indexOf('-') === 0) // function
                {
                    var funcName = chunk.substring(1);
                    current = processors[funcName](current);
                }
                else // tag selector
                {
                    current = current.getElementsByTagName(chunk);
                    if (!current.length) return '';
                }
            }
            return current ? current : '';
        }
    };

    var exceptionFunction = function(){

        var e = document;
        e = e.getElementsByClassName('swatchanchor');

        return e;
    };

    var parseAll = function(patternSet)
    {
        var out = {};
        for (var key in patternSet)
        {
            if (exceptionSite && key == 'image'){
                out[key] = exceptionFunction();
            }
            else{
                out[key] = parseItem(patternSet[key]);
            }
            //out[key] = parseItem(patternSet[key]);
        }
        return out;
    };

    var processors = {
        text : function(e)
        {
            e = Pyramid.dom.innerText(e);
            if (e) {
                if (e.match(/color:\s(.*)\s/gi)){
                    e = e.match(/color:\s(.*)\s/gi);
                    e = e[0].replace('Color:', '');
                }
                else{
                    e = e.replace('size', '');
                    e = e.trim().replace('\u2013', '-');
                    e = e.replace('Select Color:', '');
                    e = e.replace('color', '');
                    e = e.replace(':', '');
                    e = e.replace('               ', '');
                }
            }
            return e;
        },

        textWithoutTags : function(e)
        {
            e = Pyramid.dom.deleteTags(e);
            return e;
        },

        textColor : function(e)
        {
            e = Pyramid.dom.innerText(e);
            if (e) {
                if (e.match(/color:\s(.*)\s/gi)){
                    e = e.match(/color:\s(.*)\s/gi);
                    e = e[0].replace('Color:', '');
                }
                else{
                    e = '';
                }
            }
            return e;
        },

        html : function(e)
        {
            return e.innerHtml;
        },

        selected : function(e)
        {
            if (e && e.options) return e.options[e.selectedIndex].text;
            else return '';
        },

        options : function(e)
        {
            if (e && e.options)
            {
                var res = [];
                var opts = e.options;
                for (var i = 0, len = opts.length; i < len; i++)
                {
                    res.push(opts[i].text);
                }
                return res;
            }
            else return [];
        },

        values : function(e)
        {
            if (e && e.length)
            {
                var res = [];
                for (var i = 0, len = e.length; i < len; i++)
                {
                    var val = e[i].getAttribute('value');
                    res.push(val);
                }
                return res;
            }
            else return [];
        },

        texts : function(e)
        {
            if (e && e.length)
            {
                var res = [];
                for (var i = 0, len = e.length; i < len; i++)
                {
                    var elt = e[i];
                    res.push(Pyramid.dom.innerText(elt).trim());
                }
                return res;
            }
            else return [];
        },

        nonempty : function(e)
        {
            if (e.length)
            {
                for (var i = 0, len = e.length; i < len; i++)
                {
                    var child = e[i];
                    if (child && child.childNodes.length)
                    {
                        return child;
                    }
                }
            }
            return '';
        },
        
        parent : function(e)
        {
            if (e)
            {
                return e.parentNode;
            }
            return '';
        },
        
        siblings : function(e)
        {
            if (e)
            {
                return e.parentNode.childNodes;
            }
            return '';
        },

        absolute : function(e)
        {
            if (typeof (e) != 'string') return e;
            var resolver = document.createElement('a');
            resolver.href = e;
            var resolved_url  = resolver.href;
            return resolved_url;
        },

        price: function(s)
        {
            if (s)
            {
                var priceExtract = s.match(/(\d*([.,](?=\d{3}))?\d+)+((?!\2)[.,]\d\d)?/g);
                if (priceExtract && priceExtract.length)
                {
                  var price = priceExtract[0];
                  if (priceExtract[1]) {
                    price = priceExtract[0] + '.' + priceExtract[1];
                  } else {
                    price = priceExtract[0] + '.00';
                  }
                  var currAr = {
                    '$': 'USD',
                    // 'EUR': "EUR",
                    'USD': 'USD',
                    'GBP': 'GBP',
                    '\u00A3' : 'GBP'
                    // '\u20AC' : 'EUR'
                  };
                  var currency = '';
                  for (var curr in currAr)
                  {
                    if (s.indexOf(curr) != -1)
                    {
                      currency = currAr[curr];
                      break;
                    }
                  }
                  return {
                    price: price,
                    curr: currency
                  };
                }
                }
                return {
                    price: '',
                    curr: ''
                };
            },

        bootsImageUrl: function (e) {
            if (!e) return '';
            var serverRE = /serverUrl=([^&]+)/g;
            var server = serverRE.exec(e);
            var imageRE = /image=([^&]+)/g;
            var image = imageRE.exec(e);
            return server[1] + image[1];
        }

    };

    return {
        parse : function(){
            var chunks = window.location.hostname.split('.');
            var domain2nd = chunks[chunks.length-2];
            if (domain2nd == 'co' || domain2nd == 'com') domain2nd = chunks[chunks.length-3];
            
            var isIE = /*@cc_on!@*/false;
            if (domain2nd == 'katespade' && isIE)
                exceptionSite = true;
            var patternSet = patterns[domain2nd];
            if (patternSet) return parseAll(patternSet);
            else return {};
        }
    };

})();

var exceptionSite = false;

Pyramid.dom.init();
Pyramid.ui.init();