<!--
 /**
  * treewidget view file
  *
  * Date: 1/29/13
  * Time: 12:00 PM
  *
  * @author: Spiros Kabasakalis <kabasakalis@gmail.com>
  * @link http://iws.kabasakalis.gr/
  * @link http://www.reverbnation.com/spiroskabasakalis
  * @copyright Copyright &copy; Spiros Kabasakalis 2013
  * @license http://opensource.org/licenses/MIT  The MIT License (MIT)
  * @version 1.0.0
  */
  -->

<style type="text/css">

.span12{margin-left:0em !important;}

</style>
  
   
<div class="span5" style="">
    <h1 class="page-header">Manage Your Organization</h1>
    <div class="row well">
    
            You can Create,Rename,Delete,Move departments of your organization.</li>
   
    </div>
  
    <div class="row span5">
    
        <!--The tree will be rendered in this div-->
        <div class="well"  class="row" id="<?php echo $this->jstree_container_ID;?>"></div>
   
    </div>
    
</div>
