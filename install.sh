#!/bin/bash
#
# The MIT License - see License.txt
#
# Copyright (c) 2010 Ntanasis Periklis 
# 

function createconfiguration() {
	echo   "<?php
/*
 * The MIT License
 *
 * Copyright (c) 2010 Ntanasis Periklis 
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the \"Software\"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED \"AS IS\", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

/**
 * This file contains all the available configuration options for
 * the Simple RSS editor
 */
 
 // control panel admin - pass is in 3-MD5 format
 \$ADMIN_NAME = \"$username\";
 \$ADMIN_PASSWORD = \"$password\";
 
 // General Settings - change this to your configuration
 \$ARCHIVE = 0; 		//switch - 0 no, 1 yes
 \$FEEDS_LIMIT = 1;	//switch - 0 no, 1 yes
 \$MAX_FEEDS = 8;
 \$RSS_LOCATION = \"$url\";
 \$TEMP_LOCATION = \"$tmplocation\";
 
?>" > adm/configuration.php
}

function createxml() {
	echo "<?xml version=\"1.0\" encoding=\"UTF-8\" ?><rss version=\"2.0\"><channel></channel></rss>" > rss.xml
}

function createarchive() {
	echo "<?xml version=\"1.0\" encoding=\"UTF-8\" ?><rss version=\"2.0\"><channel><title>RSS backup</title><description>Here are stored all the RSS Feeds</description><link>http://github.com/MasterEx</link></channel></rss>" > archive.xml
}

echo "chmod 755 *.php adm/*.php"
chmod 755 *.php adm/*.php

echo "Username:"
read username;
echo "Password:"
read password;
# 3ple md5
password=$(echo -n $password | md5sum)
password=${password%  -}
password=$(echo -n $password | md5sum)
password=${password%  -}
password=$(echo -n $password | md5sum)
password=${password%  -}
echo $password

echo "Enter the srsseditor url (i.e. http://localhost/srsseditor/ ):"
read url;

tmplocation=$(pwd)"/adm/temp.xml"
echo $tmplocation

echo "Create the configuration.php"
createconfiguration
echo "chmod 755 adm/configuration.php"
chmod 755 adm/configuration.php
echo "Create the rss.xml"
createxml
echo "Create the archive.xml"
createarchive
echo "chmod 777 rss.xml archive.xml adm"
chmod 777 rss.xml archive.xml adm

echo "chmod 700 install.sh"
chmod 700 install.sh

exit 0
