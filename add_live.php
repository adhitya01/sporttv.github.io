<?php include("includes/header.php");

	require("includes/function.php");
	require("language/language.php");

	require_once("thumbnail_images.class.php");
	
 	$cat_qry="SELECT * FROM tbl_category ORDER BY category_name";
	$cat_result=mysqli_query($mysqli,$cat_qry); 
 
	
    if(isset($_POST['submit']) and isset($_GET['add'])){
        $image=rand(0,99999)."_".$_FILES['image']['name'];
        
        $tpath1='images/'.$image; 			 
        $pic1=compress_image($_FILES["image"]["tmp_name"], $tpath1, 100);
        
        $data = array( 
        'name'  =>  $_POST['name'],
        'image'  =>  $image,
        'url'  =>  $_POST['url'],
        'tv_pay' => addslashes($_POST['tv_pay']),
        'video_type'  =>  $_POST['video_type'],
        'cat_id'  =>  $_POST['cat_id']
        );		
        
        $qry = Insert('tbl_live',$data);	
        
        $_SESSION['msg']="10"; 
        header( "Location:add_live.php?add=yes");
        exit;	
     
    }
    
    if(isset($_GET['tv_id'])){
    	$qry="SELECT * FROM tbl_live where id='".$_GET['tv_id']."'";
    	$result=mysqli_query($mysqli,$qry);
    	$row=mysqli_fetch_assoc($result);
    }
    
    if(isset($_POST['submit']) and isset($_POST['tv_id'])){
        
        if($_FILES['image']['name']!=""){		
        
            $img_res=mysqli_query($mysqli,'SELECT * FROM tbl_live WHERE cid='.$_GET['tv_id'].'');
            $img_res_row=mysqli_fetch_assoc($img_res);
            
            if($img_res_row['image']!=""){
             unlink('images/'.$img_res_row['image']);
            }
            
            $image=rand(0,99999)."_".$_FILES['image']['name'];
            
            $tpath1='images/'.$image; 			 
            $pic1=compress_image($_FILES["image"]["tmp_name"], $tpath1, 100);
            
            $data = array( 
            'name'  =>  $_POST['name'],
            'image'  =>  $image,
            'url'  =>  $_POST['url'],
            'tv_pay' => addslashes($_POST['tv_pay']),
            'video_type'  =>  $_POST['video_type'],
            'cat_id'  =>  $_POST['cat_id']
            );		
            
            $category_edit=Update('tbl_live', $data, "WHERE id = '".$_POST['tv_id']."'");
            
        } else{
            $data = array(
            'name'  =>  $_POST['name'],
            'url'  =>  $_POST['url'],
            'tv_pay' => addslashes($_POST['tv_pay']),
            'video_type'  =>  $_POST['video_type'],
            'cat_id'  =>  $_POST['cat_id']
            );	
            
            $category_edit=Update('tbl_live', $data, "WHERE id = '".$_POST['tv_id']."'");
        }
        
        $_SESSION['msg']="11"; 
        header( "Location:add_live.php?tv_id=".$_POST['tv_id']);
        exit;
    }
?>


<div class="row">
      <div class="col-md-12">
        <div class="card">
        <div class="page_title"><?php if(isset($_GET['tv_id'])){?>Edit<?php }else{?>Add<?php }?> Live</div>
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
          <div class="card-body mrg_bottom"> 
            <form action="" name="addeditcategory" method="post" class="form form-horizontal" enctype="multipart/form-data">
            	<input  type="hidden" name="tv_id" value="<?php echo $_GET['tv_id'];?>" />

              <div class="section">
                <div class="section-body">

                <div class="section-body">
                  <div class="form-group">
                    <label class="col-md-3 control-label"><b>Category</b></label>
                    <div class="col-md-6">
                      <select name="cat_id" id="cat_id" class="select2">
                        <option value="">--Select Category--</option>
      							<?php
  									while($cat_row=mysqli_fetch_array($cat_result))
  									{
      							?>          						 
      							<option value="<?php echo $cat_row['cid'];?>" <?php if($cat_row['cid']==$row['cat_id']){?>selected<?php }?>><?php echo $cat_row['category_name'];?></option>	          							 
      							<?php
      								}
      							?>
                      </select>
                    </div>
                  </div>
                
                  <div class="form-group">
                    <label class="col-md-3 control-label"><b>Title</b></label>
                    <div class="col-md-6">
                      <input type="text" name="name" id="name" value="<?php if(isset($_GET['tv_id'])){echo $row['name'];}?>" class="form-control" required>
                    </div>
                  </div>   
                  
                  <div class="form-group">
                    <label class="col-md-3 control-label">Type</label>
                    <div class="col-md-6">                       
                      <select name="tv_pay" id="tv_pay" style="width:280px; height:25px;" class="select2" required>
						    <option value="free" <?php if($row['tv_pay']=='free'){?>selected<?php }?>>Free</option>
                            <option value="premium" <?php if($row['tv_pay']=='premium'){?>selected<?php }?>>Premium</option>
                      </select>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="col-md-3 control-label"><b>Video Type</b></label>
                    <div class="col-md-6">                       
                      <select name="video_type" id="video_type" style="width:280px; height:25px;" class="select2" required>
					  <option value="">--Select Category--</option>	
						    <option value="youtube" <?php if($row['video_type']=='youtube'){?>selected<?php }?>>Youtube</option>
						    <option value="youtube_live" <?php if($row['video_type']=='youtube_live'){?>selected<?php }?>>Youtube Live</option>
                            <option value="Online" <?php if($row['video_type']=='Online'){?>selected<?php }?>>HLS/M3U8/HTTP</option>
                            <option value="mp4" <?php if($row['video_type']=='mp4'){?>selected<?php }?>>MP4/AVI/MOV/MKV</option>
                            <option value="rtmp" <?php if($row['video_type']=='rtmp'){?>selected<?php }?>>RTMP</option>
                            <option value="Webview" <?php if($row['video_type']=='Webview'){?>selected<?php }?>>Webview</option>
                      </select>
                    </div>
                  </div>	
         
                  <div id="video_url_display1" class="form-group">
                    <label class="col-md-3 control-label"><b>Tv Url</b></label>
                    <div class="col-md-6">
                      <input type="text" name="url" id="url" value="<?php if(isset($_GET['tv_id'])){echo $row['url'];}?>" class="form-control" required>
                    </div>
                  </div>  

	               <div class="form-group">
                    <label class="col-md-3 control-label"><b>Select Image</b>
                    </label>
                    <div class="col-md-6">
                      <div class="fileupload_block">
                        <input type="file" name="image" value="fileupload" id="fileupload">
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-3 control-label"></label>
                    <div class="col-md-6">
                       <?php if(isset($_GET['tv_id']) and $row['image']!="") {?>
                        <div class="fileupload_block">
                        	  <div class="fileupload_img"><img type="image" src="images/<?php echo $row['image'];?>" /></div>
                            </div>
                          <?php } else {?>
                        	<?php }?>
                    </div>
                  </div>
      
                  <div class="form-group">
                    <div class="col-md-9 col-md-offset-3">
                      <button type="submit" name="submit" class="btn btn-primary">Save</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
<?php include("includes/footer.php");?>       
