
<link rel="stylesheet" href="css/fontawesome.min.css">
<!-- Page Wrapper -->
<div id="wrapper">

<!-- Sidebar -->
<ul class="navbar-nav  sidebar sidebar-dark accordion" style="background-color:#098934;"  id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="admin.php?q">
        <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-seedling"></i>
        </div>
        <div class="sidebar-brand-text mx-3">KMshop</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="admin.php?q">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>สรุปข้อมูลรายได้</span></a>
    </li>
    <li class="nav-item">
        
        <a class="nav-link" href="admin_mo.php">
        <i class="fas fa-shipping-fast"></i>
        <span>ขนส่ง/ตรวจสอบสินค้า</span></a>
       
        
</li><li class="nav-item">
<li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities2"
                    aria-expanded="true" aria-controls="collapseUtilities12">
                    <i class="fas fa-clipboard-list"></i>
                    <span>รายการขนส่ง/ตรวจสินค้า</span>
                </a>
                <div id="collapseUtilities2" class="collapse" aria-labelledby="headingUtilities2"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">รายการขนส่ง/ตรวจสอบสินค้า</h6>
                        <a class="collapse-item" href="orders_check.php">รายการตรวจสอบ</a>
                        <a class="collapse-item" href="orders_WFP.php">รายการรอชำระเงิน</a>
                        <a class="collapse-item" href="orders_WFD.php">รายการรอการจัดส่งสินค้า</a>
                        <a class="collapse-item" href="orders_ shipping.php">รายการกำลังดำเนินการจัดส่ง</a>
                        <a class="collapse-item" href="orders_ succeed.php">รายการพัสดุถูกจัดส่งเสร็จแล้ว</a> 
                    </div>
                </div>
            </li>



    <li class="nav-item">
        
           
            <a class="nav-link" href="admin_mo_T.php">
            <i class="fas fa-dolly"></i>
            <span>ยกเลิก/เคลมสินค้า</span></a>
            
    </li><li class="nav-item">

    <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities1"
                    aria-expanded="true" aria-controls="collapseUtilities11">
                    <i class="fas fa-clipboard-list"></i>
                    <span>รายการยกเลิก/เคลมสินค้า</span>
                </a>
                <div id="collapseUtilities1" class="collapse" aria-labelledby="headingUtilities1"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">รายการยกเลิก/เคลมสินค้า</h6>

                        <a class="collapse-item" href="orders_cancel.php">รายการที่ถูกยกเลิก</a>   
                        <a class="collapse-item" href="orders_claim.php">รายการที่ขอเคลมสินค้า</a>   
                        <a class="collapse-item" href="orders_Noclaim.php">รายการไม่อนุมัติเคลม</a>  
                        <a class="collapse-item" href="orders_claimSuccess.php">รายการเคลมสำเร็จ</a>
                    </div>
                </div>
            </li>
 <li class="nav-item">
            
            <a class="nav-link" href="admin_user.php">
            <i class="fas fa-address-book"></i>
            <span>ผู้ใช้งานระบบ</span></a>
    </li><li class="nav-item">
    

                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>ต้นไม้</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">ต้นไม้</h6>
                <a class="collapse-item" href="category.php">เพิ่มสายพันธ์</a>
                <a class="collapse-item" href="product.php">เพิ่มต้นไม้</a>
                <div class="collapse-divider"></div>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>รายการทั้งหมด</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">รวมรายการทั้งหมด</h6>
                        <a class="collapse-item" href="orders.php">รวมรายการทั้งหมด</a>
                        <a class="collapse-item" href="orders_check.php">รายการตรวจสอบ</a>
                        <a class="collapse-item" href="orders_WFP.php">รายการรอชำระเงิน</a>
                        <a class="collapse-item" href="orders_WFD.php">รายการรอการจัดส่งสินค้า</a>
                        <a class="collapse-item" href="orders_ shipping.php">รายการกำลังดำเนินการจัดส่ง</a>
                        <a class="collapse-item" href="orders_ succeed.php">รายการพัสดุถูกจัดส่งเสร็จแล้ว</a>
                        <a class="collapse-item" href="orders_cancel.php">รายการที่ถูกยกเลิก</a>   
                        <a class="collapse-item" href="orders_claim.php">รายการที่ขอเคลมสินค้า</a>   
                        <a class="collapse-item" href="orders_Noclaim.php">รายการไม่อนุมัติเคลม</a> 
                        <a class="collapse-item" href="orders_claimSuccess.php">รายการเคลมสำเร็จ</a>
                    </div>
                </div>
            </li>
           
            
        </ul>
       


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message -->
            

        </ul>
        <script src="https://kit.fontawesome.com/15a17d715f.js" crossorigin="anonymous"></script>
