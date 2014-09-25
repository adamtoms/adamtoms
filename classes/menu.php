<?php
 
/**
 * Class to handle menu items
 */
 
class menus
{
 
  // Properties
 
  /**dis  */
  public $id = null;
 
  /**
  * @var string name of the menu item
  */
  public $name = null;
 
  /**
  * @var string the html value of menu item
  */
  public $value = null;
 
  /**
  * @var level of menu item
  */
  public $child = null;
  
  /**
  * @var order to appear in list
  */
  public $itemOrder = null;
 
   /**
  * @var boolean true false, sets live/visible
  */
  public $live = null;



  /**
  * Sets the object's properties using the values in the supplied array
  *
  * @param assoc The property values
  */
 
  public function __construct( $menuData=array() ) {
    if ( isset( $menuData['id'] ) ) $this->id = (int) $menuData['id'];
	if ( isset( $menuData['name'] ) ) $this->name = $menuData['name'];
    if ( isset( $menuData['value'] ) ) $this->value = $menuData['value'];
	if ( isset( $menuData['child'] ) ) $this->child = (int) $menuData['child'];
	if ( isset( $menuData['itemOrder'] ) ) $this->itemOrder = (int) $menuData['itemOrder'];
	if ( isset( $menuData['live'] ) ) $this->live = (int) $menuData['live'];
  }
 
  /**
  * Sets the object's properties using the edit form post values in the supplied array
  *
  * @param assoc The form post values
  */
 
  public function storeMenuFormValues ( $params ) {
    // Store all the parameters
    $this->__construct( $params );
  }
 
  
  /**
  * Returns an Article object matching the given article ID
  *
  * @param int The article ID
  * @return Article|false The article object, or false if the record was not found or there was a problem
  */
 
  public static function getMenuById( $id ) {
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "SELECT *, id AS id FROM menus WHERE id = :id";
    $st = $conn->prepare( $sql );
    $st->bindValue( ":id", $id, PDO::PARAM_INT );
    $st->execute();
    $row = $st->fetch();
    $conn = null;
    if ( $row ) return new menus( $row );
  }



  /**
  * Returns all (or a range of) Article objects in the DB
  *
  * @param int Optional The number of rows to return (default=all)
  * @param int Optional Return just articles in the category with this ID
  * @param string Optional column by which to order the articles (default="publicationDate DESC")
  * @return Array|false A two-element array : results => array, a list of Article objects; totalRows => Total number of articles
  */
 
 public static function getMenuList( $numRows=1000000, $order="id ASC" ) {/*DESC*/
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "SELECT SQL_CALC_FOUND_ROWS *, (ID) AS ID FROM menus
            ORDER BY " . ($order) . " LIMIT :numRows";
 
    $st = $conn->prepare( $sql );
    $st->bindValue( ":numRows", $numRows, PDO::PARAM_INT );
    $st->execute();
    $list = array();
	
    while ( $row = $st->fetch() ) {
      $menus = new menus( $row );
      $list[] = $menus;
    }

    // Now get the total number of menu items that matched the criteria
    $sql = "SELECT FOUND_ROWS() AS totalRows";
    $totalRows = $conn->query( $sql )->fetch();
    $conn = null;
    return ( array ( "results" => $list, "totalRows" => $totalRows[0] ) );

  }

 /**
  * Inserts the current Article object into the database, and sets its ID property.
  */
 
  public function menuInsert() {
 
    // Does the menu object already have an ID?
    if ( !is_null( $this->id ) ) trigger_error ( "users::userInsert(): Attempt to insert an Article object that already has its ID property set (to $this->id).", E_USER_ERROR );
 
    // Insert the Article
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "INSERT INTO menus ( name, value, child, itemOrder, live ) VALUES ( :name, :value, :child, :itemOrder, :live )";
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":name", $this->name, PDO::PARAM_STR );
    $st->bindValue( ":value", $this->value, PDO::PARAM_STR );
    $st->bindValue( ":child", $this->child, PDO::PARAM_INT );
    $st->bindValue( ":itemOrder", $this->itemOrder, PDO::PARAM_INT );
    $st->bindValue( ":live", $this->live, PDO::PARAM_INT );
    $st->execute();
    $this->id = $conn->lastInsertId();
    $conn = null;
  }
	

  /**
  * Updates the current Article object in the database.
  */
 
  public function menuUpdate() {
 
    // Does the Article object have an ID?
    if ( is_null( $this->id ) ) trigger_error ( "users::userUpdate(): Attempt to update a User object that does not have its ID property set.", E_USER_ERROR );
    
    // Update the user
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "SELECT *, id AS id FROM menus WHERE id = :id";
    $sql = "UPDATE menus SET name=:name, value=:value, child=:child, itemOrder=:itemOrder, live=:live WHERE id=:id"; //original
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":name", $this->name, PDO::PARAM_STR );
    $st->bindValue( ":value", $this->value, PDO::PARAM_STR );
    $st->bindValue( ":child", $this->child, PDO::PARAM_INT );
    $st->bindValue( ":itemOrder", $this->itemOrder, PDO::PARAM_INT );
    $st->bindValue( ":live", $this->live, PDO::PARAM_INT );
    $st->bindValue( ":id", $this->id, PDO::PARAM_INT ); // added 12/8/14 bind Id
    $st->execute();
    $conn = null;
  }
 
 
  /**
  * Deletes the current Article object from the database.
  */
 
  public function deleteMenu() {
 
    // Does the user object have an ID?
    if ( is_null( $this->id ) ) trigger_error ( "users::removeUser(): Attempt to delete an Article object that does not have its ID property set.", E_USER_ERROR );
 
    // Delete the user
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $st = $conn->prepare ( "DELETE FROM menus WHERE id = :id LIMIT 1" );
    $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
    $st->execute();
    $conn = null;
  }
 
}
  
	

?>