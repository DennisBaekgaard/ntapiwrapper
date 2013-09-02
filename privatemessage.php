<?php
/**
* NT API WRAPPER
* Created By: Dennis Bækgaard @ Tquila Nordic-T.me
* Date: 30/08 - 2013
* Class: PrivateMessage
* Description: This class holds all information regarded to a private message.
*/
require_once("user.php");
class PrivateMessage
{
	private $replyAllowed;
	private $id;
	private $text;
	private $folder;
	private $added; 
	private $read;
	
	//user classes
	private $sender;
	private $receiver;
	
	
	public function __construct($reply_allowed, $id, $text, $folder, $added, User $receiver, $read, User $sender)
	{
		$this->setReplyAllowed($reply_allowed);
		$this->setId($id);
		$this->setText($text);
		$this->setFolder($folder);
		$this->setAdded($added);
		$this->setRead($read);
		
		$this->sender = $sender;
		$this->receiver = $receiver;
		
	}
	
	public function ReplyAllowed()
	{
		return $this->replyAllowed;
	}
	
	public function setReplyAllowed($val)
	{
		if(is_bool($val))
		{
			$this->replyAllowed = $val;
		}
		else
			throw new Exception ("ReplyAllowed has to be a boolean value");
	}
	
	public function Id()
	{
		return $this->id;
	}
	
	public function setId($val)
	{
		if(is_int($val))
		{
			$this->id = $val;
		}
		else
		{
			throw new Exception ("id has to be an int");
		}
	}
	
	public function Text()
	{
		return $this->text;
	}
	
	public function setText($val)
	{
		$this->text = $val;
	}
	
	public function Folder()
	{
		return $this->folder;
	}
	
	public function setFolder($val)
	{
		$this->folder = $val;
	}
	
	public function Added()
	{
		return $this->added;
	}
	
	public function setAdded($val)
	{
		if(is_int($val) || is_float($val))
		{
			$this->added = $val;
		}
		else
		{
			throw new Exception ("Added has to be either an int or a float value");
		}
	}
	
	public function Read()
	{
		return $this->read;
	}
	
	public function setRead($val)
	{
		if(is_bool($val))
		{
			$this->read = $val;
		}
		else
		{
			throw new Exception ("read has to be a boolean value");
		}
	}
	
	public function Sender()
	{
		return $this->sender;
	}
	
	public function setSender(User $val)
	{
		$this->sender = $val;
	}
	
	public function Receiver()
	{
		return $this->receiver;
	}
	
	public function setReceiver(User $val)
	{
		$this->receiver = $val;
	}
	
	
	
	
}

?>