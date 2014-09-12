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
	if ( isset( $menuData['child'] ) ) $this->child = $menuData['child'];
	if ( isset( $menuData['itemOrder'] ) ) $this->itemOrder = (int) $menuData['itemOrder'];
	if ( isset( $menuData['live'] ) ) $this->live = (int) $menuData['live'];
  }
 
  /**
  * Sets the object's properties using the edit form post values in the supplied array
  *
  * @param assoc The form post values
  */
 
  public function storeFormValues ( $params ) {
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
 
 public static function getMenuList( $numRows=1000000, $order="id ASC" ) {
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "SELECT SQL_CALC_FOUND_ROWS *, (ID) AS ID FROM menus
            ORDER BY " . mysql_escape_string($order) . " LIMIT :numRows";
 
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
}
 
?>
