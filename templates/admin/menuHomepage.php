<?php include "templates/include/admin/header.php" ?>
<?php include "templates/include/admin/bread.php" ?>

<br>
<ul class="mcontent">
	<li>
	<table>
		<tr>
			<th>Name</th>
			<th>Child yes/no</th>
			<th>ID</th>
			<th>Order</th>
			<th>Live</th>     	
        </tr>
        
        <?php foreach ( $results['menus'] as $menu ) { ?>
        <tr  onclick="location='admin.php?action=editMenu&amp;menuId=<?php echo $menu->id?>'">
        	<td><?php echo $menu->name ?></td>
        	<td><?php echo $menu->child?></td>
			<td><?php echo $menu->id?></td>
			<td><?php echo $menu->itemOrder?></td>
			<td><?php echo $menu->live?></td>
			<?php  /*echo $results['categories'][$article->categoryId]->name*/ ?>
        </tr>
		<?php } ?>
	</table>
	<p><?php echo $results['totalRows']?> menu<?php echo ( $results['totalRows'] != 1 ) ? 's' : '' ?> in total.</p>

	</li>	
</ul>
<?php include "templates/include/admin/footer.php" ?>