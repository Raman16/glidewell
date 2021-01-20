@extends('layouts.app')

@section('content')
 <!-- Content Header (Page header) -->
 <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
 <!-- /.content-header -->

<section class="content">
        <div class="container-fluid">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box">
                <div class="inner">
                  <h3 class="text-danger">150</h3>
                  <p>Total Users</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer bg-danger">More info <i class="fas fa-angle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box">
                <div class="inner">
                  <h3 class="text-danger">53</h3>

                  <p>Uploaded Videos</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer bg-danger">More info <i class="fas fa-angle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box">
                <div class="inner">
                  <h3 class="text-danger">104</h3>

                  <p>Quiz Conducted</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer bg-danger">More info <i class="fas fa-angle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box">
                <div class="inner">
                  <h3 class="text-danger">65</h3>

                  <p>Total Courses</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer bg-danger">More info <i class="fas fa-angle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
          </div>
          <!-- /.row -->
          <!-- Main row -->
          <div class="row">
            <!-- Left col -->
            <section class="col-lg-7 connectedSortable">
              <div class="card">
                <div class="card-header border-0">
                  <div class="d-flex justify-content-between">
                    <h3 class="card-title">New Users</h3>
                    <a href="javascript:void(0);">View Report</a>
                  </div>
                </div>
                <div class="card-body">
                  <div class="d-flex">
                    <!-- <p class="d-flex flex-column">
                      <span class="text-bold text-lg">$18,230.00</span>
                      <span>Sales Over Time</span>
                    </p> -->
                    <p class="ml-auto d-flex flex-column text-right">
                      <span class="text-success">
                        <i class="fas fa-arrow-up"></i> 33.1%
                      </span>
                      <span class="text-muted">Since last month</span>
                    </p>
                  </div>
                  <!-- /.d-flex -->

                  <div class="position-relative mb-4">
                    <canvas id="sales-chart" height="200"></canvas>
                  </div>

                  <div class="d-flex flex-row justify-content-end">
                    <span class="mr-2">
                      <i class="fas fa-square text-danger"></i> This year
                    </span>

                    <span>
                      <i class="fas fa-square text-gray"></i> Last year
                    </span>
                  </div>
                </div>
              </div>
              <!-- TABLE: LATEST ORDERS -->
              <div class="card">
                <div class="card-header border-transparent">
                  <h3 class="card-title">New User</h3>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                  <div class="table-responsive">
                    <table class="table m-0">
                      <thead>
                        <tr>
                          <th>First name</th>
                          <th>Last name</th>
                          <th>Email id</th>
                          <th>Phone number</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>James</td>
                          <td>Smith</td>
                          <td>james@mail.com</td>
                          <td>-</td>
                        </tr>
                        <tr>
                          <td>Michael </td>
                          <td>Smith</td>
                          <td>michael@mail.com</td>
                          <td>-</td>
                        </tr>
                        <tr>
                          <td>Maria</td>
                          <td>Garcia</td>
                          <td>Garcia@mail.com</td>
                          <td>-</td>
                        </tr>
                        <tr>
                          <td>David</td>
                          <td>Smith</td>
                          <td>David@mail.com</td>
                          <td>-</td>
                        </tr>
                        <tr>
                          <td>Maria</td>
                          <td>Rodriguez</td>
                          <td>Rodriguez@mail.com</td>
                          <td>-</td>
                        </tr>
                        <tr>
                          <td>Maria</td>
                          <td>Hernandez</td>
                          <td>Maria@mail.com</td>
                          <td>-</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.table-responsive -->
                  <div class="card-footer text-center">
                    <a href="javascript:void(0)" class="uppercase">View All</a>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </section>
            <!-- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->
            <section class="col-lg-5 connectedSortable">
              <div class="card">
                <div class="card-header border-0">
                  <div class="d-flex justify-content-between">
                    <!-- <h3 class="card-title">Online Store Visitors</h3> -->
                    <a href="javascript:void(0);">View Report</a>
                  </div>
                </div>
                <div class="card-body">
                  <div class="d-flex">
                    <p class="d-flex flex-column">
                      <span class="text-bold text-lg">820</span>
                      <span>Visitors Over Time</span>
                    </p>
                    <p class="ml-auto d-flex flex-column text-right">
                      <span class="text-success">
                        <i class="fas fa-arrow-up"></i> 12.5%
                      </span>
                      <span class="text-muted">Since last week</span>
                    </p>
                  </div>
                  <!-- /.d-flex -->

                  <div class="position-relative mb-4">
                    <canvas id="visitors-chart" height="200"></canvas>
                  </div>

                  <div class="d-flex flex-row justify-content-end">
                    <span class="mr-2">
                      <i class="fas fa-square text-danger"></i> This Week
                    </span>

                    <span>
                      <i class="fas fa-square text-gray"></i> Last Week
                    </span>
                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">New videos</h3>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                  <ul class="products-list product-list-in-card pl-2 pr-2">
                    <li class="item">
                      <div class="product-img">
                        <img src="{{asset('dist/img/default-150x150.png')}}" alt="Product Image" class="img-size-50">
                      </div>
                      <div class="product-info">
                        <a href="javascript:void(0)" class="product-title">Lorem Ipsum
                        </a>
                        <span class="product-description">
                          Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                        </span>
                      </div>
                    </li>
                    <!-- /.item -->
                    <li class="item">
                      <div class="product-img">
                        <img src="{{asset('dist/img/default-150x150.png')}}" alt="Product Image" class="img-size-50">
                      </div>
                      <div class="product-info">
                        <a href="javascript:void(0)" class="product-title">Lorem Ipsum
                        </a>
                        <span class="product-description">
                          Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                        </span>
                      </div>
                    </li>
                    <li class="item">
                      <div class="product-img">
                        <img src="{{asset('dist/img/default-150x150.png')}}" alt="Product Image" class="img-size-50">
                      </div>
                      <div class="product-info">
                        <a href="javascript:void(0)" class="product-title">Lorem Ipsum
                        </a>
                        <span class="product-description">
                          Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                        </span>
                      </div>
                    </li>
                    <li class="item">
                      <div class="product-img">
                        <img src="{{asset('dist/img/default-150x150.png')}}" alt="Product Image" class="img-size-50">
                      </div>
                      <div class="product-info">
                        <a href="javascript:void(0)" class="product-title">Lorem Ipsum
                        </a>
                        <span class="product-description">
                          Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                        </span>
                      </div>
                    </li>
                    <li class="item">
                      <div class="product-img">
                        <img src="{{asset('dist/img/default-150x150.png')}}" alt="Product Image" class="img-size-50">
                      </div>
                      <div class="product-info">
                        <a href="javascript:void(0)" class="product-title">Lorem Ipsum
                        </a>
                        <span class="product-description">
                          Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                        </span>
                      </div>
                    </li>

                    <!-- /.item -->
                    <li class="item">
                      <div class="product-img">
                        <img src="{{asset('dist/img/default-150x150.png')}}" alt="Product Image" class="img-size-50">
                      </div>
                      <div class="product-info">
                        <a href="javascript:void(0)" class="product-title">Lorem Ipsum
                        </a>
                        <span class="product-description">
                          Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                        </span>
                      </div>
                    </li>
                    <!-- /.item -->
                    <li class="item">
                      <div class="product-img">
                        <img src="{{asset('dist/img/default-150x150.png')}}" alt="Product Image" class="img-size-50">
                      </div>
                      <div class="product-info">
                        <a href="javascript:void(0)" class="product-title">Lorem Ipsum
                        </a>
                        <span class="product-description">
                          Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                        </span>
                      </div>
                    </li>
                    <!-- /.item -->
                  </ul>
                </div>
                <!-- /.card-body -->
                <div class="card-footer text-center">
                  <a href="javascript:void(0)" class="uppercase">View All Videos</a>
                </div>
                <!-- /.card-footer -->
              </div>
            </section>
            <!-- right col -->
          </div>
          <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
      </section>
@endsection
