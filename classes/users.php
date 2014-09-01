<?php
 
/**
 * Class to handle users
 */
 
class users
{
 
  // Properties
 
  /**dis  */
  public $id = null;
 
  /**
  * @var int Username
  */
  public $username = null;
 
  /**
  * @var users name
  */
  public $name = null;
 
  /**
  * @var users email
  */
  public $email = null;
 
  /**
  * @var user permissions
  */
  public $level = null;



  /**
  * Sets the object's properties using the values in the supplied array
  *
  * @param assoc The property values
  */
 
  public function __construct( $userData=array() ) {
	if ( isset( $userData['id'] ) ) $this->id = (int) $userData['id'];
//    if ( isset( $data['username'] ) ) $this->username = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['username'] );
//    if ( isset( $data['name'] ) ) $this->name = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['name'] );
//    if ( isset( $data['email'] ) ) $this->email = preg_replace ( "/[^\.\,\-\_\'\"\?\!\:\$ a-zA-Z0-9()]/", "", $data['email'] );
	if ( isset( $userData['username'] ) ) $this->username = $userData['username'];
	if ( isset( $userData['name'] ) ) $this->name = $userData['name'];
	if ( isset( $userData['email'] ) ) $this->email = $userData['email'];
	if ( isset( $userData['level'] ) ) $this->level = (int) $userData['level'];
  }
 
 
  /**
  * Sets the object's properties using the edit form post values in the supplied array
  *
  * @param assoc The form post values
  */
 
  public function storeUserFormValues ( $params ) {
 
    // Store all the parameters
    $this->__construct( $params );
 
  }
 
 
  /**
  * Returns a user matching the given ID
  *
  * @param int The users ID
  * @return users|false The article object, or false if the record was not found or there was a problem
  */
 
  public static function getUserById( $id ) {
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "SELECT *, id AS id FROM users WHERE id = :id";
    $st = $conn->prepare( $sql );
    $st->bindValue( ":id", $id, PDO::PARAM_INT );
    $st->execute();
    $row = $st->fetch();
    $conn = null;
    if ( $row ) return new users( $row );
  }


/*
return an users object matching the given username
*/
public static function getByuser_name( $username ) {
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "SELECT *, UNIX_TIMESTAMP(publicationDate) AS publicationDate FROM users WHERE username = :username";
    $st = $conn->prepare( $sql );
    $st->bindValue( ":username", $username, PDO::PARAM_STR );
    $st->execute();
    $row = $st->fetch();
    $conn = null;
    if ( $row ) return new users( $row );
  }

 
  /**
  * Returns all (or a range of) user objects in the DB
  *
  * @param int Optional The number of rows to return (default=all)
  * @param string Optional column by which to order the articles (default="publicationDate DESC")
  * @return Array|false A two-element array : results => array, a list of Article objects; totalRows => Total number of articles
  * order can be DESC.
  */
 
  public static function getUserList( $numRows=1000000, $order="id ASC" ) {
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "SELECT SQL_CALC_FOUND_ROWS *, (ID) AS ID FROM users
            ORDER BY " . mysql_escape_string($order) . " LIMIT :numRows";
 
    $st = $conn->prepare( $sql );
    $st->bindValue( ":numRows", $numRows, PDO::PARAM_INT );
    $st->execute();
    $list = array();
	
    while ( $row = $st->fetch() ) {
      $users = new users( $row );
      $list[] = $users;
    }
 
    // Now get the total number of users that matched the criteria
    // function not working?!
    $sql = "SELECT FOUND_ROWS() AS totalRows";
    $totalRows = $conn->query( $sql )->fetch();
    $conn = null;
    return ( array ( "results" => $list, "totalRows" => $totalRows[0] ) );
  }
  
 
 /**
  * Inserts the current Article object into the database, and sets its ID property.
  */
 
  public function userInsert() {
 
    // Does the user object already have an ID?
    if ( !is_null( $this->id ) ) trigger_error ( "users::userInsert(): Attempt to insert an Article object that already has its ID property set (to $this->id).", E_USER_ERROR );
 
    // Insert the Article
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "INSERT INTO users ( username, name, email, level ) VALUES ( :username, :name, :email, :level )";
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":username", $this->username, PDO::PARAM_STR );
    $st->bindValue( ":name", $this->name, PDO::PARAM_STR );
    $st->bindValue( ":email", $this->email, PDO::PARAM_STR );
    $st->bindValue( ":level", $this->level, PDO::PARAM_STR );
    $st->execute();
    $this->id = $conn->lastInsertId();
    $conn = null;
  }
 

  
  /**
  * Updates the current Article object in the database.
  */
 
  public function userUpdate() {
 
    // Does the Article object have an ID?
    if ( is_null( $this->id ) ) trigger_error ( "users::userUpdate(): Attempt to update a User object that does not have its ID property set.", E_USER_ERROR );
    
    // Update the user
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "SELECT *, id AS id FROM users WHERE id = :id";
    $sql = "UPDATE users SET username=:username, name=:name, email=:email, level=:level WHERE id=:id"; //original
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":username", $this->username, PDO::PARAM_STR );
    $st->bindValue( ":name", $this->name, PDO::PARAM_STR );
    $st->bindValue( ":email", $this->email, PDO::PARAM_STR );
    $st->bindValue( ":level", $this->level, PDO::PARAM_STR );
    $st->bindValue( ":id", $this->id, PDO::PARAM_INT ); // added 12/8/14 bind Id
    $st->execute();
    $conn = null;
  }
 
 
  /**
  * Deletes the current Article object from the database.
  */
 
  public function removeUser() {
 
    // Does the user object have an ID?
    if ( is_null( $this->id ) ) trigger_error ( "users::removeUser(): Attempt to delete an Article object that does not have its ID property set.", E_USER_ERROR );
 
    // Delete the user
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $st = $conn->prepare ( "DELETE FROM users WHERE id = :id LIMIT 1" );
    $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
    $st->execute();
    $conn = null;
  }
 
}

 
 
 
 
?>