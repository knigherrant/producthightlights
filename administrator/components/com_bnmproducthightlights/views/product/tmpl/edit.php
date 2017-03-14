<?php 
/*------------------------------------------------------------------------
* @version   $Id: com_bnmproducthightlights 2017-03-13 [knigherrant] $
* @author Bold New Media http://www.boldnewmedia.com.au
* @copyright Copyright (C) 2008 - 2015 Bold New Media
* @support support@boldnewmedia.com.au
-------------------------------------------------------------------------*/
defined('_JEXEC') or die;

JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.keepalive');
?>
<script type="text/javascript">
    Joomla.submitbutton = function(task)
    {
        if (task == 'product.cancel') {
            Joomla.submitform(task, document.getElementById('product-form'));
        }
        else {
            
            if (task != 'product.cancel' && document.formvalidator.isValid(document.id('product-form'))) {
                
                Joomla.submitform(task, document.getElementById('product-form'));
                
            }
            else {
                alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED')); ?>');
            }
        }
    }
</script>
<div class="metikappmgr">
    <form action="<?php echo JRoute::_('index.php?option=com_bnmproducthightlights&layout=edit&id=' . (int) $this->item->id); ?>" method="post" enctype="multipart/form-data" name="adminForm" id="product-form" class="form-validate">
        <div class="form-horizontal row-fluid">
            <div class="clearfix fltlft span4">
                <legend><?php echo JText::_('COM_BNMPRODUCTHIGHTLIGHTS_EDIT_TITLE');?></legend>
                <div class="control-group">
                    <div class="control-label"><?php echo $this->form->getLabel('title'); ?></div>
                    <div class="controls"><?php echo $this->form->getInput('title'); ?></div>
                </div>
                <br/>
                <div class="control-group">
                    <div class="control-label"><?php echo $this->form->getLabel('image'); ?></div>
                    <div class="controls"><?php echo $this->form->getInput('image'); ?></div>
                </div>
                <br/>
                <br/>
                <div class="control-group">
                    <div class="control-label"><?php echo $this->form->getLabel('created'); ?></div>
                    <div class="controls"><?php echo $this->form->getInput('created'); ?></div>
                </div>
                <br/>
                <div class="control-group">
                    <div class="control-label"><?php echo $this->form->getLabel('state'); ?></div>
                    <div class="controls"><?php echo $this->form->getInput('state'); ?></div>
                </div>
            </div>
            <div class="span8" >
                <legend><?php echo JText::_('COM_BNMPRODUCTHIGHTLIGHTS_IMAGE_POSTION');?></legend>
            </div>
            <?php echo $this->form->getInput('id'); ?>
            <input type="hidden" name="task" value="" />
            <?php echo JHtml::_('form.token'); ?>
        </div>
    </form>
</div>