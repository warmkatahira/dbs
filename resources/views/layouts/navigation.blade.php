@vite(['resources/scss/navigation.scss'])

<nav id="navigation">
    <a href="{{ route('top.index') }}" class="logo">DBS</a>
    <ul class="links flex">
        <li class="dropdown"><a href="#" class="trigger-drop">収支管理</a>
            <ul class="drop">
                <li><a href="{{ route('balance_list.index_calendar') }}">収支一覧(カレンダー)</a></li>
                <li><a href="{{ route('balance_list.index_list') }}">収支一覧(リスト)</a></li>
            </ul>
        </li>
        <li class="dropdown"><a href="#" class="trigger-drop">マスタ管理</a>
            <ul class="drop">
                <li><a href="{{ route('customer.index') }}">荷主マスタ</a></li>
            </ul>
        </li>
        <li class="dropdown"><a href="#" class="trigger-drop">設定</a>
            <ul class="drop">
                <li><a href="{{ route('sales_plan_setting.index') }}">売上計画設定</a></li>
                <li><a href="{{ route('monthly_cost_setting.index') }}">月額経費設定</a></li>
                <li><a href="{{ route('monthly_customer_setting.index') }}">月別荷主設定</a></li>
            </ul>
        </li>
        <li class="dropdown"><a href="#" class="trigger-drop">その他</a>
            <ul class="drop">
                <li><a href="">問い合わせ</a></li>
            </ul>
        </li>
        <li class="dropdown"><a href="#" class="trigger-drop">システム管理</a>
            <ul class="drop">
                <li><a href="{{ route('base_mgt.index') }}">拠点管理</a></li>
                <li><a href="">項目マスタ</a></li>
                <li><a href="">荷役マスタ</a></li>
                <li><a href="{{ route('user_mgt.index') }}">ユーザー管理</a></li>
            </ul>
        </li>
        <li class="dropdown"><a href="#" class="trigger-drop">テスト</a>
            <ul class="drop">
                <li><a href="{{ route('test.balance_create') }}">収支枠作成</a></li>
                <li><a href="{{ route('test.labor_cost_update') }}">人件費同期</a></li>
                <li><a href="{{ route('test.monthly_customer_setting_create') }}">月別荷主設定作成</a></li>
                <li><a href="{{ route('test.sales_cost_allocation') }}">売上経費分配</a></li>
            </ul>
        </li>
    </ul>
    <ul class="user_info">
        <li class="dropdown"><a href="#" class="trigger-drop">{{ Auth::user()->last_name.' '.Auth::user()->first_name.'さん' }}</a>
            <ul class="drop">
                <li>
                    <form method="POST" action="{{ route('logout') }}" class="m-0">
                        @csrf
                        <button type="submit" class="">ログアウト</button>
                    </form>
                </li>
            </ul>
        </li>
    </ul>
</nav>
<!-- アラート表示 -->
<x-alert/>