<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'О нас';
//$this->params['breadcrumbs'][] = $this->title;

$this->registerCss('
h1 {
	text-align:center;
padding: 30px 0px;
}
	');
?>

<script>
/*javascript:(
	function(){
		window.PYHOST='lqwintry.com';
		var w=window,d=w.document,o=d.createElement('script'),x=location.protocol+'//'+w.PYHOST+'/js/pyramid.js';
		(function t(){
			w.BXMERCHID='borderlinx';
			if (d.readyState&amp;&amp;d.readyState!='complete'){setTimeout(t,100);}
			else{o.setAttribute('src', x + '?r=' + Math.random());
			d.getElementsByTagName('head')[0].appendChild(o);}
		})();
	}())
*/</script>
    

</div>
<section id="about-us-banner" class="container-banner"> <div class="container"><h1><?= Html::encode($this->title) ?></h1> </div> </section>

<section id="who-we-are"> 
	<div class="container"> 
		<h2>Кто мы</h2> 
		<p> We are revolutionising the way people shop around the world by providing the freedom to purchase from any website using their 
			<a href="/en/pages/how-it-works">very own US, UK, Hong Kong or German shipping address</a>. 
			We are used by both consumers and businesses to buy all sorts of products and merchandise from overseas. 
		</p> 
		<p>We also provide a business suit of cross-border services so any merchant can integrate the Borderlinx service directly into their 
			ecommerce front-end and backoffice. Please visit our dedicated <a href="http://www.borderlinx-solutions.com" target="_blank">B2B solutions website</a> 
			or our <a href="https://www.linkedin.com/company/borderlinx" target="_blank">Company page</a> on LinkedIn®.
		</p> 
	</div> 
</section>

<section id="management-team"> 
	<div class="container"> 
		<h2>The management team</h2> 
		<ol class="list-unstyled"> 
			<li class="row"> 
				<div class="col-12 col-xs-4 col-sm-3 col-md-3 col-lg-3"> 
					<img style="display: inline;" class="lazy image-responsive lazydone" src="/img/jerome_mercier.png" 
					alt="Jérôme Mercier" height="280" width="281"> 
				</div> 
				<div class="col-12 col-xs-8 col-sm-9 col-md-9 col-lg-9"> 
					<h3><a href="http://be.linkedin.com/in/jpamercier" target="_blank">Jérôme Mercier</a>, CEO</h3> 
					<p>12 years experience in eCommerce, product and marketing.<br>
						Jerome has extensive experience in the intermediation business model as the co-founder of Kelkoo.com, Europe's leading price comparison site.
						<br>He has a strong background in retailing having also served as CMO of PhotoBox.com.
					</p> 
				</div> 
			</li> 
			<li class="row"> 
				<div class="col-12 col-xs-8 col-sm-9 col-md-9 col-lg-9"> 
					<h3 class="team-right"><a href="http://fr.linkedin.com/pub/yves-languepin/6/2b/a67" target="_blank">Yves Languepin</a>, CTO</h3> 
					<p class="team-right">20 years of experience in web &amp; eCommerce business (ChateauOnline, EYEKA, eBuzzing). 
						Yves combines a strong vision for innovation with successful track records in starting and building technology-enabled services and media businesses.
					</p> 
				</div> 
				<div class="col-12 col-xs-4 col-sm-3 col-md-3 col-lg-3"> 
					<img style="display: inline;" class="lazy image-responsive lazydone" src="/img/yves_languepin.png" 
					alt="Yves Languepin" height="280" width="281"> 
				</div> 
			</li> 
			<li class="row"> 
				<div class="col-12 col-xs-4 col-sm-3 col-md-3 col-lg-3"> 
					<img style="display: inline;" class="lazy image-responsive lazydone" src="/img/sebastien_dubuisson.png" 
					alt="Sébastien Dubuisson" height="280" width="281"> 
				</div> 
				<div class="col-12 col-xs-8 col-sm-9 col-md-9 col-lg-9"> 
					<h3><a href="http://fr.linkedin.com/in/sebastiendubuisson" target="_blank">Sébastien Dubuisson</a>, 
						CPO and Head of Marketing &amp; Customer Support
					</h3> 
					<p>12 years experience in eCommerce &amp; product management (ebay). Sebastien developed a deep understanding of the internet industry, 
						both in terms of business strategy and product design. His focus has been on optimising complex ecosystems through a customer-centric and 
						analytical approach, to generate additional purchases &amp; revenue.
					</p> 
				</div> 
			</li> 
			<!-- <li class="row"> <div class="col-12 col-xs-8 col-sm-9 col-md-9 col-lg-9"> <h3 class="team-right"><a href="http://uk.linkedin.com/pub/matthew-mitchell/28/a44/374" target="_blank">Matthew Mitchell</a>, SVP Business Development and Head of Global Sales</h3> <p class="team-right">10 years experience in logistics. Matt has an exceptional track record in DHL&#39;s Supply Chain, Express and Freight business units encompassing operations, process improvement and commercial management with some of DHL&#39;s largest customers.</p> </div> <div class="col-12 col-xs-4 col-sm-3 col-md-3 col-lg-3"> <img class="lazy image-responsive" height="280" width="281" src="http://a.bximg.net/images/ui/lazy.png" data-original="http://a.bximg.net/images/marketing/about-us/matthew_mitchell.png" alt="Matthew Mitchell"> </div> </li> --> 
			<li class="row"> 
				<div class="col-12 col-xs-8 col-sm-9 col-md-9 col-lg-9"> 
					<h3><a href="http://www.linkedin.com/pub/elizabeth-marshall/31/14/4a6" target="_blank">Elizabeth Marshall</a>, VP Supply Chain Innovations</h3> 
					<p>Over 14 years experience within the logistics industry (Fedex, UPS, Groupon). Elizabeth is an award winning expert in providing end to end supply chain solutions. 
						She is an outstanding sales and procurement professional, who is experienced in multiple vertical markets, with distinctive competencies in the e-commerce 
						and retail arena.
					</p> 
				</div> 
				<div class="col-12 col-xs-4 col-sm-3 col-md-3 col-lg-3"> 
					<img style="display: inline;" class="lazy image-responsive lazydone" src="/img/elizabeth_marshall.png" 
					alt="Elizabeth Marshall" height="280" width="281"> 
				</div> 
			</li> 
			<li class="row"> 
				<div class="col-12 col-xs-4 col-sm-3 col-md-3 col-lg-3"> 
					<img style="display: inline;" class="lazy image-responsive lazydone" src="/img/phil_ochsner.png" 
					alt="Phil Ochsner" height="280" width="281"> 
				</div> 
				<div class="col-12 col-xs-8 col-sm-9 col-md-9 col-lg-9"> 
					<h3 class="team-right"><a href="http://www.linkedin.com/profile/view?id=18903678" target="_blank">Phil Ochsner</a>, Director of Business Development</h3> 
					<p class="team-right">15 years in Sales and Business Development, leading teams at a number of software start-ups, 
						including Zillow, DocuSign, Tableau, and K2 Software. Phil's knowledge, experience, and success has been largely aided by his data driven and 
						consultative approach. Finding optimal solutions for his clients is a passion and science that he continues to strive for.
					</p> 
				</div> 
			</li> 
			<li class="row"> 
				<div class="col-12 col-xs-8 col-sm-9 col-md-9 col-lg-9"> 
					<h3><a href="http://fr.linkedin.com/pub/franck-guellerin/0/69a/6a" target="_blank">Franck Guellerin</a>, VP Business Development (Europe)</h3> 
					<p>12 years experience in Sales and Business Development, holding senior management positions in the areas of IT and Telecoms. 
						Franck has a deep experience and keen understanding of business issues, and a strong ability to nurture solid relationships with customers.
					</p> 
				</div> 
				<div class="col-12 col-xs-4 col-sm-3 col-md-3 col-lg-3"> 
					<img style="display: inline;" class="lazy image-responsive lazydone" src="/img/franck_guellerin.png" 
					alt="Franck Guellerin" height="280" width="281"> 
				</div> 
			</li> 
		</ol> 
	</div> 
</section>

<div class="container">
