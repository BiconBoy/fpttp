<div id="nav-wrapper" class="md-whiteframe-z2">
    <ul id="nav"
        data-ng-controller="NavCtrl"
        data-slim-scroll
        data-collapse-nav
        data-highlight-active>
        <li class="navigation-profile-picture">
          <a href="#/">
            <img src="dist/images/user.png" alt="" class="img80_80 img-circle">
          </a>
        </li>
        <li>
            <a md-ink-ripple="#bbb" href="#/dashboard">
              <md-icon md-svg-src="dist/img/icons/ic_dashboard_24px.svg"></md-icon>
              <span>Dashboard</span>
            </a>
            <ul>
                <li><a md-ink-ripple="#bbb" active ui-sref="dashboard"><i class="fa fa-circle submenu__icon"></i><span> Dashboard</span></a></span></li>
                <li><a md-ink-ripple="#bbb" active ui-sref="dashboard1"><i class="fa fa-circle submenu__icon"></i><span> Dashboard 1</span></a></span></li>
                <li><a md-ink-ripple="#bbb" active ui-sref="dashboard2"><i class="fa fa-circle submenu__icon"></i><span> Dashboard 2</span></a></li>
            </ul>
        </li>
        <li>
            <a md-ink-ripple="#bbb" href="#/ui">
              <md-icon md-svg-src="dist/img/icons/ic_layers_24px.svg"></md-icon>
              <span>Ui Elements</span></a>
            <ul>
                <li><a md-ink-ripple="#bbb" ui-sref="material"><i class="fa fa-circle submenu__icon"></i><span> Material UI</span></a></span></li>
                <li><a md-ink-ripple="#bbb" ui-sref="buttons"><i class="fa fa-circle submenu__icon"></i><span> Buttons</span></a></span></li>
                <li><a md-ink-ripple="#bbb" ui-sref="cards"><i class="fa fa-circle submenu__icon"></i><span> Cards</span></a></span></li>
                <li><a md-ink-ripple="#bbb" ui-sref="widgets"><i class="fa fa-circle submenu__icon"></i><span>Widgets </span><span class="badge badge-success">Trendy</span></a></li>
                <li><a md-ink-ripple="#bbb" ui-sref="grids"><i class="fa fa-circle submenu__icon"></i><span> Grids</span></a></li>
                <li><a md-ink-ripple="#bbb" ui-sref="icons"><i class="fa fa-circle submenu__icon"></i><span> Icons</span></a></li>
                <li><a md-ink-ripple="#bbb" ui-sref="typography"><i class="fa fa-circle submenu__icon"></i><span> Typography</span></a></li>
                <li><a md-ink-ripple="#bbb" ui-sref="components"><i class="fa fa-circle submenu__icon"></i><span> Bootstrap UI</span> <span class="badge badge-info">new</span></a></li>
                <!--<li><a href="#/ui/timeline"><i class="fa fa-circle submenu__icon"></i> Timeline</a></li>-->
                <li><a md-ink-ripple="#bbb" ui-sref="nested-lists"><i class="fa fa-circle submenu__icon"></i><span>Nested Lists</span></a></li>
            </ul>
        </li>
        <li>
            <a md-ink-ripple="#bbb" href="#/pages">
              <md-icon md-svg-src="dist/img/icons/ic_pages_24px.svg"></md-icon>
              <span> Custom Pages </span></a>
            <ul>
                <li><a md-ink-ripple="#bbb" ui-sref="signin"><i class="fa fa-circle submenu__icon"></i><span> Sign in</span></a></li>
                <li><a md-ink-ripple="#bbb" ui-sref="signup"><i class="fa fa-circle submenu__icon"></i><span> Sign up</span></a></li>
                <li><a md-ink-ripple="#bbb" ui-sref="forgot-password"><i class="fa fa-circle submenu__icon"></i><span> Request password</span></a></li>
                <li><a md-ink-ripple="#bbb" ui-sref="profile"><i class="fa fa-circle submenu__icon"></i><span> User page</span></a></li>
                <li><a md-ink-ripple="#bbb" ui-sref="pages-404"><i class="fa fa-circle submenu__icon"></i><span> 404</span></a></li>
                <li><a md-ink-ripple="#bbb" ui-sref="pages-500"><i class="fa fa-circle submenu__icon"></i><span> 500</span></a></li>
                <li><a md-ink-ripple="#bbb" ui-sref="contact"><i class="fa fa-circle submenu__icon"></i><span> Contact</span></a></li>
            </ul>
        </li>
        <li>
            <a md-ink-ripple="#bbb" href="#/table">
              <md-icon md-svg-src="dist/img/icons/ic_view_module_24px.svg"></md-icon>
              <span> Table styles</span></a>
            <ul>
                <li><a md-ink-ripple="#bbb" ui-sref="tables-static"><i class="fa fa-circle submenu__icon"></i><span> Normal</span></a></li>
                <li><a md-ink-ripple="#bbb" ui-sref="tables-responsive"><i class="fa fa-circle submenu__icon"></i><span> Responsive</span></a></li>
                <li><a md-ink-ripple="#bbb" ui-sref="tables-dynamic"><i class="fa fa-circle submenu__icon"></i><span> Dynamic</span></a></li>
            </ul>
        </li>
        <li>
            <a md-ink-ripple="#bbb" href="#/form">
              <md-icon md-svg-src="dist/img/icons/ic_transform_24px.svg"></md-icon>
              <span> Form elements</span></a>
            <ul>
                <li><a md-ink-ripple="#bbb" ui-sref="form-elements"><i class="fa fa-circle submenu__icon"></i><span> Form elements</span></a></li>
                <li><a md-ink-ripple="#bbb" ui-sref="form-validation"><i class="fa fa-circle submenu__icon"></i><span> Form validations</span></a></li>
                <li><a md-ink-ripple="#bbb" ui-sref="form-wizard"><i class="fa fa-circle submenu__icon"></i><span>Form wizard</span></a></li>
                <li><a md-ink-ripple="#bbb" ui-sref="form-layouts"><i class="fa fa-circle submenu__icon"></i><span> Form layouts</span></a></li>
            </ul>
        </li>
       <li>
            <a md-ink-ripple="#bbb" href="#/charts">
              <md-icon md-svg-src="dist/img/icons/ic_trending_up_24px.svg"></md-icon>
              <span> Charting</span></a>
            <ul>
                <li><a md-ink-ripple="#bbb" ui-sref="charts-morris"><i class="fa fa-circle submenu__icon"></i><span>Morris Charts</span></a></li>
                <li><a md-ink-ripple="#bbb" ui-sref="charts-chartjs"><i class="fa fa-circle submenu__icon"></i><span>Chart js</span></a></li>
                <li><a md-ink-ripple="#bbb" ui-sref="charts-flot"><i class="fa fa-circle submenu__icon"></i><span>Flot Charts</span></a></li>
                <li><a md-ink-ripple="#bbb" ui-sref="charts-others"><i class="fa fa-circle submenu__icon"></i><span>Other Charts</span></a></li>
            </ul>
        </li>
        <li>
            <a md-ink-ripple="#bbb" href="#/maps">
              <md-icon md-svg-src="dist/img/icons/ic_map_24px.svg"></md-icon>
              <span> Maps</span></a>
            <ul>
                <li><a md-ink-ripple="#bbb" ui-sref="gmap"><i class="fa fa-circle submenu__icon"></i><span> Google</span></a></li>
                <li><a md-ink-ripple="#bbb" ui-sref="jqvmap"><i class="fa fa-circle submenu__icon"></i><span> Vector</span></a></li>
            </ul>
        </li>
        <li class="nav-task">
            <a md-ink-ripple="#bbb" ui-sref="tasks">
              <md-icon md-svg-src="dist/img/icons/ic_done_all_24px.svg"></md-icon>
                <span> Tasks</span>
                <span class="badge badge-danger main-badge">{{navInfo.tasks_number}}</span>
            </a>
        </li>