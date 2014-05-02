<?php
$root = $_SERVER['DOCUMENT_ROOT']; 	
require('$root/../../../config.php');

$action = isset( $_GET['action'] ) ? $_GET['action'] : "";
 
switch ( $action ) {
  case 'archive':
    archive();
    break;
  case 'viewArticle':
    viewArticle();
    break;
  case 'viewArticleName':
    viewArticleName();
    break;
  default:
    homepage();
}
 /* view articleName added to switch*/
 
function archive() {
  $results = array();
  $data = Article::getList();
  $results['articles'] = $data['results'];
  $results['totalRows'] = $data['totalRows'];
  $results['pageTitle'] = "Article Archive | Adam Toms";
  $results['page_identifier'] = $data['page_identifier'];
  require( TEMPLATE_PATH . "/archive.php" );
}
 
function viewArticle() {
  if ( !isset($_GET["articleId"]) || !$_GET["articleId"] ) {
    homepage();
    return;
  }
 
  $results = array();
  $results['article'] = Article::getById( (int)$_GET["articleId"] );
  $results['pageTitle'] = $results['article']->title . " | Adam Toms";
  require( TEMPLATE_PATH . "/viewArticle.php" );
}

/* pull from article using page identifier */
function viewArticleName() {
  if ( !isset($_GET["page_identifier"]) || !$_GET["page_identifier"] ) {
    homepage();
    return;
  }
  $results = array();
  $results['article'] = Article::getBypage_identifier( $_GET["page_identifier"] );
  $results['pageTitle'] = $results['article']->title . " | Adam Toms";
  require( TEMPLATE_PATH . "/viewArticle.php" );
}

 
function homepage() {
  $results = array();
  $data = Article::getList( HOMEPAGE_NUM_ARTICLES );
  $results['articles'] = $data['results'];
  $results['totalRows'] = $data['totalRows'];
  $results['pageTitle'] = "Adam Toms";
  require( TEMPLATE_PATH . "/homepage.php" );
}
 
?>
<?php /* page_address_identifier */ ?>