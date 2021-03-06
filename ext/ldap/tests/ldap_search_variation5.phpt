--TEST--
ldap_search() test
--CREDITS--
Davide Mendolia <idaf1er@gmail.com>
Patrick Allaert <patrickallaert@php.net>
Belgian PHP Testfest 2009
--SKIPIF--
<?php
require_once('skipif.inc');
require_once('skipifbindfailure.inc');
?>
--FILE--
<?php
include "connect.inc";

$link = ldap_connect_and_bind($host, $port, $user, $passwd, $protocol_version);
insert_dummy_data($link);

$dn = "dc=my-domain,dc=com";
$filter = "(objectclass=person)";
var_dump(
	$result = ldap_search($link, $dn, $filter, array('sn'), 1, 1, 3, LDAP_DEREF_SEARCHING),
	ldap_get_entries($link, $result)
);
var_dump(
	$result = ldap_search($link, $dn, $filter, array('sn'), 1, 1, 3, LDAP_DEREF_FINDING),
	ldap_get_entries($link, $result)
);
var_dump(
	$result = ldap_search($link, $dn, $filter, array('sn'), 1, 1, 3, LDAP_DEREF_ALWAYS),
	ldap_get_entries($link, $result)
);
?>
===DONE===
--CLEAN--
<?php
include "connect.inc";

$link = ldap_connect_and_bind($host, $port, $user, $passwd, $protocol_version);
remove_dummy_data($link);
?>
--EXPECTF--
Warning: ldap_search(): Partial search results returned: Sizelimit exceeded in %s on line %d
resource(%d) of type (ldap result)
array(2) {
  ["count"]=>
  int(1)
  [0]=>
  array(4) {
    ["sn"]=>
    array(1) {
      ["count"]=>
      int(0)
    }
    [0]=>
    string(2) "sn"
    ["count"]=>
    int(1)
    ["dn"]=>
    string(28) "cn=userA,dc=my-domain,dc=com"
  }
}

Warning: ldap_search(): Partial search results returned: Sizelimit exceeded in %s on line %d
resource(%d) of type (ldap result)
array(2) {
  ["count"]=>
  int(1)
  [0]=>
  array(4) {
    ["sn"]=>
    array(1) {
      ["count"]=>
      int(0)
    }
    [0]=>
    string(2) "sn"
    ["count"]=>
    int(1)
    ["dn"]=>
    string(28) "cn=userA,dc=my-domain,dc=com"
  }
}

Warning: ldap_search(): Partial search results returned: Sizelimit exceeded in %s on line %d
resource(%d) of type (ldap result)
array(2) {
  ["count"]=>
  int(1)
  [0]=>
  array(4) {
    ["sn"]=>
    array(1) {
      ["count"]=>
      int(0)
    }
    [0]=>
    string(2) "sn"
    ["count"]=>
    int(1)
    ["dn"]=>
    string(28) "cn=userA,dc=my-domain,dc=com"
  }
}
===DONE===
