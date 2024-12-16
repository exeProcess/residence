
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Web Admin | DataTables</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/43.2.0/ckeditor5.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="../../plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">

  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="../../plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <!-- BS Stepper -->
  <link rel="stylesheet" href="../../plugins/bs-stepper/css/bs-stepper.min.css">
  <!-- dropzonejs -->
  <link rel="stylesheet" href="../../plugins/dropzone/min/dropzone.min.css">
  
  <link rel="stylesheet" href="../../plugins/toastr/toastr.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <style>
    .inputflyer {
    width: 0.1px;
    height: 0.1px;
    opacity: 0;
    overflow: hidden;
    position: absolute;
    z-index: -1;
  }
  .main-container {
				width: 795px;
				margin-left: auto;
				margin-right: auto;
			}
  .inputflyer + label {
    font-size: 1.25em;
    font-weight: 700;
    color: white;
    background-color: black;
    display: inline-block;
}
.preview {
            display: inline-block;
            margin: 10px;
        }
        .preview img {
            width: 100px;
            height: 100px;
            margin-right: 10px;
        }

.inputflyer + label,
.inputflyer + label:hover {
    background-color: red;
}
.inputflyer + label {
	cursor: pointer; /* "hand" cursor */
}
input[type=file] {
  /* width: 350px; */
  width: 100%;
  color: #444;
  padding: 3px;
  background: #fff;
  border-radius: 10px;
  border: 1px solid #555;
}
input[type=file]::file-selector-button {
  margin-right: 20px;
  border: none;
  background: #084cdf;
  padding: 5px 20px;
  border-radius: 10px;
  color: #fff;
  cursor: pointer;
  transition: background .2s ease-in-out;
}

input[type=file]::file-selector-button:hover {
  background: #0d45a5;
}
  </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <!-- <a class="nav-link" data-widget="pushmenu" href="#" role="button" style="cursor:;"></a> -->
      </li>
      <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="../../index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> -->
    </ul>
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <!-- <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li> -->

      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="../../dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="../../dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="../../dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li> -->
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link">
      <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <!-- <div class="image">
          <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div> -->
        <div class="info">
          <a href="#" class="d-block">American Residents</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <!-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <!-- <li class="nav-item">
                <a href="../../index.php" class="nav-link">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    Dashboard
                  </p>
                </a>
              </li> -->
              <li class="nav-item">
                <a href="./clone.php" class="nav-link active">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    Manage Products
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./data.php" class="nav-link">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                    Property List
                    
                  </p>
                </a>
              </li>
              <!-- <li class="nav-item">
                <a href="./pages/tables/edit.php" class="nav-link">
                  <i class="nav-icon fas fa-copy"></i>
                  <p>
                    Edit Property
                    
                  </p>
                </a>
              </li> -->
              <!-- <li class="nav-item">
                <a href="./pages/tables/donation.php" class="nav-link">
                  <i class="nav-icon fas fa-copy"></i>
                  <p>
                    Donations
                    <i class="fas fa-angle-left right"></i>
                    <span class="badge badge-info right">6</span>
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./pages/tables/ads.php" class="nav-link">
                  <i class="nav-icon fas fa-copy"></i>
                  <p>
                    Ads Management
                    <i class="fas fa-angle-left right"></i>
                    <span class="badge badge-info right">6</span>
                  </p>
                </a>
              </li> -->
              <!-- <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon far fa-envelope"></i>
                  <p>
                    Mailbox
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a> -->
                <!-- <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../mailbox/mailbox.html" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Inbox</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="../mailbox/compose.html" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Compose</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="../mailbox/read-mail.html" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Read</p>
                    </a>
                  </li>
                </ul> -->
              <!-- </li> -->
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Manage Products</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Products</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <?php
             $dbClass = new Database();
             $db = $dbClass->connect();
             $ctrl = new Controller($db);
             $properties = $ctrl->selectAll("properties");
          ?>
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">List Of Properties</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                      <tr>
                        <th>property name</th>
                        <th>property Location</th>
                        <th>Transaction Type</th>
                        <th>Space</th>
                        <th>Property Type</th>
                        <th>Action</th>
                      </tr>  
                  </thead>
                  <tbody id="table-body">
                     <?php 

                        foreach($properties as $property):
                      ?>
                      <tr id="row-<?= $property['id']?>">
                        <td><?= $property['name']?></td>
                        <td><?= $property['prop_location']?></td>
                        <td><?= $property['transaction_type']?></td>
                        <td><?= $property['space']?></td>
                        <td><?= $property['prop_type']?></td>
                        
                        <td class="d-flex justify-content-between">
                          <a href="./edit.php?id=<?= $property['id']?>" class="text-success"><i class="fa fa-solid fa-pen"></i></a>
                          <a href="#" class="text-danger" id="<?= $property['id']?>" onclick="fnDelete(this.id)"><i class="fa fa-solid fa-trash"></i></i></a>
                        </td>
                      </tr>
                      <?php
                        endforeach;
                      ?>
                      <!--<tr>
                        <td>Public Lecture</td>
                        <td>Fashola street,Ijoke sango. Ogun state.Al Hidayyah Mosque</td>
                        <td>3pm - 4pm</td>
                        <td> 14 - 1 - 2024</td>
                        <td>arkan</td>
                        <td>
                          <a href="">edit</a>
                        </td>
                      </tr>
                   -->
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 

</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="../../plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- InputMask -->
<script src="../../plugins/moment/moment.min.js"></script>
<script src="../../plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- date-range-picker -->
<script src="../../plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="../../plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- BS-Stepper -->
<script src="../../plugins/bs-stepper/js/bs-stepper.min.js"></script>

<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>

<script src="../../plugins/jszip/jszip.min.js"></script>
<script src="../../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>


<script>
  $("#submit_event").click(() => {
    
    alert('working')
  
  })
  let fnEdit = (id) => {
    $("#update_event").html('<i class="fa fa-sync fa-spin">')
    let dataId = id.split("-")[1]
    let data = {
      id: dataId,
      getEdit: true,
      table: "properties"
    }

    $.ajax({
      url: `./edit.php?id=${dataID}`,
      method: 'GET',
    })
  }


  let fnDelete = (id) =>{
    let data = {
      id: id,
      delete: true,
      table: "products"
    }
    $.ajax({
      url: '../../../Controller/requestHandler.php',
      method: 'POST',
      data: data,
      success: (res) => {
       // if(res == "success"){
          let row = $(`#row-${id}`);
          row.remove();
        
      }
    })
  }


  // $("#loadImg").click(() => {
  //   var flyer = $("#flyer").get("src")
  //   console.log(flyer);
  // })


  //$("#submit_event").click(() => {
    
    // let data = {
    //   name: $("#prop-name").val(),
    //   location: $("#prop-location").val(),
    //   type: $("#prop-type").val(),
    //   transactionType: $("#transcation-type").val(),
    //   space: $("#space").val(),
    //   bedroom: $("#bedroom").val(),
    //   bathroom: $("#bathroom").val(),
    //   description: $("#description").val()
    // }
    // console.log(data);
    
    // $("#submit_event").html('<i class="fa fa-sync fa-spin">')
    // let data = {
    //   name: $("#prop-name").val(),
    //   location: $("#prop-location").val(),
    //   type: $("#prop-type").val(),
    //   transactionType: $("#transcation-type").val(),
    //   space: $("#space").val(),
    //   bedroom: $("#bedroom").val(),
    //   bathroom: $("#bathroom").val(),
    //   description: $("#description").val()
    // }
    // let formdata = new FormData();
    // let file = document.querySelector("#images").files[0]
    // if(id == "submit_event"){
    //   if(data.title == " " || data.topic == " " || data.location == " " || data.date == " " || file == null){
    //     $("#submit_event").html(`<i class="fas fa-upload"></i>
    //                     <span>Upload Event</span>`)
    //     toastr.error("All feilds are required")
    //     return;
    //   }
    //   formdata.append('photo',file);
    //   formdata.append('submit_event', true)
    // }
    // if(id == "update_event"){
    //   let fileEdit = $("#edit-id").val()
    //   if(data.title == " " || data.topic == " " || data.location == "" || data.date == " " || fileEdit == " "){
    //     $("#update_event").html(`<i class="fas fa-upload"></i>
    //                     <span>Update Event</span>`)
    //     toastr.error("All feilds are required")
    //     return;
    //   }
    //   formdata.append('id',$("#edit-id").val());
    //   formdata.append('photo',fileEdit);
    //   formdata.append('edit_event', true)
    // }
    
    
    // formdata.append('name',$("#prop-name").val())
    // formdata.append('location',$("#prop-location").val());
    // formdata.append('transactionType',$("#prop-type").val());
    // formdata.append('space', $("#space").val());
    // formdata.append('bedroom', $("#bedroom").val());
    // formdata.append('bathroom', $("#bathroom").val());
    // formdata.append('description', $("#description").val());
    
   
    // $.ajax({
    //   url: '../../../Controller/requestHandler.php',
    //   method: 'POST',
    //   data: formdata,
    //   cache : false,
    //   contentType : false,
    //   processData : false,
    //   success: (res) => {
    //     let result = JSON.parse(res)
    //     console.log(res);
        
    //     if(result.status == 200){
    //       res
    //       let table = $("#table-body");
    //       let date = data.date.split(" ")[0]
    //       let time = data.date.split(" ")[1]

    //       table.prepend(`
    //       <tr>
    //                       <td>${data.title}</td>
    //                       <td>${data.location}</td>
    //                       <td>${time}</td>
    //                       <td>${date}</td>
    //                       <td>${data.topic}</td>
    //                       <td class="d-flex justify-content-between">
    //                         <a href="#" class="text-success"  onclick="edit(this.id)"><i class="fa fa-solid fa-pen"></i></a>
    //                         <a href="#" class="text-danger"  onclick="get(this.id)"><i class="fa fa-solid fa-trash"></i></i></a>
    //                       </td>
    //                     </tr>
    //       `)
    //       toastr.success('Event Uploaded Successfully')
    //       $("#submit_event").html(`<i class="fas fa-upload"></i>
    //                   <span>Upload Event</span>`)
          
    //     }else{
    //       console.log(res);
    //     }
        
        
    //   }
    // })
  //}) 
  
  // = (id) => {
  //   //e.preventDefault(

  //   $(document).ready(function(){
  //   $("#file-input").on("change", function(){
  //       var files = $(this)[0].files;
  //       $("#preview-container").empty();
  //       if(files.length > 0){
  //           for(var i = 0; i < files.length; i++){
  //               var reader = new FileReader();
  //               reader.onload = function(e){
  //                   $("<div class='preview'><img src='" + e.target.result + "'><button class='delete'>Delete</button></div>").appendTo("#preview-container");
  //               };
  //               reader.readAsDataURL(files[i]);
  //           }
  //       }
  //   });
// $("#preview-container").on("click", ".delete", function(){
//         $(this).parent(".preview").remove();
//         $("#file-input").val(""); // Clear input value if needed
// });

    // console.log(formdata);
    

</script>

</body>
</html>
