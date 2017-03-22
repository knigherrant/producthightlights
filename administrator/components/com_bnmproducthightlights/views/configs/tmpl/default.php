<?php 
/*------------------------------------------------------------------------
* @version   $Id: com_bnmproducthightlights 2017-03-13 [knigherrant] $
* @author Bold New Media http://www.boldnewmedia.com.au
* @copyright Copyright (C) 2008 - 2015 Bold New Media
* @support support@boldnewmedia.com.au
-------------------------------------------------------------------------*/
// no direct access
defined('_JEXEC') or die;
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.keepalive');
JHtml::_('formbehavior.chosen', 'select');
?>
<script type="text/javascript">
    Joomla.submitbutton = function(task){
        if (task == 'configs.cancel') {
            Joomla.submitform(task, document.getElementById('configs-form'));
        }
        else {

            if (task != 'configs.cancel' && document.formvalidator.isValid(document.id('configs-form'))) {
                Joomla.submitform(task, document.getElementById('configs-form'));
            }
            else {
                alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED')); ?>');
            }
        }
    }
</script>
<div class="producthightlight">
    <form action="<?php echo JRoute::_('index.php?option=com_bnmproducthightlights')?>" method="post" enctype="multipart/form-data" name="adminForm" id="configs-form" class="form-validate dam-dashboad">
        <?php if(!empty($this->sidebar)): ?>
        <div id="j-sidebar-container" class="span2">
            <?php echo $this->sidebar; ?>
        </div>
        <div id="j-main-container" class="span10">
        <?php else : ?>
        <div id="j-main-container">
            <?php endif;?>
            <div class="row-fluid form-horizontal" >
               
                <div class="control-group">
                    <div class="control-label">
                        <label class="hasPopover" id="jform_template-lbl" for="jform_template" class="hasPopover" title="" data-content="<?php echo JText::_('COM_BNMPRODUCTHIGHTLIGHTS_TIP_TEMPLATE_DESC'); ?>" data-original-title="Template">
                            <?php echo JText::_('Template'); ?></label>
                    </div>
                    <div class="controls">
                        <?php echo BNMProduct::listTemplate($this->item->template); ?>
                    </div>
                </div>
                
                 <div class="control-group">
                    <div class="control-label">
                        <label class="hasPopover" id="jform_upload-lbl" for="jform_upload" class="hasPopover" title="" data-content="<?php echo JText::_('COM_BNMPRODUCTHIGHTLIGHTS_UPLOAD_TEMPLATE_DESC'); ?>" data-original-title="Upload">
                            <?php echo JText::_('Upload Template'); ?></label>
                    </div>
                    <div class="controls">
                        <input type="file" name="jtemplate" />
                    </div>
                </div>
                
                
                 <br/>
                 <input type="hidden" name="id" value="1" />
                <input type="hidden" name="task" value="" />
                <?php echo JHtml::_('form.token'); ?>

            </div>
        </div>
    </form>
</div>
