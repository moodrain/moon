@extends('layout.app')
@section('title', 'Register')
@section('html')
    <div id="app">
        <el-row>
            <el-col :span="10" :offset="6">
                <el-card>
                    <el-form>
                        <x-input exp="model:form.username;pre:Username"></x-input>
                        <x-input exp="model:form.password;pre:Password;type:password"></x-input>
                        <x-input exp="model:form.re_password;pre:RePassword;type:password"></x-input>
                        <el-form-item>
                            <el-button @click="register">Register</el-button>
                            <el-divider direction="vertical"></el-divider>
                            <el-link href="{{ url('login') }}">or Login</el-link>
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
                        re_password: '',
                    }
                }
            },
            methods: {
                register() {
                    submit(this.form)
                }
            }
        })
    </script>
@endsection