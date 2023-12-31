@vite(['resources/scss/navigation.scss'])

<nav id="navigation">
    <a href="{{ route('top.index') }}" class="logo">DBS</a>
    <ul class="links flex">
        <li class="dropdown"><a href="#" class="trigger-drop">収支登録</a></li>
        <li class="dropdown"><a href="#" class="trigger-drop">収支一覧</a></li>
        <li class="dropdown"><a href="#" class="trigger-drop">マスタ管理</a>
            <ul class="drop">
                <li><a href="{{ route('base.index') }}">拠点マスタ</a></li>
                <li><a href="{{ route('customer.index') }}">荷主マスタ</a></li>
            </ul>
        </li>
        <li class="dropdown"><a href="#" class="trigger-drop">設定</a>
            <ul class="drop">
                <li><a href="{{ route('sales_plan.index') }}">売上計画</a></li>
                <li><a href="{{ route('monthly_cost.index') }}">月額経費</a></li>
            </ul>
        </li>
        <li class="dropdown"><a href="#" class="trigger-drop">その他</a>
            <ul class="drop">
                <li><a href="">問い合わせ</a></li>
            </ul>
        </li>
        <li class="dropdown"><a href="#" class="trigger-drop">システム管理</a>
            <ul class="drop">
                <li><a href="">項目マスタ</a></li>
                <li><a href="">荷役マスタ</a></li>
                <li><a href="">ユーザーマスタ</a></li>
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