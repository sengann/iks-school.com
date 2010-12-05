<?php
    defined('_JEXEC') or die;
    JHtml::addIncludePath(JPATH_COMPONENT.DS.'helpers'.DS.'html');
    JHtml::_('behavior.tooltip');
    JHtml::_('behavior.formvalidation');
    $canDo	= IKSHelper::getActions();
?>
<script type="text/javascript">
    Joomla.submitbutton = function(task)
    {
        if (task == 'province.cancel' || document.formvalidator.isValid(document.id('province-form')))
            Joomla.submitform(task, document.getElementById('province-form'));
        
    }
</script>

<form action="<?php echo JRoute::_("index.php?option=com_iks&layout=edit&id={$this->item->id}"); ?>" method="post" name="adminForm" id="province-form" class="form-validate">

    <div>
        <fieldset class="adminform">
            <legend><?php echo empty($this->item->id) ? JText::_('Add Province') : JText::sprintf('Edit Province', $this->item->id); ?></legend>

            <table class="adminform" >
                <tr>
                    <td width="100" > <?php echo $this->form->getLabel('name'); ?> </td>
                    <td> <?php echo $this->form->getInput('name'); ?> </td>
                </tr>                

                <tr>
                    <td> <?php echo $this->form->getLabel('slug'); ?></td>
                    <td> <?php echo $this->form->getInput('slug'); ?></td>
                </tr>                   

                <tr>
                    <td valign="top" > <?php echo $this->form->getLabel('description'); ?></td>
                    <td> <?php echo $this->form->getInput('description'); ?></td>
                </tr>                              

                <tr>
                    <td> <?php echo $this->form->getLabel('id'); ?> </td>
                    <td> <?php echo $this->form->getInput('id'); ?></td>
                </tr>
                
            </table>            
            <div class="cls"> </div>
            
        </fieldset>
    </div>
    <input type="hidden" name="task" value="" />
    <?php echo JHtml::_('form.token'); ?>
</form>