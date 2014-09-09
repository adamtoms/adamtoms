<?php

$root = $_SERVER['DOCUMENT_ROOT']; 	
require('$root/../../config.php');

session_start();
$action = isset( $_GET['action'] ) ? $_GET['action'] : "";
$username = isset( $_SESSION['username'] ) ? $_SESSION['username'] : "";
 
if ( $action != "login" && $action != "logout" && !$username ) {
  login();
  exit;
}

switch ( $action ) {
  case 'login':
    login();
    break;
  case 'logout':
    logout();
    break;
//articles    
  case 'newArticle':
    newArticle();
    break;
  case 'editArticle':
    editArticle();
    break;
  case 'deleteArticle':
    deleteArticle();
    break;
  case 'listArticles':
    listArticles();
    break;
//menu   
  case 'menuHome':
  	menuHome();
  	break;
  case 'newMenu':
  	newMenu();
  	break;
//categories
    case 'listCategories':
    listCategories();
    break;
  case 'newCategory':
    newCategory();
    break;
  case 'editCategory':
    editCategory();
    break;
  case 'deleteCategory':
    deleteCategory();
    break;
//users
  case 'usersHome':
    usersHome();
  	break;
  case 'newUser':
  	newUser();
    break;
  case 'editUser':
	 editUser();
    break;
  case 'removeUser':
  	removeUser();
  	break;
//Homepages
  case 'newHomepage':
	newHomepage();
	break;
  case 'editHomepage':
	editHomepage();
	break;
  case 'deleteHomepage':
	deleteHomepage();
	break;
  case 'listHomepages':
  	listHomepages();
  	break;
//misc
  case 'siteSettings':
  	siteSettings();
  	break;
  case 'zipSite':
  	zipSite();
  	break;
  default:
    home();
}
 

/*******************************************
*** Login/Out
*******************************************/
//define the user ID as opposed to the

function login() {

	$results['pageTitle'] = "Login";

  if ( isset( $_POST['login'] ) ) {
 
    // User has posted the login form: attempt to log the user in
	if ( $_POST['username'] == ADMIN_USERNAME && $_POST['password'] AND sha1($_POST['password']) == ADMIN_PASSWORD ) {
 
      // Login successful: Create a session and redirect to the admin homepage
      $_SESSION['username'] = ADMIN_USERNAME;
      header( "Location: admin.php" );
 
    } else {
 
      // Login failed: display an error message to the user
      $results['errorMessage'] = "Incorrect username or password. Please try again.";
      require( TEMPLATE_PATH . "/admin/loginForm.php" );
    }
 
  } else {
 
    // User has not posted the login form yet: display the form
    require( TEMPLATE_PATH . "/admin/loginForm.php" );
  }
 
}
 
function logout() {
  unset( $_SESSION['username'] );
  header( "Location: admin.php" );
}
 
/*******************************************
*** New Article
*******************************************/
function newArticle() {
 
  $results = array();
  $results['pageTitle'] = "New Article";
  $results['formAction'] = "newArticle";
  
  if ( isset( $_POST['saveChanges'] ) ) {
 
    // User has posted the article edit form: save the new article
    $article = new Article;
    $article->storeFormValues( $_POST );
    $article->insert();
    header( "Location: admin.php?action=listArticles&status=changesSaved" );
 
  } elseif ( isset( $_POST['cancel'] ) ) {
 
    // User has cancelled their edits: return to the article list
    header( "Location: admin.php?action=listArticles" );
  } else {
 
    // User has not posted the article edit form yet: display the form
    $results['article'] = new Article;
    
    $data = Category::getList();
    $results['categories'] = $data['results'];
    
    require( TEMPLATE_PATH . "/admin/editArticle.php" );
  }
 
}
 
function editArticle() {
 
  $results = array();
  $results['pageTitle'] = "Edit Article";
  $results['formAction'] = "editArticle";
 
  if ( isset( $_POST['saveChanges'] ) ) {
 
    // User has posted the article edit form: save the article changes
 
    if ( !$article = Article::getById( (int)$_POST['articleId'] ) ) {
      header( "Location: admin?action=listArticles&error=articleNotFound" );
      return;
    }
 
    $article->storeFormValues( $_POST );
    $article->update();
    header( "Location: admin.php?action=listArticles&status=changesSaved" );
 
  } elseif ( isset( $_POST['cancel'] ) ) {
 
    // User has cancelled their edits: return to the article list
    header( "Location: admin.php?action=listArticles" );
  } else {
 
    // User has not posted the article edit form yet: display the form
    $results['article'] = Article::getById( (int)$_GET['articleId'] );
    $data = Category::getList();
    $results['categories'] = $data['results'];
    require( TEMPLATE_PATH . "/admin/editArticle.php" );
  }
 
}

function deleteArticle() {
 
  if ( !$article = Article::getById( (int)$_GET['articleId'] ) ) {
    header( "Location: admin.php?action=listArticles&error=articleNotFound" );
    return;
  }
  $article->delete();
  header( "Location: admin.php?action=listArticles&status=articleDeleted" );
}
 
function listArticles() {
  $results = array();
  $data = Article::getList();
  $results['articles'] = $data['results'];
  $results['totalRows'] = $data['totalRows'];
  
  $data = Category::getList();
  $results['categories'] = array();
  foreach ( $data['results'] as $category ) $results['categories'][$category->id] = $category;
  
  $results['pageTitle'] = "All Articles";
  //$results['adminBread'] = "New Article";
 
  if ( isset( $_GET['error'] ) ) {
    if ( $_GET['error'] == "articleNotFound" ) $results['errorMessage'] = "Error: Article not found.";
  }
 
  if ( isset( $_GET['status'] ) ) {
    if ( $_GET['status'] == "changesSaved" ) $results['statusMessage'] = "Your changes have been saved.";
    if ( $_GET['status'] == "articleDeleted" ) $results['statusMessage'] = "Article deleted.";
  }
  require( TEMPLATE_PATH . "/admin/listArticles.php" );
}


/*******************************************
*** home and site tools
*******************************************/

function home() {
	$results['pageTitle'] = "Admin";
	require( TEMPLATE_PATH . "/admin/adminHome.php");	
}

function siteSettings() {
	$results = array();
	$results['pageTitle'] = "Settings";
	require( TEMPLATE_PATH . "/admin/settings.php");	
}


/*******************************************
*** Users Home
*******************************************/

function usersHome() {
	
  $results = array();
  $userData = users::getUserList();
  $results['users'] = $userData['results'];
  $results['username'] = $userData['username'];
  $results['id'] = "id";
  $results['totalRows'] = $userData['totalRows'];
  $results['pageTitle'] = "Users";
 
  if ( isset( $_GET['error'] ) ) {
    if ( $_GET['error'] == "articleNotFound" ) $results['errorMessage'] = "Error: Article not found.";
  }
 
  if ( isset( $_GET['status'] ) ) {
    if ( $_GET['status'] == "changesSaved" ) $results['statusMessage'] = "Your changes have been saved.";
    if ( $_GET['status'] == "articleDeleted" ) $results['statusMessage'] = "Article deleted.";
  }
	
	
	require( TEMPLATE_PATH . "/admin/usersHome.php");
}


/*******************************************
*** New User
*******************************************/

function newUser() {
 
  $results = array();
  $results['pageTitle'] = "New User";
  $results['formAction'] = "newUser";
 
  if ( isset( $_POST['saveChanges'] ) ) {
 
    // User has posted the article edit form: save the new article
    $users = new users;
    $users->storeUserFormValues( $_POST );
    $users->userInsert();
    header( "Location: admin.php?action=usersHome&status=changesSaved" );
 
  } elseif ( isset( $_POST['cancel'] ) ) {
 
    // User has cancelled their edits: return to the article list
    header( "Location: admin.php" );
  } else {
 
    // User has not posted the article edit form yet: display the form
    $results['users'] = new users;
    require( TEMPLATE_PATH . "/admin/newUser.php" );
  }
 
}

/*******************************************
*** Edit Users
*******************************************/

function editUser() {
 
  $results = array();
  $results['pageTitle'] = "Edit User";
  $results['formAction'] = "editUser";
 
  if ( isset( $_POST['saveUserChanges'] ) ) {
 
    // User has posted the article edit form: save the article changes
	
    if ( !$users = users::getUserById( (int)$_POST['userId'] ) ) {
      header( "Location: admin.php?action=usersHome&error=userNotFound" );
      return;
    }
 
    $users->storeUserFormValues( $_POST );
    $users->userUpdate();
    header( "Location: admin.php?action=usersHome&status=changesSaved" );
 
  } elseif ( isset( $_POST['cancel'] ) ) {
 
    // User has cancelled their edits: return to the article list
    header( "Location: admin.php?action=usersHome" );
  } else {
 
    // User has not posted the article edit form yet: display the form
    $results['users'] = users::getUserById( (int)$_GET['id'] );
    require( TEMPLATE_PATH . "/admin/editUsers.php" );
  }
 
}
 

function removeUser() {
	if ( !$users = users::getUserById( (int)$_GET['id'] ) ) {
		header( "Location: admin.php?usersHome&error=userNotFound" );
		return;
	}
 
	$users->removeUser();
	header( "Location: admin.php?action=usersHome&status=userDeleted" );
}




function zipSite() {
	$results['pageTitle'] = "Zip Site";
/*	if "user selects new backup"
	else if "user choses to delete"
	else "list backups with history"
*/	 
	require( TEMPLATE_PATH . "/admin/zip.php" );
}



/*****************
**Start Of Categories
****************/

function listCategories() {
  $results = array();
  $data = Category::getList();
  $results['categories'] = $data['results'];
  $results['totalRows'] = $data['totalRows'];
  $results['pageTitle'] = "Article Categories";
 
  if ( isset( $_GET['error'] ) ) {
    if ( $_GET['error'] == "categoryNotFound" ) $results['errorMessage'] = "Error: Category not found.";
    if ( $_GET['error'] == "categoryContainsArticles" ) $results['errorMessage'] = "Error: Category contains articles. Delete the articles, or assign them to another category, before deleting this category.";
  }
 
  if ( isset( $_GET['status'] ) ) {
    if ( $_GET['status'] == "changesSaved" ) $results['statusMessage'] = "Your changes have been saved.";
    if ( $_GET['status'] == "categoryDeleted" ) $results['statusMessage'] = "Category deleted.";
  }
 
  require( TEMPLATE_PATH . "/admin/listCategories.php" );
}
 
 
function newCategory() {
 
  $results = array();
  $results['pageTitle'] = "New Article Category";
  $results['formAction'] = "newCategory";
 
  if ( isset( $_POST['saveChanges'] ) ) {
 
    // User has posted the category edit form: save the new category
    $category = new Category;
    $category->storeFormValues( $_POST );
    $category->insert();
    header( "Location: admin.php?action=listCategories&status=changesSaved" );
 
  } elseif ( isset( $_POST['cancel'] ) ) {
 
    // User has cancelled their edits: return to the category list
    header( "Location: admin.php?action=listCategories" );
  } else {
 
    // User has not posted the category edit form yet: display the form
    $results['category'] = new Category;
    require( TEMPLATE_PATH . "/admin/editCategory.php" );
  }
 
}
 
 
function editCategory() {
 
  $results = array();
  $results['pageTitle'] = "Edit Article Category";
  $results['formAction'] = "editCategory";
 
  if ( isset( $_POST['saveChanges'] ) ) {
 
    // User has posted the category edit form: save the category changes
 
    if ( !$category = Category::getById( (int)$_POST['categoryId'] ) ) {
      header( "Location: admin.php?action=listCategories&error=categoryNotFound" );
      return;
    }
 
    $category->storeFormValues( $_POST );
    $category->update();
    header( "Location: admin.php?action=listCategories&status=changesSaved" );
 
  } elseif ( isset( $_POST['cancel'] ) ) {
 
    // User has cancelled their edits: return to the category list
    header( "Location: admin.php?action=listCategories" );
  } else {
 
    // User has not posted the category edit form yet: display the form
    $results['category'] = Category::getById( (int)$_GET['categoryId'] );
    require( TEMPLATE_PATH . "/admin/editCategory.php" );
  }
 
}
 
 
function deleteCategory() {
 
  if ( !$category = Category::getById( (int)$_GET['categoryId'] ) ) {
    header( "Location: admin.php?action=listCategories&error=categoryNotFound" );
    return;
  }
 
  $articles = Article::getList( 1000000, $category->id );
 
  if ( $articles['totalRows'] > 0 ) {
    header( "Location: admin.php?action=listCategories&error=categoryContainsArticles" );
    return;
  }
 
  $category->delete();
  header( "Location: admin.php?action=listCategories&status=categoryDeleted" );
}



/*******************************************
*** New Homepage
*******************************************/
function newHomepage() {
 
  $results = array();
  $results['pageTitle'] = "New Homepage";
  $results['formAction'] = "newHomepage";
  
  if ( isset( $_POST['saveChanges'] ) ) {
 
    // User has posted the article edit form: save the new article
    $homepage = new Homepage;
    $homepage->storeHomepageFormValues( $_POST );
    $homepage->insert();
    header( "Location: admin.php?action=listHomepages&status=changesSaved" );
 
  } elseif ( isset( $_POST['cancel'] ) ) {
 
    // User has cancelled their edits: return to the article list
    header( "Location: admin.php?action=listHomepages" );
  } else {
 
    // User has not posted the article edit form yet: display the form
    $results['hompages'] = new Homepage;
    
    $data = Category::getList();
    $results['categories'] = $data['results'];
    
    require( TEMPLATE_PATH . "/admin/editHomepage.php" );
  }
 
}

/*******************************************
*** Edit Homepage
*******************************************/

function editHomepage() {
 
  $results = array();
  $results['pageTitle'] = "Edit Homepage";
  $results['formAction'] = "editHomepage";
 
  if ( isset( $_POST['saveChanges'] ) ) {
 
    // User has posted the article edit form: save the article changes
 
    if ( !$homepage = Homepage::getByHomepageId( (int)$_POST['homepageId'] ) ) {
      header( "Location: admin?action=listHomepages&error=articleNotFound" );
      return;
    }
 
    $homepage->storeHomepageFormValues( $_POST );
    $homepage->update();
    header( "Location: admin.php?action=listHomepages&status=changesSaved" );
 
  } elseif ( isset( $_POST['cancel'] ) ) {
 
    // User has cancelled their edits: return to the article list
    header( "Location: admin.php?action=listArticles" );
  } else {
 
    // User has not posted the article edit form yet: display the form
    $results['homepages'] = Homepage::getByHomepageId( (int)$_GET['homepageId'] );
    $data = Category::getList();
    $results['categories'] = $data['results'];
    require( TEMPLATE_PATH . "/admin/editHomepage.php" );
  }
 
}

/*******************************************
*** delete Homepage
*******************************************/
function deleteHomepage() {
 
  if ( !$homepage = Homepage::getByHomepageId( (int)$_GET['homepageId'] ) ) {
    header( "Location: admin.php?action=listHomepage&error=homepageNotFound" );
    return;
  }
  $homepage->delete();
  header( "Location: admin.php?action=listHomepages&status=homepageDeleted" );
}

/*******************************************
*** List Homepage
*******************************************/
function listHomepages() {
  $results = array();
  $hpData = Homepage::getList();
  $results['homepages'] = $hpData['results'];
  $results['totalRows'] = $hpData['totalRows'];
  
  $data = Category::getList();
  $results['categories'] = array();
  foreach ( $data['results'] as $category ) $results['categories'][$category->id] = $category;
  
  $results['pageTitle'] = "All Homepages";
  //$results['adminBread'] = "New Article";
 
  if ( isset( $_GET['error'] ) ) {
    if ( $_GET['error'] == "articleNotFound" ) $results['errorMessage'] = "Error: Article not found.";
  }
 
  if ( isset( $_GET['status'] ) ) {
    if ( $_GET['status'] == "changesSaved" ) $results['statusMessage'] = "Your changes have been saved.";
    if ( $_GET['status'] == "articleDeleted" ) $results['statusMessage'] = "Article deleted.";
  }
  require( TEMPLATE_PATH . "/admin/listHomepages.php" );
}


/*******************************************
*** Menu Home
*******************************************/

function menuHome() {
	
  $results = array();
  $menuData = menus::getMenuList();
  $results['menus'] = $menuData['results'];
  $results['name'] = $menuData['name'];
  $results['id'] = "id";
  $results['totalRows'] = $menuData['totalRows'];
  $results['pageTitle'] = "Menus";

//add in the error messages. 
	
	require( TEMPLATE_PATH . "/admin/menuHomepage.php");
}

/*******************************************
*** New Menu
*******************************************/
function newMenu() {
 
  $results = array();
  $results['pageTitle'] = "New Menu";
  $results['formAction'] = "newHomepage";
  
  if ( isset( $_POST['saveChanges'] ) ) {
 
    // User has posted the article edit form: save the new article
    $homepage = new Homepage;
    $homepage->storeHomepageFormValues( $_POST );
    $homepage->insert();
    header( "Location: admin.php?action=listHomepages&status=changesSaved" );
 
  } elseif ( isset( $_POST['cancel'] ) ) {
 
    // User has cancelled their edits: return to the article list
    header( "Location: admin.php?action=listHomepages" );
  } else {
 
    // User has not posted the article edit form yet: display the form
    $results['hompages'] = new Homepage;
    
    $data = Category::getList();
    $results['categories'] = $data['results'];
    
    require( TEMPLATE_PATH . "/admin/editHomepage.php" );
  }
 
}

?>