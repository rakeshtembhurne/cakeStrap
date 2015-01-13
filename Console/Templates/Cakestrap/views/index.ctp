<?php

?>

<div id="page-container" class="row">
	<?php echo "<?php echo \$this->element('sidebar'); ?>"; ?>
			
	<div id="page-content" class="col-sm-9">

		<div class="<?php echo $pluralVar; ?> index">
		
			<h2><?php echo "<?php echo __('{$pluralHumanName}'); ?>"; ?></h2>
			
			<div class="table-responsive">
				<table cellpadding="0" cellspacing="0" class="table table-striped table-bordered">
					<thead>
						<tr>
			<?php foreach ($fields as $field): ?>
				<th><?php echo "<?php echo \$this->Paginator->sort('{$field}'); ?>"; ?></th>
			<?php endforeach; ?>
				<th class="actions"><?php echo "<?php echo __('Actions'); ?>"; ?></th>
						</tr>
					</thead>
					<tbody>
<?php 
	echo "<?php foreach (\${$pluralVar} as \${$singularVar}): ?>\n";
	echo "\t<tr>\n";
	foreach ($fields as $field) {
		$isKey = false;
		if (!empty($associations['belongsTo'])) {
			foreach ($associations['belongsTo'] as $alias => $details) {
				if ($field === $details['foreignKey']) {
					$isKey = true;
					echo "\t\t<td>\n\t\t\t<?php echo \$this->Html->link(\${$singularVar}['{$alias}']['{$details['displayField']}'], array('controller' => '{$details['controller']}', 'action' => 'view', \${$singularVar}['{$alias}']['{$details['primaryKey']}'])); ?>\n\t\t</td>\n";
					break;
				}
			}
		}

		if ($isKey !== true) {
			if ($field == 'created' || $field == 'modified') {
				echo "\t\t<td><?php echo \$this->Time->niceShort(\${$singularVar}['{$modelClass}']['{$field}']); ?>&nbsp;</td>\n";
			}
			else{
				echo "\t\t<td><?php echo h(\${$singularVar}['{$modelClass}']['{$field}']); ?>&nbsp;</td>\n";
			}
		}
		
	}

	echo "\t\t<td class=\"actions\">\n";
	echo "\t\t\t<?php echo \$this->Html->link('<i class =\"glyphicon glyphicon-eye-open\"></i>', array('action' => 'view', \${$singularVar}['{$modelClass}']['{$primaryKey}']), array('class' => 'btn btn-info btn-xs' , 'data-toggle' => 'tooltip' , 'data-placement' => 'bottom' , 'title' => 'View' , 'escape' => false)); ?>\n";
	echo "\t\t\t<?php echo \$this->Html->link('<i class =\"glyphicon glyphicon-pencil\"></i>', array('action' => 'edit', \${$singularVar}['{$modelClass}']['{$primaryKey}']), array('class' => 'btn btn-success btn-xs' , 'data-toggle' => 'tooltip' , 'data-placement' => 'bottom' , 'title' => 'Edit' , 'escape' => false)); ?>\n";
	echo "\t\t\t<?php echo \$this->Form->postLink('<i class =\"glyphicon glyphicon-trash\"></i>', array('action' => 'delete', \${$singularVar}['{$modelClass}']['{$primaryKey}']), array('class' => 'btn btn-danger btn-xs' , 'data-toggle' => 'tooltip' , 'data-placement' => 'bottom' , 'title' => 'Delete' , 'escape' => false), __('Are you sure you want to delete # %s?', \${$singularVar}['{$modelClass}']['{$primaryKey}'])); ?>\n";
	echo "\t\t</td>\n";
	echo "\t</tr>\n";

	echo "<?php endforeach; ?>\n";
?>
					</tbody>
				</table>
			</div><!-- /.table-responsive -->
			
			<p><small>
				<?php echo "<?php
					echo \$this->Paginator->counter(array(
					'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
					));
				?>\n"; ?>
			</small></p>

			<ul class="pagination">
				<?php
					echo "<?php\n";
					echo "\t\t\t\t\techo \$this->Paginator->prev('< ' . __('Previous'), array('tag' => 'li'), null, array('class' => 'disabled', 'tag' => 'li', 'disabledTag' => 'a'));\n";
					echo "\t\t\t\t\techo \$this->Paginator->numbers(array('separator' => '', 'currentTag' => 'a', 'tag' => 'li', 'currentClass' => 'disabled'));\n";
					echo "\t\t\t\t\techo \$this->Paginator->next(__('Next') . ' >', array('tag' => 'li'), null, array('class' => 'disabled', 'tag' => 'li', 'disabledTag' => 'a'));\n";
					echo "\t\t\t\t?>\n";
				?>
			</ul><!-- /.pagination -->
			
		</div><!-- /.index -->
	
	</div><!-- /#page-content .col-sm-9 -->

</div><!-- /#page-container .row-fluid -->