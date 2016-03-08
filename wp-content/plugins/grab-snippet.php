<?php
/*
Plugin Name: grab-snippet
Plugin URI: http://null.null
Description: Grabbing snippets and posting to blog from serp
Version: 1.0
Author: bogdan.titomir@outlook.com
Author URI: http://null.null
*/

define("GOOGLE_QUERY", "http://google.com/search?ie=ISO-8859-1&hl=en&source=hp&q=%QUERY%&btnG=Google+Search&gbv=1&start=%PAGE%&num=100");
register_activation_hook(__FILE__, 'grab_snippet_activation');
register_deactivation_hook(__FILE__, 'grab_snippet_deactivation');

/* aux functions and classes */

class Curl {
	private static $inst;
	private static $ch;
	private $output;

	private function __construct() {
        self::$ch = curl_init();
		# option by default
        curl_setopt(self::$ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt(self::$ch, CURLOPT_FOLLOWLOCATION, false);
        curl_setopt(self::$ch, CURLOPT_USERAGENT, 'Lynx/2.8.8dev.12 libwww-FM/2.14 SSL-MM/1.4.1 GNUTLS/2.12.18');
        curl_setopt(self::$ch, CURLOPT_HEADER, 0);
        curl_setopt(self::$ch, CURLOPT_TIMEOUT, 20);
        //curl_setopt(self::$ch, CURLOPT_PROXY, "127.0.0.1:8080");
	}

	public static function getInstance() {
		if(!is_resource(self::$ch)) {
			self::$inst = new self();
		}
		return self::$inst;
	}

	public function query($q) {
		curl_setopt(self::$ch, CURLOPT_URL, $q);
		$this->output = curl_exec(self::$ch);
		$this->info = curl_getinfo(self::$ch);
		curl_close(self::$ch);
	}

	public function setOpt($option_name, $option_value) {
		curl_setopt(self::$ch, $option_name, $option_value);
	}

	public function getInfo() {
		return $this->info; // $this->curlinfo['total_time'], $this->curlinfo['http_code'];
	}

	public function getResponse() {
		return $this->output;
	}
}

/* function called by activation plugin */

function grab_snippet_activation() {
	global $wpdb;
	add_option('grab_snippet_runinterval', time());
	$table_keys = $wpdb->prefix.'grab_snippet_keys';
	if(USE_MYSQL) {
		$query = "create table if not exists $table_keys 
			(`id` int(11) not null auto_increment,
				`key` varchar(255) null, primary key (`id`))";
	} else {
		$query = "create table if not exists $table_keys
			(`id` integer primary key autoincrement not null,
			`key` varchar(255) null)";
	}
	$result = $wpdb->query($query);
	file_put_contents("C:\\last-error.log", $wpdb->last_error);
}

/* function called by deactivation plugin */

function grab_snippet_deactivation() {
	echo 'deactivation';
}
 
/* admin page settings */

function grab_snippet_admin_action(){
	add_menu_page('Grab Snippet', 'Grab Snippet', 
		'manage_options', 'grab-snippet-plugin', 'grab_snippet_admin_init');
}

function grab_snippet_admin_init() { 
	global $wpdb;
	$table_keys = $wpdb->prefix.'grab_snippet_keys';
	if( wp_verify_nonce( $_POST['fileup_nonce'], 'my_file_upload' ) ){
		if ( ! function_exists( 'wp_handle_upload' ) ) 
			require_once( ABSPATH . 'wp-admin/includes/file.php' );
		$file = $_FILES['my_file_upload'];
		$overrides = array( 'test_form' => false );
		$movefile = wp_handle_upload( $file, $overrides );
		if ( $movefile ) {
			echo "File upload successfull!\n";
			$arr_keys = file($movefile['file'], FILE_IGNORE_NEW_LINES);

			$tpl = "insert into $table_keys (`key`) values ";
			$tmpfunc = create_function('$val', 'return "(\'".$val."\')";');
			$insert_tmp = $tpl.implode(',', array_map($tmpfunc, $arr_keys));
			$led = $wpdb->query($insert_tmp) ? "successfull!" : "error";
			echo "Import to wpdb $led<br>";
		} else {
			echo "File upload error!<br>";
		}
	}
?>
<form enctype="multipart/form-data" action="" method="POST">
	<?php wp_nonce_field( 'my_file_upload', 'fileup_nonce' ); ?>
	<input name="my_file_upload" type="file" />
	<input type="submit" value="Upload file" />
</form>
<?php
	$query = "select `key` from $table_keys";
	$result = $wpdb->get_results($query);
	echo "<ul>";
	foreach($result as $row) {
		echo "<li>".$row->key."</li>";
	}
	echo "</ul>";
}

add_action('admin_menu', 'grab_snippet_admin_action');

/* engine plugin */

function getSnippetContent($query, $page) {
	$url_query = str_replace(array('%PAGE%', '%QUERY%'), array($page, rawurlencode($query)), GOOGLE_QUERY);
	$headers = array(
		'Host: www.google.com',
		'Accept: text/html, text/plain, text/sgml, */*;q=0.01',
		'Accept-Encoding: deflate',
		'Accept-Language: en',
		'User-Agent: Lynx/2.8.3rel.1 libwww-FM/2.14FM',
		'Referer: http://www.google.com/',
		'Cookie2: $Version="1"'
	);

	$curl = Curl::getInstance();
	$curl->setopt(CURLOPT_HTTPHEADER, $headers);
	$curl->query($url_query);
	$info = $curl->getInfo();
	if($info['http_code'] != '200') {
		exit();
	}
	$output = $curl->getResponse();
	return $output;
}

function getKeyFromDB() {
	global $wpdb;
	$table_keys = $wpdb->prefix.'grab_snippet_keys';
	$results = $wpdb->get_results("select * from $table_keys order by rand() limit 0, 1");
	if(empty($results)) return false;
	$query = "delete from $table_keys where id = %d";
	$wpdb->query($wpdb->prepare($query, $results[0]->id)); 
	return $results[0]->key;
}

function run_grabbing() {
	$key = getKeyFromDB();
	$content = getSnippetContent($key, 0);
	//$content = file_get_contents("C:\\hello_world.html");
	preg_match_all("/<td class=\"j\"><font size=\"-1\">([\s\S]+?)<font color=\"green\">/", $content, $match);
	$content = implode($match[1]);
	$content = preg_replace('/<[^>]+>/', '', $content);
	$content = preg_replace( '/[^[:print:]]/', '', $content);
	$content = preg_replace( '/\.\.\./', '', $content);
	$content = preg_replace( '/([a-z])\.([A-Z])/', "\$1. \$2", $content);
	preg_match_all("/[A-Z].+?[a-z]\.\ /", $content, $match);
	$ccc = (count($match[0]) < 10) ? count($match[0]) : 10;
	$cnt = array_rand($match[0], rand(5, $ccc));
	$content = '';
	foreach($cnt as $c)
		$content .= $match[0][$c];

	preg_match_all("/[A-Z].+?[a-z]\.\ /", $content, $match);
	$ccc = (count($match[0]) < 5) ? count($match[0]) : 5;
	$cnt = array_rand($match[0], rand(3, $ccc));

	for($c = 0; $c < count($cnt); $c++) {
		if($c == 3) {
			$tags = "</p><!--more--><p>";
		} else $tags = "</p><p>";
		$match[0][$cnt[$c]] = $tags.$match[0][$cnt[$c]];
	}
	$content = "<p>".implode($match[0])."</p>";

	$posts = get_posts();
	$to_cnt = (count($posts) < 5) ? count($posts) : 5;
	$rand_posts = array_rand($posts, rand(1, $to_cnt));
	$rand_posts = !is_array($rand_posts) ? array($rand_posts) : $rand_posts;
	$words = explode(" ", $content);
	foreach($rand_posts as $c) {
		$link = "<a href=\"".$posts[$c]->guid."\">".$posts[$c]->post_title."</a>";
		array_splice($words, rand(1, count($words)), 0, array($link));
	}
	$content = implode(" ", $words);

	$post = array(
		'post_title' => $key,
		'post_content' => $content,
		'post_status' => 'publish',
		'post_autor' => 1
	);
	wp_insert_post($post);
}

/* main job plugin */

function grab_snippet_action(){
	$timepoint = get_option('grab_snippet_runinterval');
	if(time() > $timepoint) {
		update_option('grab_snippet_runinterval', time() + (rand(3, 10) * 60));
		run_grabbing();
	}
}

add_action('wp_footer', 'grab_snippet_action');
