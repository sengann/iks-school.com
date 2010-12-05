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
        if (task == 'supporter.cancel' || document.formvalidator.isValid(document.id('supporter-form')))
            Joomla.submitform(task, document.getElementById('supporter-form'));
        
    }
</script>

<form action="<?php echo JRoute::_("index.php?option=com_iks&layout=edit&id={$this->item->id}"); ?>" method="post" name="adminForm" id="supporter-form" class="form-validate">

    <div>
        <fieldset class="adminform">
            <legend><?php echo empty($this->item->id) ? JText::_('Add Supporter') : JText::sprintf('Edit Supporter', $this->item->id); ?></legend>

            <table class="adminform" >
                 <tr>
                    <td> <?php echo $this->form->getLabel('state'); ?></td>
                    <td> <?php echo $this->form->getInput('state'); ?></td>
                </tr>
                <tr>
                    <td> <?php echo $this->form->getLabel('title'); ?></td>
                    <td> <?php echo $this->form->getInput('title'); ?></td>
                </tr>
                <tr>
                    <td width="100" > <?php echo $this->form->getLabel('name'); ?> </td>
                    <td> <?php echo $this->form->getInput('name'); ?> </td>
                </tr>                

              
                <tr>
                    <td> <?php echo $this->form->getLabel('email'); ?></td>
                    <td> <?php echo $this->form->getInput('email'); ?></td>
                </tr>

                 <tr>
                    <td> <?php echo $this->form->getLabel('address'); ?></td>
                    <td> <?php echo $this->form->getInput('address'); ?></td>
                </tr>

                 <tr>
                    <td> <?php echo $this->form->getLabel('city'); ?></td>
                    <td> <?php echo $this->form->getInput('city'); ?></td>
                </tr>

                 <tr>
                    <td> <?php echo $this->form->getLabel('country'); ?></td>
                    <td> <?php echo $this->form->getInput('country'); ?></td>
                </tr>

                 <tr>
                    <td> <?php echo $this->form->getLabel('donate'); ?></td>
                    <td> <?php echo $this->form->getInput('donate'); ?></td>
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