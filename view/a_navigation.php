<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.html"><img style="display:inline-block;margin-right:5px;" src="img/apicon.png" class="fa-fw">Apartment Rental</a>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right">
        <!-- /.dropdown -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                </li>
                <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                </li>
                <li class="divider"></li>
                <li><a href="index?route=logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li class="sidebar-search">
                    <div class="input-group custom-search-form">
                        <!-- <input type="text" class="form-control" placeholder="Search..."> -->
                        <!-- <span class="input-group-btn"> -->
                        <!-- <button class="btn btn-default" type="button"> -->
                            <!-- <i class="fa fa-search"></i> -->
                        <!-- </button> -->
                    <!-- </span> -->
                    <img style="display:inline-block;margin-right:5px;width:13%;height:8%;" src="users/default-profile-picture.png" class="fa-fw">
					<label style="text-align:center;">ADMINISTRATOR</label>
                    </div>
                    <!-- /input-group -->
                </li>
                <li>
                    <a href="index?route=dashboard"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                </li>
                <li>
                    <a href="#"><i class="glyphicon glyphicon-home fa-fw"></i> Rooms<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="index?route=rooms">Rooms Map</a>
                        </li>
                        <li>
                            <a href="index?route=roomstable">Rooms Table</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="index?route=applicants"><i class="fa fa-plus-square fa-fw"></i> Applicants</a>
                </li>
                <li>
                    <a href="index?route=tenants"><i class="fa fa-group fa-fw"></i> Tenants</a>
                </li>
                <li>
                    <a href="index?route=payments"><i class="fa fa-ruble fa-fw"></i> Payments</a>
                </li>
                <li>
                    <a href="index?route=complaints"><i class="fa fa-exclamation-triangle fa-fw"></i> Complaints</a>
                </li>
                <li>
                    <a href="index?route=notifications"><i class="fa fa-bell fa-fw"></i> Notifications</a>
                </li>
                <!-- <li>
                    <a href="#"><i class="fa fa-sitemap fa-fw"></i> Multi-Level Dropdown<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="#">Second Level Item</a>
                        </li>
                        <li>
                            <a href="#">Second Level Item</a>
                        </li>
                        <li>
                            <a href="#">Third Level <span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                <li>
                                    <a href="#">Third Level Item</a>
                                </li>
                                <li>
                                    <a href="#">Third Level Item</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li> -->
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>