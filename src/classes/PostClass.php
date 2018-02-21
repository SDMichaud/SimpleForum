<?php
// Class that holds functions relating to handling posts
class PostClass
{
    public static function createPostDivHTML($post_data_array) : string
    {
	$photo = $post_data_array['photo'];
	$id = $post_data_array['id'];
	$author = $post_data_array['author'];
	$subject = $post_data_array['subject'];
	$updated = $post_data_array['updated'];
	$content = $post_data_array['content'];
	
	$html_res = "<div style='border: 2px solid black; margin: 10px 0px;'>" .
		    "<img src=/uploads/" . $photo . " width='128px'>" .
		    "#" . $id . "<br>" .
		    $author . " " . $subject . " Posted: " . $updated . "<br>" .
		    $content . "<br>" .
		    "<a href='/reply/" . $id . "'>Reply</a>" .
		    "</div>";

	return $html_res;
    }
}
?>
