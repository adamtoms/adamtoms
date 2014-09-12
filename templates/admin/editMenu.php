<?php include "templates/include/admin/header.php" ?>
<?php include'templates/include/admin/bread.php';?>

<br><br><br>
<form action="admin.php?action=<?php echo $results['formAction']?>" method="post" id="edit-menu" style="max-width: 100%;">
	<input type="hidden" name="menuId" value="<?php echo $results['menu']->id ?>"/>
 	
 	<?php if ( isset( $results['errorMessage'] ) ) { ?>
        <div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
	<?php } ?>

	<ul>
		<li>
			<label for="name">Menu Name</label>
            <input type="text" name="name" id="name" placeholder="Name of the menu item" required autofocus maxlength="255" value="<?php echo htmlspecialchars( $results['menu']->name )?>"/>
		</li>
		<li>
			<label for="value">Value</label>
			<textarea name="value" id="value" placeholder="htmlhere" required maxlength="1000" style="height: 5em;"><?php echo $results['menus']->value ?></textarea>
		</li>
		<li>
			<label for="itemOrder">Order</label>
			<input type="number" name="itemOrder" min="0" max="<?php echo $results['totalRows']?>" value="" />
				  <?php echo $results['menu']->itemOrder ?>
		</li>
		<li>
			<label for="Live">Live</label>
			<input type="number" name="live" id="live" placeholder="0/1" required autofocus maxlength="255" value="<?php echo htmlspecialchars( $results['menu']->live )?>"/>		
		</li>
	</ul>
	<div class="buttons">
		<input type="submit" name="saveMenuChanges" value="Save Changes" />
		<input type="submit" formnovalidate name="cancel" value="Cancel" />
	</div>
</form>
 
<?php if ( $results['menu']->id ) { ?>
      <p><a href="admin.php?action=deleteHomepage&amp;homepageId=<?php echo $results['homepages']->id ?>" onclick="return confirm('Delete This Article?')">Delete This Homepage</a></p>
<?php } ?>
 <p><br><br></p>
<?php include "templates/include/footer.php" ?>