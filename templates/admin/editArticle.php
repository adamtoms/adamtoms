<?php include "templates/include/admin/header.php" ?>
<?php include'templates/include/admin/bread.php';?>



      <script>
 
      // Prevents file upload hangs in Mac Safari
      // Inspired by http://airbladesoftware.com/notes/note-to-self-prevent-uploads-hanging-in-safari
 
      function closeKeepAlive() {
        if ( /AppleWebKit|MSIE/.test( navigator.userAgent) ) {
          var xhr = new XMLHttpRequest();
          xhr.open( "GET", "/ping/close", false );
          xhr.send();
        }
      }
 
      </script>



	<form action="admin.php?action=<?php echo $results['formAction']?>" method="post" id="edit-article" enctype="multipart/form-data" onsubmit="closeKeepAlive()">
		<input type="hidden" name="articleId" value="<?php echo $results['article']->id ?>"/>
		<ul>
			<li>
				<label for="title">Title</label>
				<input type="text" name="title" id="title" placeholder="Name of the article" required autofocus maxlength="255" value="<?php echo htmlspecialchars( $results['article']->title )?>" />
			</li>
			<li>
				<label for="summary">Summary</label>
				<textarea name="summary" id="summary" placeholder="Brief description of the article, this appears in google as site discription. Max 120 ~ confirm" required maxlength="150" style="height: 5em;"><?php echo htmlspecialchars( $results['article']->summary )?></textarea>
			</li>
			<li>
				<label for="content">Content</label>
				<textarea name="content" id="content" placeholder="The HTML content of the article" required maxlength="100000" style="height: 30em;"><?php echo htmlspecialchars( $results['article']->content )?></textarea>
				<script type="text/javascript">CKEDITOR.replace( 'content' );</script>
			</li>
			<li>
				<label for="categoryId">Category</label>
				<select name="categoryId" style="width: 150px;">
					<option value="0"<?php echo !$results['article']->categoryId ? " selected" : ""?>>(none)</option>
					<?php foreach ( $results['categories'] as $category ) { ?>
					<option value="<?php echo $category->id?>"<?php echo ( $category->id == $results['article']->categoryId ) ? " selected" : ""?>><?php echo htmlspecialchars( $category->name )?></option>
           			<?php } ?>
           		 </select>
			</li>
			<li>
				<label for="page_identifier">Page Identifier</label>
			<input type="text" name="page_identifier" id="page_identifier" placeholder="CategoryName/page_identifier/"  autofocus maxlength="255" value="<?php echo htmlspecialchars( $results['article']->page_identifier )?>" /><!--required removed-->
			</li>
			<li>
				<label for="live">Live</label>
					<select name="live" style="width: 70px;text-align: center;">
						<option value="1" <?php echo ($results['article']->live == '1') ? " selected" : ""?>>Yes</option>
						<option value="0" <?php echo !$results['article']->live ? " selected" : ""?>>No</option>
					</select>				
			</li>
			<li>
				<label for="publicationDate">Publication Date</label>
				<input type="date" name="publicationDate" id="publicationDate" placeholder="YYYY-MM-DD" required maxlength="10" value="<?php echo $results['article']->publicationDate ? date( "Y-m-d", $results['article']->publicationDate ) : "" ?>" />
			</li>
			<?php if ( $results['article'] && $imagePath = $results['article']->getImagePath() ) { ?>
				<li>
					<label>Current Image</label>
					<img id="articleImage" src="<?php echo $imagePath ?>" alt="Article Image" />
				</li>
				<li>
					<label for="deleteImage" style="width:200px;float:left;">Remove Image</label>
					<input type="checkbox" name="deleteImage" id="deleteImage" value="yes" style="width: 50px;float: left;margin: 12px 0px;" />
				</li>
			<?php } ?>
			<li>
            	<label for="image">New Image</label>
            	<input type="file" name="image" id="image" placeholder="Choose an image to upload" maxlength="255"style="border:none;" />
			</li>
		</ul>
		
        <div class="buttons">
			<input type="submit" name="saveChanges" value="Save Changes" />
			<input type="submit" formnovalidate name="cancel" value="Cancel" />
			<?php if ( $results['article']->id ) { ?>
      		<p><a href="admin.php?action=deleteArticle&amp;articleId=<?php echo $results['article']->id ?>" onclick="return confirm('Delete This Article?')">Delete This Article</a></p>
<?php } ?>
		</div>
	</form>
	<?php include "templates/include/footer.php" ?>