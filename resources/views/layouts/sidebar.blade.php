<aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="{{url('/admin/dashboard')}}"  class="brand-link">
        <img src="{{asset('dist/img/site-logo_228x52.png')}}" alt="Glidewell" class="brand-image" style="opacity: .8">
        <!-- <span class="brand-text font-weight-light">Glidewell</span> -->
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="{{asset('dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">{{Auth::user()->name}}</a>
          </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
              <a href="{{url('/admin/dashboard')}}" class="nav-link active">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
              </a>
            </li>
          
            @if(Auth::user()->is_admin==1)
            <li class="nav-item">
              <a href="{{url('admin/admin-list')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Admin Management</p>
              </a>
            </li>
            @endif
            <li class="nav-item">
              <a href="{{url('admin/agent-list')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Agent Management</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{url('admin/users/users-list')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>End User Management</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="course-management.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Course Management</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{url('admin/videos-management/video-list')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Video Management</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{url('admin/question-management/questions-category-list')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Question Management</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                  FlashCards Management
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{url('admin/flashcards/modules-list')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>FlashCards Management</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{url('admin/flashcards/flashcard-questions-list')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>FlashCard Question Management</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-header">Messages &amp; Notifications</li>
            <li class="nav-item">
              <a href="index.html" class="nav-link">
                <i class="nav-icon fas fa-comment-dots"></i>
                <p>
                  Messages<span class="badge badge-success right">2</span>
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="index.html" class="nav-link">
                <i class="nav-icon fas fa-bell"></i>
                <p>
                  Notifications<span class="badge badge-warning right">2</span>
                </p>
              </a>
            </li>
            <li class="nav-header">Profile &amp; Settings</li>
            <li class="nav-item">
              <a href="index.html" class="nav-link">
                <i class="nav-icon fas fa-cog"></i>
                <p>
                  Settings
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="index.html" class="nav-link">
                <i class="nav-icon fas fa-address-book"></i>
                <p>
                  About Glidewell
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="index.html" class="nav-link">
                <i class="nav-icon fas fa-address-book"></i>
                <p>
                  FAQ
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="index.html" class="nav-link">
                <i class="nav-icon fas fa-address-book"></i>
                <p>
                  T&C
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="index.html" class="nav-link">
                <i class="nav-icon fas fa-address-book"></i>
                <p>
                  Privacy Policy
                </p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->