<?php
require_once("classes/crud.php");
$array_tag=[];
	
function getQuery($cat_slug=false,$post_slug=false)
{

	global $crud;
	$where = array();

	if(isset($cat_slug) && $cat_slug != '')
	{
		 $where[]="category.cat_slug='$cat_slug'";
	}

	if(isset($post_slug) && $post_slug != '')
	{
		 $where[]="posts.slug='$post_slug'";
	}
	
	if(count($where) > 0)
	{
		$whereStr =' WHERE '.implode(" AND ", $where);

	}
	$sql="SELECT posts.*,category.title as category_title FROM posts INNER JOIN category ON posts.category = category.id ". $whereStr ." ORDER BY posts.id desc";
	return $sql;
}
function getPosts($query,$starting_position,$records_per_page)
{
	global $crud;
	$sql=$query." LIMIT $starting_position,$records_per_page";
	//echo $sql;
	if($crud->numRows($sql) > 0)
	{
		$rows=$crud->read($sql);
		$response = ['status'=> 202, 'result'=> $rows];
	}
	else
	{
		$response = ['status'=> 303, 'result'=> 'No Post found!'];
	}
	return $response;
                  
}

function getCategory()
{
	global $crud;
	$sql="SELECT category.title,category.cat_slug,count(posts.category) as count_cat FROM category LEFT JOIN posts ON category.id = posts.category GROUP BY category.id";
	$rows_cat=$crud->read($sql);
   	return $rows_cat;
}

function paginglink($url,$query,$records_per_page,$page_no=false)
{

	global $crud;

	$total_no_of_records = $crud->numRows($query);

	if($total_no_of_records > 0)
	{
	    echo '<div class="pagination flex-row">';
	    $total_no_of_pages=ceil($total_no_of_records/$records_per_page);
	    $current_page=1;
	    if(isset($page_no) && $page_no != '')
	    {
	       $current_page=$page_no;
	    }
	    if($current_page!=1)
	    {
	       $previous =$current_page-1;
	       //echo "<a href='/techblog/1'>First</a>&nbsp;&nbsp;";
	       echo "<a href='".$url."page/".$previous."'><i class='fas fa-chevron-left'></i></a>";
	       //<a href="#"><i class="fas fa-chevron-left"></i></a>
	    }
	    for($i=1;$i<=$total_no_of_pages;$i++)
	    {
	        if($i==$current_page)
	        {
	            echo "<a href='".$url."page/".$i."' class='pages'>".$i."</a>";
	        }
	        else
	        {
	            echo "<a href='".$url."page/".$i."' class='pages'>".$i."</a>";
	            //<a href="#" class="pages">3</a>
	        }
		}
	   if($current_page!=$total_no_of_pages)
	   {
	        $next=$current_page+1;
	        echo "<a href='".$url."page/".$next."'><i class='fas fa-chevron-right'></i></a>";
	        //echo '<a href="#"><i class="fas fa-chevron-right"></i></a>';
	        //echo "<a href='/techblog/".$total_no_of_pages."'>Last</a>&nbsp;&nbsp;";
	   }
		echo '</div>';
	}
}

function getTags()
{
	global $crud;
	global $array_tag;
	$tag=[];
	$duplicate = 0;
	$sql="SELECT tags FROM posts";
	$rows_tags=$crud->read($sql);
	
	foreach ($rows_tags as $tags) {
		
		$tag=explode(',', $tags['tags']);
		for($i = 0;$i<count($tag); $i++)
		{
			if(count($array_tag) > 0)
			{
				for($j = 0 ; $j < count($array_tag) ; $j++)
				{
					if($array_tag[$j] === $tag[$i])
					{
						$duplicate = 1;
						break;
					}
					else
					{
						$duplicate = 0;
					}
					if($duplicate == 0)
					{
						array_push($array_tag, $tag[$i]);
					}
				}
			}

			if(count($array_tag) == 0)
			{
				array_push($array_tag, $tag[$i]);
			}
			$array_tag = array_unique($array_tag);
		}
		
	}
	return $array_tag;
}

?>