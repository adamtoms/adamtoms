<?php include "templates/include/admin/header.php" ?>
<?php include'templates/include/admin/bread.php';?>

<br><br><br>
<form action="admin.php?action=<?php echo $results['formAction']?>" method="post" id="edit-homepage" style="max-width: 100%;">
	<input type="hidden" name="homepageId" value="<?php echo $results['homepages']->id ?>"/>
 	
 	<?php if ( isset( $results['errorMessage'] ) ) { ?>
        <div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
	<?php } ?>

	<ul>
		<li>
			<label for="title">Homepage Title</label>
            <input type="text" name="title" id="title" placeholder="Name of the article" required autofocus maxlength="255" value="<?php echo htmlspecialchars( $results['homepages']->title )?>"/>
		</li>
		<li>
			<label for="summary">Summary</label>
			<textarea name="summary" id="summary" placeholder="Brief description of the article" required maxlength="1000" style="height: 5em;"><?php echo htmlspecialchars( $results['homepages']->summary )?></textarea>
		</li>
		<li>
			<label for="content">Homepage Content</label>
			<textarea name="content" id="content" placeholder="The HTML content of the article" required maxlength="100000" style="height: 30em;"><?php echo htmlspecialchars( $results['homepages']->content )?></textarea>
		</li>
		<li>
			<label for="categoryId">Homepage Category</label>
			<select name="categoryId">
				<option value="0"<?php echo !$results['homepages']->categoryId ? " selected" : ""?>>(none)</option>
            	<?php foreach ( $results['categories'] as $category ) { ?>
              	<option value="<?php echo $category->id?>"<?php echo ( $category->id == $results['homepages']->categoryId ) ? " selected" : ""?>><?php echo htmlspecialchars( $category->name )?></option>
				<?php } ?>
            </select>
		</li>
		<li>
			<label for="page_identifier">Page Identifier</label>
			<input type="text" name="page_identifier" id="page_identifier" placeholder="Name to appear in url category/page_identifier/" required autofocus maxlength="255" value="<?php echo htmlspecialchars( $results['homepages']->page_identifier )?>"/>		
		</li>
		<li>
			<label for="publicationDate">Publication Date</label>
			<input type="date" name="publicationDate" id="publicationDate" placeholder="YYYY-MM-DD" required maxlength="10" value="<?php echo $results['homepages']->publicationDate ? date( "Y-m-d", $results['homepages']->publicationDate ) : "" ?>"/>
          </li> 
	</ul>
	<div class="buttons">
		<input type="submit" name="saveChanges" value="Save Changes" />
		<input type="submit" formnovalidate name="cancel" value="Cancel" />
	</div>
</form>
 
<?php if ( $results['homepages']->id ) { ?>
      <p><a href="admin.php?action=deleteHomepage&amp;homepageId=<?php echo $results['homepages']->id ?>" onclick="return confirm('Delete This Article?')">Delete This Article</a></p>
<?php } ?>
 <p><br><br></p>
<?php include "templates/include/footer.php" ?>