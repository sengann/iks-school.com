<?php
/**
 * @version		$Id: edit.php 19281 2010-10-29 10:12:49Z eddieajau $
 * @package		Joomla.Administrator
 * @subpackage	com_banners
 * @copyright	Copyright (C) 2005 - 2010 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
?>
<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{
		if (task == 'banner.cancel' || document.formvalidator.isValid(document.id('banner-form'))) {
			Joomla.submitform(task, document.getElementById('banner-form'));
		}
	}
	window.addEvent('domready', function() {
		document.id('jform_type0').addEvent('click', function(e){
			document.id('image').setStyle('display', 'block');
			document.id('url').setStyle('display', 'block');
			document.id('custom').setStyle('display', 'none');
		});
		document.id('jform_type1').addEvent('click', function(e){
			document.id('image').setStyle('display', 'none');
			document.id('url').setStyle('display', 'none');
			document.id('custom').setStyle('display', 'block');
		});
		if(document.id('jform_type0').checked==true) {
			document.id('jform_type0').fireEvent('click');
		} else {
			document.id('jform_type1').fireEvent('click');
		}
	});
</script>

<form action="<?php echo JRoute::_('index.php?option=com_iks&layout=edit&id='.(int) $this->item->id); ?>" method="post" name="adminForm" id="banner-form" class="form-validate">
	<div class="width-60 fltlft">
		<fieldset class="adminform">
			<legend><?php echo empty($this->item->id) ? JText::_('Add New Student') : JText::sprintf('Update Student', $this->item->id); ?></legend>
			<ul class="adminformlist">
				<li><?php echo $this->form->getLabel('first_name'); ?>
				<?php echo $this->form->getInput('first_name'); ?></li>
                                
                                <li><?php echo $this->form->getLabel('last_name'); ?>
				<?php echo $this->form->getInput('last_name'); ?></li>
                                
                                <li><?php echo $this->form->getLabel('gender'); ?>
				<?php echo $this->form->getInput('gender'); ?></li>
                                
                                <li><?php echo $this->form->getLabel('date_of_birth'); ?>
				<?php echo $this->form->getInput('ate_of_birth'); ?></li>
                                
                                <li><?php echo $this->form->getLabel('place_of_birth'); ?>
				<?php echo $this->form->getInput('place_of_birth'); ?></li>
                                
                                <li><?php echo $this->form->getLabel('address'); ?>
				<?php echo $this->form->getInput('address'); ?></li>

                                 <li><?php echo $this->form->getLabel('village'); ?>
				<?php echo $this->form->getInput('village'); ?></li>

                                 <li><?php echo $this->form->getLabel('commune'); ?>
				<?php echo $this->form->getInput('commune'); ?></li>

                                  <li><?php echo $this->form->getLabel('district'); ?>
				<?php echo $this->form->getInput('district'); ?></li>

                                   <li><?php echo $this->form->getLabel('province'); ?>
				<?php echo $this->form->getInput('province'); ?></li>

                                    <li><?php echo $this->form->getLabel('grade'); ?>
				<?php echo $this->form->getInput('grade'); ?></li>

                                     <li><?php echo $this->form->getLabel('photo'); ?>
				<?php echo $this->form->getInput('photo'); ?></li>

                                      <li><?php echo $this->form->getLabel('favorite'); ?>
				<?php echo $this->form->getInput('favorite'); ?></li>



			</ul>
			<div class="clr"> </div>

		</fieldset>
	</div>

<div class="width-40 fltrt">
	<?php echo JHtml::_('sliders.start','banner-sliders-'.$this->item->id, array('useCookie'=>1)); ?>

	<?php echo JHtml::_('sliders.panel',JText::_('Publish Detail'), 'publishing-details'); ?>
		<fieldset class="panelform">
		<ul class="adminformlist">
			<?php foreach($this->form->getFieldset('publish') as $field): ?>
				<li>
					<?php if (!$field->hidden): ?>
						<?php echo $field->label; ?>
					<?php endif; ?>
					<?php echo $field->input; ?>
				</li>
			<?php endforeach; ?>
			</ul>
		</fieldset>

	<?php echo JHtml::_('sliders.panel',JText::_('Meta Data'), 'metadata'); ?>
		<fieldset class="panelform">
			<ul class="adminformlist">
				<?php foreach($this->form->getFieldset('metadata') as $field): ?>
					<?php if (!$field->hidden): ?>
						<li><?php echo $field->label; ?></li>
					<?php endif; ?>
					<li><?php echo $field->input; ?></li>
				<?php endforeach; ?>
			</ul>
		</fieldset>

	<?php echo JHtml::_('sliders.end'); ?>
	<input type="hidden" name="task" value="" />
	<?php echo JHtml::_('form.token'); ?>
</div>

<div class="clr"></div>
</form>
