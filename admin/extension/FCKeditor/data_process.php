<?php
###################################################################################################################
# Project Name:  Auction CMS
# Program Name : data_process.php
# Purpose: This file is used for data processing 
# Created Date: 12-March-2005      
###################################################################################################################

# 	include required files.
//include_once("logout.php");
include_once("./../siteconfig/config_include.php");

/*echo "<pre>";
print_r($_POST);
echo "</pre>";*/

//exit;


#   Get Process	
if($process=='') 
{
	if(trim($_POST["process"]==''))
		$process = trim($_GET["process"]);
	else 
		$process = trim($_POST["process"]);
}

$process = strtolower($process);

//echo $process;
//exit;

switch($process)
{

#	Config values Module ------------------------------------------------
	case "configvalues_add":
		include_once("configurations/configvalues.php");
		if(AddConfigvalues())
			header("Location: main.php?process=$process"."msg");
	break;


	case "configvalues_edit":
		include_once("configurations/configvalues.php");
		if(EditConfigvalues())
			header("Location: main.php?process=$process"."msg");
	break;

	
	case "configvalues_delete":
		include_once("configurations/configvalues.php");
		if(DeleteConfigvalues())
			header("Location: main.php?process=$process"."msg");
	break;



#	Config type Module ------------------------------------------------
	case "configtype_add":
		include_once("configurations/configtype.php");
		if(AddConfigtype())
			header("Location: main.php?process=$process"."msg");
	break;


	case "configtype_edit":
		include_once("configurations/configtype.php");
		if(EditConfigtype())
			header("Location: main.php?process=$process"."msg");
	break;


	case "configtype_delete":
		include_once("configurations/configtype.php");
		if(DeleteConfigtype())
			header("Location: main.php?process=$process"."msg");
	break;



#	User Module ------------------------------------------------

	case "user_add":
		include_once("users/user.php");
		if(AddUser())
			header("Location: main.php?process=$process"."msg");
	break;


	case "user_edit":
		include_once("users/user.php");
		if(EditUser())
			header("Location: main.php?process=$process"."msg");
	break;

	case "user_delete":
		include_once("users/user.php");
		if(DeleteUser())
			header("Location: main.php?process=$process"."msg");
	break;


#	News Module ------------------------------------------------

	case "add_newsaddcattype":
		include_once("news/news.php");
		if(AddNewsCat())
			header("Location: main.php?process=$process"."msg");
	break;


	case "user_edit":
		include_once("users/user.php");
		if(EditUser())
			header("Location: main.php?process=$process"."msg");
	break;

	case "user_delete":
		include_once("users/user.php");
		if(DeleteUser())
			header("Location: main.php?process=$process"."msg");
	break;





#	Level Module ------------------------------------------------
	case "level_add":
		include_once("levels/level.php");
		if(AddLevel())
			header("Location: main.php?process=$process"."msg");
	break;


	case "level_edit":
		include_once("levels/level.php");
		if(EditLevel())
			header("Location: main.php?process=$process"."msg");
	break;


	case "level_delete":
		include_once("levels/level.php");
		if(DeleteLevel())
			header("Location: main.php?process=$process"."msg");
	break;


#	Department Module ------------------------------------------------

	case "department_add":
		include_once("departments/department.php");
		if(AddDepartment())
			header("Location: main.php?process=$process"."msg");
	break;


	case "department_edit":
		include_once("departments/department.php");
		if(EditDepartment())
			header("Location: main.php?process=$process"."msg");
	break;

	case "department_delete":
		include_once("departments/department.php");
		if(DeleteDepartment())
			header("Location: main.php?process=$process"."msg");
	break;


#	Reg Users Module ------------------------------------------------

	case "regusers_add":
		include_once("regusers/reguser.php");
		if(AddUser())
			header("Location: main.php?process=$process"."msg");
	break;


	case "regusers_edit":
		include_once("regusers/reguser.php");
		if(EditUser())
			header("Location: main.php?process=$process"."msg");
	break;

	case "regusers_delete":
		include_once("regusers/reguser.php");
		if(DeleteUser())
			header("Location: main.php?process=$process"."msg");
	break;



#	Category Module ------------------------------------------------
	case "logincmsegories_add":
		include_once("logincmsegories/category.php");
		if(AddCategory())
			header("Location: main.php?process=$process"."msg");
	break;

	case "logincmsegories_edit":
		include_once("logincmsegories/category.php");
		if(EditCategory())
			header("Location: main.php?process=$process"."msg");
	break;

	case "logincmsegories_delete":
		include_once("logincmsegories/category.php");
		if(DeleteCategory())
			header("Location: main.php?process=$process"."msg");
	break;

	case "category_add_user":
		include_once("logincmsegories/category.php");
		if(AddCategoryUser())
			header("Location: main.php?process=$process"."msg");
	break;


	case "category_edit_permission":
		include_once("logincmsegories/category.php");
		if(EditCategoryUser())
			header("Location: main.php?process=$process"."msg");
	break;

	case "category_user_delete":
		include_once("logincmsegories/category.php");
		if(DeleteCategoryUser())
			header("Location: main.php?process=$process"."msg");
	break;


	case "logincmsegories_uprank":
		include_once("logincmsegories/category.php");
		if(UpRank())
			header("Location: main.php?process=$process"."msg");
	break;

	case "logincmsegories_downrank":
		include_once("logincmsegories/category.php");
		if(DownRank())
			header("Location: main.php?process=$process"."msg");
	break;

	case "logincmsegories_subcategory_add":
		include_once("logincmsegories/category.php");
		if(AddSubcategory())
			header("Location: main.php?process=$process"."msg");
	break;

#	Category Type Module ------------------------------------------------
	case "categorytype_add":
		include_once("logincmsegories/categorytype.php");
		if(AddCategorytype())
			header("Location: main.php?process=$process"."msg");
	break;

	case "categorytype_edit":
		include_once("logincmsegories/categorytype.php");
		if(EditCategorytype())
			header("Location: main.php?process=$process"."msg");
	break;

	case "categorytype_delete":
		include_once("logincmsegories/categorytype.php");
		if(DeleteCategorytype())
			header("Location: main.php?process=$process"."msg");
	break;


#	News Module ------------------------------------------------
	case "news_add":
		include_once("news/news.php");
		if(AddNews())
			header("Location: main.php?process=$process"."msg");
	break;

	case "news_edit":
		include_once("news/news.php");
		if(EditNews())
			header("Location: main.php?process=$process"."msg");
	break;

	case "news_delete":
		include_once("news/news.php");
		if(DeleteNews())
			header("Location: main.php?process=$process"."msg");
	break;

	case "news_archive":
		include_once("news/news.php");
		if(ArchiveNews())
			header("Location: main.php?process=$process"."msg");
	break;

	case "news_unarchive":
		include_once("news/news.php");
		if(UnarchiveNews())
			header("Location: main.php?process=$process"."msg");
	break;


	case "news_archive_delete":
		include_once("news/news.php");
		if(DeleteArchiveNews())
			header("Location: main.php?process=$process"."msg");
	break;


#	News Type Module ------------------------------------------------
	case "newstype_add":
		include_once("news/newstype.php");
		if(AddNewstype())
			header("Location: main.php?process=$process"."msg");
	break;

	case "newstype_edit":
		include_once("news/newstype.php");
		if(EditNewstype())
			header("Location: main.php?process=$process"."msg");
	break;

	case "newstype_delete":
		include_once("news/newstype.php");
		if(DeleteNewstype())
			header("Location: main.php?process=$process"."msg");
	break;


#	Article Module ------------------------------------------------
	case "article_add":
		include_once("articles/article.php");
		if(AddArticle())
			header("Location: main.php?process=$process"."msg");
	break;

	case "article_edit":
		include_once("articles/article.php");
		if(EditArticle())
			header("Location: main.php?process=$process"."msg");
	break;


	case "article_delete":
		include_once("articles/article.php");
		if(DeleteArticle())
			header("Location: main.php?process=$process"."msg");
	break;


#	Static Article Module ------------------------------------------------
	case "staticarticle_add":
		include_once("articles/staticarticle.php");
		if(AddStaticArticle())
			header("Location: main.php?process=$process"."msg");
	break;

	case "staticarticle_edit":
		include_once("articles/staticarticle.php");
		if(EditStaticArticle())
			header("Location: main.php?process=$process"."msg");
	break;


	case "staticarticle_delete":
		include_once("articles/staticarticle.php");
		if(DeleteStaticArticle())
			header("Location: main.php?process=$process"."msg");
	break;


#	Fixture Module ------------------------------------------------

	case "fixture_add":
		include_once("fixtures/fixture.php");
		if(AddFixture())
			header("Location: main.php?process=$process"."msg");
	break;

	case "fixture_edit":
		include_once("fixtures/fixture.php");	
		if(EditFixture())
			header("Location: main.php?process=$process"."msg");
	break;

	case "fixture_delete":
		include_once("fixtures/fixture.php");
		if(DeleteFixture())
			header("Location: main.php?process=$process"."msg");
	break;

	case "fixture_addgallery":
		include_once("fixtures/fixture.php");
		if(AddFixtureGallery())
			header("Location: main.php?process=$process"."msg&fixture_id=$_POST[fixture_id]");
	break;

	case "fixture_editgallery":
		include_once("fixtures/fixture.php");
		if(editFixtureGallery())
			header("Location: main.php?process=$process"."msg&fixture_id=$_POST[fixture_id]");
	break;

	case "fixture_deletegallery":
		include_once("fixtures/fixture.php");
		if(deleteFixtureGallery())
			header("Location: main.php?process=$process"."msg&fixture_id=$_POST[fixture_id]");
	break;



#	Fixture Type Module ------------------------------------------------
	case "fixturetype_add":
		include_once("fixtures/fixturetype.php");
		if(AddFixturetype())
			header("Location: main.php?process=$process"."msg");
	break;

	case "fixturetype_edit":
		include_once("fixtures/fixturetype.php");
		if(EditFixturetype())
			header("Location: main.php?process=$process"."msg");
	break;

	case "fixturetype_delete":
		include_once("fixtures/fixturetype.php");
		if(DeleteFixturetype())
			header("Location: main.php?process=$process"."msg");
	break;

#	Team Crests Module ------------------------------------------------

	case "teamcrests_add":
		include_once("fixtures/teamcrests.php");
		if(AddTeamCrests())
			header("Location: main.php?process=$process"."msg");
	break;

	case "teamcrests_edit":
		include_once("fixtures/teamcrests.php");
		if(EditTeamCrests())
			header("Location: main.php?process=$process"."msg");
	break;

	case "teamcrests_delete":
		include_once("fixtures/teamcrests.php");
		if(DeleteTeamCrests())
			header("Location: main.php?process=$process"."msg");
	break;

#	Download Module ------------------------------------------------
	case "download_add":
		include_once("downloads/download.php");
		if(AddDownload())
			header("Location: main.php?process=$process"."msg");
	break;

	case "download_edit":
		include_once("downloads/download.php");
		if(EditDownload())
			header("Location: main.php?process=$process"."msg");
	break;

	case "download_delete":
		include_once("downloads/download.php");
		if(DeleteDownload())
			header("Location: main.php?process=$process"."msg");
	break;

	#	Download Type Module ------------------------------------------------
	case "downloadtype_add":
		include_once("downloads/downloadtype.php");
		if(AddDownloadtype())
			header("Location: main.php?process=$process"."msg");
	break;

	case "downloadtype_edit":
		include_once("downloads/downloadtype.php");
		if(EditDownloadtype())
			header("Location: main.php?process=$process"."msg");
	break;

	case "downloadtype_delete":
		include_once("downloads/downloadtype.php");
		if(DeleteDownloadtype())
			header("Location: main.php?process=$process"."msg");
	break;

#	Banner Module ------------------------------------------------
	case "banner_add":
		include_once("banners/banner.php");
		if(AddBanner())
			header("Location: main.php?process=$process"."msg");
	break;

	case "banner_edit":
		include_once("banners/banner.php");
		if(EditBanner())
			header("Location: main.php?process=$process"."msg");
	break;

	case "banner_delete":
		include_once("banners/banner.php");
		if(DeleteBanner())
			header("Location: main.php?process=$process"."msg");
	break;

#	Team Profile Module ------------------------------------------------
	case "teamprofile_add":
		include_once("teamprofile/teamprofile.php");
		if(AddTeamprofile())
			header("Location: main.php?process=$process"."msg");
	break;

	case "teamprofile_edit":
		include_once("teamprofile/teamprofile.php");
		if(EditTeamprofile())
			header("Location: main.php?process=$process"."msg");
	break;

	case "teamprofile_delete":
		include_once("teamprofile/teamprofile.php");
		if(DeleteTeamprofile())
			header("Location: main.php?process=$process"."msg");
	break;

#	Player Type Module -----------------------------------------
	case "playertype_add":
		include_once("teamprofile/playertype.php");
		if(AddPlayertype())
			header("Location: main.php?process=$process"."msg");
	break;

	case "playertype_edit":
		include_once("teamprofile/playertype.php");
		if(EditPlayertype())
			header("Location: main.php?process=$process"."msg");
	break;

	case "playertype_delete":
		include_once("teamprofile/playertype.php");
		if(DeletePlayertype())
			header("Location: main.php?process=$process"."msg");
	break;

#	Asset Module ------------------------------------------------

	case "asset_add":
		include_once("images/images.php");
		if(images_addDB())
			header("Location: main.php?process=$process"."msg&category=$_POST[category]&catid=$_POST[catid]&type=$_POST[type]");
	break;

	case "asset_edit":
		include_once("images/images.php");
		if(images_editDB())
			header("Location: main.php?process=$process"."msg&category=$_POST[category]&catid=$_POST[catid]&type=$_POST[type]");
	break;

	case "asset_delete":
		include_once("images/images.php");
		if(images_delete())
			header("Location: main.php?process=$process"."msg&category=$_POST[category]&catid=$_POST[catid]&type=$_POST[type]");
	break;

#	Asset Category Module ------------------------------------------------

	case "assetcategory_add":
		include_once("images/imagescategory.php");
		if(imagecategory_addDB())
		{
			header("Location: main.php?process=$process"."msg");
		}
	break;

	case "assetcategory_edit":
		include_once("images/imagescategory.php");
		if(imagecategory_editDB())
			header("Location: main.php?process=$process"."msg");
	break;

	case "assetcategory_delete":
		include_once("images/imagescategory.php");
		if(imagecategory_delete())
			header("Location: main.php?process=$process"."msg");
	break;

	#	Venue Module ------------------------------------------------
	case "venue_add":
		include_once("venue/venue.php");
		if(AddVenue())
			header("Location: main.php?process=$process"."msg");
	break;


	case "venue_edit":
		include_once("venue/venue.php");
		if(EditVenue())
			header("Location: main.php?process=$process"."msg");
	break;


	case "venue_delete":
		include_once("venue/venue.php");
		if(DeleteVenue())
			header("Location: main.php?process=$process"."msg");
	break;

	#	Product Module ------------------------------------------------
	case "productshop_add":
		include_once("store/product/product.php");
		if(AddProduct())
			header("Location: main.php?process=$process"."msg");
	break;
	
	
	case "productshop_edit":
		include_once("store/product/product.php");
		if(EditProduct())
			header("Location: main.php?process=$process"."msg");
	break;

	
	case "productshop_delete":
		include_once("store/product/product.php");
		if(DeleteProduct())
			header("Location: main.php?process=$process"."msg");
	break;

	#	Variation Module ------------------------------------------------
	case "variation_add":
		include_once("store/product/variation.php");
		if(AddVariation())
			header("Location: main.php?process=$process"."msg");
	break;


	case "variation_edit":
		include_once("store/product/variation.php");
		if(EditVariation())
			header("Location: main.php?process=$process"."msg");
	break;


	case "variation_delete":
		include_once("store/product/variation.php");
		if(DeleteVariation())
			header("Location: main.php?process=$process"."msg");
	break;

	#	Membership Module ------------------------------------------------
	case "membership_add":
		include_once("store/membership/membership.php");
		if(AddMembership())
			header("Location: main.php?process=$process"."msg");
	break;


	case "membership_edit":
		include_once("store/membership/membership.php");
		if(EditMembership())
			header("Location: main.php?process=$process"."msg");
	break;


	case "membership_delete":
		include_once("store/membership/membership.php");
		if(DeleteMembership())
			header("Location: main.php?process=$process"."msg");
	break;


	case "membershippatron_add":
		include_once("store/membership/membershippatron.php");
		if(AddMembership())
			header("Location: main.php?process=$process"."msg");
	break;


	case "membershippatron_edit":
		include_once("store/membership/membershippatron.php");
		if(EditMembership())
			header("Location: main.php?process=$process"."msg");
	break;


	case "membershippatron_delete":
		include_once("store/membership/membershippatron.php");
		if(DeleteMembership())
			header("Location: main.php?process=$process"."msg");
	break;

	#	Members Module ------------------------------------------------
	case "membershop_add":
		include_once("store/members/member.php");
		if(AddMember())
			header("Location: main.php?process=$process"."msg");
	break;
	
	
	case "membershop_edit":
		include_once("store/members/member.php");
		if(EditMember())
			header("Location: main.php?process=$process"."msg");
	break;


	case "membershop_delete":
		include_once("store/members/member.php");
		if(DeleteMember())
			header("Location: main.php?process=$process"."msg");
	break;

	
	case "membertypeshop_typeadd":
		include_once("store/members/membertype.php");
		if(AddMembertype())
			header("Location: main.php?process=$process"."msg");
	break;


	case "membertypeshop_edit":
		include_once("store/members/membertype.php");
		if(EditMembertype())
			header("Location: main.php?process=$process"."msg");
	break;


	case "membertypeshop_delete":
		include_once("store/members/membertype.php");
		if(DeleteMembertype())
			header("Location: main.php?process=$process"."msg");
	break;

	#	User Type Module ------------------------------------------------
	case "usertype_add":
		include_once("store/usertype/usertype.php");
		if(AddUserType())
			header("Location: main.php?process=$process"."msg");
	break;


	case "usertype_edit":
		include_once("store/usertype/usertype.php");
		if(EditUserType())
			header("Location: main.php?process=$process"."msg");
	break;


	case "usertype_delete":
		include_once("store/usertype/usertype.php");
		if(DeleteUserType())
			header("Location: main.php?process=$process"."msg");
	break;

	#	Message Module ------------------------------------------------
	case "messages_add":
		include_once("store/messages/messageemail.php");
		if(AddMessage())
			header("Location: main.php?process=$process"."msg");
	break;

	
	case "messages_edit":
		include_once("store/messages/messageemail.php");
		if(EditMessage())
			header("Location: main.php?process=$process"."msg");
	break;


	case "messages_delete":
		include_once("store/messages/messageemail.php");
		if(DeleteMessage())
			header("Location: main.php?process=$process"."msg");
	break;


	case "messagetype_add":
		include_once("store/messages/messagetype.php");
		if(AddMessageType())
			header("Location: main.php?process=$process"."msg");
	break;

	
	case "messagetype_edit":
		include_once("store/messages/messagetype.php");
		if(EditMessageType())
			header("Location: main.php?process=$process"."msg");
	break;


	case "messagetype_delete":
		include_once("store/messages/messagetype.php");
		if(DeleteMessageType())
			header("Location: main.php?process=$process"."msg");
	break;

	#	Shipping Module ------------------------------------------------
	case "shippingshop_add":
		include_once("store/shipping/shipping.php");
		if(AddShipping())
			header("Location: main.php?process=$process"."msg");
	break;


	case "shippingshop_edit":
		include_once("store/shipping/shipping.php");
		if(EditShipping())
			header("Location: main.php?process=$process"."msg");
	break;


	case "shippingshop_delete":
		include_once("store/shipping/shipping.php");
		if(DeleteShipping())
			header("Location: main.php?process=$process"."msg");
	break;

	#	Country Module ------------------------------------------------
	case "countryshop_add":
		include_once("store/shipping/country.php");
		if(AddCountry())
			header("Location: main.php?process=$process"."msg");
	break;


	case "countryshop_edit":
		include_once("store/shipping/country.php");
		if(EditCountry())
			header("Location: main.php?process=$process"."msg");
	break;


	case "countryshop_delete":
		include_once("store/shipping/country.php");
		if(DeleteCountry())
			header("Location: main.php?process=$process"."msg");
	break;

	#	Order Module ------------------------------------------------
	case "ordershop_status":
		include_once("store/orderadmin/order.php");
		
		if(ChangeStatus())
			header("Location: main.php?process=$process"."msg");
	break;

	case "ordershoparchive_status":
		include_once("store/orderadmin/order.php");
		
		if(ChangeStatus())
			header("Location: main.php?process=$process"."msg");
	break;

	
	case "ordershopnew_delete":
		include_once("store/orderadmin/order.php");		
		if(OrderDelete())
			header("Location: main.php?process=$process"."msg");
	break;

	
	case "ordershop_delete":
		include_once("store/orderadmin/order.php");		
		if(OrderDelete())
			header("Location: main.php?process=$process"."msg");
	break;

	
	case "ordershopmanual_add":
		include_once("store/orderadmin/cart.php");
		if(AddCartManual())
			header("Location: main.php?process=$process"."msg");
	break;


	case "delete_item":
		include_once("store/orderadmin/cart.php");
		if(DeleteCartManual())
			header("Location: main.php?process=$process"."msg");
	break;


	case "ordermember_add":
		include_once("store/orderadmin/cart.php");
		if(AddMemberManualCart())
			header("Location: main.php?process=$process"."msg");
	break;
	
	
	case "ordershopmanual_delete":
		include_once("store/orderadmin/cart.php");
		if(DeleteCartManual())
			header("Location: main.php?process=$process"."msg");
	break;


	case "ordershopmanual_update":
		include_once("store/orderadmin/cart.php");
		if(UpdateCartManualAll())
			header("Location: main.php?process=$process"."msg");
	break;
	

	case "ordershopmanual_empty":
		include_once("store/orderadmin/cart.php");
		if(EmptyCartManual())
			header("Location: main.php?process=$process"."msg");
	break;


	case "add_ticketitem":
		include_once("store/orderadmin/cart.php");
		if(AddTicketManualCart())
			header("Location: main.php?process=$process"."msg");
	break;

	
	case "orderticketintl_view":
		include_once("store/orderadmin/cart.php");
		if(AddIntlTicketManualCart())
			header("Location: main.php?process=$process"."msg");
	break;


	case "ordershopmanual_checkout":
		include_once("store/orderadmin/cart.php");
		if(AddIntlTicketManualCart())
			header("Location: main.php?process=$process"."msg");
	break;

	case "form_item":
		include_once("store/orderadmin/cart.php");
		if(AddFormManualItem())
			header("Location: main.php?process=$process"."msg");
	break;

	

}

?>