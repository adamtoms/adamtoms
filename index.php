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
  case 'viewCategoryList':
    viewCategoryList();
    break;
  case 'viewCategoryName':
  	viewCategoryName();
  	break;
  case 'viewCategoryNameandArticle':
  	viewCategoryNameandArticle();
  	break;
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



function viewCategoryList() {

  $results = array();
  $data = Category::getList();
  $results['categories'] = $data['results'];
  $results['totalRows'] = $data['totalRows'];
  $results['pageTitle'] = "Categories";
 
  if ( isset( $_GET['error'] ) ) {
    if ( $_GET['error'] == "categoryNotFound" ) $results['errorMessage'] = "Error: Category not found.";
    if ( $_GET['error'] == "categoryContainsArticles" ) $results['errorMessage'] = "Error: Category contains articles. Delete the articles, or assign them to another category, before deleting this category.";
  }
 
  if ( isset( $_GET['status'] ) ) {
    if ( $_GET['status'] == "changesSaved" ) $results['statusMessage'] = "Your changes have been saved.";
    if ( $_GET['status'] == "categoryDeleted" ) $results['statusMessage'] = "Category deleted.";
  }
 
  require( TEMPLATE_PATH . "/viewCategory.php" );
}

/****
 * Gets the category name and returns cat details.


//http://adamtoms.co.uk/?action=viewCategoryName&categoryName=membership
function viewCategoryName() {
 
   if ( !isset($_GET["categoryName"]) || !$_GET["categoryName"] ) {
    homepage();
    return;
  }
  $results = array();
  $results['category'] = Category::getByCategoryName( $_GET["categoryName"] );
  $results['pageTitle'] = $results['category']->name . " | Adam Toms";
  require( TEMPLATE_PATH . "/admin/test.php" );
}
 ****/


//http://adamtoms.co.uk/?action=viewCategoryNameandArticle&categoryName=events&page_identifier=events
function viewCategoryName() {
	
	if ( !isset($_GET["categoryName"]) || !$_GET["categoryName"] ) {
    homepage();
    return;
  }
  
  $results = array();
  $results['category'] = Category::getByCategoryName( $_GET["categoryName"] );
  $results['article'] = Article::getBypage_identifier( $_GET["page_identifier"] );
  $results['pageTitle'] = $results['article']->title . " ";
 
 // use the below to set the breadcrum level before, will allow to return to the homepage.
 // $results['pageTitle'] = $results['category']->name . " | Adam Toms";
  require( TEMPLATE_PATH . "/admin/test.php" );
	
	
}



?>
<?php /* page_address_identifier */ ?>