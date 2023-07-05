<div id="sidebar" class="sidebar hidden-print">
    <!-- begin sidebar scrollbar -->
    <div data-scrollbar="true" data-height="100%">
        <!-- begin sidebar user -->
        <ul class="nav">
            <li class="nav-profile">
                <div class="image">
                    <a href="javascript:;"><img
                            src="{{ Auth::check() && Auth::user()->url_img != null ? \App\Sf::fileFtpUrl(Auth::user()->url_img) : url('coloradmin/assets/img/user-13.jpg') }}"
                            onerror="this.src='{{ url('coloradmin/assets/img/ionic.png') }}'" /></a>
                </div>
                <div class="info">
                    {{ Auth::check() ? Auth::user()->userid : '' }}
                    <small>{{ ucwords(strtolower(Auth::check() ? Auth::user()->username : 'Guest')) }}</small>
                </div>
            </li>
        </ul>
        <!-- end sidebar user -->
        <!-- begin sidebar nav -->
        <ul class="nav">
            <li class="nav-header"><a href="{{ url('sys_system_change_plant') }}"> Plant :
                    {{ \Session::get('plant') }}</a></li>
            <?php $dtMenu = \App\Http\Controllers\Sys\SystemController::getListMenu(); ?>
            <?php foreach ($dtMenu as $k1 => $v1): ?>
            <?php if ($v1->rel_symenu->count() == 0): ?>
            <li><a href="{{ url(@$v1->url == '' ? '#' : @$v1->url) }}">{{ @$v1->label }}</a></li>
            <?php else: ?>
            <li class="has-sub"><a href="javascript:;"><b class="caret pull-right"></b><i
                        class="{{ $v1->icon == '' ? 'fa fa-folder' : $v1->icon }}"></i>
                    <span>{{ $v1->label }}</span></a>
                <ul class="sub-menu">
                    <?php foreach ($v1->rel_symenu as $k2 => $v2): ?>
                    <?php if ($v2->rel_symenu->count() == 0): ?>
                    <li><a href="{{ url(@$v2->url == '' ? '#' : @$v2->url) }}">{{ @$v2->label }}</a></li>
                    <?php else: ?>
                    <li class="has-sub"><a href="javascript:;"><b class="caret pull-right"></b>
                            <span>{{ $v2->label }}</span></a>
                        <ul class="sub-menu">

                            <?php foreach ($v2->rel_symenu as $k3 => $v3): ?>
                            <?php if ($v3->rel_symenu->count() == 0): ?>
                            <li><a href="{{ url(@$v3->url == '' ? '#' : @$v3->url) }}">{{ @$v3->label }}</a></li>
                            <?php else: ?>
                            <li class="has-sub"><a href="javascript:;"><b class="caret pull-right"></b>
                                    <span>{{ $v3->label }}</span></a>
                                <ul class="sub-menu">

                                    <?php foreach ($v3->rel_symenu as $k4 => $v4): ?>
                                    <?php if ($v4->rel_symenu->count() == 0): ?>
                                    <li><a
                                            href="{{ url(@$v4->url == '' ? '#' : @$v4->url) }}">{{ @$v4->label }}</a>
                                    </li>
                                    <?php else: ?>
                                    <li class="has-sub"><a href="javascript:;"><b class="caret pull-right"></b>
                                            <span>{{ $v4->label }}</span></a>
                                        <ul class="sub-menu">

                                            <?php foreach ($v4->rel_symenu as $k5 => $v5): ?>
                                            <?php if ($v5->rel_symenu->count() == 0): ?>
                                            <li><a
                                                    href="{{ url(@$v5->url == '' ? '#' : @$v5->url) }}">{{ @$v5->label }}</a>
                                            </li>
                                            <?php else: ?>
                                            <li class="has-sub"><a href="javascript:;"><b class="caret pull-right"></b>
                                                    <span>{{ $v5->label }}</span></a>
                                                <ul class="sub-menu">


                                                </ul>
                                            </li>
                                            <?php endif; ?>
                                            <?php endforeach; ?>

                                        </ul>
                                    </li>
                                    <?php endif; ?>
                                    <?php endforeach; ?>


                                </ul>
                            </li>
                            <?php endif; ?>
                            <?php endforeach; ?>


                        </ul>
                    </li>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </li>
            <?php endif; ?>
            <?php endforeach; ?>


            <!-- begin sidebar minify button -->
            <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i
                        class="fa fa-angle-double-left"></i></a></li>
            <!-- end sidebar minify button -->
        </ul>
        <!-- end sidebar nav -->
    </div>
    <!-- end sidebar scrollbar -->
</div>
<div class="sidebar-bg hidden-print"></div>
