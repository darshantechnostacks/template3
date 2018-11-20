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
    
?>
<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="">
        <meta name="author" content="">
        <title>CPA Template</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/fontello.css" rel="stylesheet">
        <link href="css/menu.css" rel="stylesheet">
        <link href="css/slick.css" rel="stylesheet">
        <link rel="stylesheet" href="css/jquery-ui.css">
        <link href="css/font-awesome.min.css" rel="stylesheet">
        <link href="css/custom.css" rel="stylesheet">
        <link rel='stylesheet' href='css/jquery.rateyo.min.css' type='text/css' media='all'/>
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <body class="home">
        <div class="header">
            <section class="top-section clearfix">
                <div class="clearfix container">
                    <ul class="pull-left top-contact-info">
                        <li><i class="icon-mobile"></i> <?php echo isset($homePages->firm_phone) ? $homePages->firm_phone : ""; ?></li>
                        <li><i class="icon-email"></i> <a href="mailtto:<?php echo isset($homePages->firm_email) ? $homePages->firm_email : ""; ?>"><?php echo isset($homePages->firm_email) ? $homePages->firm_email : ""; ?></a></li>
                    </ul>
                    <ul class="pull-right top-social-media">
                         <?php if (isset($settings->twitter_link) && !empty($settings->twitter_link)) { ?>
                                        <li><a href="<?php echo isset($settings->twitter_link) ? $settings->twitter_link : ""; ?>" target="_blank"><i class="icon-twitter"></i></a></li>

                                    <?php } if (isset($settings->facebook_link) && !empty($settings->facebook_link)) { ?>
                                        <li><a href="<?php echo isset($settings->facebook_link) ? $settings->facebook_link : ""; ?>" target="_blank"><i class="icon-facebook"></i></a></li>
                                    <?php } if (isset($settings->google_link) && !empty($settings->google_link)) { ?>
                                        <li><a href="<?php echo isset($settings->google_link) ? $settings->google_link : ""; ?>" target="_blank"><i class="icon-gplus"></i></a></li>
                                    <?php } ?>
                        
                    </ul>
                </div>
            </section>
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
                            <img src="<?php echo API_URL . 'geturl/uploads/logo/' . $settings->logo; ?>" class="logo_main" alt="Logo" style="height: 100px;width:200px;">
                        <?php } else { ?>
                            <img src="images/default-logo.png" class="logo_main" alt="Logo">
                        <?php } ?>
                       </a>
                    </div>
                    <div id="navbar" class="navbar-collapse">
                        <ul class="nav navbar-nav" style="margin-top: 20px;">
                             <?php echo $rows;?>
                            

                            
                        </ul>
                    </div><!--/.nav-collapse -->


                </div>
            </nav>
            
