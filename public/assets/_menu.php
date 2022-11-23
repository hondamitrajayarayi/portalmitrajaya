<?php
    $menus = file_get_contents("menu.json");
    $menus = (array)json_decode($menus);
?>
 <div class="app-menu navbar-menu">
                <!-- LOGO -->
                <div class="navbar-brand-box">
                    <!-- Dark Logo-->
                    <a href="index.html" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="assets/images/logo-sm.png" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="assets/images/logo-dark.png" alt="" height="30">
                        </span>
                    </a>
                    <!-- Light Logo-->
                    <a href="index.html" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="assets/images/logo-sm.png" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="assets/images/logo-light.png" alt="" height="30">
                        </span>
                    </a>
                    <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
                        id="vertical-hover">
                        <i class="ri-record-circle-line"></i>
                    </button>
                </div>

                <div id="scrollbar">
                    <div class="container-fluid">

                        <div id="two-column-menu">
                        </div>
                        <ul class="navbar-nav" id="navbar-nav">
                            <li class="menu-title"><span data-key="t-menu">Menu</span></li>

                            <?php
                            foreach ($menus as $key => $menu) {
                                $menu = (array)$menu;
                            ?>
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="#<?=$menu['link'];?>" data-bs-toggle="collapse" role="button"
                                    aria-expanded="false" aria-controls="<?=$menu['link'];?>">
                                    <i class="<?=$menu['icon'];?>"></i> <span data-key="t-<?=$menu['name'];?>"><?=$menu['name'];?></span>
                                </a>
                            <?php if (count($menu["children"])>0){?>
                                <div class="collapse menu-dropdown" id="<?=$menu['link'];?>">
                                    <ul class="nav nav-sm flex-column">
                                            <?php
                                            foreach ($menu["children"] as $index => $child) {
                                                $child = (array)$child;
                                            ?>
                                                <?php if ($child['link']=='' && $child['icon']!=''){?>
                                                <li class="nav-item">
                                                    <h6 class="text-light"><i class="<?=$child['icon'];?>"></i> <?=$child["name"];?>
                                                    </h6>
                                                </li>

                                                <?php } else {?>
                                                <li class="nav-item">
                                                    <a href="<?=$child["link"];?>" class="nav-link" data-key="t-<?=$child["name"];?>"> <?=$child["name"];?>
                                                    </a>
                                                </li>
                                                <?php } ?>
                                            <?php }?>

                                    </ul>
                                </div>
                            <?php }?>
                        </li>
                            
                           <?php }?>

                        </ul>
                    </div>
                    <!-- Sidebar -->
                </div>
            </div>           