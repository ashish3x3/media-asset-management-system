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
    body{
    background-color:skyblue;}
  
  </style>
  
   
<div class="span12" style="margin-left:15em;">
    <h1 class="page-header"><center>Manage Your Organization</center></h1>
    <div class="row well">
    <center> 
       
            You can Create,Rename,Delete,Move departments of your organization.</li>
        
       </center>
    </div>
  
    <div class="row span11">
    
        <!--The tree will be rendered in this div-->
        <div class="well" style ="background-color:#ccc;margin-top: 20px" class="row" id="<?php echo $this->jstree_container_ID;?>"></div>
   
    </div>
    
</div>
