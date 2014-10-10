<?php
 
/**
 * Class to handle homepages
 */
 
class Homepage
{
 
  // Properties
 
  /**dis  */
  public $id = null;
 
  /**
  * @var int When the Homepage was published
  */
  public $publicationDate = null;
 
  /**
  * @var int The homepage category ID
  */
  public $categoryId = null;
 
  /**
  * @var string Full title of the homepage
  */
  public $title = null;
 
  /**
  * @var string A short summary of the homepage
  */
  public $summary = null;
 
  /**
  * @var string The HTML content of the homepage
  */
  public $content = null;
  
  /**
  * @var Identify the page_identifier
  */
  public $page_identifier = null;
 /* added function, as described */


  /**
  * Sets the object's properties using the values in the supplied array
  *
  * @param assoc The property values
  */
 
  public function __construct( $hpData=array() ) {
    if ( isset( $hpData['id'] ) ) $this->id = (int) $hpData['id'];
    if ( isset( $hpData['publicationDate'] ) ) $this->publicationDate = (int) $hpData['publicationDate'];
    if ( isset( $hpData['categoryId'] ) ) $this->categoryId = (int) $hpData['categoryId'];
    if ( isset( $hpData['title'] ) ) $this->title = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $hpData['title'] );
    if ( isset( $hpData['summary'] ) ) $this->summary = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $hpData['summary'] );
    if ( isset( $hpData['content'] ) ) $this->content = $hpData['content'];
	if ( isset( $hpData['page_identifier'] ) ) $this->page_identifier = $hpData['page_identifier'];
     /* added page_identifier and cat indetifier to the array */
  }
 
 
  /**
  * Sets the object's properties using the edit form post values in the supplied array
  *
  * @param assoc The form post values
  */
 
  public function storeHomepageFormValues ( $params ) {
 
    // Store all the parameters
    $this->__construct( $params );
 
    // Parse and store the publication date
    if ( isset($params['publicationDate']) ) {
      $publicationDate = explode ( '-', $params['publicationDate'] );
 
      if ( count($publicationDate) == 3 ) {
        list ( $y, $m, $d ) = $publicationDate;
        $this->publicationDate = mktime ( 0, 0, 0, $m, $d, $y );
      }
    }
  }
 
 
  /**
  * Returns a Homepage object matching the given article ID
  *
  * @param int The Homepage ID
  * @return Article|false The article object, or false if the record was not found or there was a problem
  */
 
  public static function getByHomepageId( $id ) {
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "SELECT *, UNIX_TIMESTAMP(publicationDate) AS publicationDate FROM homepages WHERE id = :id";
    $st = $conn->prepare( $sql );
    $st->bindValue( ":id", $id, PDO::PARAM_INT );
    $st->execute();
    $row = $st->fetch();
    $conn = null;
    if ( $row ) return new Homepage( $row );
  }


/*
return a homepage object matching the given homepage page_identifier
*/
public static function getByHomepage_name( $page_identifier ) {
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "SELECT *, UNIX_TIMESTAMP(publicationDate) AS publicationDate FROM homepages WHERE page_identifier = :page_identifier";
    $st = $conn->prepare( $sql );
    $st->bindValue( ":page_identifier", $page_identifier, PDO::PARAM_STR );
    $st->execute();
    $row = $st->fetch();
    $conn = null;
    if( ! $row)
	{
		header("Status: 404 Not Found");
		include_once("404.html");
		die ("Error" . " File: " . __FILE__ . " on line: " . __LINE__); 
	}
   else if ( $row ) return new Homepage( $row );
  }
  


  /**
  * Returns all (or a range of) Homepage objects in the DB
  *
  * @param int Optional The number of rows to return (default=all)
  * @param int Optional Return just articles in the category with this ID
  * @param string Optional column by which to order the articles (default="publicationDate DESC")
  * @return Array|false A two-element array : results => array, a list of Article objects; totalRows => Total number of articles
  */
 
  public static function getList( $numRows=1000000, $categoryId=null, $order="publicationDate DESC" ) {
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $categoryClause = $categoryId ? "WHERE categoryId = :categoryId" : "";
    $sql = "SELECT SQL_CALC_FOUND_ROWS *, UNIX_TIMESTAMP(publicationDate) AS publicationDate FROM homepages $categoryClause
            ORDER BY " . mysql_escape_string($order) . " LIMIT :numRows";
 
    $st = $conn->prepare( $sql );
    $st->bindValue( ":numRows", $numRows, PDO::PARAM_INT );
	if ( $categoryId ) $st->bindValue( ":categoryId", $categoryId, PDO::PARAM_INT );
    $st->execute();
    $list = array();
 
    while ( $row = $st->fetch() ) {
      $homepage = new Homepage( $row );
      $list[] = $homepage;
    }
 
    // Now get the total number of articles that matched the criteria
    $sql = "SELECT FOUND_ROWS() AS totalRows";
    $totalRows = $conn->query( $sql )->fetch();
    $conn = null;
    return ( array ( "results" => $list, "totalRows" => $totalRows[0] ) );
  }
 

 
 
  /**
  * Inserts the current Homepage object into the database, and sets its ID property.
  */
 
  public function insert() {
 
    // Does the Homepage object already have an ID?
    if ( !is_null( $this->id ) ) trigger_error ( "Homepage::insert(): Attempt to insert an Article object that already has its ID property set (to $this->id).", E_USER_ERROR );
 
    // Insert the Homepage
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    
$sql = "INSERT INTO homepages ( publicationDate, categoryId, title, summary, content, page_identifier) VALUES ( FROM_UNIXTIME(:publicationDate), :categoryId, :title, :summary, :content, :page_identifier)";
//add above , page_identifier and :page_identifier
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":publicationDate", $this->publicationDate, PDO::PARAM_INT );
    $st->bindValue( ":categoryId", $this->categoryId, PDO::PARAM_INT );
    $st->bindValue( ":title", $this->title, PDO::PARAM_STR );
    $st->bindValue( ":summary", $this->summary, PDO::PARAM_STR );
    $st->bindValue( ":content", $this->content, PDO::PARAM_STR );
$st->bindValue( ":page_identifier", $this->page_identifier, PDO::PARAM_STR );
    $st->execute();
    $this->id = $conn->lastInsertId();
    $conn = null;
  }
 
 
  /**
  * Updates the current Article object in the database.
  */
 
  public function update() {
 
    // Does the Article object have an ID?
    if ( is_null( $this->id ) ) trigger_error ( "Homepage::update(): Attempt to update an Article object that does not have its ID property set.", E_USER_ERROR );
    
    // Update the Article
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "UPDATE homepages SET publicationDate=FROM_UNIXTIME(:publicationDate), categoryId=:categoryId, title=:title, summary=:summary, content=:content WHERE id = :id";
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":publicationDate", $this->publicationDate, PDO::PARAM_INT );
    $st->bindValue( ":categoryId", $this->categoryId, PDO::PARAM_INT );
    $st->bindValue( ":title", $this->title, PDO::PARAM_STR );
    $st->bindValue( ":summary", $this->summary, PDO::PARAM_STR );
    $st->bindValue( ":content", $this->content, PDO::PARAM_STR );
    $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
    $st->execute();
    $conn = null;
  }
 
 
  /**
  * Deletes the current Article object from the database.
  */
 
  public function delete() {
 
    // Does the Article object have an ID?
    if ( is_null( $this->id ) ) trigger_error ( "Homepage::delete(): Attempt to delete an Article object that does not have its ID property set.", E_USER_ERROR );
 
    // Delete the Article
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $st = $conn->prepare ( "DELETE FROM homepages WHERE id = :id LIMIT 1" );
    $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
    $st->execute();
    $conn = null;
  }
 
}
 
?>