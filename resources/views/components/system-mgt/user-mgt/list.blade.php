<div class="scroll_wrap flex flex-grow overflow-scroll">
    <div class="table_parent_div bg-white overflow-x-auto overflow-y-auto border border-gray-600">
        <table class="text-sm block whitespace-nowrap">
            <thead>
                <tr class="text-cneter text-white bg-gray-600 sticky top-0">
                    <th class="font-thin py-3 px-2">拠点</th>
                    <th class="font-thin py-3 px-2">ユーザー名</th>
                    <th class="font-thin py-3 px-2">メールアドレス</th>
                    <th class="font-thin py-3 px-2">権限</th>
                    <th class="font-thin py-3 px-2">最終ログイン日時</th>
                    <th class="font-thin py-3 px-2">ステータス</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach($users as $user)
                    <tr class="text-left hover:bg-theme-sub cursor-default">
                        <td class="py-1 px-2 border">{{ $user->base->base_name }}</td>
                        <td class="py-1 px-2 border">{{ $user->last_name.' '.$user->first_name }}</td>
                        <td class="py-1 px-2 border">{{ $user->email }}</td>
                        <td class="py-1 px-2 border">{{ $user->dbs_role->role_name }}</td>
                        <td class="py-1 px-2 border text-center">{{ CarbonImmutable::parse($user->last_login_at)->isoFormat('YYYY年MM月DD日 HH時mm分ss秒') }}</td>
                        <td class="py-1 px-2 border text-center">{{ $user->status == '1' ? '有効' : '無効' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>