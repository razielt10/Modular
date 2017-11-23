<div class="navbar-default sidebar" role="navigation" id="sidebar-wrapper">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav in" id="side-menu">
            <li class="sidebar-search">
                <div class="input-group custom-search-form">
                    <input class="form-control" placeholder="Search..." type="text">
                    <span class="input-group-btn">
                        <button class="btn btn-primary" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                </span>
                </div>
                <!-- /input-group -->
            </li>
            <li>
                <a href="{{ route('admin') }}" class="active"><i class="fa fa-dashboard fa-fw"></i>Inicio</a>
            </li>

            @php
             $menu = ''; $first =false ;
            @endphp
            @foreach (Auth::user()->userModule as $key => $value)
              @if($module = $value->parentModule())
                @if( $menu != $module->nameModule)
                  @if($first)
                    </ul></li>
                  @endif
                  @php
                      $first = true;
                      $menu = $module->nameModule;
                  @endphp
              <li>
                  <a href="#"><i class="fa {{ $module->classIcon }} fa-fw"></i>{{ ' '.$module->nameModule }}<span class="fa arrow"></span></a>
                  <ul class="nav nav-second-level collapse">
                @endif
              @endif
              <li>
                  <a href="{{ route('site').'/'.$value->pathModule }}"><i class="fa {{ $value->classIcon }} fa-fw"></i>{{ ' '.$value->nameModule }}</a>
              </li>

            @endforeach
            @if( !empty($menu) )
              </ul></li>
            @endif
        </ul>
    </div>
</div>
