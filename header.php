<?php
require_once('config.php');

if ($menus->id) {
    $menu = (array)json_decode($menus->menu_detail, true);

    $res = selectAll('sort', $menu);
    $rows = buildMenu($res, 0);
}

function selectAll($sortBy = '', $data)
{
    if (is_array($sortBy)) {
        $sortKey = $sortBy ? key($sortBy) : 'id';
        $direct = current($sortBy);
    } else {
        $sortKey = $sortBy ?: $this->primary;
        $direct = 'asc';
    }
    uasort($data, function ($a, $b) use ($sortKey, $direct) {
        $prev = isset($a[$sortKey]) ? (int)$a[$sortKey] : 0;
        $next = isset($b[$sortKey]) ? (int)$b[$sortKey] : 0;

        return strtolower($direct) === 'desc' ? strcmp($next, $prev) : strcmp($prev, $next);
    });

    return $data;
}

function buildMenu($menus, $parentid = 0)
{
    if ($parentid == 0) {
        $ul = 'id="menu_main" class="menu_main_nav"';
    } else {
        $ul = 'class="sub-menu"';
    }

    $result = null;
    foreach ($menus as $key => $item)
        if ($item['pid'] == $parentid) {
            $count = array_search($item['id'], array_column($menus, 'pid'));
            if ($count) {
                $li = "class='menu-item menu-item-has-children'";
            } else {
                $li = "class='menu-item'";
            }
            $result .= "\n<li {$li}> 
                \n  <a title='{$item['menu_name']}' href='{$item['page_slug']}'>{$item['menu_name']}</a>" . buildMenu($menus, $key) . "</li>\n";
        }
    return $result ? "\n<ul {$ul} >\n$result</ul>\n" : null;
}

$url = $_SERVER['REQUEST_URI'];
$select2Css = '';
if (strpos($url, 'blogs.php') !== false) {
    $select2Css = "<link href='https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css' rel='stylesheet' />";
}
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="format-detection" content="telephone=no">
    <link rel="icon" type="image/x-icon" href="images/favicon.ico"/>
    <title>CPA Template</title>
    <meta name='robots' content='noindex,follow'/>

    <link rel='stylesheet' id='rs-plugin-settings-css' href='js/vendor/revslider/rs-plugin/css/settings.css'
          type='text/css' media='all'/>
    <link rel='stylesheet' href='css/fontello/css/fontello.css' type='text/css' media='all'/>
    <link rel="stylesheet" href="js/vendor/calculated-fields-form/css/stylepublic.css" type="text/css"/>
    <link rel="stylesheet" href="js/vendor/calculated-fields-form/css/cupertino/jquery-ui-1.8.20.custom.css"
          type="text/css"/>
    <link rel='stylesheet' href='css/core.animation.css' type='text/css' media='all'/>
    <link href="css/owl.carousel.css" rel="stylesheet"/>
    <link rel='stylesheet' href='css/jquery.rateyo.min.css' type='text/css' media='all'/>
    <link rel='stylesheet' href='css/bootstrap.min.css' type='text/css' media='all'/>
    <link rel='stylesheet' href='css/font-awesome.min.css' type='text/css' media='all'/>
    <link rel='stylesheet' href='css/style.css' type='text/css' media='all'/>

    <?= isset($select2Css) ? $select2Css : '' ?>

    <link rel='stylesheet' href='css/responsive.css' type='text/css' media='all'/>
    <link rel='stylesheet' href='css/custom.css' type='text/css' media='all'/>

</head>

<body class="home sidebar_show sidebar_right page body_style_boxed body_filled article_style_stretch top_panel_style_light top_panel_opacity_solid top_panel_show top_panel_above menu_center sidebar_hide body_bg1">

<div class="body_wrap">
    <div class="page_wrap">
        <div class="top_panel_fixed_wrap"></div>
        <header class="top_panel_wrap bg_tint_light">
            <div class="menu_main_wrap with_text">
                <div class="content_wrap clearfix display_none">
                    <div class="logo">
                        <div class="logo_img">
                            <a href="index.php">
                                <?php if (isset($settings->logo) && !empty($settings->logo)) { ?>
                                    <img src="<?php echo API_URL . 'geturl/uploads/logo/' . $settings->logo; ?>"
                                         class="logo_main" alt="" style="height: 100px;width:200px;">
                                <?php } else { ?>
                                    <img src="images/default-logo.png" class="logo_main" alt="">
                                <?php } ?>
                            </a>
                        </div>
                    </div>
                    <div class="inline image side-right marg_top_2em top-panel_blocks">
                        <div class="inline">
                            <div class="inline-wrapper">
                                <div class="side-right marg_null marg_top top-panel_left">
                                    <div class="icon_user-top">
                                        <i class="user_top_icon icon-telephone"></i>
                                    </div>
                                    <h4><?php echo isset($homePages->firm_phone) ? $homePages->firm_phone : ""; ?></h4>
                                    <span class="font_086em">
                                                <a href="mailto:<?php echo isset($homePages->firm_email) ? $homePages->firm_email : ""; ?>"><?php echo isset($homePages->firm_email) ? $homePages->firm_email : ""; ?></a>
                                            </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="#" class="menu_main_responsive_button icon-menu">Menu</a>
                </div>
                <div class="main-menu_wrap_bg">
                    <div class="main-menu_wrap_content">
                        <nav role="navigation" class="menu_main_nav_area">

                            <?php echo $rows; ?>
                        </nav>
                    </div>
                </div>
            </div>
        </header>