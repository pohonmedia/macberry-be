<!-- START X-NAVIGATION VERTICAL -->
<ul class="x-navigation x-navigation-horizontal x-navigation-panel">
    <!-- TOGGLE NAVIGATION -->
    <li class="xn-icon-button">
        <a href="#" class="x-navigation-minimize"><span class="fa fa-dedent"></span></a>
    </li>
    <!-- END TOGGLE NAVIGATION -->
    <!-- SEARCH -->
    <li class="xn-search hidden">
        <form role="form">
            <input type="text" name="search" placeholder="Search..."/>
        </form>
    </li>   
    <!-- END SEARCH -->
    <!-- SIGN OUT -->
    <li class="xn-icon-button pull-right">
        <a href="#" class="mb-control" data-box="#mb-signout"><span class="fa fa-sign-out"></span></a>                        
    </li> 
    <!-- END SIGN OUT -->
    <!-- MESSAGES -->
    <li class="xn-icon-button pull-right">
        <a href="#"><span class="fa fa-comments"></span></a>
        <!-- <div class="informer informer-danger">4</div> -->
        <div class="panel panel-primary animated zoomIn xn-drop-left xn-panel-dragging">
            <div class="panel-heading">
                <h3 class="panel-title"><span class="fa fa-comments"></span> Messages</h3>                                
                <div class="pull-right">
                    <!-- <span class="label label-danger">4 new</span> -->
                </div>
            </div>
            <div class="panel-body list-group list-group-contacts scroll" style="height: auto;">
                <a href="#" class="list-group-item">
                    <!--                    <div class="list-group-status status-offline"></div>
                                        <img src="assets/images/users/user6.jpg" class="pull-left" alt="Darth Vader"/>
                                        <span class="contacts-title">Darth Vader</span>-->
                    <p class="text-center">No New Message</p>
                </a>
            </div>     
            <div class="panel-footer text-center">
                <a href="#">Show all messages</a>
            </div>                            
        </div>                        
    </li>
    <!-- END MESSAGES -->
    <!-- TASKS -->
    <li class="xn-icon-button pull-right">
        <a href="#"><span class="fa fa-tasks"></span></a>
        <!--<div class="informer informer-warning">3</div>-->
        <div class="panel panel-primary animated zoomIn xn-drop-left xn-panel-dragging">
            <div class="panel-heading">
                <h3 class="panel-title"><span class="fa fa-tasks"></span> Tasks</h3>                                
                <div class="pull-right">
                    <!--<span class="label label-warning">3 active</span>-->
                </div>
            </div>
            <!--<div class="panel-body list-group scroll" style="height: auto;">-->                                
            <div class="panel-body list-group list-group-contacts scroll" style="height: auto;">                                
                <a class="list-group-item" href="#">
<!--                    <strong>Phasellus augue arcu, elementum</strong>
                    <div class="progress progress-small progress-striped active">
                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%;">50%</div>
                    </div>
                    <small class="text-muted">John Doe, 25 Sep 2014 / 50%</small>-->
                    <p class="text-center">No Task(s)</p>
                </a>
            </div>     
            <div class="panel-footer text-center">
                <a href="#">Show all tasks</a>
            </div>                            
        </div>                        
    </li>
    <!-- END TASKS -->
</ul>
<!-- END X-NAVIGATION VERTICAL -->                     

<!-- START BREADCRUMB -->
<?php echo $this->breadcrumbs->show(); ?>
<!--<ul class="breadcrumb">
    <li><a href="#">Home</a></li>                    
    <li class="active">Dashboard</li>
</ul>-->
<!-- END BREADCRUMB -->