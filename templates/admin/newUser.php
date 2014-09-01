<?php include "templates/include/admin/header.php" ?>

 
      <h1 style="padding:20px 0;"><?php echo $results['pageTitle']?></h1>
 
      <form action="admin.php?action=<?php echo $results['formAction']?>" method="post" id="newUser" style="max-width: 600px;">
        <input type="hidden" name="newUser" value="<?php echo $results['users']->id ?>"/>
 
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
            <input type="text" name="name" id="name" placeholder="Namee" required maxlength="50"><?php echo htmlspecialchars( $results['users']->name )?></input>
          </li>
 
          <li>
            <label for="content">Email</label>
            <input name="email" id="email" placeholder="Email" required maxlength="50"><?php echo htmlspecialchars( $results['users']->email )?></input>
          </li>
 
          <li>
            <label for="level">Access Level 1-5ASC</label>
            <input type="text" name="level" id="level" placeholder="1-5" required maxlength="1" value="<?php echo htmlspecialchars( $results['users']->level )?>" />
          </li>
 
 
        </ul>
 
        <div class="buttons">
          <input type="submit" name="saveChanges" value="Save Changes" />
          <input type="submit" formnovalidate name="cancel" value="Cancel" />
        </div>
 
      </form>
 
<?php if ( $results['article']->id ) { ?>
      <p><a href="admin.php?action=deleteArticle&amp;articleId=<?php echo $results['article']->id ?>" onclick="return confirm('Delete This Article?')">Delete This Article</a></p>
<?php } ?>
 <p><br><br></p>
<?php include "templates/include/admin/footer.php" ?>