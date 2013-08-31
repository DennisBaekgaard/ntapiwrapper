<?php
/**
* NT API WRAPPER
* Created By: Dennis Bækgaard @ Tquila Nordic-T.me
* Date: 30/08 - 2013
* Class: Post
* Description: This class contains all information related to one specific post.
* 
* Note: get/set policy. Due to the lacking support of getters and setters in the current versions of PHP, I have decided to use 
* setX for setters and only X (capitalised first letter as per normal properties). It's easier to read when you use the code, so:
* $somePost->PostId() rather than $somePost->getPostId(); and $somePost->setText("something"); for setters.
*/
require_once("user.php");
class Post
{
	/**
	* FIELDS
	*/
	
	//STRICTLY INTS
	private $postId;
	private $postingAppId;
	private $topicId;
	private $forumId;
	private $likes;
	private $editBy;
	private $added;
	private $lastEdit;
	
	//strings
	private $topicTitle;
	private $text;
	
	
	private $user; //user model
	
	/**
	* The wrapper for a post requires that all received information from the API must be present in a post as well.
	*/
	public function __construct($post_id, $post_text, $post_app_id, $topic_id, $topic_title, $added_time, $forum_id, $edit_time, $likes, $edit_by, User $user_ent)
	{
		
		$this->setPostId($post_id);
		$this->setText($post_text);
		$this->setPostingAppId($post_app_id);
		$this->setTopicId($topic_id);
		$this->setTopicTitle($topic_title);
		$this->setAddedTime($added_time);
		$this->setForumId($forum_id);
		$this->setEditTime($edit_time);
		$this->setLikes($likes);
		$this->setUser($user_ent);
	}
	
	
	/**
	* Properties
	*/
	
	public function PostId()
	{
		return $this->postId;
	}
	
	public function setPostId($val)
	{
		if(is_int($val))
			$this->postId = $val;
		else
			throw new Exception ("PostId has to be of integer value");
	}
	
	public function Text()
	{
		return $this->text;
	}
	
	public function setText($val)
	{
		$this->text = $val;
	}
	
	public function PostingAppId()
	{
		return $this->postingAppId;
	}
	
	public function setPostingAppId($val)
	{
		if(is_int($val))
			$this->postingAppId = $val; 
		else
			throw new Exception ("PostingAppId has to be of integer value");
	}
	
	public function TopicId()
	{
		return $this->topicId;
	}
	
	public function setTopicId($val)
	{
		if(is_int($val))
			$this->topicId = $val;
		else
			throw new Exception ("TopicId has to be of integer value");
	}
	
	public function TopicTitle()
	{
		return $this->topicTitle;
	}
	
	public function setTopicTitle($val)
	{
		$this->topicTitle = $val;
	}
	
	public function AddedTime()
	{
		return $this->added;
	}
	
	//Note: this is in fact a float value, however, there's no precision needed so it's ok to store as int for now.
	public function setAddedTime($val)
	{
		if(is_float($val) || is_int($val))
			$this->added = $val;
		else
			throw new Exception ("AddedTime has to be of float value");
	}
	
	public function ForumId()
	{
		return $this->forumId;
	}
	
	public function setForumId($val)
	{
		if(is_int($val))
			$this->forumId = $val;
		else
			throw new Exception ("ForumId has to be of integer value");
	}
	
	public function EditTime()
	{
		return $this->lastEdit;
	}
	
	public function setEditTime($val)
	{
		if(is_float($val) || is_int($val))
			$this->lastEdit = $val;
		else
			throw new Exception ("EditTime has to be of float value");
	}
	
	public function Likes()
	{
		return $this->likes;
	}
	
	public function setLikes($val)
	{
		if(is_int($val))
			$this->likes = $val;
		else
			throw new Exception ("Likes has to be of integer value");
	}
	
	public function User()
	{
		return $this->user;
	}
	
	public function setUser($val)
	{
		$this->user = $val;
	}
	
}

?>