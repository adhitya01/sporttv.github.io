<?php include("includes/header.php");

	require("includes/function.php");
	require("language/language.php");

  if(isset($_POST['data_search']))
   {

      $qry="SELECT * FROM tbl_live                   
                  WHERE tbl_live.name like '%".addslashes($_POST['search_value'])."%'
                  ORDER BY tbl_live.name";
 
     $result=mysqli_query($mysqli,$qry); 

   }
   else
   {
	
	//Get all Category 
	 
      $tableName="tbl_live";   
      $targetpage = "manage_live.php"; 
      $limit = 12; 
      
      $query = "SELECT COUNT(*) as num FROM $tableName";
      $total_pages = mysqli_fetch_array(mysqli_query($mysqli,$query));
      $total_pages = $total_pages['num'];
      
      $stages = 3;
      $page=0;
      if(isset($_GET['page'])){
      $page = mysqli_real_escape_string($mysqli,$_GET['page']);
      }
      if($page){
        $start = ($page - 1) * $limit; 
      }else{
        $start = 0; 
        } 
      
     $qry="SELECT * FROM tbl_live ORDER BY tbl_live.id DESC LIMIT $start, $limit";
 
     $result=mysqli_query($mysqli,$qry); 
	
    } 
	 
?>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.css">       
    <div class="row">
      <div class="col-xs-12">
        <div class="card mrg_bottom">
          <div class="page_title_block">
            <div class="col-md-5 col-xs-12">
              <div class="page_title">Manage Live</div>
            </div>
            <div class="col-md-7 col-xs-12">
              <div class="search_list">
                <div class="search_block">
                  <form  method="post" action="">
                  <input class="form-control input-sm" placeholder="Search Live..." aria-controls="DataTables_Table_0" type="search" name="search_value" value="<?php if(isset($_POST['data_search'])){ echo $_POST['search_value'];} ?>" required>
                        <button type="submit" name="data_search" class="btn-search"><i class="fa fa-search"></i></button>
                  </form>  
                </div>
                <div class="add_btn_primary"> <a href="add_live.php?add=yes">Add Live</a> </div>
              </div>
            </div>
          </div>
           <div class="clearfix"></div>
          <div class="row mrg-top">
            <div class="col-md-12">
               
              <div class="col-md-12 col-sm-12">
                <?php if(isset($_SESSION['msg'])){?> 
                 <div class="alert alert-success alert-dismissible" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                  <?php echo $client_lang[$_SESSION['msg']] ; ?></a> </div>
                <?php unset($_SESSION['msg']);}?> 
              </div>
            </div>
          </div>
          <div class="col-md-12 mrg-top">
            <div class="row">
              <?php 
              $i=0;
              while($row=mysqli_fetch_array($result))
              {         
          ?>
              <div class="col-lg-3 col-sm-6 col-xs-12">
                <div class="block_wallpaper">   
                 <div class="wall_category_block">
                                <h2>
                                    <?php 
                                    if(strlen($row['tv_pay']) > 18){
                                        echo mb_substr(stripslashes($row['tv_pay']), 0, 17).'...';  
                                    }else{
                                        echo $row['tv_pay'];
                                    }
                                    ?>
                                </h2>  
                                <div class="checkbox" style="float: right;">
                                    
                                </div>
                            </div>
                
                
                  <div class="wall_image_title">
                    <h2><a href="#"><?php echo $row['name'];?></span></a></h2>
                    <ul>                
                      <li><a href="add_live.php?tv_id=<?php echo $row['id'];?>" target="_blank" data-toggle="tooltip" data-tooltip="Edit"><i class="fa fa-edit"></i></a></li>               
                      <li><a href="" class="btn_delete_a" data-id="<?php echo $row['id'];?>"  data-toggle="tooltip" data-tooltip="Delete"><i class="fa fa-trash"></i></a>
                                    </li>
                                    <?php if($row['status']!="0"){?>
                                    <li><div class="row toggle_btn"><a href="javascript:void(0)" data-id="<?php echo $row['id'];?>" data-action="deactive" data-column="status" data-toggle="tooltip" data-tooltip="ENABLE"><img src="assets/images/btn_enabled.png" alt="" /></a></div></li>
                                    <?php }else{?>
                                    <li><div class="row toggle_btn"><a href="javascript:void(0)" data-id="<?php echo $row['id'];?>" data-action="active" data-column="status" data-toggle="tooltip" data-tooltip="DISABLE"><img src="assets/images/btn_disabled.png" alt="" /></a></div></li>
                                    <?php }?>
                      
                      

                    </ul>
                  </div>
                  <span><img src="images/<?php echo $row['image'];?>" /></span>
                </div>
              </div>
          <?php
            
            $i++;
              }
        ?>     
               
      </div>
          </div>
          <div class="col-md-12 col-xs-12">
            <div class="pagination_item_block">
              <nav>
                <?php if(!isset($_POST["data_search"])){ include("pagination.php");}?>
              </nav>
            </div>
          </div>
         
        </div>
      </div>
    </div>
        
<?php include("includes/footer.php");?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.js"></script>


<script type="text/javascript">

  $(".toggle_btn a").on("click",function(e){
    e.preventDefault();
    
    var _for=$(this).data("action");
    var _id=$(this).data("id");
    var _column=$(this).data("column");
    var _table='tbl_live';

    $.ajax({
      type:'post',
      url:'processData.php',
      dataType:'json',
      data:{id:_id,for_action:_for,column:_column,table:_table,'action':'toggle_status','tbl_id':'id'},
      success:function(res){
          console.log(res);
          if(res.status=='1'){
            location.reload();
          }
        }
    });

  });

  $(".btn_delete_a").click(function(e){
      e.preventDefault();
      var _ids = $(this).data("id");
      
      if(_ids!=''){
        Swal.fire({
          title: 'Are you sure?',
          input: 'checkbox',
          inputPlaceholder: 'Do you want to delete related tv?'
        }).then(function(result) {
            
          if (result.value) {
            $.ajax({
              type:'post',
              url:'processData.php',
              dataType:'json',
              data:{id:_ids,'action':'multi_delete','yes_no':"yes",'tbl_nm':'tbl_live'},
              success:function(res){
                  console.log(res);
                  if(res.status=='1'){
                    Swal.fire({type: 'success', text: 'Deleted successfully..!!'}).then(function(){ 
                       location.reload();
                       }
                    );
                  }
                  else if(res.status=='-2'){
                    alert(res.message);
                  }
                }
            });
            
          }else if (result.value === 0) {
            $.ajax({
              type:'post',
              url:'processData.php',
              dataType:'json',
              data:{id:_ids,'action':'multi_delete','yes_no':"no",'tbl_nm':'tbl_live'},
              success:function(res){
                  console.log(res);
                  if(res.status=='1'){
                    Swal.fire({type: 'success', text: 'Deleted successfully..!!'}).then(function(){ 
                       location.reload();
                       }
                    );
                  }
                  else if(res.status=='-2'){
                    alert(res.message);
                  }
                }
            });
          } else {
          }
        });
      }
  });
</script>

  