<?php
require_once "config/db.php";
?>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

<div class="container mt-5">
    <?php if (isset($_SESSION['success'])) { ?>
        <div class="alert alert-success">
            <?php
            echo $_SESSION['success'];
            unset($_SESSION['success']);
            ?>
        </div>
    <?php } ?>
    <?php if (isset($_SESSION['error'])) { ?>
        <div class="alert alert-danger">
            <?php
            echo $_SESSION['error'];
            unset($_SESSION['error']);
            ?>
        </div>
    <?php } ?>
    <span style="color:red">
        ** <span class="SpanAccountNo">สินค้าถึงลูกค้าแล้วต้องอัดวิดีโอก่อนเปิดสินค้าเท่านั้นเพื่อรักษาสิทธิ์ ลูกค้าหากไม่มีวิดีโอยืนยันทางร้านขอไม่รับผิดชอบทุกกรณี</span>
    </span>
    <br>
    <span style="color:red">
                        ** <span class="SpanAccountNo">ในการรีวิวนั้นต้องรีวิวจากสินค้าที่ซื้อไปก่อนตามลำดับ</span>
                        </span>
    <table class="table " id="dataTable" width="10%" cellspacing="">
        <thead>
            <tr>
                <th scope="col">ชื่อ-สกุล</th>
                <th scope="col">ที่อยู่</th>
                <th scope="col">สินค้า</th>
                <th scope="col">ราคาทั้งหมด</th>
                <th scope="col">สถานะการจัดส่ง</th>
                <th scope="col">เลขพัสดุ</th>
                <th scope="col">ยกเลิกสินค้า/เคลมสินค้า</th>
                <th scope="col">กดเพื่อรีวิว</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($_SESSION['user_login'])) {
                $user_id = $_SESSION['user_login'];
                $stmt = $conn->query("SELECT * FROM users WHERE id = $user_id");
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $email = $row['email'];
                $email_m = $email;
            }



            $stmt1 = $conn->query("SELECT * FROM orders WHERE orders_user_id = $user_id");

            $stmt1->execute();
            $users = $stmt1->fetchAll();

            if (!$users) {
                echo "<p><td colspan='6' class='text-center'>No data available</td></p>";
            } else {
                foreach ($users as $user) {
            ?>
                    <tr>
                        <td><?php echo $user['name']; ?></td>
                        <td><?php echo $user['address']; ?></td>
                        <td><?php echo $user['products']; ?></td>
                        <td><?php echo $user['amount_paid']; ?></td>
                        <?php if ($user['status'] == "2") {
                                echo "<td><span style='color:#0B67FF' i class='fas fa-circle'  >ยืนยันการสั่งซื้อสินค้า</span></td>";
                            } else if ($user['status'] == "1") {

                                echo "<td><span style='color:#2CDFEB'  i class='fas fa-circle'>รอการจัดส่งสินค้า</span></td>";
                            }
                            else if ($user['status'] == "3") {

                                echo "<td><span style='color:#FFC80B'  i class='fas fa-circle'>กำลังดำเนินการจัดส่ง</span></td>";
                            } 
                            else if ($user['status'] == "4") {

                                echo "<td><span style='color:#0FFF0B'  i class='fas fa-circle'>พัสดุถูกจัดส่งเสร็จสินแล้ว</span></td>";
                            }
                            else if ($user['status'] == "5") {

                                echo "<td><span style='color:#FF0000'  i class='fas fa-circle'>ยกเลิกสินค้า</span></td>";
                            }
                            else if ($user['status'] == "6") {

                                echo "<td><span style='color:#B42CEB'  i class='fas fa-circle'>ตรวจสอบข้อมูล</span></td>";
                            }
                            else if ($user['status'] == "8") {

                                echo "<td><span style='color:#0FFF0B'  i class='fas fa-circle'>เคลมสำเร็จแล้ว</span></td>";
                            }
                            else if ($user['status'] == "9") {

                                echo "<td><span style='color:#6D3D00'  i class='fas fa-circle'>ไม่สามารถเคลมสินค้าได้</span></td>";
                            }
                            else if ($user['status'] == "10") {

                                echo "<td><span style='color:#B42CEB'  i class='fas fa-circle'>ตรวจสอบข้อมูล</span></td>";
                            }else {

                                echo "<td><span style='color:#F4F800'  i class='fas fa-circle'>เคลมสินค้า</span></td>";
                            }
                            ?>
                        <td><?php echo $user['parcel_number']; ?></td>
                        
                        
                       
                        <td>
                        <?php if ($user['status'] == "1") {
                            ?>
                            <a href="product_%20status.php?id=<?= $user['id']?>#divOne1"class="text-danger lead" onclick="return confirm('คุณต้องการที่จะยกเลิกสินค้าใช่หรือไม่');"><i class="fas fa-solid fa-ban"></i></a>
                            <?php
                            } else if ($user['status'] == "2") {
                                ?>
                                <a href="product_%20status.php?id=<?= $user['id']?>#divOne1"class="text-danger lead" onclick="return confirm('คุณต้องการที่จะยกเลิกสินค้าใช่หรือไม่');"><i class="fas fa-solid fa-ban"></i></a>
                                
                            <?php
                            } else if ($user['status'] == "3") {
                                ?>
                               
                            <?php
                            } else if ($user['status'] == "8") {
                                ?>
                               
                            <?php
                             } else if ($user['status'] == "10") {
                                ?>
                               <a href="product_%20status.php?id=<?= $user['id']?>#divOne1" class="text-danger lead" onclick="return confirm('คุณต้องการที่จะยกเลิกสินค้าใช่หรือไม่');"><i class="fas fa-solid fa-ban"></i></a>
                            <?php
                            } else if ($user['status'] == "9") {
                                ?>
                               
                            <?php
                            } else if ($user['status'] == "7") {
                                ?>
                               กำลังยื่นเคลมสินค้า
                            <?php
                            }else if ($user['status'] == "5") {
                                ?>
                                ยกเลิกสินค้า
                                
                            <?php
                            }else if ($user['status'] == "6") {
                                ?>
                                
                                <a href="product_%20status.php?id=<?= $user['id']?>#divOne1" class="text-danger lead" onclick="return confirm('คุณต้องการที่จะยกเลิกสินค้าใช่หรือไม่');"><i class="fas fa-solid fa-ban"></i></a>
                                
                            <?php
                            }else {
                                ?>
                                <a href="product_%20status.php?id=<?= $user['id']?>#divOne" class="text-warning lead" onclick="return confirm('คุณต้องการที่จะเคลมสินค้าใช่หรือไม่');"><i class="fas fa-exclamation-circle"></i></a>
                               <?php
                            }
                            ?>

                       
						
						</td>
                        <?php if ($user['status'] == "4") {
                            ?>
                           <?php if($user['id'] == $user['review_id'] ){
                             echo "<td><span style='color:gray'>คุณได้รีวิวสินค้าไปแล้ว</span></td>";
                            ?>
                            <?php
                            
                           }else{
                            ?>
                            <td><a href="?id=<?= $user['id']?>#"  type='submit'   name='add_review' id='add_review'><input type="submit"  class="btn btn-primary" value="รีวืว" ></td>
                           <?php
                               
                            }
                          
                           ?>
                            
                            
                            <?php
                            } elseif($user['status'] == "8") {
                                ?>
                                <?php if($user['id'] == $user['review_id'] ){
                                  echo "<td><span style='color:gray'>คุณได้รีวิวสินค้าไปแล้ว</span></td>";
                                 ?>
                                 <?php
                                 
                                }else{
                                 ?>
                                 <td><a href="?id=<?= $user['id']?>#"  type='submit'   name='add_review' id='add_review'><input type="submit"  class="btn btn-primary" value="รีวืว" ></td>
                                <?php
                                    
                                 }
                               
                                ?>
                            <?php
                            }elseif($user['status'] == "9") {
                                ?>
                                <?php if($user['id'] == $user['review_id'] ){
                                  echo "<td><span style='color:gray'>คุณได้รีวิวสินค้าไปแล้ว</span></td>";
                                 ?>
                                 <?php
                                 
                                }else{
                                 ?>
                                 <td><a href="?id=<?= $user['id']?>#"  type='submit'   name='add_review' id='add_review'><input type="submit"  class="btn btn-primary" value="รีวืว" ></td>
                                <?php
                                    
                                 }
                               
                                
                               
                            }
                            ?>
                        <td>
                        </td>
                        
                    </tr>
            <?php }
            } ?>
        </tbody>
    </table>
</div>
<script>
        let imgInput = document.getElementById('imgInput');
        let previewImg = document.getElementById('previewImg');

        imgInput.onchange = evt => {
            const [file] = imgInput.files;
            if (file) {
                previewImg.src = URL.createObjectURL(file)
            }
        }
    </script>