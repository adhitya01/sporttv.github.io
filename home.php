<?php include("includes/header.php");

$qry_live="SELECT COUNT(*) as num FROM tbl_live";
$total_video= mysqli_fetch_array(mysqli_query($mysqli,$qry_live));
$total_video = $total_video['num'];

$qry_dwn="SELECT SUM(total_views) as num FROM tbl_live";
$total_views= mysqli_fetch_array(mysqli_query($mysqli,$qry_dwn));
$total_views = $total_views['num'];

$qry_cat="SELECT COUNT(*) as num FROM tbl_category";
$total_category= mysqli_fetch_array(mysqli_query($mysqli,$qry_cat));
$total_category = $total_category['num'];

$qry_urs="SELECT COUNT(*) as num FROM tbl_users";
$total_users= mysqli_fetch_array(mysqli_query($mysqli,$qry_urs));
$total_users = $total_users['num'];

$qry_banner="SELECT COUNT(*) as num FROM tbl_banner";
$total_banner = mysqli_fetch_array(mysqli_query($mysqli,$qry_banner));
$total_banner = $total_banner['num'];

?>       


        <div class="btn-floating" id="help-actions">
      <div class="btn-bg"></div>
      
      
    </div>

    <div class="row">
        
        
              <?php  if(DARK!="0"){?>
                      
                    <Style>

.rad-info-box {
    margin-bottom: 16px;
    padding: 20px;
    background: #262626;
    border: 1px solid #252525;
    border-radius: 10px;
}
                    </Style>
                    
                      <?php }else{?>
                      
                      <Style>
 .rad-info-box{
	margin-bottom:16px;
	padding:20px;
	background: #fff;
	border: 1px solid #dadce0;
	border-radius: 10px;
}
                      </Style>
                      
                     
                      <?php }?>     
        
        
        
        <Style>
        
        
        .rad-info-box:hover {
            color: #2196F3;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 5px rgba(0, 0, 0, 0.24);
            border: 1px solid #2196F3;
          }

.rad-info-box i{
	display:block;
	background-clip:padding-box;
	margin-right:15px;
	height:60px;
	width:60px;
	border-radius:100%;
	line-height:60px;
	text-align:center;
	font-size:4.4em;
	position:absolute;	
}

.rad-info-box .value,
.rad-info-box .heading{
	display:block;	
	position:relative;
	color: $text-color;
	text-align:right;
	z-index:10;
}

.rad-info-box .heading{
	font-size:1.2em;
	font-weight:300;
	text-transform:uppercase;
}

.rad-info-box .value{
	font-size:2.1em;
	font-weight:600;
	margin-top:5px;
}

.rad-list-group-item{
	margin:5px 10px 25px 5px;	
	
	&:after{
		content:"";
		display:table;
	}
}
.rad-txt-primary{
	color:#1C7EBB;
}
.rad-bg-primary{
	background:#1C7EBB;
}
.rad-txt-success{
	color:#23AE89;
}
.rad-bg-success{
	background:#23AE89;
}
.rad-txt-danger{
	color:#E94B3B;
}
.rad-bg-danger{
	background:#E94B3B;
}
.rad-txt-warning{
	color:#F98E33;
}
.rad-bg-warning{
	background:#F98E33;
}
.rad-txt-violet{
	color:#6A55C2;
}
.rad-bg-violet{
	background:#6A55C2;
}
.rad-txt-violet{
	color:#6A55C2;
}
.rad-bg-violet{
	background:#6A55C2;
}

.rad-txt-banner{
	color:#ffbc00;
}

.rad-txt-playlist{
	color:#c900b9;
}

.rad-txt-suggestion{
	color:#00b83f;
}

.rad-txt-rating{
	color:#ff006a;
}
.rad-txt-reports{
	color:#8d9293;
}
        
        
        <Style>



        </Style>
        <div class="row">
					<div class="col-lg-3 col-xs-6">
						<div class="rad-info-box my rad-txt-success">
							<i class="icon fa fa-sitemap"></i>
							<span class="heading">Categories</span>
							<span class="value"><span data-purecounter-duration="1.0" data-purecounter-end="<?php echo $total_category;?>"class="purecounter">0</span></span>
						</div>
					</div>
					<div class="col-lg-3 col-xs-6">
						<div class="rad-info-box my rad-txt-primary">
							<i class="fa fa-film"></i>
							<span class="heading">Total TV</span>
							<span class="value"><span data-purecounter-duration="1.0" data-purecounter-end="<?php echo $total_video;?>"class="purecounter">0</span></span>
						</div>
					</div>
					<div class="col-lg-3 my col-xs-6">
						<div class="rad-info-box rad-txt-danger">
							<i class="icon fa fa-eye"></i>
							<span class="heading">Total Views</span>
							<span class="value"><span data-purecounter-duration="1.0" data-purecounter-end="<?php echo $total_views;?>"class="purecounter">0</span></span>
						</div>
					</div>
					<div class="col-lg-3 my col-xs-6">
						<div class="rad-info-box rad-txt-violet">
							<i class="icon fa fa-user-md"></i>
							<span class="heading">Admin</span>
						
							<span class="value"><span>1</span></span>
						</div>
					</div>
						<div class="col-lg-3 my col-xs-6">
						<div class="rad-info-box rad-txt-danger">
							<i class="icon fa fa-users"></i>
							<span class="heading">Users</span>
							<span class="value"><span data-purecounter-duration="1.0" data-purecounter-end="<?php echo $total_users;?>"class="purecounter">0</span></span>
						</div>
					</div>
					
					<div class="col-lg-3 my col-xs-6">
						<div class="rad-info-box my rad-txt-playlist">
							<i class="icon fa fa-sliders"></i>
							<span class="heading">Banners</span>
							<span class="value"><span data-purecounter-duration="1.0" data-purecounter-end="<?php echo $total_banner;?>"class="purecounter">0</span></span>
						
						</div>
					</div>
					
					
				</div>
				
				


       


    </div>

	<script async src="dist/purecounter.js"></script>
<?php include("includes/footer.php");?>       
