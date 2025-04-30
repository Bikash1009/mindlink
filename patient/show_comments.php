
<?php
include_once("../connection.php");
$commentQuery = "SELECT id, parent_id, comment, sender, date FROM comment WHERE parent_id = '0' ORDER BY id DESC";
$commentsResult = mysqli_query($database, $commentQuery) or die("database error:". mysqli_error($database));
$commentHTML = '';
while($comment = mysqli_fetch_assoc($commentsResult)){
	$commentHTML .= '
		<div class="panel panel-primary">
		<div class="panel-heading">By <b>'.$comment["sender"].'</b> on <i>'.$comment["date"].'</i></div>
		<div class="panel-body">'.$comment["comment"].'</div>
		<div class="panel-footer" align="right"><button type="button" class="btn btn-primary reply" id="'.$comment["id"].'">Reply</button></div>
		</div> ';
	$commentHTML .= getCommentReply($database, $comment["id"]);
}
echo $commentHTML;

function getCommentReply($database, $parentId = 0, $marginLeft = 0) {
	$commentHTML = '';
	$commentQuery = "SELECT id, parent_id, comment, sender, date FROM comment WHERE parent_id = '".$parentId."'";	
	$commentsResult = mysqli_query($database, $commentQuery);
	$commentsCount = mysqli_num_rows($commentsResult);
	if($parentId == 0) {
		$marginLeft = 0;
	} else {
		$marginLeft = $marginLeft + 48;
	}
	if($commentsCount > 0) {
		while($comment = mysqli_fetch_assoc($commentsResult)){  
			$commentHTML .= '
				<div class="panel panel-primary" style="margin-left:'.$marginLeft.'px">
				<div class="panel-heading">By <b>'.$comment["sender"].'</b> on <i>'.$comment["date"].'</i></div>
				<div class="panel-body">'.$comment["comment"].'</div>
				<div class="panel-footer" align="right"><button type="button" class="btn btn-primary reply" id="'.$comment["id"].'">Reply</button></div>
				</div>
				';
			$commentHTML .= getCommentReply($database, $comment["id"], $marginLeft);
		}
	}
	return $commentHTML;
}
?>

<style>
.panel {
 border-radius: 10px;
 margin-bottom: 20px;
}

.panel-heading {
    font-size: 14px;
   padding: 10px;
    color: white;
}

.panel-primary {
    background-color: white;
    border-color: ;
    color: black;
    padding: 15px;
}

.panel-footer {
    background-color: transparent;
}

.reply {
    padding: 5px 10px;
    background-color: #3074AE;
    font-size: 14px;
    border-radius: 5px;
    transition: all 0.2s ease-in-out;
    margin-left: 10px;
}

.reply:hover {
    background-color: #3074AE;
    color: #fff;
    cursor: pointer;
}
</style>