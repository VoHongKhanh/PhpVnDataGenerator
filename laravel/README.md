<h3>Cấu hình thư viện</h3>
<ol>
<li>Tải tập tin PhpVnDataGenerator.zip và giải nén vào thư mục <code>vendor\laravel\framework\src\Illuminate</code></li>
<li>Tạo tập tin resources\views\test.php có nội dung như sau:<br/> 
<pre>&lt;!DOCTYPE html&gt;
&lt;html lang="en"&gt;
&lt;head&gt;
	&lt;meta charset="UTF-8" /&gt;
	&lt;title&gt;Laravel 5.2 &amp; Angular JS&lt;/title&gt;
&lt;/head&gt;
&lt;body&gt;
&lt;?php 
use Illuminate\PhpVnDataGenerator\VnBase;
use Illuminate\PhpVnDataGenerator\VnFullname;
use Illuminate\PhpVnDataGenerator\VnPersonalInfo;

/**
  * @example Test PhpVnDataGenerator's functions.
  */
function Test() {
	$o = new VnFullname();
	$p = new VnPersonalInfo();

	echo "&lt;h3&gt;Random name:&lt;/h3&gt;&lt;ul&gt;";
	$name     = $o-&gt;FullName(VnBase::VnMale);
	$birthdate= $p-&gt;Birthdate();
	$email    = $p-&gt;Email($name, $birthdate, "", ".-_", "Ymd", VnBase::VnLowerCase, VnBase::VnTrimNormal);
	$phone    = $p-&gt;Phone();
	$father   = $o-&gt;Father($name, VnBase::VnMale, VnBase::VnTrue);
	$mother   = $o-&gt;Mother($name);
	$parents  = $o-&gt;Parents($name, VnBase::VnMale, VnBase::VnTrue);
	$son      = $o-&gt;Children(VnBase::VnMale  , $name);
	$daughter = $o-&gt;Children(VnBase::VnFemale, $name);
	$address  = $p-&gt;Address();
	echo "&lt;li&gt;Male: $name (".$birthdate["birthdate"]." - $email - $phone) - son: $son - daughter: $daughter"; 
	echo "&lt;ul&gt;&lt;li&gt;Address: $address&lt;/li&gt;&lt;li&gt;Father: $father&lt;/li&gt;&lt;li&gt;Mother: $mother&lt;/li&gt;&lt;li&gt;Parents: $parents&lt;/li&gt;&lt;/ul&gt;&lt;/li&gt;";

	$name     = $o-&gt;FullName(VnBase::VnFemale);
	$birthdate= $p-&gt;Birthdate();
	$email    = $p-&gt;Email($name, $birthdate, "", "", "Y", VnBase::VnCapitalize, VnBase::VnTrimFirstLast);
	$phone    = $p-&gt;Phone();
	$father   = $o-&gt;Father($name, VnBase::VnFemale);
	$mother   = $o-&gt;Mother($name);
	$parents  = $o-&gt;Parents($name, VnBase::VnFemale);
	$son      = $o-&gt;Children(VnBase::VnMale  , "", $name);
	$daughter = $o-&gt;Children(VnBase::VnFemale, "", $name);
	$address  = $p-&gt;Address();
	echo "&lt;li&gt;Female: $name (".$birthdate["birthdate"]." - $email - $phone) - son: $son - daughter: $daughter"; 
	echo "&lt;ul&gt;&lt;li&gt;Address: $address&lt;/li&gt;&lt;li&gt;Father: $father&lt;/li&gt;&lt;li&gt;Mother: $mother&lt;/li&gt;&lt;li&gt;Parents: $parents&lt;/li&gt;&lt;/ul&gt;&lt;/li&gt;";
	
	//$name = $o-&gt;FullName(VnBase::VnMixed);
	$gender   = rand(0, 1000) &gt; 450? VnBase::VnMale: VnBase::VnFemale;
	$name     = $o-&gt;FullName($gender);
	$birthdate= $p-&gt;Birthdate();
	$email    = $p-&gt;Email($name, $birthdate["birthdate"], "", "?", "", VnBase::VnMixed, VnBase::VnMixed, VnBase::VnTrue);
	$phone    = $p-&gt;Phone();
	$father   = $o-&gt;Father($name, VnBase::VnMixed);
	$mother   = $o-&gt;Mother($name);
	$parents  = $o-&gt;Parents($name, VnBase::VnMixed);
	$address  = $p-&gt;Address();
	if ($gender == VnBase::VnMale) {
		$wife     = $o-&gt;FullName(VnBase::VnFemale);
		$son      = $o-&gt;Children(VnBase::VnMale  , $name, $wife);
		$daughter = $o-&gt;Children(VnBase::VnFemale, $name, $wife);
		echo "&lt;li&gt;Mixed: $name (".$birthdate["birthdate"]." - $email - $phone) - wife: $wife - son: $son - daughter: $daughter"; 
		echo "&lt;ul&gt;&lt;li&gt;Address: $address&lt;/li&gt;&lt;li&gt;Father: $father&lt;/li&gt;&lt;li&gt;Mother: $mother&lt;/li&gt;&lt;li&gt;Parents: $parents&lt;/li&gt;&lt;/ul&gt;&lt;/li&gt;";
	} else {
		$husband  = $o-&gt;FullName(VnBase::VnMale);
		$son      = $o-&gt;Children(VnBase::VnMale  , $husband, $name);
		$daughter = $o-&gt;Children(VnBase::VnFemale, $husband, $name);
		echo "&lt;li&gt;Mixed: $name (".$birthdate["birthdate"]." - $email - $phone) - husband: $husband - son: $son - daughter: $daughter"; 
		echo "&lt;ul&gt;&lt;li&gt;Address: $address&lt;/li&gt;&lt;li&gt;Father: $father&lt;/li&gt;&lt;li&gt;Mother: $mother&lt;/li&gt;&lt;li&gt;Parents: $parents&lt;/li&gt;&lt;/ul&gt;&lt;/li&gt;";
	}
	echo "&lt;/ul&gt;";

	$randomLength = 10;
	echo "&lt;hr/&gt;&lt;h3&gt;Random $randomLength mixed names:&lt;/h3&gt;";
	$a = $o-&gt;FullNames(VnBase::VnMixed, $randomLength);
	            
	TestUniqueList($a, VnBase::VnNotSorting);

	echo "&lt;br/&gt;&lt;b&gt;generated names&lt;/b&gt;&lt;br/&gt;";
	foreach ($a as $i =&gt; $name) {
		echo ($i+1).". $name&lt;br/&gt;";
	}

}

/**
  * Check unique list and print the list.
  *
  * @param string[] $a 		the list that will be checked.
  * @param int 		$isSort (VnBase::VnSorting | VnBase::VnNotSorting) 
  *							will the list be sorted.
  */
function TestUniqueList(&amp;$a, $isSort = VnBase::VnSorting) {
    if ($isSort) {
        sort($a, SORT_STRING);
    }

    $n = count($a);
    $duplicates = [];
    for ($i=0; $i &lt;= $n-2 ; $i++) { 
        if ($a[$i] == $a[$i+1] ||
            VnBase::Vn2En($a[$i]) == VnBase::Vn2En($a[$i+1])) {
            array_push($duplicates, ["index"=&gt;$i, "name"=&gt;$a[$i]." - ".$a[$i+1]]);
        }
    }
    if (count($duplicates) == 0) {
        echo "&lt;b&gt;don't have duplicate name&lt;/b&gt;";
    } else {
        echo "&lt;b&gt;duplicate names&lt;/b&gt;&lt;br/&gt;";
        foreach ($duplicates as $i =&gt; $value) {
            echo ($i+1).". ".$value['index']." and ".($value['index']+1)." (".$value['name'].")&lt;br/&gt;";
        }
    }
}

Test();
?&gt;
&lt;/body&gt;
&lt;/html&gt;
</pre>
</li>
<li>Thêm route vào tập tin routes\web.php dòng lệnh như sau:<br/>
<pre>Route::get('/test', function () { return view('testPhpVnDataGenerator'); });
</pre></li>
<li>Mở trình duyệt và gõ đường dẫn http://.../test</li>
</ol>
