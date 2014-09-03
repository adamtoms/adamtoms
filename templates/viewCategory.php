<?php include "templates/include/header.php" ?>
<!-- http://eat.adamtoms.co.uk/?action=viewCategoryList -->
<ul class="mcontent">
<br>
	<ul class="homepage-grid">
 	<?php foreach ( $results['categories'] as $category ) { ?>
		<li onclick="location='?action=archive&amp;categoryId=<?php echo $category->id?>'">
		    <h2><?php echo $category->name?> </h2>
	 	</li>
	<?php } ?>
	</ul>
	
	<p style="display: inline-block;width: 100%;"><?php echo $results['totalRows']?> categor<?php echo ( $results['totalRows'] != 1 ) ? 'ies' : 'y' ?> in total.</p>

 
 
 
 
 
<!-- 	<li>
      <table>
        <tr>
          <th>Category</th>
        </tr>
 
<?php /*foreach ( $results['categories'] as $category ) { */ ?>
 
        <tr onclick="location='?action=archive&amp;categoryId=<?php /* echo $category->id*/?>'">
          <td>
            <?php/* echo $category->name*/?>
          </td>
        </tr>
 
<?php /*} */?>
 
      </table>
 
      <p><?php /* echo $results['totalRows']?> categor<?php echo ( $results['totalRows'] != 1 ) ? 'ies' : 'y' */ ?> in total.</p>
 
 </li>  -->
 </ul>
<?php include "templates/include/footer.php" ?>
