<?php
/**
 * @version		$Id: details_doc.php 19347 2010-11-04 06:22:16Z infograf768 $
 * @package		Joomla.Administrator
 * @subpackage	com_media
 * @copyright	Copyright (C) 2005 - 2010 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;
?>
		<tr>
			<td>
				<a>
					<?php  echo JHTML::_('image',$this->_tmp_doc->icon_16, $this->_tmp_doc->name, null, true, true) ? JHTML::_('image',$this->_tmp_doc->icon_16, $this->_tmp_doc->name, array('width' => 16, 'height' => 16, 'border' => 0), true) : JHTML::_('image','media/con_info.png', $this->_tmp_doc->name, array('width' => 16, 'height' => 16, 'border' => 0), true);?> </a>
			</td>
			<td class="description">
				<?php echo $this->_tmp_doc->name; ?>
			</td>
			<td>&#160;

			</td>
			<td>
				<?php echo MediaHelper::parseSize($this->_tmp_doc->size); ?>
			</td>
			<td>
				<a class="delete-item" href="index.php?option=com_media&amp;task=file.delete&amp;tmpl=component&amp;<?php echo JUtility::getToken(); ?>=1&amp;folder=<?php echo $this->state->folder; ?>&amp;rm[]=<?php echo $this->_tmp_doc->name; ?>" rel="<?php echo $this->_tmp_doc->name; ?>"><?php echo JHTML::_('image','media/remove.png', JText::_('Delete'), array('width' => 16, 'height' => 16, 'border' => 0), true);?></a>
				<input type="checkbox" name="rm[]" value="<?php echo $this->_tmp_doc->name; ?>" />
			</td>
		</tr>
