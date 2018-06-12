<?php
/**
 * Created by PhpStorm.
 * User: chixiaobin
 * Date: 2018/6/10
 * Time: 下午2:24
 */
//setrawcookie("user","alex",time()+3600);
?>
<html>
<body>
<?php if(isset($_COOKIE["user"]))
{
    $str=null;
    echo "welcome",$_COOKIE["user"];
    setrawcookie("user",$str,time()-3600);
}
else{
    echo "sorry";
}
?>
</body>
</html>
