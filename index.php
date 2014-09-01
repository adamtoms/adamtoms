<?php
$root = $_SERVER['DOCUMENT_ROOT']; 	
require('$root/../../config.php');

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
  case 'listArticles';
    listArticles();
    break;
  case 'viewCategoryName';
  	viewCategoryName();
  default:
    homepage();
}



function archive() {
  $results = array();
  
  $categoryId = ( isset( $_GET['categoryId'] ) && $_GET['categoryId'] ) ? (int)$_GET['categoryId'] : null;
  $results['category'] = Category::getById( $categoryId );
  $data = Article::getList( 100000, $results['category'] ? $results['category']->id : null );
  
  $results['articles'] = $data['results'];
  $results['totalRows'] = $data['totalRows'];
  
  $data = Category::getList();
  $results['categories'] = array();
  foreach ( $data['results'] as $category ) $results['categories'][$category->id] = $category;
  $results['pageHeading'] = $results['category'] ?  $results['category']->name : "Article Archive";
  $results['pageTitle'] = $results['pageHeading'] . "Article Archive | Adam Toms";
  
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
  $results['category'] = Category::getById( $results['article']->categoryId );
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



/* this has the same function as abo
function viewCategoryName() {
  if ( !isset($_GET["category_identifier"]) || !$_GET["category_identifier"] ) {
    homepage();
    return;
  }
  $results = array();
  $results['category'] = category::getBycategory_identifier( $_GET["category_identifier"] );
  $results['pageTitle'] = $results['article']->title . " | Adam Toms";
  require( TEMPLATE_PATH . "/viewArticle.php" );
} */








 
function homepage() {
  $results = array();
  $data = Article::getList( HOMEPAGE_NUM_ARTICLES );
  $results['articles'] = $data['results'];
  $results['totalRows'] = $data['totalRows'];
  
  $data = Category::getList();
  $results['categories'] = array();
  foreach ( $data['results'] as $category ) $results['categories'][$category->id] = $category; 
  
  $results['pageTitle'] = "Adam Toms";
  require( TEMPLATE_PATH . "/homepage.php" );
}

function listArticles() {
  $results = array();
  $data = Article::getList( HOMEPAGE_NUM_ARTICLES );
  $results['articles'] = $data['results'];
  $results['totalRows'] = $data['totalRows'];
  $results['pageTitle'] = "Adam Toms";
  require( TEMPLATE_PATH . "/homepage.php" );
}

?>
<?php /* page_address_identifier */ ?>