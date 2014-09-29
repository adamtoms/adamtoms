<?php include "templates/include/admin/header.php" ?>
<?php include'templates/include/admin/bread.php';?>

	<form action="admin.php?action=<?php echo $results['formAction']?>" method="post" id="edit-settings">
		<input type="hidden" name="settingId" value="<?php echo $results['globalSettings']->id ?>"/>
		<ul>
			<li>
				<label for="name">Name/id</label>
				<input type="text" name="name" id="name" placeholder="Name of setting" required autofocus maxlength="255" value="<?php echo  $results['globalSettings']->name ?>" />
			</li>
			<li>
				<label for="content">Content</label>
				<textarea name="content" id="content" placeholder="utf8 content" required maxlength="100000" style="height: 5em;"><?php echo htmlspecialchars( $results['globalSettings']->content )?></textarea>
			</li>
			<li>
				<label for="notes">Notes</label>
				<textarea name="notes" id="notes" placeholder="anything to remember/explain?" required maxlength="150" style="height: 5em;"><?php echo htmlspecialchars( $results['globalSettings']->notes )?></textarea>
			</li>
		</ul>
		
        <div class="buttons">
			<input type="submit" name="saveChanges" value="Save Changes" />
			<input type="submit" formnovalidate name="cancel" value="Cancel" />
			<?php if ( $results['globalSettings']->id ) { ?>
      		<p><a href="admin.php?action=deleteSetting&amp;settingId=<?php echo $results['globalSettings']->id ?>" onclick="return confirm('Delete This Article?')">Delete This Article</a></p>
<?php } ?>
		</div>
	</form>
	<?php include "templates/include/footer.php" ?>