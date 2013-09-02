<?php
/**
* NT API WRAPPER
* Created By: Dennis Bækgaard @ Tquila Nordic-T.me
* Date: 30/08 - 2013
* Class: user
* Description: This class holds information about the user. 
* It also holds information with regards to token status, expiration and so forth.
* Further all user-related API specific actions are in this class, such as getting PMs, posts and so on.
* 
* 
* 
* Note: this user class may be of two types.
* 1) The user is using an app, and hence has a token and relations to the API.
* 2) The user is not using an app, and hence has no tokens and relations to the API (e.g. if it's a saved user from a post ID or something like that).
*/
require_once("post.php");
require_once("privatemessage.php");
class User extends NordicT
{
	/**
	* FIELDS
	*/
	
	private $username;
	private $userId;
	
	private $enabled; //bool
	private $joindate; 
	private $isAdultAvater;
	private $warned;
	private $userClass;
	private $avatarURL;
	private $country = array(); // contains an id, country name (string) and flagpicture
	private $showNSWFAvatar;
	private $title;
	private $friends = array(); // array of friends
	private $donor;
	private $likes;
	private $age;
	private $gender;

	
	
	//Fields only used if this user is in fact the one using the API
	private $token;
	private $token_expiration;
	private $token_status;
	
	/**
	* CONSTRUCTOR
	*/
	public function __construct($username, $token = null, $user_id = null, $token_expiration = null, $token_status = null, $is_enabled = null, $join_date = null, $is_adult_avatar = null, 
									$is_warned = null, $user_class = null, $avatar_url = null, $country = null, $show_nswf_avatar = null, $title = null, $friends = array(), $donor = null, $likes = 0, $age = null, $gender = null)
	{
		

		$this->setUsername($username);
		$this->setUserId($user_id);
		$this->setToken($token);
		$this->setTokenExpiration($token_expiration);
		$this->setTokenStatus($token_status);
		$this->setIsEnabled($is_enabled);
		$this->setJoinDate($join_date);
		$this->setIsAvatarAdult($is_adult_avatar);
		$this->setIsWarned($is_warned);
		$this->setUserClass($user_class);
		$this->setAvatarURL($avatar_url);
		$this->setCountry($country);
		$this->setShowNSFWAvatar($show_nswf_avatar);
		$this->setTitle($title);
		$this->setFriends($friends);
		$this->setIsDonor($donor);
		$this->setLikes($likes);
		$this->setAge($age);
		$this->setGender($gender);
		
	}
	
	#region properties
	/**
	* PROPERTIES
	*/
	public function getUsername()
	{
		return $this->username;
	}
	
	public function setUsername($val)
	{
		$this->username = $val;
	}
	
	public function getUserId()
	{
		return $this->userId;
	}
	
	public function setUserId($val)
	{
		/**
		 *  is_null() used throughout because of no overload support in php. This is the least messy way of doing it I could think of.
		 */
		if(is_int($val) || is_null($val))
			$this->userId = $val;
		else
			throw new Exception ("Field user_id has to be of value INT");
	}
	
	public function getToken()
	{
		return $this->token;
	}
	
	public function setToken($val)
	{
		$this->token = $val;
	}
	
	public function getTokenExpiration()
	{
		return $this->token_expiration;
	}
	
	public function setTokenExpiration($val)
	{
		$this->token_expiration = $val;
	}
	
	public function getTokenStatus()
	{
		return $this->token_status;
	}
	
	public function setTokenStatus($val)
	{
		$this->token_status = $val;
	}
	
	public function IsEnabled()
	{
		return $this->enabled;
	}
	
	public function setIsEnabled($val)
	{
		if(is_bool($val) || is_null($val))
			$this->enabled = $val;
		else
			throw new Exception ("Enabled has to be represented by a boolean value");	
	}
	
	public function JoinDate()
	{
		return $this->joindate;
	}
	
	public function setJoinDate($val)
	{
		if(is_float($val) || is_null($val))
			$this->joindate = $val;
		else
			throw new Exception ("JoinDate has to be of type float");
	}
	
	public function IsAvatarAdult()
	{
		return $this->isAdultAvater;
	}
	
	public function setIsAvatarAdult($val)
	{
		if(is_bool($val) || is_null($val))
			$this->isAdultAvater = $val;
		else
			throw new Exception ("IsAvatarAdult as to be a boolean value");
	}
	
	public function IsWarned()
	{
		return $this->warned;
	}
	
	public function setIsWarned($val)
	{
		if(is_bool($val) || is_null($val))
			$this->warned = $val;
		else
			throw new Exception ("IsWarned as to be a boolean value");
	}
	
	public function UserClass()
	{
		return $this->userClass;
	}
	
	public function setUserClass($val)
	{
		$this->userClass = $val;
	}
	
	public function AvatarURL()
	{
		return $this->avatarURL;
	}
	
	public function setAvatarURL($val)
	{
		$this->avatarURL = $val;
	}
	
	public function Country()
	{
		return $this->country;
	}
	
	public function setCountry($val)
	{
		
		if(count($val) < 1)
		{
			$val = null;
		}
		
		if(!is_null($val))
		{
			
			if(is_array($val) && count($val) == 3)
			{
				if(is_int($val['id']) && is_string($val['name']) && is_string($val['flagPic']))
					$this->country = $val;
				else
					throw new Exception ("The array for Country has to be of size 3 and contain int, string, string");
			}
			else
			{
				throw new Exception ("The array for Country has to be of size 3 and contain int, string, string");
			}
		}
		else
		{
			$this->country = array();
		}
	}
	
	public function ShowNSFWAvatar()
	{
		return $this->showNSWFAvatar;
	}
	
	public function setShowNSFWAvatar($val)
	{
		if(is_bool($val) || is_null($val))
			$this->showNSWFAvatar = $val;
		else
			throw new Exception ("ShowNSFWAvatar has to be a boolean value");
	}
	
	public function Title()
	{
		return $this->title;
	}
	
	public function setTitle($val)
	{
		$this->title = $val;
	}
	
	/**
	 * @return array of friends (userIDs)
	 */
	public function Friends()
	{
		return $this->friends;
	}
	
	public function setFriends(array $val)
	{
		$this->friends = $val;
	}
	
	public function IsDonor()
	{
		return $this->donor;
	}
	
	public function setIsDonor($val)
	{
		if(is_bool($val) || is_null($val))
			$this->donor = $val;
		else
			throw new Exception ("Donor has to be a boolean value");	
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
			throw new Exception ("Likes has to be of type int");
	}
	
	public function Age()
	{
		return $this->age;
	}
	
	public function setAge($val)
	{
		if(is_int($val) || is_null($val))
			$this->age = $val;
		else
			throw new Exception ("Age has to be of type int");
	}
	
	public function Gender()
	{
		return $this->gender;
	}
	
	public function setGender($val)
	{
		if(!is_null($val))
		{
			if(strtolower($val) == "male" || strtolower($val) == "female")
				$this->gender = $val;
			else
				throw new Exception ("Gender has to be of type string, and be either male or female");
		}
		else
		{
			$this->gender = $val;
		}
	}
	
	#endregion
	
	/**
	 * @abstract Function restores the entire users information from the API. If you have saved the userinformation to your own database, it is not needed to repopulate it, but
	 * if you just restore a user from token/username this is needed. It can be run autonomously if setting has been set to do so.	 
	 */
	public function populateUserFieldsFromAPI()
	{
		$data = array(
			'token' => $this->token
		);
		$options = array(
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_BINARYTRANSFER => true,
			CURLOPT_FAILONERROR => false,
			CURLOPT_POST => false,
			CURLOPT_URL =>  $this->api_url . 'user/?' . http_build_query($data)
		);

		$result = $this->runCurl($options);	
		
		if($result)
		{
			$data = json_decode($result, true);

			$this->setIsEnabled($data['data']['enabled']);
			$this->setJoinDate($data['data']['joindate']);
			$this->setIsAvatarAdult($data['data']['isAdultAvatar']);
			$this->setIsWarned($data['data']['warned']);
			$this->setUserClass($data['data']['class']);
			$this->setAvatarURL($data['data']['avatar']);
			$this->setCountry($data['data']['country']);
			$this->setShowNSFWAvatar($data['data']['showNswfAvatar']);
			$this->setTitle($data['data']['title']);
			$this->setFriends($data['data']['friends']);
			$this->setIsDonor($data['data']['donor']);
			$this->setLikes($data['data']['likes']);
			$this->setAge($data['data']['age']);		
			$this->setGender($data['data']['gender']);
			
			return true;

		}
		else
		{
			return false;
		}
	}

	
	/**
	 * Function retrieves the latest post by the user logged in.
	 */
	public function getLatestUserPost()
	{
		return $this->getUserPosts(0, 1);
	}
	
	
	/**
	 * function retrieves a finite amount of posts in descending order from the user
	 * @param offset : the offset of which the posts are to be retrieved
	 * @param limit : the amount of posts to retrieve	 
	 * @return an array of type @see post 	 
	 */
	public function getUserPosts($offset = 0, $limit = 1)
	{
		$data = array(
			'token' => $this->token,
			'offset' => $offset,
			'limit' => $limit
		);
		$options = array(
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_BINARYTRANSFER => true,
			CURLOPT_FAILONERROR => false,
			CURLOPT_POST => false,
			CURLOPT_URL =>  $this->api_url . 'user/' . $this->userId . '/posts/?' . http_build_query($data)
		);

		$result = $this->runCurl($options);
		
		if($result)
		{
			$data = json_decode($result, true);
			
			//The array that will be sent back to the user.
			$posts_array = array();
			
			foreach($data['data'] as $post)
			{
				
				$c_post = new Post($post['id'], 
									$post['body'], 
									$post['postingAppId'], 
									$post['topicid'], 
									$post['topictitle'], 
									$post['added'], 
									$post['forumid'], 
									$post['editedat'], 
									$post['likes'], 
									$post['editedby'], 
									new User($post['user']['username'],
												null,
												$post['user']['userId'],
												null,
												null,
												$post['user']['enabled'],
												$post['user']['joindate'],
												$post['user']['isAdultAvatar'],
												$post['user']['warned'],
												$post['user']['class'],
												$post['user']['avatar'],
												$post['user']['country'],
												$post['user']['showNswfAvatar'],/*Spelling mistake not by me :p*/
												$post['user']['title'],
												$post['user']['friends'],
												$post['user']['donor'],
												$post['user']['likes'],
												$post['user']['age'],
												$post['user']['gender'])
				);
				
				array_push($posts_array, $c_post);
				
			}
			
			return $posts_array;
		}
		else
			return false;
		
	}

	/**
	 * @abstract Function retrieves a finite amount of private messages from the user
	 * @param offset : 0 by default, can be anything.
	 * @param limit : 5 by default, can be set to anything
	 * @param folder : the folder which to retrive messages from. 'inbox' by default
	 * @return an array of @see PrivateMessage 	 
	 */
	public function getPrivateMessages($offset = 0, $limit = 5, $folder = 'inbox')
	{
		$data = array(
			'token' => $this->token,
			'offset' => $offset,
			'limit' => $limit
		);
		
		$options = array(
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_BINARYTRANSFER => true,
			CURLOPT_FAILONERROR => false,
			CURLOPT_POST => false,
			CURLOPT_URL =>  $this->api_url . 'privatemessages/'. $folder . '?' . http_build_query($data)
		);
		
		
		$result = $this->runCurl($options);
		
		if($result)
		{
			$data = json_decode($result);
			
			$private_messages_array = array();
			foreach($data->data as $pm)
			{
				//In case it's a PM from the system (like helpdesk) we have to create a standard user, because the "system" has no user data.
				if($pm->senderId == 0)
					$sender = new User("System", null, 0);
				else
					$sender = $this->createUserFromJSON($pm->senderuser);
				
				$receiver = $this->createUserFromJSON($pm->receiveruser);
				
				
				$privateMessage = new PrivateMessage($pm->canReply, $pm->id, $pm->content, $pm->folder, $pm->added, $receiver, $pm->read, $sender);
				
				array_push($private_messages_array, $privateMessage);
			}
			
			return $private_messages_array;
		}
	}

	/**
	 * @abstract Send a Private Message to another user on Nordic-T.
	 * @param $receiver : int - the userId of the receiver.
	 * @param $text : the message
	 * @param $save : true/false, save to your own inbox.	 
	 */
	public function sendPm($receiver, $text, $save = true)
	{
		$data = array(
			'token' => $this->token
		);
		
		$postfields = array(
			'receiver' => $receiver,
			'msg' => $text,
			'saveInOutbox'	=> $save
		);
		
		$options = array(
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_BINARYTRANSFER => true,
			CURLOPT_FAILONERROR => false,
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => http_build_query($postfields),
			CURLOPT_URL =>  $this->api_url . 'privatemessages/?'. http_build_query($data)
		);

		$result = $this->runCurl($options);		
		
		if($result)
		{
			//Note: this can be expanded upon to receive information, however, for now it's only relevant (I think) if the PM has been sent or not, at least from an API perspective.
			$data = json_decode($result, true); 
			
			return true;
		}
		else
		{
			return false;
		}
	}
	
	/**
	 * @abstract Gets a post by the postID.
	 * @param id : post id	 
	 */
	public function getPostById($id)
	{
		$data = array(
			'token' => $this->token
		);
		$options = array(
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_BINARYTRANSFER => true,
			CURLOPT_FAILONERROR => false,
			CURLOPT_POST => false,
			CURLOPT_URL =>  $this->api_url . 'forums/post/' . $id . '/?' . http_build_query($data)
		);

		$result = $this->runCurl($options);		
		if($result)
		{
			$data = json_decode($result, true);
			
			if($data['result'] == "true")
			{
				return new Post($data['data']['id'], 
									$data['data']['body'], 
									$data['data']['postingAppId'], 
									$data['data']['topicid'], 
									null, 
									$data['data']['added'], 
									$data['data']['forumid'], 
									$data['data']['editedat'], 
									$data['data']['likes'], 
									$data['data']['editedby'], 
									new User($data['data']['user']['username'],
												null,
												$data['data']['user']['userId'],
												null,
												null,
												$data['data']['user']['enabled'],
												$data['data']['user']['joindate'],
												$data['data']['user']['isAdultAvatar'],
												$data['data']['user']['warned'],
												$data['data']['user']['class'],
												$data['data']['user']['avatar'],
												$data['data']['user']['country'],
												$data['data']['user']['showNswfAvatar'],/*Spelling mistake not by me :p*/
												$data['data']['user']['title'],
												$data['data']['user']['friends'],
												$data['data']['user']['donor'],
												$data['data']['user']['likes'],
												$data['data']['user']['age'],
												$data['data']['user']['gender'])
				);
				
			}
			else
			{
				return false;
			}
		}

	}
	
}

?>