<?php
/*
 * The MIT License
 *
 * Copyright (c) 2010 Ntanasis Periklis 
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */
 
include("adm/configuration.php");
 
class writer {
	
	private $filename;
	private $archive;
	
	function __construct($name) 
	{
        $this->filename = $name;
    }
    
    function set_archive($arch)
    {
		$this->archive = $arch;
	}
	
	function open()
	{
		$fh = fopen($this->filename, 'w') or die("can't open file");
		fwrite($fh, '<?xml version="1.0" encoding="UTF-8" ?>');
		$fh = fopen($this->filename, 'a') or die("can't open file");
		fwrite($fh, '<rss version="2.0">');
		fwrite($fh, '<channel>');
	}

	function close()
	{
		$fh = fopen($this->filename, 'a') or die("can't open file");
		fwrite($fh, '</channel>');
		fwrite($fh, '</rss>');
		fclose($fh);
	}

	//Required Channel Elements
	function rce($title,$desc,$link)
	{
		$fh = fopen($this->filename, 'a') or die("can't open file");
		fwrite($fh, '<title>'.$title.'</title>');
		fwrite($fh, '<description>'.htmlentities($desc).'</description>');
		fwrite($fh, '<link>'.htmlentities($link).'</link>');
	}
	
	//Optional Channel Elements
	function pubDate($arg)
	{
		$fh = fopen($this->filename, 'a') or die("can't open file");
		fwrite($fh, '<pubDate>'.$arg.'</pubDate>');
	}
	
	function lastBuildDate($arg)
	{
		$fh = fopen($this->filename, 'a') or die("can't open file");
		fwrite($fh, '<lastBuildDate>'.$arg.'</lastBuildDate>');
	}

	function language($arg)
	{
		$fh = fopen($this->filename, 'a') or die("can't open file");
		fwrite($fh, '<language>'.$arg.'</language>');
	}
	
	function copyright($arg)
	{
		$fh = fopen($this->filename, 'a') or die("can't open file");
		fwrite($fh, '<copyright>'.$arg.'</copyright>');
	}
	
	function webmaster($arg)
	{
		$fh = fopen($this->filename, 'a') or die("can't open file");
		fwrite($fh, '<webmaster>'.$arg.'</webmaster>');
	}
	
	function managingEditor($arg)
	{
		$fh = fopen($this->filename, 'a') or die("can't open file");
		fwrite($fh, '<managingEditor>'.$arg.'</managingEditor>');
	}
	
	function category($arg)
	{
		$fh = fopen($this->filename, 'a') or die("can't open file");
		fwrite($fh, '<category>'.$arg.'</category>');
	}
	
	function generator($arg)
	{
		$fh = fopen($this->filename, 'a') or die("can't open file");
		fwrite($fh, '<generator>'.$arg.'</generator>');
	}
	
	function ttl($arg)
	{
		$fh = fopen($this->filename, 'a') or die("can't open file");
		fwrite($fh, '<ttl>'.$arg.'</ttl>');
	}
	
	function docs($arg)
	{
		$fh = fopen($this->filename, 'a') or die("can't open file");
		fwrite($fh, '<docs>'.$arg.'</docs>');
	}
	
	//Sub Channel Elements - Image <image></image>
	function oimage()
	{
		$fh = fopen($this->filename, 'a') or die("can't open file");
		fwrite($fh, '<image>');
	}
	
	function cimage()
	{
		$fh = fopen($this->filename, 'a') or die("can't open file");
		fwrite($fh, '</image>');
	}
	
	function title($arg)
	{
		$fh = fopen($this->filename, 'a') or die("can't open file");
		fwrite($fh, '<title>'.$arg.'</title>');
	}
	
	function description($arg)
	{
		$fh = fopen($this->filename, 'a') or die("can't open file");
		fwrite($fh, '<description>'.htmlentities($arg).'</description>');
	}
	
	function url($arg)
	{
		$fh = fopen($this->filename, 'a') or die("can't open file");
		fwrite($fh, '<url>'.$arg.'</url>');
	}
	
	function width($arg)
	{
		$fh = fopen($this->filename, 'a') or die("can't open file");
		fwrite($fh, '<width>'.$arg.'</width>');
	}
	
	function height($arg)
	{
		$fh = fopen($this->filename, 'a') or die("can't open file");
		fwrite($fh, '<height>'.$arg.'</height>');
	}
	
	function link($arg)
	{
		$fh = fopen($this->filename, 'a') or die("can't open file");
		fwrite($fh, '<link>'.htmlentities($arg).'</link>');
	}
	
	//Sub Channel Elements - Item <item></item>
	function oitem()
	{
		$fh = fopen($this->filename, 'a') or die("can't open file");
		fwrite($fh, '<item>');
	}
	
	function citem()
	{
		$fh = fopen($this->filename, 'a') or die("can't open file");
		fwrite($fh, '</item>');
	}
	
	//general write function
	function write($tag,$value)
	{
		$fh = fopen($this->filename, 'a') or die("can't open file");
		fwrite($fh, '<'.$tag.'>');
		fwrite($fh, $value);
		fwrite($fh, '</'.$tag.'>');
	}
	
	//adds new entry with limit and archives all the posts
	function add_new_limit($title,$description,$link,$category)
	{	
		global $rsslocation;
		global $templocation;
		global $maxfeeds;
		$pubDate = date('M,j Y h:i:s A T');
		$source = $rsslocation.''.$filename;
		if (!copy($source, $templocation)) 
		{
			echo "failed to copy file...\n";
			exit();
		}
		$xml = simplexml_load_file($templocation);
		$this->open();
		$this->rce($xml->channel->title,$xml->channel->description,$xml->channel->link);
		$this->oitem();
		$this->title($title);
		$this->description($description);
		$this->link($link);
		$this->pubDate($pubDate);
		$this->category($category);
		$this->citem();
		$i=1;
		foreach($xml->channel->item as $item)
		{
			if($i===$maxfeeds)
			{
				break;
			}
			$this->oitem();
			$this->title($item->title);
			$this->description($item->description);
			$this->link($item->link);
			$this->pubDate($item->pubDate);
			$this->category($item->category);
			$this->citem();
			$i = $i + 1;
		}
		$this->close();
		unlink($templocation);
	}
	
	//method that adds one new entry	
	function add_new($title,$description,$link,$category)
	{
		global $rsslocation;
		global $templocation;
		$pubDate = date('M,j Y h:i:s A T');
		$source = $rsslocation.'archive.xml';
		if (!copy( $source,$templocation)) 
		{
			echo "failed to copy archive.xml...\n";
			exit();
		}
		$xml = simplexml_load_file($templocation);
		$this->open();
		$this->rce($xml->channel->title,$xml->channel->description,$xml->channel->link);
		$this->oitem();
		$this->title($title);
		$this->description($description);
		$this->link($link);
		$this->pubDate($pubDate);
		$this->category($category);
		$this->citem();
		foreach($xml->channel->item as $item)
		{
			$this->oitem();
			$this->title($item->title);
			$this->description($item->description);
			$this->link($item->link);
			$this->pubDate($item->pubDate);
			$this->category($item->category);
			$this->citem();
		}
		$this->close();
		unlink($templocation);
	}
	
	//updates RCE
	function rce_update($title,$description,$link)
	{
		global $rsslocation;
		global $templocation;
		$filename = 'rss.xml';
		$pubDate = date('M,j Y h:i:s A T');
		if (!copy($rsslocation.$filename, $templocation))
		{
			echo "failed to copy file...\n";
			exit();
		}
		$xml = simplexml_load_file($templocation);
		$this->open();
		$this->rce($title,$description,$link);
		foreach($xml->channel->item as $item)
		{
			$this->oitem();
			$this->title($item->title);
			$this->description($item->description);
			$this->link($item->link);
			$this->pubDate($item->pubDate);
			$this->category($item->category);
			$this->citem();
		}
		$this->close();
		unlink($templocation);
	}
	
	//edits an entry
	function edit($pos,$title,$description,$link,$category)
	{
		global $rsslocation;
		global $templocation;
		$pubDate = date('M,j Y h:i:s A T');
		$source = $rsslocation.'rss.xml';
		if (!copy( $source,$templocation)) 
		{
			echo "failed to copy file...\n";
			exit();
		}
		$xml = simplexml_load_file($templocation);
		$this->open();
		$this->rce($xml->channel->title,$xml->channel->description,$xml->channel->link);
		$y = 1;
		foreach($xml->channel->item as $item)
		{
			if($y==$pos)
			{
				$this->oitem();
				$this->title($title);
				$this->description($description);
				$this->link($link);
				$this->pubDate($pubDate);
				$this->category($category);
				$this->citem();
				$y = $y + 1;
				continue;
			}
			$this->oitem();
			$this->title($item->title);
			$this->description($item->description);
			$this->link($item->link);
			$this->pubDate($item->pubDate);
			$this->category($item->category);
			$this->citem();
			$y = $y + 1;
		}
		$this->close();
		unlink($templocation);
	}
	
	//a function that deletes feeds
	function delete($pos)
	{
		global $rsslocation;
		global $templocation;
		$source = $rsslocation.'rss.xml';
		if (!copy( $source,$templocation)) 
		{
			echo "failed to copy file...\n";
			exit();
		}
		$xml = simplexml_load_file($templocation);
		$this->open();
		$this->rce($xml->channel->title,$xml->channel->description,$xml->channel->link);
		$y = 1;
		foreach($xml->channel->item as $item)
		{
			if($y==$pos)
			{
				$y = $y + 1;
				continue;
			}
			$this->oitem();
			$this->title($item->title);
			$this->description($item->description);
			$this->link($item->link);
			$this->pubDate($item->pubDate);
			$this->category($item->category);
			$this->citem();
			$y = $y + 1;
		}
		$this->close();
		unlink($templocation);
	}

}

?>
