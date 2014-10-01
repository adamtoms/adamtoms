<?php include "templates/include/admin/header.php" ?>
<?php include'templates/include/admin/bread.php';?>
	<form action="admin.php?action=<?php echo $results['formAction']?>" method="post" id="edit-menu">
		<input type="hidden" name="menuId" value="<?php echo $results['menus']->id ?>"/>
		<ul>
			<li>
				<label for="name">Name</label>
				<input type="text" name="name" id="name" placeholder="Name of the menu item" required autofocus maxlength="255" value="<?php echo htmlspecialchars( $results['menus']->name )?>" />
			</li>
			<li>
				<label for="value">value</label>
				<textarea name="value" id="value" placeholder="Brief description of the article" required maxlength="1000" style="height: 5em;"><?php echo ( $results['menus']->value )?></textarea>
			</li>
			<li>
				<label for="child">Child</label>
				<input type="text" name="child" id="child" placeholder="Name of the menu item" required autofocus maxlength="255" value="<?php echo htmlspecialchars( $results['menus']->child )?>" />
			</li>
			<li>
				<label for="itemOrder">itemOrder</label>
				<input type="number" name="itemOrder" id="itemOrder" placeholder="Name of the menu item" required autofocus maxlength="255" value="<?php echo htmlspecialchars( $results['menus']->itemOrder )?>" />
			</li>
			<li>
				<label for="live">live</label>
				<input type="text" name="live" id="live" placeholder="Name to appear in url category/page_identifier/" required autofocus maxlength="255" value="<?php echo htmlspecialchars( $results['menus']->live )?>" />
			</li>
		</ul>
        <div class="buttons">
			<input type="submit" name="saveChanges" value="Save Changes" />
			<input type="submit" formnovalidate name="cancel" value="Cancel" />
			<?php if ( $results['menus']->id ) { ?>
      		<p><a href="admin.php?action=deleteMenu&amp;menuId=<?php echo $results['menus']->id ?>" onclick="return confirm('Delete This Article?')">Delete This Article</a></p>
<?php } ?> -->
		</div>
	</form>
	<?php include "templates/include/footer.php" ?>