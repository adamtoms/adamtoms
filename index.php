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
  case 'viewHomepage':
  	viewHomepage();
  	break;
  case 'viewHomepageName':
  	viewHomepageName();
  	break;
  case 'viewMenuList':
	viewMenuList();
	break;
  default:
    homepage();
}

function archive() {
  $results = array();
  //remove INT and get by id change to getByCategoryName, allows lookup from cat name. Change template for archive page to include correct links. Cat name is surely better for calling? Can create a new rule too 
  $categoryId = ( isset( $_GET['categoryId'] ) && $_GET['categoryId'] ) ? $_GET['categoryId'] : null;
  $results['category'] = Category::getByCategoryName( $categoryId );
  $data = Article::getPublicList( 100000, $results['category'] ? $results['category']->id : null );
  
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


function viewArticleName() {
  if ( !isset($_GET["page_identifier"]) || !$_GET["page_identifier"] ) {
    homepage();
    return;
  }
  $results = array();
  $results['article'] = Article::getBypage_identifier( $_GET["page_identifier"] );
	$results['category'] = Category::getById( $results['article']->categoryId );
  $results['pageTitle'] = $results['article']->title . " | Adam Toms";
  require( TEMPLATE_PATH . "/viewArticle.php" );
  

}

function homepage() {
  $results = array();
  $data = Article::getPublicList( HOMEPAGE_NUM_ARTICLES );
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
  $data = Article::getPublicList( HOMEPAGE_NUM_ARTICLES );
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
  
  
$menuData = Menus::getMenuList();
$menuResults['menus'] = $menuData['menuResults'];



//$os = array("Mac", "NT", "Irix", "Linux");
/*if (in_array("about", $results)) {
    echo "Got Irix";
}else{echo'not in array';}
*/



  /* if($results['category']->name == true){
 	echo'category name ='.$results['category']->name;
 }else{
 	echo'name missing..';
 }
 */
  
  
 // use the below to set the breadcrum level before, will allow to return to the homepage.
 // $results['pageTitle'] = $results['category']->name . " | Adam Toms";
  require( TEMPLATE_PATH . "/viewArticle.php" );
		
}

/* pull from article using page identifier */
function viewHomepageName() {
  if ( !isset($_GET["page_identifier"]) || !$_GET["page_identifier"] ) {
    homepage();
    return;
  }
  $results = array();
  $results['homepages'] = Homepage::getByHomepage_name( $_GET["page_identifier"] );
  $results['category'] = Category::getById( $results['homepages']->categoryId );
  
  $results['pageTitle'] = $results['homepages']->title . "";
  require( TEMPLATE_PATH . "/viewHomepage.php" );
}

/*******************************************
*** echo the menu list
*******************************************/
function viewMenuList() {

  $results = array();
  $menuData = Menus::getMenuList();
  $results['menus'] = $menuData['results'];
  foreach ( $results['menus'] as $menuItem ) 
  	{ echo'<li>'; echo $menuItem->value; echo'</li>'; }
  	


/*if ($results['category']->name == true){
	echo'true';
}else{
	echo'false';
};
*/


}


//find the cat id and then cat name, 

//take the category name asociated, and set active to menu/list items.





/*******************************************
*** Call a single Global Setting by name //globalSetting("domain")
*******************************************/
function globalSetting($settingName){
  $results = array();
  $results['globalSettings'] = globalSettings::getBySetting_identifier($settingName);
  echo $results['globalSettings']->content;
}


?>
<?php /* page_address_identifier */ ?>