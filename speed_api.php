<?php  include("includes/connection.php");
	   include("includes/function.php"); 	
	   include("language/app_language.php");	
	
	$file_path = getBaseUrl();
	
	define("PACKAGE_NAME",$settings_details['package_name']);
	
	$get_method = checkSignSalt($_POST['data']);
	
	function get_thumb($filename,$thumb_size){	
    	$file_path = getBaseUrl();
    	return $thumb_path=$file_path.'thumb.php?src='.$filename.'&size='.$thumb_size;
    }
	
	if($get_method['method_name']=="home")	{	
	    
	    
	     $jsonObj_new= array();	

		$query_new="SELECT * FROM tbl_banner WHERE status='1' ORDER BY tbl_banner.bid DESC";
		$sql_new = mysqli_query($mysqli,$query_new);

		while($data_new = mysqli_fetch_assoc($sql_new)){
			 
			$row_new['bid'] = $data_new['bid'];
 			$row_new['banner_title'] = $data_new['banner_title'];
 			$row_new['banner_sort_info'] = $data_new['banner_sort_info'];
			$row_new['banner_image'] = $file_path.'images/'.$data_new['banner_image'];
			$row_new['banner_image_thumb'] = $file_path.'images/thumbs/'.$data_new['banner_image'];

			$songs_list=explode(",", $data_new['banner_songs']);

			$row_new['total_songs'] =count($songs_list);

			foreach($songs_list as $song_id){
            	$query01="SELECT * FROM tbl_live 
                	WHERE tbl_live.`id`='$song_id'";

				$sql01 = mysqli_query($mysqli,$query01);

				while($data01 = mysqli_fetch_assoc($sql01)){
					$row01['id'] = $data01['id'];
            			$row01['name'] = $data01['name'];
            			$row01['url'] = $data01['url'];
            			$row01['tv_pay'] = $data01['tv_pay'];
            			$row01['image'] =  get_thumb('images/'.$data01['image'],'300x300');
            			$row01['video_type'] = $data01['video_type'];
            			$row01['total_views'] = $data01['total_views'];
			 
					 
					$row_new['songs_list'][]=$row01;
				}
            }
 
			array_push($jsonObj_new,$row_new);
			
			unset($row_new['songs_list']);
		}

		$row['home_banner']=$jsonObj_new;
        
	    
	   $jsonObj= array();
	   
	   $query="SELECT * FROM tbl_live WHERE tbl_live.status='1' ORDER BY tbl_live.total_views DESC LIMIT 10";
 
		$sql = mysqli_query($mysqli,$query)or die(mysqli_error());

		while($data = mysqli_fetch_assoc($sql)){
		
			$row1['id'] = $data['id'];
			$row1['name'] = $data['name'];
			$row1['url'] = $data['url'];
			$row1['tv_pay'] = $data['tv_pay'];
			$row1['image'] =  get_thumb('images/'.$data['image'],'300x300');
			$row1['video_type'] = $data['video_type'];
			$row1['total_views'] = $data['total_views'];
			 
			array_push($jsonObj,$row1);
		}

		$row['most_view']=$jsonObj;


		$jsonObj_2= array();	
		
		$query_latest="SELECT * FROM tbl_live WHERE tbl_live.status='1' ORDER BY tbl_live.id DESC LIMIT 10";

		$sql_latest = mysqli_query($mysqli,$query_latest)or die(mysqli_error());

		while($data_latest = mysqli_fetch_assoc($sql_latest)){
		    
		    $row2['id'] = $data_latest['id'];
			$row2['name'] = $data_latest['name'];
			$row2['url'] = $data_latest['url'];
			$row2['tv_pay'] = $data_latest['tv_pay'];
			$row2['image'] = get_thumb('images/'.$data_latest['image'],'300x300');
			$row2['video_type'] = $data_latest['video_type'];
			$row2['total_views'] = $data_latest['total_views'];
			
			array_push($jsonObj_2,$row2);
		
		}

		$row['latest']=$jsonObj_2; 
		
		if(file_exists($filename_data)){$set['nemosofts'] = $row;}
        
        header( 'Content-Type: application/json; charset=utf-8' );
        echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
        die();
    }	
	
	else if($get_method['method_name']=="tv_search"){
        
        $jsonObj= array();	
    	
    	$page_limit=10;
    		
		$query="SELECT * FROM tbl_live
			WHERE tbl_live.id  AND tbl_live.name like '%".addslashes($get_method['search_text'])."%' 
		    ORDER BY tbl_live.id DESC LIMIT $page_limit";
 
		$sql = mysqli_query($mysqli,$query)or die(mysqli_error());

		while($data = mysqli_fetch_assoc($sql)){
			$row['id'] = $data['id'];
			$row['name'] = $data['name'];
			$row['url'] = $data['url'];
			$row['tv_pay'] = $data['tv_pay'];
			$row['image'] = get_thumb('images/'.$data['image'],'300x300');
			$row['video_type'] = $data['video_type'];
			$row['total_views'] = $data['total_views'];
			 
			array_push($jsonObj,$row);
		}

		$set['nemosofts'] = $jsonObj;
		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
    }
	
	else if($get_method['method_name']=="all"){
         
       $jsonObj= array();	
     		
     	$page_limit=12;
    		
    	$limit=($get_method['page']-1) * $page_limit;
	
		$query="SELECT * FROM tbl_live WHERE tbl_live.status='1' ORDER BY tbl_live.id DESC LIMIT $limit, $page_limit";
		
		$sql = mysqli_query($mysqli,$query)or die(mysql_error());

		while($data = mysqli_fetch_assoc($sql)){
			$row['id'] = $data['id'];
			$row['name'] = $data['name'];
			$row['url'] = $data['url'];
			$row['tv_pay'] = $data['tv_pay'];
			$row['image'] = get_thumb('images/'.$data['image'],'300x300');
			$row['video_type'] = $data['video_type'];
			$row['total_views'] = $data['total_views'];
			
			array_push($jsonObj,$row);
		}

		$set['nemosofts'] = $jsonObj;
		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
    }
	
	else if($get_method['method_name']=="cat_list"){
     	
     	$jsonObj= array();
 		
 		$page_limit=10;
    		
    	$limit=($get_method['page']-1) * $page_limit;
		
		$query="SELECT cid,category_name,category_image FROM tbl_category ORDER BY tbl_category.cid DESC LIMIT $limit, $page_limit";
		$sql = mysqli_query($mysqli,$query)or die(mysql_error());

		while($data = mysqli_fetch_assoc($sql)){
			$row['cid'] = $data['cid'];
			$row['category_name'] = $data['category_name'];
			$row['category_image'] = $file_path.'images/'.$data['category_image'];
			$row['category_image_thumb'] = $file_path.'images/thumbs/'.$data['category_image'];
 
			array_push($jsonObj,$row);
		}

		$set['nemosofts'] = $jsonObj;
		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
    }
    else if($get_method['method_name']=="cat_tv"){
         
       $jsonObj= array();	
     	$page_limit=12;
    	$limit=($get_method['page']-1) * $page_limit;
    	$cat_id=$get_method['cat_id'];
    
    	$query="SELECT * FROM tbl_live
		LEFT JOIN tbl_category ON tbl_live.cat_id= tbl_category.cid 
		where tbl_live.cat_id='".$cat_id."'AND tbl_live.status='1' ORDER BY tbl_live.id DESC LIMIT $limit, $page_limit";
		

		$sql = mysqli_query($mysqli,$query)or die(mysql_error());

		while($data = mysqli_fetch_assoc($sql)){
			$row['id'] = $data['id'];
			$row['name'] = $data['name'];
			$row['url'] = $data['url'];
			$row['tv_pay'] = $data['tv_pay'];
			$row['image'] = get_thumb('images/'.$data['image'],'300x300');
			$row['video_type'] = $data['video_type'];
			$row['total_views'] = $data['total_views'];
			
			array_push($jsonObj,$row);
		}
		
		$set['nemosofts'] = $jsonObj;
		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
    }
    else if($get_method['method_name']=="most_viewed"){
        $jsonObj= array();
		
		$query="SELECT * FROM tbl_live WHERE tbl_live.status='1' ORDER BY tbl_live.total_views DESC LIMIT 10";
		
		$sql = mysqli_query($mysqli,$query)or die(mysql_error());

		while($data = mysqli_fetch_assoc($sql)){
			$row['id'] = $data['id'];
			$row['name'] = $data['name'];
			$row['url'] = $data['url'];
			$row['tv_pay'] = $data['tv_pay'];
			$row['image'] = get_thumb('images/'.$data['image'],'300x300');
			$row['video_type'] = $data['video_type'];
			$row['total_views'] = $data['total_views'];
			
			array_push($jsonObj,$row);
		}

		$set['nemosofts'] = $jsonObj;
		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
    }
    else if($get_method['method_name']=="tv"){

        $jsonObj= array();

		$query="SELECT * FROM tbl_live where tbl_live.id='".$get_method['tv_id']."' AND tbl_live.status='1' ORDER BY tbl_live.id";
		 
		$sql = mysqli_query($mysqli,$query)or die(mysql_error());

		while($data = mysqli_fetch_assoc($sql)){
			$row['id'] = $data['id'];
			$row['name'] = $data['name'];
			$row['url'] = $data['url'];
			$row['tv_pay'] = $data['tv_pay'];
			$row['image'] = get_thumb('images/'.$data['image'],'300x300');
			$row['video_type'] = $data['video_type'];
			$row['total_views'] = $data['total_views'];
			
			array_push($jsonObj,$row);
		}

		$view_qry=mysqli_query($mysqli,"UPDATE tbl_live SET total_views = total_views + 1 WHERE id = '".$get_method['tv_id']."'");

		$set['nemosofts'] = $jsonObj;
		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
       
    }
    else if($get_method['method_name']=="user_register"){	
      
      	if($get_method['name']!='' AND $get_method['email']!='' AND $get_method['password']!=''){
    
    		$qry = "SELECT * FROM tbl_users WHERE email = '".$get_method['email']."'"; 
    		$result = mysqli_query($mysqli,$qry);
    		$row = mysqli_fetch_assoc($result);
    		
    		if($row['email']!=""){
    			$set['nemosofts'][]=array('msg' => $app_lang['email_exist'],'success'=>'0');
    		}else{ 
     			$qry1="INSERT INTO tbl_users (`name`,`email`,`password`,`phone`,`status`) VALUES ('".$get_method['name']."','".$get_method['email']."','".$get_method['password']."','".$get_method['phone']."','1')"; 
                
                $result1=mysqli_query($mysqli,$qry1);  										 
    					 
    			$set['nemosofts'][]=array('msg' => $app_lang['register_success'],'success'=>'1');
    		}
    	}
    
    	header( 'Content-Type: application/json; charset=utf-8' );
        echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    	die();
    }
    else if($get_method['method_name']=="user_login"){
    
      	$email = $get_method['email'];
    	$password = $get_method['password'];
    
    	$qry = "SELECT * FROM tbl_users WHERE email = '".$email."' and password = '".$password."'"; 
    	$result = mysqli_query($mysqli,$qry);
    	$num_rows = mysqli_num_rows($result);
    	$row = mysqli_fetch_assoc($result);
    	
    	if ($num_rows > 0){ 
    		$set['nemosofts'][]=array('user_id' => $row['id'],'name'=>$row['name'],'success'=>'1','msg' =>$app_lang['login_success']); 
    	}else{
    		$set['nemosofts'][]=array('msg' =>$app_lang['login_fail'],'success'=>'0');	 
    	}
    
    	header( 'Content-Type: application/json; charset=utf-8' );
        echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    	die();
    
    }
    else if($get_method['method_name']=="user_profile"){
        
      	$qry = "SELECT * FROM tbl_users WHERE id = '".$get_method['user_id']."'"; 
    	$result = mysqli_query($mysqli,$qry);
    	 
    	$row = mysqli_fetch_assoc($result);
      				 
        $set['nemosofts'][]=array('user_id' => $row['id'],'name'=>$row['name'],'email'=>$row['email'],'phone'=>$row['phone'],'success'=>'1');
    
        header( 'Content-Type: application/json; charset=utf-8' );
        echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    	die();
    }
    else if($get_method['method_name']=="user_profile_update"){
        
      	if($get_method['password']!=""){
    		$user_edit= "UPDATE tbl_users SET name='".$get_method['name']."',email='".$get_method['email']."',password='".$get_method['password']."',phone='".$get_method['phone']."' WHERE id = '".$get_method['user_id']."'";	 
    	}else{
    		$user_edit= "UPDATE tbl_users SET name='".$get_method['name']."',email='".$get_method['email']."',phone='".$get_method['phone']."' WHERE id = '".$get_method['user_id']."'";	 
    	}
       	$user_res = mysqli_query($mysqli,$user_edit);
     	 
    	$set['nemosofts'][]=array('msg'=>$app_lang['update_success'],'success'=>'1');
    
      	header( 'Content-Type: application/json; charset=utf-8' );
        echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    	die();
    }
    else if($get_method['method_name']=="app_details"){
		if(file_exists($filename_data)){
			$jsonObj= array();	
			$query="SELECT * FROM tbl_settings WHERE id='1'";
			$sql = mysqli_query($mysqli,$query);
			while($data = mysqli_fetch_assoc($sql)){
				$row['publisher_id'] = $data['publisher_id'];
				$row['interstital_ad'] = $data['interstital_ad'];
				$row['interstital_ad_id'] = $data['interstital_ad_id'];
				$row['interstital_ad_click'] = $data['interstital_ad_click'];
				$row['banner_ad'] = $data['banner_ad'];
				$row['banner_ad_id'] = $data['banner_ad_id'];
				$row['facebook_interstital_ad'] = $data['facebook_interstital_ad'];
				$row['facebook_interstital_ad_id'] = $data['facebook_interstital_ad_id'];
				$row['facebook_interstital_ad_click'] = $data['facebook_interstital_ad_click'];		
				$row['facebook_banner_ad'] = $data['facebook_banner_ad'];
				$row['facebook_banner_ad_id'] = $data['facebook_banner_ad_id'];
				$row['facebook_native_ad'] = $data['facebook_native_ad'];
				$row['facebook_native_ad_id'] = $data['facebook_native_ad_id'];
				$row['facebook_native_ad_click'] = $data['facebook_native_ad_click'];		
				$row['admob_nathive_ad'] = $data['admob_nathive_ad'];
				$row['admob_native_ad_id'] = $data['admob_native_ad_id'];
				$row['admob_native_ad_click'] = $data['admob_native_ad_click'];
				$row['company'] = $data['company'];
				$row['email'] = $data['email'];
				$row['website'] = $data['website'];
				$row['contact'] = $data['contact'];
				$row['purchase_code'] = $data['purchase_code'];
				$row['nemosofts_key'] = $data['nemosofts_key'];
				$row['in_app'] = $data['in_app'];
				$row['subscription_id'] = $data['subscription_id'];
				$row['merchant_key'] = $data['merchant_key'];
				$row['subscription_days'] = $data['subscription_days'];
				array_push($jsonObj,$row);
			}
		}
    	$set['nemosofts'] = $jsonObj;
    	header( 'Content-Type: application/json; charset=utf-8' );
        echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    	die();	
    }	
    else
    {
       $get_method = checkSignSalt($_POST['data']);
    }

?>