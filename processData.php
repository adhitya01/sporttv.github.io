<?php 
	require("includes/connection.php");
	require("includes/function.php");
	require("language/language.php");

	$response=array();

	switch ($_POST['action']) {
		case 'toggle_status':
			$id=$_POST['id'];
			$for_action=$_POST['for_action'];
			$column=$_POST['column'];
			$tbl_id=$_POST['tbl_id'];
			$table_nm=$_POST['table'];

			if($for_action=='active'){
				$data = array($column  =>  '1');
			    $edit_status=Update($table_nm, $data, "WHERE $tbl_id = '$id'");
			}else{
				$data = array($column  =>  '0');
			    $edit_status=Update($table_nm, $data, "WHERE $tbl_id = '$id'");
			}
			
	      	$response['status']=1;
	      	$response['action']=$for_action;
	      	echo json_encode($response);
			break;

		case 'removeData':
			$id=$_POST['id'];
			$tbl_nm=$_POST['tbl_nm'];
			$tbl_id=$_POST['tbl_id'];

			if($tbl_nm=='tbl_users'){
				Delete('tbl_comments','user_id='.$id.'');
				Delete('tbl_song_suggest','user_id='.$id.'');
				Delete('tbl_reports','user_id='.$id.'');
			}

			Delete($tbl_nm,$tbl_id.'='.$id);

			$_SESSION['msg']="12";
	      	$response['status']=1;
	      	echo json_encode($response);
			break;

        case 'multi_delete':

			$ids=implode(",", $_POST['id']);

			if($ids==''){
				$ids=$_POST['id'];
			}

			$tbl_nm=$_POST['tbl_nm'];

			if($tbl_nm=='tbl_banner'){

				$sql="SELECT * FROM $tbl_nm WHERE `bid` IN ($ids)";
				$res=mysqli_query($mysqli, $sql);
				while ($row=mysqli_fetch_assoc($res)){
					if($row['banner_image']!=""){
						unlink('images/'.$row['banner_image']);
						unlink('images/thumbs/'.$row['banner_image']);
					}
				}
				$deleteSql="DELETE FROM $tbl_nm WHERE `bid` IN ($ids)";

				mysqli_query($mysqli, $deleteSql);
			}
			else if($tbl_nm=='tbl_category'){
			    
				$sqlCategory="SELECT * FROM $tbl_nm WHERE `cid` IN ($ids)";
				$res=mysqli_query($mysqli, $sqlCategory);
				while ($row=mysqli_fetch_assoc($res)){
					if($row['category_image']!=""){
						unlink('images/'.$row['category_image']);
					}
				}
				$deleteSql="DELETE FROM $tbl_nm WHERE `cid` IN ($ids)";
				mysqli_query($mysqli, $deleteSql);
			}
			
			else if($tbl_nm=='tbl_live'){
				$sqlCategory="SELECT * FROM $tbl_nm WHERE `id` IN ($ids)";
				$res=mysqli_query($mysqli, $sqlCategory);
				while ($row=mysqli_fetch_assoc($res)){
					if($row['image']!=""){
						unlink('images/'.$row['image']);
					}
				}
				$deleteSql="DELETE FROM $tbl_nm WHERE `id` IN ($ids)";
				mysqli_query($mysqli, $deleteSql);
			}
			
		$_SESSION['msg']="12";
	      	$response['status']=1;
	      	echo json_encode($response);
			break;
		
		default:
			# code...
			break;
	}

?>