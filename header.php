<?php
require_once('config.php');

if($menus->id)
{
    $menu = (array)json_decode($menus->menu_detail, true);

    $res = selectAll('sort',$menu);
    $rows = buildMenu($res,0);
}

function selectAll($sortBy = '',$data )
{
    if (is_array($sortBy)) {
        $sortKey = $sortBy ? key($sortBy) : 'id';
        $direct = current($sortBy);
    } else {
        $sortKey = $sortBy ?: $this->primary;
        $direct = 'asc';
    }
    uasort($data, function ($a, $b) use ($sortKey, $direct){
        $prev = isset($a[$sortKey]) ? (int)$a[$sortKey] : 0;
        $next = isset($b[$sortKey]) ? (int)$b[$sortKey] : 0;

        return strtolower($direct) === 'desc' ? strcmp($next, $prev) : strcmp($prev, $next);
    });

    return $data;
}

function buildMenu($menus, $parentid = 0)
{
    if($parentid == 0)
    {
        $div = '';
        $ul =  'id="menu_main" class="nav navbar-nav"';
        $div1 = '';
    }
    else
    {
        $div ='<div class="sub-menu-outer">';
        $ul =  'class="sub-navigation"';
        $div1 ='</div>';
    }

    $result = null;
    foreach ($menus as $key => $item)
        if ($item['pid'] == $parentid) {
            $count = array_search($item['id'], array_column($menus, 'pid'));
            if($count)
            {
                //   $li =  "class='menu-item menu-item-has-children'";
                $li = '';
            }
            else{
                // $li =  "class='menu-item'";
                $li = '';
            }
            $result .= "\n<li {$li}> 
                \n  <a title='{$item['menu_name']}' href='{$item['page_slug']}'>{$item['menu_name']}</a>" . buildMenu($menus, $key) . "</li>\n";
        }
    return $result ?  "\n{$div}<ul {$ul} >\n$result</ul>{$div1}\n" : null;
}
$url = $_SERVER['REQUEST_URI'];
$select2Css = '';
if (strpos($url, 'blogs.php') !== false) {
    $select2Css = "<link href='https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css' rel='stylesheet' />";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">
    <meta name="author" content="">
    <title>Template-3 Home Page</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/fontello.css" rel="stylesheet">
    <link href="css/menu.css" rel="stylesheet">
    <link href="css/slick.css" rel="stylesheet">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link href="css/custom.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="home">
<div class="header">
    <nav class="navbar">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">
                    <?php if (isset($settings->logo) && !empty($settings->logo)) { ?>
                        <img src="<?= LOGO_URL . $settings->logo ?>" class="logo_main" alt="" style="height: 100px;width:200px;">
                    <?php } else { ?>
                        <img src="img/logo.png" class="logo_main" alt="">
                    <?php } ?>
                </a>
            </div>
            <section class="top-section pull-right">
                <div class="clearfix">

                    <ul class="pull-right top-social-media">
                        <?php
                        $links = array('twitter_link' => 'icon-tumblr',
                            'facebook_link' => 'icon-facebook',
                            'google_link' => 'icon-gplus');
                        foreach ($links as $link => $class){
                            if(!empty($settings->$link)){
                                ?>
                                <li><a href="<?= $settings->$link ?>"><i class="<?= $class ?>"></i></a></li>
                                <?php
                            }
                        }
                        ?>
                    </ul>
                </div>
            </section>
            <div id="navbar" class="navbar-collapse">
                <?= $rows; ?>
            </div><!--/.nav-collapse -->


        </div>
    </nav>

</div>