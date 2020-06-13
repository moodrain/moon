@extends('layout.app')
@section('title', 'Login')
@section('html')
    <div id="app">
        <el-row>
            <el-col :span="10" :offset="6">
                <el-card>
                    <el-form>
                        <x-input exp="model:form.username;pre:Username"></x-input>
                        <x-input exp="model:form.password;pre:Password;type:password"></x-input>
                        <el-form-item>
                            <el-button @click="login">Login</el-button>
                            <el-divider direction="vertical"></el-divider>
                            <el-link href="{{ url('register') }}">or Register</el-link>
                        </el-form-item>
                        @isset($msg)
                            <el-alert title="{{ $msg }}"></el-alert>
                        @endisset
                    </el-form>
                </el-card>
            </el-col>
        </el-row>
    </div>
@endsection

@section('js')
<script>
    new Vue({
        el: '#app',
        data() {
            return {
                form: {
                    username: '{{ $username ?? '' }}',
                    password: '',
                }
            }
        },
        methods: {
            login() {
                submit(this.form)
            }
        }
    })
</script>
@endsection