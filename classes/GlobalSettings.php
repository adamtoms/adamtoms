<?php


/*$GlobalSettings = [
    "DbUser" => "foo",
    "DbPassword" => "bar",
    "Root" => $_SERVER['DOCUMENT_ROOT'],
    "keywords" => "site,key,words,comma,seperates",
    "siteDiscription" => "Learning, Kiting, Photography",
    "domain" => "adamtoms.co.uk",
    "APIKeys" => "longsting"
    ];
//Then you have total clarity, and to access them:
$GlobalSettings["Root"];
// the above method is good, however will have to be edited over FTP. If i create a class and a DB I can change all of these from one page/multiple locations.
*/

 
/**
 * Class to handle Global Settings
 */
 
class globalSettings
{
  // Properties
 
  /**
  * @var int The settings ID from the database
  */
  public $id = null;
 
  /**
  * @var string Name of the category
  */
  public $name = null;
 
  /**
  * @var string A short description of the category
  */
  public $content = null;
 
 /**
  * @var Identify the category_identifier
  */
  public $notes = null;

 
 
  /**
  * Sets the object's properties using the values in the supplied array
  *
  * @param assoc The property values
  */
 
  public function __construct( $data=array() ) {
    if ( isset( $data['id'] ) ) $this->id = (int) $data['id'];
    if ( isset( $data['name'] ) ) $this->name = $data['name'];
    if ( isset( $data['content'] ) ) $this->content = $data['content'];
    if ( isset( $data['notes'] ) ) $this->notes = $data['notes'];
  }

 
  /**
  * Sets the object's properties using the edit form post values in the supplied array
  *
  * @param assoc The form post values
  */
 
  public function storeSettingFormValues ( $params ) {
 
    // Store all the parameters
    $this->__construct( $params );
  }
 
 
  /**
  * Returns a Category object matching the given category ID
  *
  * @param int The category ID
  * @return Category|false The category object, or false if the record was not found or there was a problem
  */
 
  public static function getSettingById( $id ) {
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "SELECT * FROM globalSettings WHERE id = :id";
    $st = $conn->prepare( $sql );
    $st->bindValue( ":id", $id, PDO::PARAM_INT );
    $st->execute();
    $row = $st->fetch();
    $conn = null;
    if ( $row ) return new globalSettings( $row );
  }
 
 
 public static function getBySetting_identifier( $name ) {
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "SELECT * FROM globalSettings WHERE name = :name";
    $st = $conn->prepare( $sql );
    $st->bindValue( ":name", $name, PDO::PARAM_STR );
    $st->execute();
    $row = $st->fetch();
    $conn = null;
    if( ! $row)
	{
		header("Status: 404 Not Found");
		include_once("404.html");
		die ("Error" . " File: " . __FILE__ . " on line: " . __LINE__); 
	}
 else if ( $row ) return new globalSettings( $row );
  }
  
  
 
  /**
  * Returns all (or a range of) Category objects in the DB
  *
  * @param int Optional The number of rows to return (default=all)
  * @param string Optional column by which to order the categories (default="name ASC")
  * @return Array|false A two-element array : results => array, a list of Category objects; totalRows => Total number of categories
  */
 
  public static function getSettingsList( $numRows=1000000, $order="id ASC" ) {
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM globalSettings
            ORDER BY " . mysql_escape_string($order) . " LIMIT :numRows";
 
    $st = $conn->prepare( $sql );
    $st->bindValue( ":numRows", $numRows, PDO::PARAM_INT );
    $st->execute();
    $list = array();
 
    while ( $row = $st->fetch() ) {
      $globalSetting = new globalSettings( $row );
      $list[] = $globalSetting;
    }
 
    // Now get the total number of categories that matched the criteria
    $sql = "SELECT FOUND_ROWS() AS totalRows";
    $totalRows = $conn->query( $sql )->fetch();
    $conn = null;
    return ( array ( "results" => $list, "totalRows" => $totalRows[0] ) );
  }
 
 
  /**
  * Inserts the current Category object into the database, and sets its ID property.
  */
 
  public function insert() {
 
    // Does the Category object already have an ID?
    if ( !is_null( $this->id ) ) trigger_error ( "Category::insert(): Attempt to insert a Category object that already has its ID property set (to $this->id).", E_USER_ERROR );
 
    // Insert the Category
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "INSERT INTO globalSettings ( name, content, notes ) VALUES ( :name, :content, :notes )";
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":name", $this->name, PDO::PARAM_STR );
    $st->bindValue( ":content", $this->content, PDO::PARAM_STR );
    $st->bindValue( ":notes", $this->notes, PDO::PARAM_STR );
    $st->execute();
    $this->id = $conn->lastInsertId();
    $conn = null;
  }
 
 
  /**
  * Updates the current Category object in the database.
  */
 
  public function updateSettings() {
 
    // Does the Category object have an ID?
    if ( is_null( $this->id ) ) trigger_error ( "Category::update(): Attempt to update a Category object that does not have its ID property set.", E_USER_ERROR );
    
    // Update the Category
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "UPDATE globalSettings SET name=:name, content=:content, notes=:notes WHERE id = :id";
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":name", $this->name, PDO::PARAM_STR );
    $st->bindValue( ":content", $this->content, PDO::PARAM_STR );
    $st->bindValue( ":notes", $this->notes, PDO::PARAM_STR );
    $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
    $st->execute();
    $conn = null;
  }
 
 
  /**
  * Deletes the current Category object from the database.
  */
 
  public function deleteSetting() {
 
    // Does the Category object have an ID?
    if ( is_null( $this->id ) ) trigger_error ( "Category::delete(): Attempt to delete a Category object that does not have its ID property set.", E_USER_ERROR );
 
    // Delete the Category
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $st = $conn->prepare ( "DELETE FROM globalSettings WHERE id = :id LIMIT 1" );
    $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
    $st->execute();
    $conn = null;
  }
 
}
 
?>