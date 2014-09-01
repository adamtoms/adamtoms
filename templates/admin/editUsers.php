<?php include "templates/include/admin/header.php" ?>
<h1><?php echo $results['pageTitle'] ?></h1>

      <form action="admin.php?action=<?php echo $results['formAction']?>" method="post" id="editUser" style="max-width: 600px;">
        <input type="hidden" name="userId" value="<?php echo $results['users']->id ?>"/>
 
<?php if ( isset( $results['errorMessage'] ) ) { ?>
        <div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
<?php } ?>
 
        <ul>
          <li>
            <label for="title">Username</label>
   <input type="text" name="username" id="username" placeholder="Username" required autofocus maxlength="255" value="<?php echo htmlspecialchars( $results['users']->username )?>" />
          </li>
 
          <li>
            <label for="name">Full Name</label>
            <input type="text" name="name" id="name" placeholder="Name" required maxlength="50" value="<?php echo htmlspecialchars( $results['users']->name )?>"></input>
          </li>
 
          <li>
            <label for="content">Email</label>
            <input name="email" id="email" placeholder="Email" required maxlength="50" value="<?php echo htmlspecialchars( $results['users']->email )?>"></input>
          </li>
 
          <li>
            <label for="level">Access Level 1-5ASC</label>
            <input type="text" name="level" id="level" placeholder="1-5" required maxlength="1" value="<?php echo htmlspecialchars( $results['users']->level )?>" />
          </li>
 
 
        </ul>
 
        <div class="buttons">
          <input type="submit" name="saveUserChanges" value="Save Changes" />
          <input type="submit" formnovalidate name="cancel" value="Cancel" />
        </div>
 
      </form>
 
<?php if ( $results['users']->id ) { ?>
      <p><a href="admin.php?action=removeUser&amp;id=<?php echo $results['users']->id ?>" onclick="return confirm('Delete This Article?')">Delete This Article</a></p>
<?php } ?>

 <p><br><br></p>
<?php include "templates/include/footer.php" ?>