@extends('layout.app')

@section('html')
    <el-row id="app">
        <el-col :span="8" :offset="8">
            <br />
            <el-card>
                <br />
                <p>Greeting {{ $user->username }}</p>
                <el-divider></el-divider>
                <p>Last Logined at {{ $user->last_logined_at }}</p>
                <el-divider></el-divider>
                <el-button @click="logout">Logout</el-button>
            </el-card>
        </el-col>
    </el-row>
@endsection

@section('js')
<script>
new Vue({
    el: '#app',
    methods: {
        logout() {
            submit('{{ url('logout') }}')
        }
    }
})
</script>
@endsection